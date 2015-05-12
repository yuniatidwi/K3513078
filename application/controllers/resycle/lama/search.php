<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array("db_event"));
	}
	public function slug()
	{
		$nama = $this->uri->segment(2);
		if (empty($nama)) {
			if (isset($_GET['q'])) {
				$q = $_GET['q'];
				$q = preg_replace("/[^a-zA-Z0-9 ]/", "", $q);
				if (empty($q)) {
					$data['pesan_warning'] = 'Event tidak ditemukan, isi form pencarian tidak boleh kosong.';
					return $this->tampil_rekomendasi($data);
				} else {
					//isikan perintahnya disinisssss
					$data['search_name'] = $q;
					$q = $a=preg_replace("/[^a-zA-Z0-9']/", ' ', $q);
					$qq = "nama like '%".$q."'";
					$pencarian = $this->db_event->get_data_pencarian($qq);
					foreach ($pencarian as $pencarian_ava) {}
					if (empty($pencarian_ava->nama)) {
						//generate new query
						$w = array();
						$kata = explode(" ", $q);
						$w[0] = "nama like '%".$kata[0]."%'";
						$kata_jum = count($kata);
						if ($kata_jum > 1) {
							for ($i=1; $i <= $kata_jum - 1; $i++) { 
								$w[] = "OR nama like '%".$kata[$i]."%'";
							}
						}
						$w_fix = implode(" ", $w);
						$data['pesan_search_only'] = '<div class="alert alert-success fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="icon-remove"></i></button><p align="center">Kami tidak bisa menampilkan pencarian "'.$q.'", namun kami memberikan beberapa rekomendasi event dibawah ini.</p></div>';
						$pencarian2 = $this->db_event->get_data_pencarian($w_fix);
						foreach ($pencarian2 as $pencarian_ava2) {}
						if (empty($pencarian_ava2->nama)) {
							$data['pesan_search_only'] = '<div class="alert alert-success fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="icon-remove"></i></button><p align="center">Pencarian dengan kata kunci "'.$q.'" tidak ditemukan</p></div>';
						} else {
							$data['data_pencarian'] = $pencarian2;
						}
					} else {
						$data['data_pencarian'] = $pencarian;
					}
					$data['title'] = "Search : ".$q;
					$data['pesan_warning'] = 'Untuk hasil yang maksimal, gunakan kata kunci yang tepat. Kami hanya mencarikan judul dengan maksimal 30 event aktif yang terdekat';
					$data['content'] = 'content/search';
					return $this->tampil_halaman($data);
				}
			} else {
				$data['pesan_warning'] = 'Event tidak ditemukan, isi form pencarian dengan benar.';
				return $this->tampil_rekomendasi($data);
			}
		} else {
			$data['pesan_warning'] = 'Not Found, isi form pencarian dengan benar.';
			return $this->tampil_rekomendasi($data);
		}
	}

	public function index()
	{
		return $this->slug();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */