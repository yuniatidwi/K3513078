<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Percobaan extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		//echo "Hello world, this session mode";
		if (isset($_GET['session'])) {
			$newdata = array('username'  => 'anni','name'=> 'John Doe','email' => 'johndoe@gmail.com');
			$this->session->set_userdata($newdata);
		}

		print_r($this->session->all_userdata());
		$user = $this->session->userdata('username');
		echo $user;
		if (empty($user)) {
			echo 'tak ada';
		} else echo 'ada';
	}
	public function destroy_session()
	{
		$this->session->sess_destroy();
		return $this->show_page();
	}
	public function is_logged_in()
	{
		$user = $this->session->userdata('username');
		if (empty($user)) {
			redirect('/login','location');
		} else return TRUE;
	}
	public function alert()
	{
		$data['content'] = 'content/home';
		$data['alert']['success'] = 'Ini isi alert danger';

		$data['alert']['danger'] = 'Ini isi alert danger';
		$data['alert']['success'][0] = 'Ini isi alert duja';
		//array_push(array, var)
		return $this->show_page($data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */