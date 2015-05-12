<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}
	//hanya bisa dipanggil ketika ada public funtion yang memangging fungsi show page ini
	protected function show_page($data)
	{
		//cek sudah login atau belum
		$this->is_logged_in();
		//load the configuration function
		$configuration = $this->general_conf();
		foreach ($configuration as $conf => $value) {$data[$conf] = $value;}
		$this->load->view('template/master',$data);
	}
	//hanya bisa dipanggil oleh class yang berada di rumahnya
	//konfigurasi dasar websitenya
	private function general_conf()
	{
		$data['conf_title'] = 'FOSS Ci - Septiancheepy.esy.es';
		$data['conf_nama'] = 'Septian Nugroho';
		$data['conf_nim'] = 'K3513064';
		$data['conf_prodi'] = 'PTIK 2013 Sem. 3 FKIP UNS';
		$data['conf_facebook'] = 'http://facebook.com/septian.cheepy';
		$data['conf_twitter'] = 'http://twitter.com/septiancheepy';
		$data['conf_google_plus'] = '#';
		return $data;
	}
	//cek status user
	private function is_logged_in()
	{
		$user = $this->session->userdata('username');
		if (empty($user)) {
			redirect('/login?warning','location'); 
			return false;
		} else return true;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */