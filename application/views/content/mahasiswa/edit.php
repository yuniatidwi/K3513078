			<div class="row">
				<div class="col-md-7">
					<div class="box box-solid">
                        <div class="box-header">
                            <h3 class="box-title">Edit data mahasiswa</h3>
                        </div>
                        <!-- /.box-header -->
                        <?php
                            foreach ($data_lengkap_mahasiswa as $data) {
                                //inisialisasi
                                $nim = $data->nim;
                                $nama = $data->nama;
                                $tempat_lahir = $data->tempat_lahir;
                                $tanggal_lahir = $data->tanggal_lahir;
                                $gender = $data->gender;
                                $gol_darah = $data->gol_dar;
                                $agama_db = $data->agama;
                                $hobi = $data->hobi;
                                $alamat = $data->alamat;
                                $kota = $data->ibu_kota;
                                $provinsi = $data->nama_provinsi;
                                $kodepos = $data->kodepos;
                                $telepon = $data->telepon;
                                $email = $data->email;
                                $pendidikan_1 = $data->pendidikan_1;
                                $pendidikan_2 = $data->pendidikan_2;
                                $pendidikan_3 = $data->pendidikan_3;
                            }
                            echo validation_errors();
                        ?>
                        <form role="form" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>NIM*</label>
                                            <input type="text" name="nim_disable" id="nim" class="form-control" value="<?php echo $nim ;?>" disabled>
                                            <input type="hidden" name="nim"  value="<?php echo $nim ;?>">
                                        </div>
                                        <div class="form-group">
                                            <label>NAMA*</label>
                                            <input type="text" name="nama" class="form-control"  value="<?php echo $nama ;?>"required>
                                        </div>
                                        <div class="form-group">
                                            <label>TEMPAT, TANGGAL LAHIR*</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" name="tempat_lahir" class="form-control" value="<?php echo $tempat_lahir ;?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $tanggal_lahir ;?>"  required>
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>GENDER*</label>
                                            <?php if ($gender == 'P') {
                                                echo '<div class="row">
                                                <div class="col-md-3">
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="gender" id="optionsRadios1" value="L" >
                                                            Laki - laki
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="gender" id="optionsRadios2" value="P" checked="">
                                                            Perempuan
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>';
                                            } else echo '<div class="row">
                                                <div class="col-md-3">
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="gender" id="optionsRadios1" value="L" checked="">
                                                            Laki - laki
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="gender" id="optionsRadios2" value="P">
                                                            Perempuan
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>';
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label>GOLONGAN DARAH*</label>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <select name="gol_dar" class="form-control" required>
                                                        <?php 
                                                        $darah = array('A','B','O','AB','-');
                                                        for ($i=0; $i <count($darah) ; $i++) { 
                                                            if ($gol_darah == $darah[$i]) {
                                                                echo '<option value="'.$darah[$i].'" selected>'.$darah[$i].'</option>';
                                                            } else echo '<option value="'.$darah[$i].'">'.$darah[$i].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>AGAMA*</label>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <select name="agama" class="form-control" required>
                                                        <?php 
                                                        $agama = array('Islam','Kristen','Katolik','Budha','Hindu');
                                                        for ($i=0; $i <count($agama) ; $i++) { 
                                                            if ($agama_db == $agama[$i]) {
                                                                echo '<option value="'.$agama[$i].'" selected>'.$agama[$i].'</option>';
                                                            } else echo '<option value="'.$agama[$i].'">'.$agama[$i].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>HOBI*</label>
                                            <input type="text" name="hobi" class="form-control" value="<?php echo $hobi ;?>"  required>
                                        </div>
                                        <div class="form-group">
                                            <label>ALAMAT*</label>
                                            <textarea name="alamat" class="form-control" rows="3" ><?php echo $alamat ;?></textarea>
                                        </div>
<script type="text/javascript">
//use for ajax
function showKota(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","<?php echo base_url().'tools/getkota';?>?q="+str,true);
xmlhttp.send();
}
//use for konfirmation
function konfirmasi(){
    var r = confirm("Apakah yakin akan dihapus?");
    if (r == true) {
        return true;
    } else {
        return false;
    }
}
</script>
                                        <div class="form-group">
                                            <label>PROVINSI*</label>
                                            <select name="provinsi" class="form-control" onchange="showKota(this.value)" required>
                                            	<?php
                                            	//load data provinsi
                                            	$query = "SELECT * from provinsi order by nama_provinsi asc";
                                            	$result = mysql_query($query);
                                            	while ($data = mysql_fetch_array($result)) {
                                            		echo "<option value=".$data['kode_provinsi'].">".$data['nama_provinsi']."</option>";
                                            	}
                                            	?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>KOTA*</label>
                                            <div id="txtHint"><?php echo $kota ;?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>KODEPOS*</label>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input type="text" name="kodepos" value="<?php echo $kodepos ;?>" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>TELEPON*</label>
                                            <input type="text" name="telepon" value="<?php echo $telepon ;?>" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>EMAIL*</label>
                                            <input type="email" name="email" value="<?php echo $email ;?>" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="box-header">
                                                    <h3 class="box-title">Riwayat pendidikan*</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <!--riwayat pendidikan 1-->
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>MASUK*</label>
                                                    <select name="masuk_1" class="form-control" required>
                                                        <option value="">pilih...</option>
                                                        <?php
                                                            $tahun_awal = 1970;
                                                            $tahun_akhir = (int)date("Y");
                                                            for ($i=$tahun_awal; $i <=$tahun_akhir ; $i++) { 
                                                                echo "<option value='".$i."''>".$i."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>LULUS*</label>
                                                    <select name="lulus_1" class="form-control" required>
                                                        <option value="">pilih...</option>
                                                        <?php
                                                            $tahun_awal = 1970;
                                                            $tahun_akhir = (int)date("Y");
                                                            for ($i=$tahun_awal; $i <=$tahun_akhir ; $i++) { 
                                                                echo "<option value='".$i."''>".$i."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div> 
                                                <div class="col-md-6">
                                                    <label>NAMA INSTITUSI*</label>
                                                    <input type="text" name="institusi_1" class="form-control" required>
                                                </div>  
                                            </div>
                                        </div>
                                        <!--end riwayat pendidikan 1-->
                                        <!--riwayat pendidikan 2-->
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <select name="masuk_2" class="form-control" required>
                                                        <option value="">pilih...</option>
                                                        <?php
                                                            $tahun_awal = 1970;
                                                            $tahun_akhir = (int)date("Y");
                                                            for ($i=$tahun_awal; $i <=$tahun_akhir ; $i++) { 
                                                                echo "<option value='".$i."''>".$i."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <select name="lulus_2" class="form-control" required>
                                                        <option value="">pilih...</option>
                                                        <?php
                                                            $tahun_awal = 1970;
                                                            $tahun_akhir = (int)date("Y");
                                                            for ($i=$tahun_awal; $i <=$tahun_akhir ; $i++) { 
                                                                echo "<option value='".$i."''>".$i."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div> 
                                                <div class="col-md-6">
                                                    <input type="text" name="institusi_2" class="form-control" required>
                                                </div>  
                                            </div>
                                        </div>
                                        <!--end riwayat pendidikan 2-->
                                        <!--riwayat pendidikan 3-->
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <select name="masuk_3" class="form-control" required>
                                                        <option value="">pilih...</option>
                                                        <?php
                                                            $tahun_awal = 1970;
                                                            $tahun_akhir = (int)date("Y");
                                                            for ($i=$tahun_awal; $i <=$tahun_akhir ; $i++) { 
                                                                echo "<option value='".$i."''>".$i."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <select name="lulus_3" class="form-control" required>
                                                        <option value="">pilih...</option>
                                                        <?php
                                                            $tahun_awal = 1970;
                                                            $tahun_akhir = (int)date("Y");
                                                            for ($i=$tahun_awal; $i <=$tahun_akhir ; $i++) { 
                                                                echo "<option value='".$i."''>".$i."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div> 
                                                <div class="col-md-6">
                                                    <input type="text" name="institusi_3" class="form-control" required>
                                                </div>  
                                            </div>
                                        </div>
                                        <!--end riwayat pendidikan 3-->
                                        <div class="form-group">
                                            <p class="help-block">Catatan : tanda bintang (*) harus diisi.</p>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                        <button type="reset" class="btn btn-danger" name="reset">Reset</button>
                                    </div>
                                </form><!-- /.box-body -->
                    </div>
                </div>
            </div>