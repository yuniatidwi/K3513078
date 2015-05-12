<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function getkota($kode_prov)
	{
		$query = $this->db->query("SELECT * from kota where kode_provinsi = '$kode_prov' order by ibu_kota asc");
		return $query->result();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */