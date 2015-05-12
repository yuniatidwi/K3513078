<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coba extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("db_coba","",TRUE);
	}

	public function index()
	{
		$data['judul']='Ini judul';
		$data['isi'] = $this->db_coba->find_all();
		$this->load->view('view_isi',$data);
	}
	public function cari($id = null)
	{
		$data['judul']='Cari data '.$id;
		$data['isi'] = $this->db_coba->find_by_id($id);
		$this->load->view('view_isi',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */