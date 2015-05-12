<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = 'mahasiswa';
	}

	public function mahasiswa_all()
	{
		$this->db->join('kota', 'mahasiswa.kota = kota.kode_kota', 'inner');
		$this->db->order_by('nama','asc');
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function mahasiswa_cari($q)
	{
		$this->db->like('nim',$q);
		$this->db->or_like('nama',$q);
		$this->db->or_like('telepon',$q);
		$this->db->join('kota', 'mahasiswa.kota = kota.kode_kota', 'inner');
		$this->db->order_by('nama','asc');
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function delete($nim)
	{
		$this->db->where('nim', $nim);
		$this->db->delete($this->table);
	}

	public function select($nim)
	{
		$this->db->where('nim', $nim);
		$this->db->join('kota', 'mahasiswa.kota = kota.kode_kota', 'inner');
		$this->db->join('provinsi', 'kota.kode_provinsi = provinsi.kode_provinsi', 'inner');
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function update_mahasiswa($nim, $set)
	{
		$this->db->where('nim', $nim);
		$this->db->update($this->table, $set);
	}

	public function insert_mahasiswa($set)
	{
		$this->db->insert($this->table, $set);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */