<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url',"form"));
	}
	public function index()
	{
		$this->load->view('home');
	}
	public function input()
	{
		$this->load->view('input_siswa');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */