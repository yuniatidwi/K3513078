<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori extends MY_Controller {

	/**
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('db_event', 'db_sidebar'));
	}

	public function slug()
	{
		$nama = $this->uri->segment(2);
		if (empty($nama)) {
			$data['title']='Pilih kategori';
			$data['pesan_warning']='Anda belum memilih kategori event, pilih kategori dibawah ini.';
			$data['kategori_list']= $this->db_event->kategori_list();
			$data['content'] = 'content/kategori_pilih';
		} else {
			$kategori_available = $this->db_sidebar->get_data_kategori();
			$kategori = array();
			$nama = str_replace('%20', ' ', $nama);
			$key = $nama;
			foreach ($kategori_available as $kategori_available1) { $kategori[]= $kategori_available1->kategori; }
			for ($i=0; $i <= count($kategori)-1; $i++) { if ($key == $kategori[$i]) { $status = 'available';}}
			if (isset($status)) {
				
				$data['title']='Kategori '.$nama;
				$data['content'] = 'content/kategori';
				$data['nama_kategori'] = $nama;
				$data['kategori_show']=$this->db_event->kategori_show($nama);
			} else {
				$data['title']='Not Found';
				$data['pesan_warning']='Kategori '.$nama.' tidak ditemukan, pilih kategori dibawah ini.';
				$data['kategori_list']= $this->db_event->kategori_list();
				$data['content'] = 'content/kategori_pilih';
			}
			
		}
		return $this->tampil_halaman($data);
	}
	public function index()
	{
		return $this->slug();
	}
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */