<?php
	require_once 'system/init.php';

	$title = "Inventaris";
	include_once 'include/header.php';
?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    	<div class="panel panel-default">
                      <div class="panel-heading">
                         <center><h3 class="panel-title"><b>DETAIL ALAT</b></h3></center>
                         </div>
					      <div class="panel-body">
                                <table class="table table-hover">
                                    <tr><th>No</th><th>Nama Alat</th><th></th></tr>
                                    <?php
                                        $query = $db->query("select * from `detail_alat`");
                                        while ($row = $db->result($query)){
                                    ?>
                                    <tr><td><?php echo $row['id_alat'];?></td><td><?php echo $row['nama_alat'];?></td><td><a href="?view=<?php echo $row['id_alat'];?>" class="btn btn-default"><i class="fa fa-eye"></i> Lihat Detail</a>

                                    <?php if(isset($_SESSION['login'])) { ?>
                                    <!--<button type="simpan" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</button>-->
                                    <?php } ?>
                                    </td>
                                    <?php } ?>
                                    </tr>
                                </table>
                          </div>
					    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->



<?php
  if(!empty($_GET['view'])) {
    $id = $_GET['view'];
    $no = 1;
    $query = $db->query("select * from `detail_alat` where `id_alat`='$id'");

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
        <h4 class="modal-title" id="myModalLabel"><?php echo $data['nama_alat'];?></h4>
      </div>
      <div class="modal-body">

      <div class="row">
    <div class="col-xs-6"><img src="assets/images/alat/<?php echo $data['gambar'];?>" alt="Gambar" class="col-xs-12"></div> <div class="col-xs-6"><?php echo $data['keterangan'];?></div>
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
?>
<?php
   	include 'include/footer.php';
 ?>