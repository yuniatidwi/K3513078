<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('table'));
		$this->load->helper(array('url',"form"));
		$this->load->model(array('siswa_model'));
	}
	public function input()
	{
		if (isset($_POST['submit'])) {
			$data['nama'] = $this->input->post('nama', TRUE);
			$data['alamat'] = $this->input->post('alamat', TRUE);
			$data['jenis_kelamin'] = $this->input->post('jenis_kelamin', TRUE);
			$data['tanggal_lahir'] = $this->input->post('tanggal_lahir', TRUE);
			$this->siswa_model->input($data);
		}
		$this->load->view('input_siswa', $data);
	}
	public function cetak_semua()
	{
		$siswas = $this->siswa_model->get_paged_list()->result();
		$this->table->set_empty('&nbsp;');
		$this->table->set_heading('No','Nama','Alamat','Jenis Kelmain','Tanggal lahir','Detail');
		$i =0;
		foreach ($siswas as $siswa ) {
			$this->table->add_row(++$i,
			$siswa->nama,
			$siswa->alamat,
			$siswa->jenis_kelamin,
			$siswa->tanggal_lahir,
			anchor('siswa/cetak_detail/'.$siswa->id,"Detail")
				);
		}
		$data['table'] = $this->table->generate();
		$this->load->view('siswa_list',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */