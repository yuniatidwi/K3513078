<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('mahasiswa_model','tools_model'));
		$this->load->helper(array('url'));
	}

	public function index()
	{
		$this->slug();
	}

	public function slug()
	{
		$uri = $this->uri->segment(2);
		switch ($uri) {
			//jika uri yang kedua adalah mahasiswa maka akan menjalankan fungsi tertentu
			case 'ceknim': $this->ceknim(); break;
			case 'getkota': $this->getkota(); break;
			default: redirect('','location'); break;
		}
	}

	private function getkota()
	{
		if (isset($_GET['q'])) {
			$kode_prov = $_GET['q'];
			$data_provinsi = $this->tools_model->getkota($kode_prov);
			echo '<select name="kota" class="form-control" required>';
			foreach ($data_provinsi as $data) {
				echo "<option value='".$data->kode_kota."'>".$data->ibu_kota."</option>";
			}
			echo '</select>';
		}
	}

	private function ceknim()
	{
		if (isset($_GET['nim'])) {
			$nim = $_GET['nim'];
			$data_mahasiswa = $this->mahasiswa_model->select($nim);
			if (count($data_mahasiswa) == 0) {
				echo "<font color='green'>NIM OK...</font>";
			} else echo "<font color='red'>NIM $nim sudah digunakan</font>";
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */