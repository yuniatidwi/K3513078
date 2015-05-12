<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coba extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model(array("db_sidebar"));
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
	public function link()
	{
		$data = $this->db_sidebar->createlink();
		$nama1 = array();
		foreach ($data as $nama_acara) {
			echo $nama_acara->id."---->".$nama_acara->nama."<br>";
			$nama1[] = $nama_acara->nama;
		}
		echo "Jumlah total data ".count($nama1);
		echo "===================================";
		for ($i=0; $i <= 51; $i++) { 
			$id = $i+1;
			$this->db_sidebar->updatelink($id,$nama1[$i]);
		}
		$id=53;
		for ($i=54; $i <= 99; $i++) {
			$isiarray=$i-2;
			$id=$i;
			$this->db_sidebar->updatelink($id,$nama1[$isiarray]);
		}
	}
	public function link_dua()
	{
		$data = $this->db_sidebar->createlink();
		$nama1 = array();
		foreach ($data as $nama_acara) {
			echo $nama_acara->id."---->".$nama_acara->nama."<br>";
			$nama1[] = $nama_acara->nama;
		}
		echo "Jumlah total data ".count($nama1);
		echo "===================================";
		for ($i=0; $i <= 51; $i++) { 
			$id = $i+1;
			$link_no_code=preg_replace("/[^A-Za-z0-9]/", '_', $nama1[$i]);
			$link_lower=strtolower($link_no_code);
			//$linkfix=$id.'_'.$link_lower;
			$linkfix=$link_lower;
			$this->db_sidebar->updatelink_dua($id,$linkfix);	
		}
		$id=53;
		for ($i=54; $i <= 99; $i++) {
			$isiarray=$i-2;
			$id=$i;
			$link_no_code=preg_replace("/[^A-Za-z0-9]/", '_', $nama1[$isiarray]);
			$link_lower=strtolower($link_no_code);
			//$linkfix=$id.'_'.$link_lower;
			$linkfix=$link_lower;
			$this->db_sidebar->updatelink_dua($id,$linkfix);
		}
	}
	public function replace_duplicate()
	{
		$data_ini = $this->db_sidebar->show_link();
		$nama1 = array();
		$nama1_id = array();
		foreach ($data_ini as $nama_acara) {
			echo $nama_acara->id."---->".$nama_acara->link."<br>";
			$nama1[] = $nama_acara->link;
			$nama1_id[] = $nama_acara->id;
		}
		echo "=========================================<br>";
		for ($i=0; $i <=51 ; $i++) { 
			$key = $nama1[$i];
			for ($j=$i+1; $j <=97 ; $j++) { 
				if ($key == $nama1[$j]) {
					$linkfix = str_replace(".html", "", $nama1[$j]);
					$link_replaced = $linkfix."_2";
					$id = $nama1_id[$j];
					$this->db_sidebar->updatelink_dua($id,$link_replaced);
					echo $nama1[$j]." Has been replaced with ".$link_replaced.".html";
				}
			}
		}
		//start with id 3
		$id=53;
		for ($i=54; $i <=99 ; $i++) { 
			$isiarray=$i-2;
			$id=$i;
			$key = $nama1[$isiarray];
			for ($j=$isiarray+1; $j <=97 ; $j++) { 
				if ($key == $nama1[$j]) {
					$linkfix = str_replace(".html", "", $nama1[$isiarray]);
					$link_replaced = $linkfix."_2";
					//$id = $nama1_id[$j];
					$this->db_sidebar->updatelink_dua($id,$link_replaced);
					echo $nama1[$isiarray]." Has been replaced with ".$link_replaced.".html.<br><br>";
				}
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */