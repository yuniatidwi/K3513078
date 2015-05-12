<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function slug()
	{
		if ($this->is_logged_in() == true) {
			redirect('/home','location');
		}elseif (isset($_POST['submit'])) {
			$nim = strtoupper($_POST['nim']);
			if ($nim == 'K3513064') {
				//jika sama, maka akan meng generate session dan akan redirect
				$newdata = array('username'  => 'anni','name'=> 'John Doe','email' => 'johndoe@gmail.com');
				$this->session->set_userdata($newdata);
				redirect('/login','location');
			} else redirect('/login?fail','location');
		}
		$this->load->view('content/login');
	}

	public function index()
	{
		return $this->slug();
	}

	//hanya bisa dipanggil oleh class yang berada di rumahnya
	private function is_logged_in()
	{
		$user = $this->session->userdata('username');
		if (!empty($user)) {
			return true;
		} else return false;
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */