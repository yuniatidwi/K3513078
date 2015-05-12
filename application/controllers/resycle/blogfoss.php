<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blogfoss extends CI_Controller {

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
		$this->load->helper("url");	
	}

	public function index()
	{
		//echo "Latihan CI";
		$this->load->view("blogfoss/blog_awal");	
	}

	public function komentar()
	{
		echo "Latihan CI ini adalah komentar";
	}

	public function ambil($a = null,$b = null)
	{
		echo "\$a berisi ".$a." dan \$b berisi".$b;
	}

	public function blog_view($var = null)
	{
		$data['title'] = $var.'Ini judul';
		$data['body'] = $var."Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

		$this->load->view("blogfoss/blog_view", $data);	
	}
	public function simpan_view($var = null)
	{
		$data['title'] = $var.'Ini judul';
		$data['body'] = $var."Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

		$out = $this->load->view("blogfoss/blog_view", $data, true);
		echo $out;	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
