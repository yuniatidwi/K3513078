<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Submit extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('db_event','db_tools'));
	}

	public function slug()
	{	
		//nothing session detected
		if (isset($_GET['session']) && isset($_GET['submit'])) {
			if (isset($_POST['submit'])) {
				$this->load->library('form_validation');
				$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|max_length[100]');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				$this->form_validation->set_rules('judul', 'Judul event', 'required|max_length[200]');
				$this->form_validation->set_rules('tempat', 'Tempat event', 'required|max_length[200]');
				$this->form_validation->set_rules('alamat', 'Alamat event', 'required|max_length[200]');
				$this->form_validation->set_rules('kota', 'Kota event', 'required|alpha|max_length[100]');
				$this->form_validation->set_rules('mulai_date', 'Tanggal mulai event', 'required|max_length[20]');
				$this->form_validation->set_rules('mulai_time', 'Waktu mulai event', 'required|max_length[20]');
				$this->form_validation->set_rules('selesai_date', 'Tanggal selesai event', 'required|max_length[20]');
				$this->form_validation->set_rules('selesai_time', 'Waktu selesai event', 'required|max_length[20]');
				$this->form_validation->set_rules('deskripsi', 'Deskripsi event', 'required|max_length[500]');
				$this->form_validation->set_rules('detail', 'Detail event', 'required');
				$this->form_validation->set_rules('kategori', 'Kategori event', 'required');
				$this->form_validation->set_rules('hastag', 'Hastag event', 'required');
				$this->form_validation->set_rules('jawaban', 'Kode verifikasi','required|integer');
				$this->form_validation->set_rules('price', 'HTM event','required|integer');
				if (($this->form_validation->run() == TRUE) && ($_GET['session'] == md5($_POST['jawaban']))) {
					//upload image
					$dir_image = 'image/event/';
					$config['upload_path'] = './'.$dir_image;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('gambar')){
						$error = array('error' => $this->upload->display_errors());
						$pesan = 'terjadi kelasalahan dalam pengunggahan gambar, pastikan gambar yang dimasukkan bertipe jpg, png, gif atau jpeg.';
						return $this->tampil_form($pesan);
						//$this->load->view('coba/upload_form', $error);
					}
					else {
						$data = array('upload_data' => $this->upload->data());

						//setting for initialize
						$mulai = $this->input->post('mulai_date')." ".$this->input->post('mulai_time');
						$selesai = $this->input->post('selesai_date')." ".$this->input->post('selesai_time');
						//generating code
						$code = '';
						for ($i=1; $i <= 6; $i++) { 
							$a = rand(1,2);
							if ($a == 1) {
								//1 = huruf
								//$code = $code.rand('a','z');
								$code = $code.substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", 2)), 0, 1);
							}
							if ($a == 2) {
								//2 = nomor
								$code = $code.rand(0,9);
							}
						}
						$code = strtoupper($code);
						$data['code'] = $code;
						//*end generating

						//generate links
						$judul = $this->input->post('judul');
						$link = strtolower(preg_replace("/[^A-Za-z0-9]/", '_', $judul));
						//checklink
						$link_html = $link.'.html';
						$check = $this->db_event->check_link($link_html);
						//echo $link_html;
						//echo count($check);
						if (count($check)>0) {
							//echo "dicek lagi";
							$jum = 2;
							for ($i=1; $i <= $jum ; $i++) { 
								$link_html2 = $link.'_'.$i.'.html';
								//echo count($check);
								$check = $this->db_event->check_link($link_html2);
								if (count($check)>0) {
									$jum++;
								} else {
									$link_html = $link.'_'.($i-1).'.html';
								}
							}
						}
						//generating link end

						//generating hastag
						$kata2= $this->input->post('hastag');
						$kata2=preg_replace("/[^A-Za-z0-9,]/", ' ', $kata2);
						$kata2=strtolower($kata2);
						$kata2=trim($kata2);
						$kata2=str_replace(", ",",",$kata2);
						$kata2=str_replace(" ,",",",$kata2);
						$kata2=str_replace(" ","_",$kata2);
						$hastag_fix =  $kata2; //simpan ke database $kata2, will receive event,2015.feef_dfe
						

						$input_data['pub_name'] = $this->input->post('nama');
						$input_data['email'] = $this->input->post('email');
						$input_data['code'] = $code;
						$input_data['status'] = 'aktif';
						$input_data['view'] = 0;
						$input_data['post_date'] = date("Y-m-d");
						$input_data['link'] = $link_html;
						$input_data['rev_by'] = 'otomatis';
						$input_data['gambar_url'] =  $dir_image.$data['upload_data']['file_name']; // url gambar to database
						$input_data['nama'] = $judul;
						$input_data['area'] = $this->input->post('kota');
						$input_data['mulai'] = $mulai;
						$input_data['selesai'] = $selesai;
						$input_data['tempat'] = $this->input->post('tempat');
						$input_data['alamat'] = $this->input->post('alamat');
						$input_data['kategori'] = $this->input->post('kategori');
						$input_data['hastag'] = $hastag_fix;
						$input_data['deskripsi_singkat'] = $this->input->post('deskripsi');
						$input_data['deskripsi'] = $this->input->post('detail');
						$input_data['longitude'] = '';
						$input_data['latitude'] = '';
						$input_data['price'] = $this->input->post('price'); 
						$input_data['website'] = $this->input->post('website');
						$input_data['facebook'] = $this->input->post('facebook');
						$input_data['twitter'] = $this->input->post('twitter'); 
						$this->db_event->make_event($input_data);

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

						$data['code'] = $code;
						$data['link_event'] = $link_html;
						return $this->tampil_submit_ok($data);
					}
				} else $pesan = 'Sekuruti salah atau ada data yang tidak valid.'; return $this->tampil_form($pesan);
			} else $pesan = 'Kamu harus mengisi form terlebih dahulu'; return $this->tampil_form($pesan);
		} else return $this->tampil_form();
	}

	function do_upload()
	{
		$config['upload_path'] = './image/';
		$config['allowed_types'] = 'gif|jpg|png';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('coba/upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->load->view('coba/upload_success', $data);
		}
	}

	function tampil_submit_ok($data)
	{
		$data['show_today_event'] = false;
		$data['title'] = 'Submit Done';
		$data['content'] = 'content/submit_ok';
		$this->tampil_halaman($data);
	}

	function tampil_form($pesan = null)
	{
		//create new session to submit event
		if ($pesan <> null) {
			$data['pesan_warning'] = $pesan;
		}
		$data['show_today_event'] = false;
		$data['data_provinsi'] = $this->db_tools->get_provinsi();
		$data['data_kategori_submit'] = $this->db_tools->get_kategori();
		//create random math for question
		$a = rand(10,97);
		$b = rand(5,32);
		$c = $a + $b;
		$data['question'] = $a.' + '.$b.' = ';
		$data['session'] = md5($c);

		$data['title'] = 'Submit Event';
		$data['content'] = 'content/submit';
		$this->tampil_halaman($data);
	}

	public function index()
	{
		return $this->slug();
	}
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */