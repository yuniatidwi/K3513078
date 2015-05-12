<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lib_sidebar {

	public function get_data_sidebar()
	{
		//sidebar data
		$data['data_kalender'] = $this->db_sidebar->get_data_kalender();
		$data['data_kategori'] = $this->db_sidebar->get_data_kategori();
		return $data;
	}
}