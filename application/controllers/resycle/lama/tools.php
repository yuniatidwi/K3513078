<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('db_tools');
	}

	public function index()
	{
		$data['pesan_warning'] = 'Halaman yang anda cari tidak ada.';
		return $this->tampil_rekomendasi($data);
	}

	public function kota()
	{
		if (isset($_GET['q'])) {
			$q = $_GET['q'];
			$kota = $this->db_tools->get_kota($q);
			echo '<select name="kota" class="form-control m-bot15" required>';
			foreach ($kota as $data) {
				echo "<option value='".$data->ibu_kota."'>".$data->ibu_kota."</option>";
			}
			echo "</select>";
		}
	}
	public function kota_show()
	{
		if (isset($_GET['q'])) {
			$q = $_GET['q'];
			$data['kota'] = $this->db_tools->get_kota($q);
			return $this->load->view('tools/kota_show',$data);
		}
	}

	public function do_upload()
	{
		$directories = './image/';
		$config['upload_path'] = $directories;
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
			//resize image
						$make_width = 720;
						$lebar = $data['upload_data']['image_width'];
						$panjang = $data['upload_data']['image_height'];
						if ($lebar > $make_width) {
							$lebar_pem = $lebar / $make_width;
							$panjang = floor($panjang / $lebar_pem);
							echo $panjang;
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

			$this->load->view('coba/upload_success', $data);
		}
	}
	public function cek_event()
	{
		if (isset($_GET['e']) && isset($_GET['l'])) {
			$email = mysql_escape_string($_GET['e']);
			$link = mysql_escape_string($_GET['l']);

			$data = $this->db_tools->cek_event($email,$link);
			if (count($data)==0) {
				echo "<p><font color='red'>Event tidak tersedia</font></p>";
	    		echo "<font color='gray'>Tip : http://event.puskominfo.com/detail/<font color='red'>link_event.html</font> (masukkan link event hanya yang bertanda merah)</font>";
			} else {
				echo "<font color='green'>Event OK</font>";
			}
		} 
		
	}
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */