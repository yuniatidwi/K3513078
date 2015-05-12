<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Detail extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('db_event');
	}
	public function slug()
	{
		$link = $this->uri->segment(2);
		//$link=preg_replace("/[^0-9]/", '', $link);
		$cek_id_event =  $this->db_event->cek_event($link);
		foreach ($cek_id_event as $data_event) {}
		if (empty($data_event->id)) {
			$data['title'] = 'Not Found';
			$data['pesan_warning']='Event yang anda pilih tidak ada. Pilih rekomendasi event dibawah ini.';
			return $this->tampil_rekomendasi($data);
		} else {
			$data['data_terkait'] = $this->db_event->show_terkait($data_event->link, $data_event->kategori_id, $data_event->area);
			$data['title'] = $data_event->nama;
			$data['gambar_url'] = $data_event->gambar_url;
			$data['nama_event'] = $data_event->nama;
			$data['view_event'] = $data_event->view;
			$data['mulai_event'] = $data_event->mulai;
			$data['selesai_event'] = $data_event->selesai;
			$data['post_date_event'] = $data_event->post_date;
			$data['nama_publisher_event'] = $data_event->pub_name;
			$data['tempat'] = $data_event->tempat;
			$data['alamat'] = $data_event->alamat;
			$data['area'] = $data_event->area;
			$data['kategori'] = $data_event->kategori;
			$data['hastag'] = $data_event->hastag;
			$data['price'] = $data_event->price;
			$data['description'] = $data_event->deskripsi_singkat;
			$data['deskripsi'] = $data_event->deskripsi;
			$data['website'] = $data_event->website;
			$data['facebook'] = $data_event->facebook;
			$data['twitter'] = $data_event->twitter;

			//update viewer
			$value = (int)$data['view_event'];
			$value = $value + 1;
			$this->db_event->update_viewer($value, $link);
			$data['view_event'] = $value;

			$data['content'] = 'content/detail';
			return $this->tampil_halaman($data);
		}
	}
	public function index()
	{
		$this->slug();
	}
	//FUNCTION DIBAWAH INI TIDAK BERFUNGSI
	public function tanggal($hari = null)
	{
		$data['title']='Tanggal '.$hari;
		$data['content'] = 'content/detail';
		return $this->tampil_halaman($data);
	}

	public function kategori($nama = null)
	{
		if (empty($nama)) {
			$data['title']='Pilih kategori event';
			$data['pesan_warning']='Anda belum memilih kategori event, pilih kategori dibawah ini.';
			$data['kategori_list']=$this->db_event->kategori_list();
			$data['content'] = 'content/kategori_pilih';
		} else {
			$data['title']='Kategori '.$nama;
			$data['content'] = 'content/kategori';
			$data['nama_kategori'] = $nama;
			$data['kategori_show']=$this->db_event->kategori_show($nama);
		}
		return $this->tampil_halaman($data);
	}

	public function hastag($nama = null)
	{
		//tinggal sampai halaman sini
		if (empty($nama)) {
			$data['pesan_warning']='Anda belum memilih hastag event. Pilih rekomendasi event dibawah ini.';
			$data['content'] = 'content/home';
		} else {
			$data['title']='Kategori '.$nama;
			$data['content'] = 'content/hastag';
			$data['nama_hastag'] = $nama;
			$data['hastag_show']=$this->db_event->kategori_show($nama);
		}
		return $this->tampil_halaman($data);
	}

	public function index2()
	{
		$data['judul']='Ini judul dua';
		$data['isi'] = $this->db_event->find_all();
		$this->load->view('view_isi',$data);
	}

	public function detail($id = null)
	{
		if (empty($id)) {
			$data['title']='Pilih event';
			$data['pesan_warning']='Anda belum memilih event, pilih rekomendasi event dibawah ini.';
			$data['content'] = 'content/detail';
		} else {
			$data['title']='Kategori '.$id;
			$data['content'] = 'content/detail';
			$data['isi'] = $this->db_event->find_kategori($id);
		}
		return $this->tampil_halaman($data);
	}
	public function detail_event($a = null)
	{
		$a=preg_replace("/[^0-9]/", ' ', $a);
		$a=explode(" ", $a);
		$b=$a[0];
		echo "ini kata ".$b;
	}
	public function search($a = null)
	{
		//select * from e_acara where nama like '%kata%' or deskripsi like '%kata%'limit 30
		$a=preg_replace("/[^a-zA-Z0-9]/", ' ', $a);
		$a=explode(" ", $a);
		$b=$a[0];
		echo "ini kata ".$b;
	}
	
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */