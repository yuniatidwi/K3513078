<?php
foreach ($data_lengkap_mahasiswa as $data) {
    //inisialisasi
    $nim_db = $data->nim;
    $nama = $data->nama;
    $ttl = $data->tempat_lahir.", ".date_id($data->tanggal_lahir);
    $gender = gender($data->gender);
    $gol_darah = $data->gol_dar;
    $agama = $data->agama;
    $hobi = $data->hobi;
    $alamat = $data->alamat.'. '.$data->ibu_kota.', '.$data->nama_provinsi.', '.$data->kodepos;
    $telepon = $data->telepon;
    $email = $data->email;
    $pendidikan_1 = $data->pendidikan_1;
    $pendidikan_2 = $data->pendidikan_2;
    $pendidikan_3 = $data->pendidikan_3;
}
class PDF extends FPDF
{
//Page header
function Header()
{
    //Logo
    //$this->Image('fpdf/logo_pb.png',10,8,33);
    //Arial bold 15
    $this->SetFont('Arial','B',15);
    //Move to the right
    $this->Cell(80);
    //Title
    $this->Cell(30,10,'Biodata Mahasiswa',0,0,'C');
    //Line break
    $this->Ln(20);
}

//Page footer
function Footer()
{
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

//Instanciation of inherited class
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(0,10,'NIM : '.$nim_db,0,1);
$pdf->Cell(0,10,'Nama : '.$nama,0,1);
$pdf->Cell(0,10,'Tempat, tanggal lahir : '.$ttl,0,1);
$pdf->Cell(0,10,'Gender : '.$gender,0,1);
$pdf->Cell(0,10,'Golongan darah : '.$gol_darah,0,1);
$pdf->Cell(0,10,'Agama : '.$agama,0,1);
$pdf->Cell(0,10,'Hobi : '.$hobi,0,1);
$pdf->Cell(0,10,'Alamat : '.$alamat,0,1);
$pdf->Cell(0,10,'Telepon : '.$telepon,0,1);
$pdf->Cell(0,10,'E-mail : '.$email,0,1);
$pdf->Cell(0,10,'RIWAYAT PENDIDIKAN : ',0,1);
$pdf->setX(20);
$pdf->Cell(0,10,$pendidikan_1,0,1);
$pdf->setX(20);
$pdf->Cell(0,10,$pendidikan_2,0,1);
$pdf->setX(20);
$pdf->Cell(0,10,$pendidikan_3,0,1);
$pdf->Output();
?>