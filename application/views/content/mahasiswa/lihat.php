
                    <div class="box box-solid">
                        <div class="box-header">
                            <h3 class="box-title">Lihat data mahasiswa...</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          <!--content here-->
                          <?php echo $table_data_mahasiswa; ?>
                          <!--content end-->
                         </div><!-- /.box-body -->
                    </div> 
<script type="text/javascript">
function konfirmasi(){
  var r = confirm("Apakah yakin akan dihapus?");
  if (r == true) {
      return true;
  } else {
      return false;
  }
}
</script>