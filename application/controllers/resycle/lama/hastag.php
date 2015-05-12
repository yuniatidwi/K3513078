<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hastag extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('db_event','db_sidebar');
	}

	public function slug()
	{
		$nama_hastag = $this->uri->segment(2);
		//tinggal sampai halaman sini
		if (empty($nama_hastag)) {
			$data['title'] = 'Rekomendasi';
			$data['pesan_warning']='Anda belum memilih hastag event. Pilih rekomendasi event dibawah ini.';
			return $this->tampil_rekomendasi($data);
		} else {
			/* Skenario
			- kumpulin semua hastag yang ada, terus dijadiin array
			- key nya dijadiin array, kalo ada akan ada inisialisasi status, kalo enggak not found
			*/
			$hastag_available = $this->db_sidebar->get_data_hastag();
			$hastag = array();
			$key = $nama_hastag;
			foreach ($hastag_available as $hastag_available1) { $hastag[]= $hastag_available1; }
			for ($i=0; $i <= count($hastag)-1; $i++) { if ($key == $hastag[$i]) { $status = 'available';}}
			if (isset($status)) {
				$this->load->model('db_event');
				$data['title']='Hastag #'.$nama_hastag;
				$data['nama_hastag'] = $nama_hastag;
				$data['hastag_show']=$this->db_event->hastag_show($nama_hastag);
				$data['content'] = 'content/hastag';
				return $this->tampil_halaman($data);
			}else{
				$data['title'] = 'Not Found';
				$data['pesan_warning']='Hastag #'.$nama_hastag.' Tidak ada dalam database. Pilih rekomendasi event dibawah ini.';
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