<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//convert bilangan ke bentuk nominal indonesia
function rupiah($nominal){
  if ($nominal == 0) {
    $harga = 'FREE';
    echo $harga;
  }  else {
    $harga = "Rp ".number_format($nominal, 2, ",",".");
    echo $harga;
  }
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

function selisih_old($tanggal)
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
            $max_tgl = jum_bulan($sekarang[1],$tanggal[0]);
            $selisih = $selisih + ($max_tgl - $sekarang[2]);
          } else {
            $max_tgl = jum_bulan($i,$tanggal[0]);
            $selisih = $selisih + $max_tgl;
          }
        }
        $sekarang[1]=1;
        $sekarang[2]=0;
      }
      for ($i=$sekarang[1]; $i <= $tanggal[1]; $i++) { 
        if ($i==$sekarang[1] && $sekarang[2] <> 0) {
          $max_tgl = jum_bulan($sekarang[1],$tanggal[0]);
          $selisih = $selisih + ($max_tgl - $sekarang[2]);
        }elseif ($i==$tanggal[1]) {
          $selisih = $selisih + $tanggal[2];
        } else {
          $max_tgl = jum_bulan($i,$tanggal[0]);
          $selisih = $selisih + $max_tgl;
        }
      }
    }
    return $selisih;
  }

function selisih($tanggal)
{
  $now = strtotime(date("Y-m-d")); // or your date as well
  $your_date = strtotime($tanggal);
  $datediff = $your_date - $now;
  $selisih =  floor($datediff/(60*60*24));
  return $selisih;
}
function hitung_selisih($tanggal)
  {
    $selisih = selisih($tanggal);
    if ($selisih == 0) {
      $pesan = 'Sekarang';
    }elseif ($selisih == 1) {
      $pesan = 'Besok';
    }elseif ($selisih <= 7 && $selisih >= 1) {
      $pesan = $selisih.' hari lagi';
    } elseif ($selisih > 7 && $selisih < 30) {
      $remaining = floor($selisih / 7);
      $pesan = $remaining." minggu lagi";
    }elseif ($selisih >= 30) {
      $remaining = floor($selisih / 30);
      $pesan = $remaining." bulan lagi";
    }elseif ($selisih > 365) {
      $remaining = floor($selisih / 365);
      $pesan = $remaining." tahun lagi";
    }else{$pesan="Sekarang";}
    echo $pesan;
  }
  //untuk mengeksekusi halaman pada localhost/tanggal/2015-02-17
  function hitung_selisih_for_tanggal_page_only($tanggal)
  {
    $selisih = selisih($tanggal);
    if ($selisih == 0) {
      $pesan = '<span class="label label-success label-mini">Sekarang</span>';
    }elseif ($selisih == 1) {
      $pesan = '<span class="label label-success label-mini">Besok</span>';
    }elseif ($selisih <= 7 && $selisih != 1) {
      $pesan = '<span class="label label-success label-mini">'.$selisih.' hari lagi';
    } elseif ($selisih > 7 && $selisih < 30) {
      $remaining = floor($selisih / 7);
      $pesan = '<span class="label label-success label-mini">'.$remaining." minggu lagi";
    }elseif ($selisih > 30) {
      $remaining = floor($selisih / 30);
      $pesan = '<span class="label label-success label-mini">'.$remaining." bulan lagi".'</span>';
    }if ($tanggal<date('Y-m-d')){
      $pesan = '<span class="label label-info label-mini">Expire</span>';
    }
    echo $pesan;
  }
  //merubah format tanggal ke indonesia format
  function tanggal_to_id($data_tanggal)
  {
    $tanggal = $data_tanggal;
    $pecah = explode("-", $tanggal);
    $tanggal = $pecah[2];
    $bulan = $pecah[1];
    $tahun = $pecah[0];
    //menghasilkan 1 untuk monday, 2 tuesday, dll 
    $hari =  date("N", mktime(0, 0, 0, $bulan, $tanggal, $tahun));
    switch ($hari) {
      case 1: $hari = "Senin"; break;
      case 2: $hari = "Selasa"; break;
      case 3: $hari = "Rabu"; break;
      case 4: $hari = "Kamis"; break;
      case 5: $hari = "Jumat"; break;
      case 6: $hari = "Sabtu"; break;
      case 7: $hari = "Minggu"; break;
    }
    switch ($bulan){
      case 1:$bulan =  "Januari"; break;
      case 2:$bulan =  "Februari";break;
      case 3:$bulan =  "Maret";break;
      case 4:$bulan =  "April";break;
      case 5:$bulan =  "Mei";break;
      case 6:$bulan =  "Juni";break;
      case 7:$bulan =  "Juli";break;
      case 8:$bulan =  "Agustus";break;
      case 9:$bulan =  "September";break;
      case 10:$bulan =  "Oktober";break;
      case 11:$bulan =  "Nopember";break;
      case 12:$bulan =  "Desember";break;
    }
    echo $hari.", ".$tanggal." ".$bulan." ".$tahun;
  }
  //cek status apakah expire atau available
  function cek_avability_event($mulai, $selesai)
  {
    $sekarang = date("Y-m-d");
    if ($selesai <= $sekarang) {
      $print = '<a class="btn btn-warning" href="#detail"><i class="icon-smile"></i> Expire</a>';
    } 
    if ($mulai >= $sekarang) {
      $print = '<a class="btn btn-info" href="#detail"><i class="icon-smile"></i> Available</a>';
    }
    if ($mulai <= $sekarang && $selesai >= $sekarang) {
      $print = '<a class="btn btn-info" href="#detail"><i class="icon-smile"></i> Sekarang</a>';
    }
    echo $print;
  }
?>