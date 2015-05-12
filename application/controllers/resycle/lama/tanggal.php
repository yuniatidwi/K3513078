<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tanggal extends MY_Controller {

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
		$this->load->model('db_event');
	}

	public function slug()
	{
		$tanggal_date = $this->uri->segment(2);
		if(preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $tanggal_date)) {
			$data['title']='Tanggal '.$tanggal_date;
			$data['tanggal_date'] = $tanggal_date;
			$data['tanggal_show']=$this->db_event->tanggal_show($tanggal_date);
			$data['content'] = 'content/tanggal';
			return $this->tampil_halaman($data);
		}
		if (empty($tanggal_date)) {
			$data['title'] = 'Rekomendasi';
			$data['pesan_warning']='Anda belum memilih tanggal event. Pilih rekomendasi event dibawah ini.';
			return $this->tampil_rekomendasi($data);
		} else {
			$data['title'] = 'Rekomendasi';
			$data['pesan_warning']='Format tanggal salah, harus YYYY-MM-DD. Pilih rekomendasi event dibawah ini.';
			return $this->tampil_rekomendasi($data);
		}
	}

	public function index()
	{
		return $this->slug();
	}
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */