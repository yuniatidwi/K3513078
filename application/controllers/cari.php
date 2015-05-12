<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cari extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url',"form"));
		$this->load->model(array('mahasiswa_model'));
		$this->load->library(array('table'));
	}
	public function index()
	{
		//ambil data get
		if (isset($_GET['q'])) {
			$q = $_GET['q'];
			$data['alert']['success'] = 'Menampilkan data pencarian "'.$q.'"';
			return $this->generate_table_mahasiswa($data, $q);
		} redirect('/mahasiswa/lihat','location');
	}

	//generating all data mahasiswa
	private function generate_table_mahasiswa($data = null,$q)
	{
		$cari_mahasiswa = $this->mahasiswa_model->mahasiswa_cari($q);
		//generate table
		$template = array( 'table_open'          => '<table class="table table-bordered">');
		$this->table->set_template($template);
		$this->table->set_heading('NIM', 'NAMA', 'ALAMAT','NO HP','Action');
		foreach ($cari_mahasiswa as $mahasiswa) {
			$this->table->add_row($mahasiswa->nim, 
									$mahasiswa->nama, 
									$mahasiswa->ibu_kota,
									$mahasiswa->telepon, 
									anchor('mahasiswa/print/'.$mahasiswa->nim, 'Print', 'target="blank"').' | '.
									anchor('mahasiswa/edit/'.$mahasiswa->nim, 'Edit').' | '.
									anchor('mahasiswa/delete/'.$mahasiswa->nim, 'Delete', 'onclick="return konfirmasi()"'));
		}
		$data['table_data_mahasiswa'] = $this->table->generate();
		//end generate
		$data['content'] = 'content/mahasiswa/lihat';
		//array_push(array, var)
		return $this->show_page($data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */