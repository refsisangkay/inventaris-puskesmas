<?php
	require_once 'system/init.php';

	$title = "Inventaris";
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
                         <center><h3 class="panel-title"><b>STOK ALAT</b></h3></center>
                         </div>
                            <div class="panel-heading">
                          </div>
                          <div class="panel-body">
                                 <form class="navbar-form navbar-left">
                                 <button type="submit" class="btn btn-default">Cari</button>
                                    <div class="form-group">
                                      <input type="text" name="query" class="form-control" placeholder="Search">
                                    </div>
                                  </form>
                                <table class="table">
                                    <tr><th>No</th><th>Nama</th><th>Kode Alat</th><th>Asal</th><th>Tahun</th><th>Jumlah Awal</th>
                                    <th>Jumlah Akhir</th><?php if(isset($_SESSION['login'])) { ?><!--<th></th>--><?php } ?></tr>
                                    <?php
                                    if(!isset($_GET['query'])) {
                                        $query = $crud->getStokAlat();
                                      }else {
                                        $query = $crud->cariStokAlat($_GET['query']);
                                      }
                                      $no = 1;
                                    if($query->num_rows>0){
                                      while ($data = $query->fetch_assoc()) {
                                    ?>
                                    <tr>
                                    <td><?php echo $no;?></td>
                                    <td><?php echo $data['nama_alat'];?></td>
                                    <td><?php echo $data['id_alat'];?></td>
                                    <td><?php echo $data['asal'];?></td>
                                    <td><?php echo $data['tahun'];?></td>
                                    <td><?php echo $data['jumlah_awal'];?> <?php echo $data['satuan'];?></td>
                                    <td><?php echo $data['stok_alat'];?> <?php echo $data['satuan'];?></td>

                                    <!--<<td><a href="?edit=<?php echo $data['id_alat'];?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>

                                    a href="?action=hapus&id=<?php echo $data['id_alat'];?>" class="btn btn-danger" onclick="return konfirmasi();"><i class="fa fa-trash"></i></a></td>--></tr>
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
                                <button type="button" class="btn btn-primary pull-right" href="laporan_masuk.php">
                                <i class="fa fa-print"></i>  Cetak Laporan
                                </button>
                                <div class="clearfix"></div>
                          <?php } ?> 
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->




<?php
  if(!empty($_GET['edit'])) {
    $id = $_GET['edit'];
    $no = 1;
    $query = $crud->getAlatByID($id);

    if($query->num_rows>0) {
      $data = $query->fetch_assoc();
?>
<!-- Modal Edit Data -->
<div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="editData">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="edit_stok_alat.php" method="post" enctype="multipart/form-data">
     <input type="hidden" name="id" value="<?php echo $data['id_alat'];?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Stok <?php echo $data['nama_alat'];?></h4>
      </div>
      <div class="modal-body">

             <div class="form-group">
                 <label for="tahun">Stok Alat:</label>
                 <input type="text" class="form-control" id="stok_alat" placeholder="Masukan stok_alat" name="stok_alat" value="<?php echo $data['stok_alat'];?>">
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
<script type="text/javascript">
    $("#editData").modal('show');
</script>
<?php
    }
  }

   	include 'include/footer.php';
 ?>