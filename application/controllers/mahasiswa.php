<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('mahasiswa_model'));
		$this->load->library(array('form_validation','table'));
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
			case 'lihat': $this->lihat_mahasiswa(); break;
			case 'input': $this->input_mahasiswa(); break;
			case 'delete': $this->delete_mahasiswa(); break;
			case 'print': $this->print_mahasiswa(); break;
			case 'edit': $this->edit_mahasiswa(); break;
			default: redirect('mahasiswa/lihat','location'); break;
		}
	}

	private function lihat_mahasiswa()
	{
		$data['alert']['success'] = 'Data semua mahasiswa.';
		return $this->generate_table_mahasiswa($data);
	}

	private function input_mahasiswa()
	{
		if (isset($_POST['submit'])) {
			//cek data if exist
			$nim = $this->input->post('nim');
			$data_mahasiswa = $this->mahasiswa_model->select($nim);
			if (count($data_mahasiswa) == 1) {
				$data['alert']['danger'] = 'Nim sudah digunakan, inputkan data lagi dengan nim yang berbeda';
			} else{
				//validasi dulu
				$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[100]');
				$this->form_validation->set_rules('tempat_lahir', 'Tempat lahir', 'required|max_length[100]');
				$this->form_validation->set_rules('tanggal_lahir', 'Nama', 'required|max_length[100]');
				$this->form_validation->set_rules('gender', 'Nama', 'required|alpha');
				$this->form_validation->set_rules('gol_dar', 'Nama', 'required|alpha_dash');
				$this->form_validation->set_rules('agama', 'Nama', 'required|alpha');
				$this->form_validation->set_rules('hobi', 'Nama', 'required|max_length[100]');
				$this->form_validation->set_rules('alamat', 'Nama', 'required');
				$this->form_validation->set_rules('kota', 'Nama', 'required');
				$this->form_validation->set_rules('kodepos', 'Nama', 'required|is_natural');
				$this->form_validation->set_rules('telepon', 'Nama', 'required|is_natural');
				$this->form_validation->set_rules('email', 'Nama', 'required|valid_email');
				if ($this->form_validation->run() == TRUE) {
					$set['nim'] = $this->input->post('nim');
					$set['nama'] = $this->input->post('nama');
					$set['tempat_lahir'] = $this->input->post('tempat_lahir');
					$set['tanggal_lahir'] = $this->input->post('tanggal_lahir');
					$set['gender'] = $this->input->post('gender');
					$set['gol_dar'] = $this->input->post('gol_dar');
					$set['agama'] = $this->input->post('agama');
					$set['hobi'] = $this->input->post('hobi');
					$set['alamat'] = $this->input->post('alamat');
					$set['provinsi'] = $this->input->post('provinsi');
					$set['kota'] = $this->input->post('kota');
					$set['kodepos'] = $this->input->post('kodepos');
					$set['telepon'] = $this->input->post('telepon');
					$set['email'] = $this->input->post('email');
					if (($this->input->post('masuk_1') != '') && ($this->input->post('lulus_1') != '') && ($this->input->post('institusi_1') != '')) {
                        $set['pendidikan_1'] = $this->input->post('masuk_1').' - '.$this->input->post('lulus_1').' : '.$this->input->post('institusi_1');
                    }
                    if (($this->input->post('masuk_2') != '') && ($this->input->post('lulus_2') != '') && ($this->input->post('institusi_1') != '')) {
                        $set['pendidikan_2'] = $this->input->post('masuk_2').' - '.$this->input->post('lulus_2').' : '.$this->input->post('institusi_2');
                    }
                    if (($this->input->post('masuk_3') != '') && ($this->input->post('lulus_3') != '') && ($this->input->post('institusi_1') != '')) {
                        $set['pendidikan_3'] = $this->input->post('masuk_3').' - '.$this->input->post('lulus_3').' : '.$this->input->post('institusi_3');
                    }
                    $insert = $this->mahasiswa_model->insert_mahasiswa($set);
                    $data['alert']['success'] = 'Data berhasil ditambahkan (<strong>'.$nim.'</strong>)<a href="'. base_url().'mahasiswa/lihat">Lihat daftar mahasiswa</a>';
                    
				}else $data['alert']['danger'] = 'Ada kesalahan dalam menginputkan data.';
			}
		}
		$data['content'] = 'content/mahasiswa/input';
		//array_push(array, var)
		return $this->show_page($data);
	}

	private function delete_mahasiswa()
	{
		//localhost/mahasiswa/delete/this location
		$nim = $this->uri->segment(3);
		if ($nim == "") {
			$data['alert']['warning'] = 'Data tidak ditemukan';
		} else {
			$data_mahasiswa = $this->mahasiswa_model->select($nim);
			if (count($data_mahasiswa) == 1) {
				$this->mahasiswa_model->delete($nim);
				$data['alert']['success'] = 'Data berhasil dihapus';
			} else $data['alert']['danger'] = 'Tidak ada data dengan nim '.$nim;
		}
		//menampilkan semua data mahasiswa dalam bentuk tabel
		return $this->generate_table_mahasiswa($data);
	}

	private function print_mahasiswa()
	{
		//localhost/mahasiswa/print/this location
		$nim = $this->uri->segment(3);
		if ($nim == "") {
			$data['alert']['danger'] = 'Data tidak ditemukan';
		} else {
			$data_mahasiswa = $this->mahasiswa_model->select($nim);
			if (count($data_mahasiswa) == 1) {
				$data['data_lengkap_mahasiswa'] = $this->mahasiswa_model->select($nim);
				$this->load->helper(array('fpdf','konversi'));
				$this->load->view('content/mahasiswa/print',$data);
				return false;
			} else $data['alert']['danger'] = 'Tidak ada data dengan nim '.$nim;
		}
		//menampilkan semua data mahasiswa dalam bentuk tabel
		return $this->generate_table_mahasiswa($data);
	}

	private function edit_mahasiswa()
	{
		//localhost/mahasiswa/print/this location
		$nim = $this->uri->segment(3);
		if (isset($_POST['submit'])) {
			//cek data if exist
			$data_mahasiswa = $this->mahasiswa_model->select($nim);
			if (count($data_mahasiswa) == 1) {
				//validasi dulu
				$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[100]');
				$this->form_validation->set_rules('tempat_lahir', 'Tempat lahir', 'required|max_length[100]');
				$this->form_validation->set_rules('tanggal_lahir', 'Tanggal lahir', 'required|max_length[100]');
				$this->form_validation->set_rules('gender', 'Gender', 'required|alpha');
				$this->form_validation->set_rules('gol_dar', 'Golongan darah', 'required|alpha_dash');
				$this->form_validation->set_rules('agama', 'Agama', 'required|alpha');
				$this->form_validation->set_rules('hobi', 'Hobi', 'required|max_length[100]');
				$this->form_validation->set_rules('alamat', 'Alamat', 'required');
				$this->form_validation->set_rules('kota', 'Kota', '');
				$this->form_validation->set_rules('kodepos', 'Kodepos', 'required|is_natural');
				$this->form_validation->set_rules('telepon', 'Telepon', 'required|is_natural');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				if ($this->form_validation->run() == TRUE) {
					$nim = $this->input->post('nim');
					$set['nama'] = $this->input->post('nama');
					$set['tempat_lahir'] = $this->input->post('tempat_lahir');
					$set['tanggal_lahir'] = $this->input->post('tanggal_lahir');
					$set['gender'] = $this->input->post('gender');
					$set['gol_dar'] = $this->input->post('gol_dar');
					$set['agama'] = $this->input->post('agama');
					$set['hobi'] = $this->input->post('hobi');
					$set['alamat'] = $this->input->post('alamat');
					if (isset($_POST['kota'])) {
						$set['kota'] = $this->input->post('kota');
						$set['provinsi'] = $this->input->post('provinsi');
					}
					$set['kodepos'] = $this->input->post('kodepos');
					$set['telepon'] = $this->input->post('telepon');
					$set['email'] = $this->input->post('email');
					if (($this->input->post('masuk_1') != '') && ($this->input->post('lulus_1') != '') && ($this->input->post('institusi_1') != '')) {
                        $set['pendidikan_1'] = $this->input->post('masuk_1').' - '.$this->input->post('lulus_1').' : '.$this->input->post('institusi_1');
                    }
                    if (($this->input->post('masuk_2') != '') && ($this->input->post('lulus_2') != '') && ($this->input->post('institusi_1') != '')) {
                        $set['pendidikan_2'] = $this->input->post('masuk_2').' - '.$this->input->post('lulus_2').' : '.$this->input->post('institusi_2');
                    }
                    if (($this->input->post('masuk_3') != '') && ($this->input->post('lulus_3') != '') && ($this->input->post('institusi_1') != '')) {
                        $set['pendidikan_3'] = $this->input->post('masuk_3').' - '.$this->input->post('lulus_3').' : '.$this->input->post('institusi_3');
                    }
                    $update = $this->mahasiswa_model->update_mahasiswa($nim, $set);
                    $data['alert']['success'] = 'Data berhasil diedit (<strong>'.$nim.'</strong>). <a href="'. base_url().'mahasiswa/lihat">Lihat daftar mahasiswa</a>';
                    
				}
				// masukkan data mahasiswa disini
			} else $data['alert']['danger'] = 'Nim tidak sitemukan';
		}
		if ($nim == "") {
			$data['alert']['warning'] = 'Data tidak ditemukan';
		} else {
			$data_mahasiswa = $this->mahasiswa_model->select($nim);
			if (count($data_mahasiswa) == 1) {
				$data['data_lengkap_mahasiswa'] = $this->mahasiswa_model->select($nim);
				$data['content'] = 'content/mahasiswa/edit';
				return $this->show_page($data);
			} else $data['alert']['danger'] = 'Tidak ada data dengan nim '.$nim;
		}
		redirect('/mahasiswa/lihat','location');
	}	
	
	//generating all data mahasiswa
	private function generate_table_mahasiswa($data = null)
	{
		$semua_mahasiswa = $this->mahasiswa_model->mahasiswa_all();
		//generate table
		$template = array( 'table_open'          => '<table class="table table-bordered">');
		$this->table->set_template($template);

		$this->table->set_heading('NIM', 'NAMA', 'ALAMAT','NO HP','Action');
		foreach ($semua_mahasiswa as $mahasiswa) {
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