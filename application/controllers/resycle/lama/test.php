<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Controller {

	public $data1;
	public function __construct()
	{
		parent::__construct();
		$this->load->library('output');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->model(array('db_test', 'db_sidebar'));
	}

	public function date_loops_fix()
	{
		//$this->date_loops();
		$data['data_kalender'] = $this->db_sidebar->get_data_kalender2();
		$data_tanggal2 = array();
		foreach ($data['data_kalender'] as $tanggal) {
			$awal = explode(" ", $tanggal->mulai);
			$akhir = explode(" ", $tanggal->selesai);
			//jika event hanya dalam satu hari
			if ($awal[0] == $akhir[0]) {
				$date_key = $awal[0];
				if (array_key_exists($date_key, $data_tanggal2)) {
					$temp = $data_tanggal2[$adate_key] + 1;
					$data_tanggal2[$date_key] = $temp;
				} else {
					$data_tanggal2[$date_key] = 1;
				}
			} else {
				// libih dari 1 hari
				$begin = new DateTime( $awal[0] );
				$end = new DateTime( $akhir[0] );
				$interval = DateInterval::createFromDateString('1 day');
				$period3 = new DatePeriod($begin, $interval, $end);
				foreach ($period3 as $dataku) {
					$date_key = $dataku->format( "Y-m-d" );
					if (array_key_exists($date_key, $data_tanggal2)) {
						$temp = $data_tanggal2[$date_key] + 1;
						$data_tanggal2[$date_key] = $temp;
					} else {
						$data_tanggal2[$date_key] = 1; 
					}
				}
				// disini, date terakhir tidak disebutkan, maka diakhit foreac diberikan parameter lagi untuk akhir
				$date_key = $akhir[0];
				if (array_key_exists($date_key, $data_tanggal2)) {
					$temp = $data_tanggal2[$date_key] + 1;
					$data_tanggal2[$date_key] = $temp;
				} else {
					$data_tanggal2[$date_key] = 1;
				}
			}
		}
		array_multisort($data_tanggal2, SORT_ASC);
		$data['jumlah_data2'] = $data_tanggal2;
		$this->load->view('test/date_loops', $data);
	}

	public function date_loops2()
	{
		//$this->date_loops();
		$data['data_kalender'] = $this->db_sidebar->get_data_kalender2();
		$jumlah_data = array();
		$data_tanggal = array();
		$data_tanggal2 = array();
		$jumDat=0;
		foreach ($data['data_kalender'] as $tanggal) {
			$awal = explode(" ", $tanggal->mulai);
			$akhir = explode(" ", $tanggal->selesai);
			$i=0;
			$jumlah=0;
			//jika event hanya dalam satu hari
			if ($awal[0] == $akhir[0]) {
				$jumlah++;
				$date_key = $awal[0];
				if (array_key_exists($date_key, $data_tanggal2)) {
					$temp = $data_tanggal2[$adate_key] + 1;
					$data_tanggal2[$date_key] = $temp;
					$jumDat++;
					echo $jumDat." ".$date_key." satu<br>";
				} else {
					$data_tanggal2[$date_key] = 1;
					$jumDat++; 
					echo $jumDat." ".$date_key." dua <br>";
				}
			} else {
				// libih dari 1 hari
				$begin = new DateTime( $awal[0] );
				$end = new DateTime( $akhir[0] );
				$interval = DateInterval::createFromDateString('1 day');
				$period3 = new DatePeriod($begin, $interval, $end);
				foreach ($period3 as $dataku) {
					$date_key = $dataku->format( "Y-m-d" );
					if (array_key_exists($date_key, $data_tanggal2)) {
						$temp = $data_tanggal2[$date_key] + 1;
						$data_tanggal2[$dataku->format( "Y-m-d" )] = $temp;
						$jumDat++;
						echo $jumDat.' '.$date_key." tiga temp ini ".$temp.'<br>';
					} else {
						$data_tanggal2[$date_key] = 1; 
						$jumDat++; 
						echo $jumDat.' '.$date_key."empat<br>";
					}
					$jumlah++;
					$i++;
				}
				// disini, date terakhir tidak disebutkan, maka diakhit foreac diberikan parameter lagi untuk akhir
				$date_key = $akhir[0];
				if (array_key_exists($date_key, $data_tanggal2)) {
					$temp = $data_tanggal2[$date_key] + 1;
					$data_tanggal2[$date_key] = $temp;
					$jumDat++;
					echo $jumDat.' '.$date_key." lima<br>";
				} else {
					$data_tanggal2[$date_key] = 1;
					$jumDat++;
					echo $jumDat.' '.$date_key." enam<br>";
				}
				$jumlah++;
				$i++;
			}
			$jumlah_data[] = $jumlah;
		}
		array_multisort($data_tanggal2, SORT_ASC);
		$data['jumlah_data'] = $data_tanggal;
		$data['jumlah_data2'] = $data_tanggal2;
		$this->load->view('test/date_loops', $data);
	}
	

	public function date_loops()
	{
		$begin = new DateTime( '2010-05-01' );
		$end = new DateTime( '2010-05-10' );
		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($begin, $interval, $end);
		$period2 = new DatePeriod($begin, $interval, $end);
		foreach ( $period as $dt ) echo $dt->format( "l Y-m-d H:i:s\n" ),'<br>';
		echo "=================<br>";
		foreach ( $period2 as $dt2 ) echo $dt2->format( "Y-m-d" ),'<br>';
		echo "======================================================";

		$data['data_kalender'] = $this->db_sidebar->get_data_kalender();
		$a[] = 'grgrgsd<br>';
		$jumlah_data = array();
		$data_tanggal = array();
		foreach ($data['data_kalender'] as $tanggal) {
			$awal = explode(" ", $tanggal->mulai);
			$akhir = explode(" ", $tanggal->selesai);
			echo $awal[0]."=====>".$akhir[0];
			echo "===========================>";
			$i=0;
			$jumlah=0;
			if ($awal[0] == $akhir[0]) {
				$jumlah++;
				echo "1";
				if (!in_array($awal[0], $data_tanggal)) {
					$data_tanggal[] = $awal[0];
				}
			} else {
				$begin = new DateTime( $awal[0] );
				$end = new DateTime( $akhir[0] );
				$interval = DateInterval::createFromDateString('1 day');
				$period3 = new DatePeriod($begin, $interval, $end);
				foreach ($period3 as $dataku) {
					if (!in_array($dataku->format( "Y-m-d" ), $data_tanggal)) {
						$data_tanggal[] = $dataku->format( "Y-m-d" );
					}
					$jumlah++;
					$i++;
					echo $i.'->'.$dataku->format( "Y-m-d" ).'<-,';
				}
				if (!in_array($akhir[0], $data_tanggal)) {
					$data_tanggal[] = $akhir[0];
				}
				$jumlah++;
				$i++;
				echo $i.'->'.$akhir[0].'<-,';
			}
			echo ' = '.$jumlah.'<br>';
			$jumlah_data[] = $jumlah;
		}
		array_multisort($data_tanggal, SORT_ASC);
		$data['jumlah_data'] = $data_tanggal;
		$this->load->view('test/date_loops', $data);
	}

	public function db_func_test()
	{
		$this->load->model('db_rekomendasi');
		$this->load->helper('my');
		$data['data_kategori'] = $this->db_rekomendasi->get_data_rekomendasi();
		$this->load->view('test/db_func_test', $data);

	}
	public function date_diff()
	{
		$uri1 = $this->uri->segment(3);
		$uri2 = $this->uri->segment(4);
		$datetime1 = date_create('2009-10-11');
		$datetime2 = date_create('2009-10-13');
		$interval = date_diff($datetime1, $datetime2);
		echo $interval->format('%R%a days');

	}
	public function input()
	{
		$this->load->view('test/input');
	}
	public function input_hasil()
	{
		$this->form_validation->set_rules('nama','Nama','required|alpha');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('usia','Usia','required|is_natural');
		$this->form_validation->set_rules('nim','NIM','required|alpha_numeric|max_length[8]');
		$this->form_validation->set_rules('email','E-mail','required|valid_email');
		$this->form_validation->set_rules('tgl_lahir','Tanggal lahir','required|numeric_dash');
		if ($this->form_validation->run()) {
			$data['nama'] = $this->input->post('nama',true);
			$data['alamat'] = $this->input->post('alamat',true);
			$data['usia'] = $this->input->post('usia',true);
			$data['nim'] = $this->input->post('nim',true);
			$data['email'] = $this->input->post('email',true);
			$data['tgl_lahir'] = $this->input->post('tgl_lahir',true);
			$this->db_test->masukin_db($data);
			$data['status'] = 'sukses';
			$this->load->view('test/input',$data);
		} else {
			echo "<script>alert('data yang dimasukkan salah, coba lagi')</script>";
			$this->load->view('test/input');
		}
	}
	public function show_test()
	{
		$data['show_test'] = $this->db_test->show_test();
		$this->load->view('test/show_test',$data);
	}
	public function tanggal($data)
	{
		$tanggal = $data;
		$pecah = explode("-", $tanggal);
		echo date("l, N", mktime(0, 0, 0, $pecah[1], $pecah[2], $pecah[0]));

	}
	public function index()
	{
		$string='isi data string';
		$data['tangkap'] = $this->output->get_output($string);
		echo $string;
	}
	public function cocok_tanggal($data)
	{
		if(preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $data)) {
			echo "Sesuai";
		}
	}
	public function kata($a = null)
	{
		$a=preg_replace("/[0-9]/", ' ', $a);
		$a=explode(" ", $a);
		$b=$a[0];
		echo "ini kata ".$b;
	}
	public function tampil()
	{
		echo "Hello world...".site_url();
		echo "<a href='".base_url().$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$this->uri->segment(4)."'>Makan</a>";

	}
	function jum_bulan($bulan,$tahun)
	{
		switch ($bulan) {
			case 1: $max_tgl = 31; break;
			case 2: 
				if ($tahun % 4 == 0) {
					$max_tgl = 29;
				} else $max_tgl = 28;
				break;
			case 3: $max_tgl = 31; break;
			case 4: $max_tgl = 30; break;
			case 5: $max_tgl = 31; break;
			case 6: $max_tgl = 30; break;
			case 7: $max_tgl = 31; break;
			case 9: $max_tgl = 30; break;
			case 10: $max_tgl = 31; break;
			case 11: $max_tgl = 30; break;
			case 12: $max_tgl = 31; break;
			default: $max_tgl = 30; break;
		}
		return $max_tgl;
	}
	function selisih($tanggal)
	{
		$tanggal = explode("-", $tanggal);
		$sekarang = explode("-", date('Y-m-d')); //2014-02-09
		if ($tanggal[1]==$sekarang[1]) {
			$selisih = $tanggal[2]-$sekarang[2];
		} else {
			$selisih = 0;
			if ($tanggal[1]<=$sekarang[1]) {
				for ($i=$sekarang[1]; $i <= 12; $i++) { 
					if ($i==$sekarang[1]) {
						$max_tgl = $this->jum_bulan($sekarang[1],$tanggal[0]);
						$selisih = $selisih + ($max_tgl - $sekarang[2]);
					} else {
						$max_tgl = $this->jum_bulan($i,$tanggal[0]);
						$selisih = $selisih + $max_tgl;
					}
				}
				$sekarang[1]=1;
				$sekarang[2]=0;
			}
			for ($i=$sekarang[1]; $i <= $tanggal[1]; $i++) { 
				if ($i==$sekarang[1] && $sekarang[2] <> 0) {
					$max_tgl = $this->jum_bulan($sekarang[1],$tanggal[0]);
					$selisih = $selisih + ($max_tgl - $sekarang[2]);
				}elseif ($i==$tanggal[1]) {
					$selisih = $selisih + $tanggal[2];
				} else {
					$max_tgl = $this->jum_bulan($i,$tanggal[0]);
					$selisih = $selisih + $max_tgl;
				}
			}
		}
		return $selisih;
	}
	public function hitung_selisih()
	{
		$selisih = $this->selisih('2015-7-28');
		if ($selisih <= 7) {
			$pesan = $selisih.' hari lagi';
		} elseif ($selisih > 7 && $selisih < 28) {
			$remaining = floor($selisih / 7);
			$pesan = $remaining." minggu lagi";
		}elseif ($selisih > 38) {
			$remaining = floor($selisih / 30);
			$pesan = $remaining." bulan lagi";
		}
		echo $pesan;
	}
	public function hastag()
	{
		$hastag = ' makan, ya , dia,  ehem enak , *@ makandua';
		$pecah = explode(',', $hastag);
		for ($i=1; $i <= count($pecah) ; $i++) { 
			$pecah[$i-1]=preg_replace("/[^a-zA-Z0-9]/", ' ', $pecah[$i-1]);
			$pecah[$i-1] = str_replace(" ", "_", $pecah[$i-1]);
			//$pecah[$i-1] = str_replace(" ,", "", $pecah[$i-1]);
			echo $pecah[$i-1];
		}
		echo implode(",", $pecah).'<br><br><br><br>';

		//pertama jadi string
		$kata2=" event, event 2015,ya , j(i)n!g^g%a, Makan-enak, bhyhb34r 4rv-4r";
		$kata2=preg_replace("/[^A-Za-z0-9,]/", ' ', $kata2);
		$kata2=strtolower($kata2);
		$kata2=trim($kata2);
		$kata2=str_replace(", ",",",$kata2);
		$kata2=str_replace(" ,",",",$kata2);
		$kata2=str_replace(" ","_",$kata2);
		$kata2; //simpan ke database $kata2, will receive event,2015.feef_dfe
		echo $kata2;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */