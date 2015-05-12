<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_event extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('db_event','db_my_event'));
	}
	public function slug($data = null)
	{
		$pesan = 'Isi data dengan benar';
		if (isset($_GET['session']) && isset($_POST['jawaban']) && isset($_GET['submit'])) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('link', 'Link event', 'required');
			$this->form_validation->set_rules('code', 'Kode event', 'required|exact_length[6]');
			if (($this->form_validation->run() == TRUE) && $_GET['session'] == md5($_POST['jawaban'])) {
				//check avability event
				$email = $this->input->post('email');
				$link = $this->input->post('link');
				$code = $this->input->post('code');
				$event = $this->db_my_event->cek_event_kepemilikan($email,$link,$code);
				if (count($event) == 0) {
					$pesan = 'Tidak ada event dengan data yang dimasukkan, coba lagi.';return $this->show_form($pesan);
				} else {
					//make session 
					session_start();
					$_SESSION['session'] = $_GET['session'];
					$_SESSION['email'] = $email;
					$_SESSION['link'] = $link;
					$_SESSION['code'] = $code;
					//echo $_SESSION['code'].'  => '.$_SESSION['email'].'  => '.$_SESSION['link'].'  => '.$_SESSION['code'];
					return $this->do_view_event();
				}
			}else $pesan = 'kode verifikasi salah'; return $this->show_form($pesan);
		}elseif (isset($_GET['session']) && isset($_GET['view'])) {
			session_start();
			if (isset($_SESSION['session'])) {
				if ($_SESSION['session'] == $_GET['session']) {
					return $this->do_view_event();
					//deleted
				}
			}
		}elseif (isset($_GET['session']) && isset($_GET['replace_image']) && isset($_POST)) {
			session_start();
			if (isset($_SESSION['session'])) {
				if ($_SESSION['session'] == $_GET['session']) {
					//upload image
					$dir_image = './image/event/';
					$config['upload_path'] = $dir_image;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('gambar')){
						//$error = array('error' => $this->upload->display_errors());
						$data['pesan_warning'] = 'terjadi kelasalahan dalam pengunggahan gambar, pastikan gambar yang dimasukkan bertipe jpg, png, gif atau jpeg.';
						
						//return $this->load->view('coba/upload_form', $error);
						//return $this->do_view_event($data);
						//$this->load->view('coba/upload_form', $error);
					}
					else {
						$data = array('upload_data' => $this->upload->data());
						$input_data['gambar_url'] =  $dir_image.$data['upload_data']['file_name']; // url gambar to database
						$input_data['link'] = $_SESSION['link']; 
						$input_data['email'] = $_SESSION['email'];
						$input_data['code'] = $_SESSION['code'];
						$this->db_my_event->update_image($input_data);
						//resize image
						$directories = $dir_image;
						$make_width = 720;
						$lebar = $data['upload_data']['image_width'];
						$panjang = $data['upload_data']['image_height'];
						if ($lebar > $make_width) {
							$lebar_pem = $lebar / $make_width;
							$panjang = floor($panjang / $lebar_pem);
							$this->load->library('image_lib');
							$config['image_library'] = 'gd2';
							$config['source_image']	= $directories.$data['upload_data']['file_name'];
							$config['create_thumb'] = TRUE;
							$config['maintain_ratio'] = TRUE;
							$config['width']	= $make_width;
							$config['height']	= $panjang;
							$this->image_lib->clear();
							$this->image_lib->initialize($config);
							$this->image_lib->resize();
							if ( ! $this->image_lib->resize())
							{
							    echo $this->image_lib->display_errors();
							} else {
								$oldname = $directories.$data['upload_data']['raw_name'].'_thumb'.$data['upload_data']['file_ext'];
								$newname = $directories.$data['upload_data']['raw_name'].$data['upload_data']['file_ext'];
								rename($oldname, $newname);
							}
						}
						$data['pesan_success'] = 'Gambar berhasil diupdate';
					}
					return $this->do_view_event($data);
				}
			}
		}elseif (isset($_GET['session']) && isset($_GET['delete'])) {
			session_start();
			if (isset($_SESSION['session'])) {
				if ($_SESSION['session'] == $_GET['session']) {
					return $this->do_delete_event();
					//deleted
				}
			}
		}elseif (isset($_GET['session']) && isset($_GET['edit'])) {
			session_start();
			if (isset($_SESSION['session'])) {
				if ($_SESSION['session'] == $_GET['session']) {
					return $this->do_edit_event();
					//edited
				}
			}
		}else $pesan = 'Isi data dengan benar'; return $this->show_form($pesan); 
	}
	//complete mode
	public function do_view_event($data = null)
	{
		$email = $_SESSION['email'];
		$link = $_SESSION['link'];
		$code = $_SESSION['code'];
		$data['session'] = $_SESSION['session'];
		//show query for show full event
		//reduplicate with detail
		$cek_id_event =  $this->db_event->cek_event($link);
		foreach ($cek_id_event as $data_event) {}
		if (empty($data_event->id)) {
			$data['title'] = 'Not Found';
			$data['pesan_warning']='Event yang anda pilih tidak ada. Pilih rekomendasi event dibawah ini.';
			return $this->tampil_rekomendasi($data);
		} else {
			$data['data_terkait'] = $this->db_event->show_terkait($data_event->link, $data_event->kategori_id, $data_event->area);
			$data['title'] = $data_event->nama;
			$data['gambar_url'] = $data_event->gambar_url;
			$data['nama_event'] = $data_event->nama;
			$data['view_event'] = $data_event->view;
			$data['mulai_event'] = $data_event->mulai;
			$data['selesai_event'] = $data_event->selesai;
			$data['post_date_event'] = $data_event->post_date;
			$data['nama_publisher_event'] = $data_event->pub_name;
			$data['content'] = 'content/my_event/my_event_detail';
			return $this->tampil_halaman($data);
		}
	}
	public function do_delete_event()
	{
		$email = $_SESSION['email'];
		$link = $_SESSION['link'];
		$code = $_SESSION['code'];
		$this->db_my_event->delete_event($email,$link,$code);
		session_destroy();

		$data['show_today_event'] = false;
		$data['title'] = 'Event berhasil di hapus';
		$data['content'] = 'content/my_event/delete_ok';
		return $this->tampil_halaman($data);
	}
	public function slug67g()
	{
		session_start();
		echo $_SESSION['session'].'  =>  '.$_SESSION['code'].'  => '.$_SESSION['email'].'  => '.$_SESSION['link'].'  => '.$_SESSION['code'];
	}
	public function show_form($pesan = null)
	{
		if ($pesan <> null) {
			$data['pesan_warning'] = $pesan;
		}

		$data['show_today_event'] = false;
		//create random math for question
		$a = rand(10,97);
		$b = rand(5,32);
		$c = $a + $b;
		$data['question'] = $a.' + '.$b.' = ';
		$data['session'] = md5($c);
		$data['title'] = "My Event";
		$data['content'] = 'content/my_event/my_event';
		return $this->tampil_halaman($data);
	}
	public function index()
	{
		$this->slug();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */