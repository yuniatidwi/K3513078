<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("db_event","",TRUE);
	}

	public function preview($demo = null)
	{	
		$data['content'] = 'content/'.$demo;
		$this->load->view('template/master',$data);
	}

	public function kategori($nama = null)
	{
		if (empty($nama)) {
			$data['judul']='Ini judul dua';
			$data['isi'] = $this->db_event->kategori($nama);
			$this->load->view('view_isi',$data);
		} else {
			$data['title']='Kategori '.$nama;
			$data['content'] = 'content/home';
			$data['isi'] = $this->db_event->kategori($nama);
			$this->load->view('template/master',$data);
		}
	}

	public function index()
	{
		$data['judul']='Ini judul dua';
		$data['isi'] = $this->db_event->find_all();
		$this->load->view('view_isi',$data);
	}

	public function detail($id = null)
	{
		$data['judul']='Cari data '.$id;
		$data['isi'] = $this->db_event->find_by_id($id);
		$this->load->view('view_isi',$data);
	}
	
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */