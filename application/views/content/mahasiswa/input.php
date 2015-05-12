			<div class="row">
				<div class="col-md-7">
					<div class="box box-solid">
                        <div class="box-header">
                            <h3 class="box-title">Input data mahasiswa</h3>
                        </div>
                        <!-- /.box-header -->
                        <form role="form" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>NIM*</label>
                                            <input type="text" name="nim" id="nim" onblur="ceknim()" class="form-control" required>
                                            <span id="teks" style="font-size:8pt"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>NAMA*</label>
                                            <input type="text" name="nama" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>TEMPAT, TANGGAL LAHIR*</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" name="tempat_lahir" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="date" name="tanggal_lahir" class="form-control" required>
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>GENDER*</label>
                                            <div class="row">
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
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>GOLONGAN DARAH*</label>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <select name="gol_dar" class="form-control" required>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="O">O</option>
                                                        <option value="AB">AB</option>
                                                        <option value="-">-</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>AGAMA*</label>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <select name="agama" class="form-control" required>
                                                        <option value="Islam">Islam</option>
                                                        <option value="Kristen">Kristen</option>
                                                        <option value="Katolik">Katolik</option>
                                                        <option value="Budha">Budha</option>
                                                        <option value="Hindu">Hindu</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>HOBI*</label>
                                            <input type="text" name="hobi" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>ALAMAT*</label>
                                            <textarea name="alamat" class="form-control" rows="3" ></textarea>
                                        </div>
<script type="text/javascript">
//use for cek id
var drz, kata, x;
function ceknim(){
    kata = document.getElementById("nim").value;
    if(kata.length>2){
        document.getElementById("teks").innerHTML = "checking...";
        drz = buatajax();
        var url="<?php echo base_url().'tools/ceknim';?>";
        url=url+"?nim="+kata;
        url=url+"&sid="+Math.random();
        drz.onreadystatechange=stateChanged;
        drz.open("GET",url,true);
        drz.send(null);
    }else{
        fokus();

    }
}

function buatajax(){
    if (window.XMLHttpRequest){
        return new XMLHttpRequest();
    }
    if (window.ActiveXObject){
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
    return null;
}

function stateChanged(){
var data;
    if (drz.readyState==4){
        data=drz.responseText;
        document.getElementById("teks").innerHTML = data;
    }
}

function fokus(){
    document.getElementById("nim").focus();
}

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
                                                <option value="">pilih...</option>
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
                                            <div id="txtHint"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>KODEPOS*</label>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input type="text" name="kodepos" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>TELEPON*</label>
                                            <input type="text" name="telepon" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>EMAIL*</label>
                                            <input type="email" name="email" class="form-control" required>
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