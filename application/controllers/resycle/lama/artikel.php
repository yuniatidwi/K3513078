<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artikel extends MY_Controller {

	public $data1;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function slug()
	{
		$segment2 = $this->uri->segment(2);
		echo "Uri 2 = ".$segment2;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */