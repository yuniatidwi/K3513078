<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class logout extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}
	public function slug()
	{
		$this->session->sess_destroy();
		//jika session dihapus maka akan terlempar ke halamam login
		redirect('/login','location');
	}
	public function index()
	{
		$this->slug();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */