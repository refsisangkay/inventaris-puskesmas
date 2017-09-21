<?php
  require_once 'system/init.php';

  $title = "Alat Keluar";
  include_once 'include/header.php';
?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                       <?php if(isset($_GET['msg'])) { ?>
                          <div class="alert alert-info"><?php echo $_GET['msg'];?></div>
                        <?php } ?>
                 <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                         <center><h3 class="panel-title"><b>ALAT RUSAK</b></h3></center>
                         </div>
                            <div class="panel-heading">
                           
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                           Tambah
                          </button>
                          <div class="clearfix"></div>
                          </div>
                          <div class="panel-body">
                                 <form class="navbar-form navbar-left">
                                 <button type="submit" class="btn btn-default">Cari</button>
                                    <div class="form-group">
                                      <input type="text" name="query" class="form-control" placeholder="Search">
                                    </div>
                                  </form>
                                <table class="table">
                                    <tr>
                                          <th>No</th>
                                          <th>Kode Alat</th>
                                          <th>Nama Alat</th>
                                          <th>Jumlah Rusak</th>
                                    <?php if(isset($_SESSION['login'])) { ?><th></th><?php } ?></tr>
                                    <?php
                                    if(!isset($_GET['query'])) {
                                        $query = $crud->getAlatRusak();
                                      }else {
                                        $query = $crud->cariAlatRusak($_GET['query']);
                                      }
                                      $no = 1;
                                    if($query->num_rows>0){
                                      while ($data = $query->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no;?></td>
                                        <td><?php echo $data['id_alat'];?></td>
                                        <td><?php echo $data['nama_alat'];?></td>
                                        <td><?php echo $data['jumlah_rusak'];?> <?php echo $data['satuan'];?></tahuntd>

                                        <?php if(isset($_SESSION['login'])) { ?><td><a href="?view=<?php echo $data['id_alat'];?>" class="btn btn-primary"><i class="fa fa-eye"></i></a> <a href="?action=hapus&id=<?php echo $data['id_alat'];?>" class="btn btn-danger" onclick="return konfirmasi();"><i class="fa fa-trash"></i></a></td><?php } ?></tr>
                                    <?php
                                    $no++;
                                    }

                                    }else {
                                    ?>
                                    <tr><td colspan="8">Data Tidak Ada</td></tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                          </div>
                          <div class="panel-footer">
                          <?php if(isset($_SESSION['login'])) { ?>
                                <a href="report_alat_rusak.php" target="_blank">
                                <button type="button" class="btn btn-primary pull-right" href="laporan_masuk.php">
                                <i class="fa fa-print"></i>  Cetak Laporan
                                </button>
                                </a>
                                <div class="clearfix"></div>
                          <?php } ?> 
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="proses_alat_rusak.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Alat Rusak</h4>
      </div>
      <div class="modal-body">
        <div class="">
              <div class="form-group">
                 <label for="kode">Alat:</label>
                 <select class="form-control" name="kode">
                 <?php
                      $query = $db->query("select `alat_kesehatan`.*,`detail_alat`.* from `alat_kesehatan` JOIN `detail_alat` on `detail_alat`.`id_alat`=`alat_kesehatan`.`id_alat` order by `detail_alat`.`id_alat`");

                     if($query->num_rows>0){
                     while($row = $query->fetch_array()){
                 ?>
                   <option value="<?php echo $row['id_alat'];?>"><?php echo $row['nama_alat'];?></option>
                  <?php
                  }
                }
                  ?>

                 </select>
             </div>

            <div class="form-group">
                <label>Jumlah Rusak:</label>
                <input type="text" class="form-control" class="jumlah" placeholder="Masukan jumlah" name="jumlah">
            </div>

        </div>         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="simpan" class="btn btn-primary">Simpan</button>
      </div>
    </div>
    </form>
  </div>
</div>


<?php
  if(!empty($_GET['view'])) {
    $id = $_GET['view'];
    $no = 1;
    $query = $crud->getAlatByID($id);

    if($query->num_rows>0) {
      $data = $query->fetch_assoc();
?>
<!-- Modal Edit Data -->
<div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="editData">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="act_edit_masuk.php">
      <input type="hidden" name="id" value="<?php echo $data['id_alat'];?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Data Alat</h4>
      </div>
      <div class="modal-body">

      <div class="row">
      <div class="col-xs-4">Kode Alat:</div> <div class="col-xs-8"><?php echo $data['id_alat'];?></div>
      <div class="col-xs-4">Nama Alat:</div> <div class="col-xs-8"><?php echo $data['nama_alat'];?></div>
      <div class="col-xs-4">Stok Alat:</div> <div class="col-xs-8"><?php echo $data['stok_alat'];?> <?php echo $data['satuan'];?>  </div>    
      </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    </form>
  </div>
</div>
<script type="text/javascript">
    $("#editData").modal('show');
</script>
<?php
    }
  }

if(isset($_GET['action'])) {

if($_GET['action']=='hapus' && !empty($_GET['id'])) {
    $id = $_GET['id'];
      $b =  $db->query("delete from `alat_rusak` where `id_alat`='$id'");
      if($b){
        $msg = "Suskes";
      }else {
        $msg = "Error (2)";
      }
echo "<script>window.location=\"?msg=$msg\"</script>";
  
}
?>

<?php
}
?>

<script type="text/javascript">
  function konfirmasi() {
    var jawab = confirm("Anda yakin menghapis ini?");
    if(jawab){
      return true;
    }else {
      return false;
    }
  }

   $("#tanggal").datepicker();
</script>

<?php
    include 'include/footer.php';
 ?>