<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('db_home');
	}
/*
	public function kota()
	{
		//cari jumlah kolta yang ada order dari yang terbanyak 
		$daftar_kota = $this->db_home->get_kota();
		$jumkota = 0;
		$nama_area = array();
		$jum_event_di_kota_ini = array();
		foreach ($daftar_kota as $event) {
			$jumkota++;
			$nama_area[$jumkota] = $event->area;
			$jum_event_di_kota_ini[$jumkota] = $event->jumlah;
		}
		for ($i=1; $i <= $jumkota; $i++) { 
			echo $i.' '.$nama_area[$i].' '.$jum_event_di_kota_ini[$i];
			if ($jum_event_di_kota_ini[$i] < 5) {
				$max_event = $jum_event_di_kota_ini[$i];
			} else{
				$max_event = 5;
			}
		}
	}
*/
	public function index()
	{
		//kategori yang muncul Festival
		//$data['data_kategori_festival'] = $this->db_home->get_data_kategori_home('1');//Festival
		//$data['data_kategori_seni'] = $this->db_home->get_data_kategori_home('7');//Seni dan budaya
		//$data['data_kategori_agama'] = $this->db_home->get_data_kategori_home('3');//Keagamaan
		//$data['data_kategori_parade'] = $this->db_home->get_data_kategori_home('5');//Parade
		//konten halaman yang akan dibuka
		//$data['content'] = 'content/rekomendasi';
		$data['pesan_success'] = 'Selamat datang di website event Indonesia, Website ini masih dalam tahap pengembangan. Berikan masukkan kalian tentang website ini supaya lebih baik. <a href="kontak"><button class="btn btn-danger btn-xs">Kirim masukan</button></a>';
		return $this->tampil_rekomendasi($data);
	}
	
	public function home($isi = null)
	{
		$this->index();
	}
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */