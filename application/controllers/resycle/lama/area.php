<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Area extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('db_event','db_tools'));
	}

	public function slug()
	{
		$nama_area = $this->uri->segment(2);
		//tinggal sampai halaman sini
		if (empty($nama_area)) {
			$data['title'] = 'Cari area';
			$data['pesan_warning']='Pilih area kota yang ada di Indonesia';
			$data['data_provinsi'] = $this->db_tools->get_provinsi();
			$data['content'] = 'content/area_cari';
			return $this->tampil_halaman($data);
		} else {
			/* Skenario
			- kumpulin semua area yang ada, terus dijadiin array
			- key nya dijadiin array, kalo ada akan ada inisialisasi status, kalo enggak not found
			*/
			$area_available = $this->db_event->get_data_area();
			$area = array();
			$nama_area = str_replace("%20", " ", $nama_area);
			$key = $nama_area;
			foreach ($area_available as $area_available1) { $area[] =  $area_available1->area;}
			for ($i=0; $i <= count($area)-1; $i++) { if ($key == $area[$i]) { $status = 'available';}}
			if (isset($status)) {
				$this->load->model('db_event');
				$data['title']='Area '.$nama_area;
				$data['nama_area'] = $nama_area;
				$data['area_show']=$this->db_event->area_show($nama_area);
				$data['content'] = 'content/area';
				return $this->tampil_halaman($data); 
			}else{
				$data['title'] = 'Tidak ada';
				$data['pesan_warning']='Tidak ada event di  '.$nama_area.'. Pilih rekomendasi event dibawah ini.';
				return $this->tampil_rekomendasi($data);
			}
		}
	}

	public function index()
	{
		return $this->slug();
	}
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */