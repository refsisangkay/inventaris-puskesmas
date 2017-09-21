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
                            <center><h3 class="panel-title"><b>ALAT KESEHATAN</b></h3></center>
                          </div>

                          <div class="panel-footer">
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                           Tambah
                          </button>
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
                                          <th>Satuan</th>
                                    <?php if(isset($_SESSION['login'])) { ?><th></th><?php } ?></tr>
                                    <?php
                                    if(!isset($_GET['query'])) {
                                        $query = $crud->getAlatKesehatan();
                                      }else {
                                        $query = $crud->cariAlatKesehatan($_GET['query']);
                                      }
                                      $no = 1;
                                    if($query->num_rows>0){
                                      while ($data = $query->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no;?></td>
                                        <td><?php echo $data['id_alat'];?></td>
                                        <td><?php echo $data['nama_alat'];?></td>
                                        <td><?php echo $data['satuan'];?></tahuntd>

                                        <?php if(isset($_SESSION['login'])) { ?><td><a href="?edit=<?php echo $data['id_alat'];?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a> <a href="?action=hapus&id=<?php echo $data['id_alat'];?>" class="btn btn-danger" onclick="return konfirmasi();"><i class="fa fa-trash"></i></a></td><?php } ?></tr>
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
    <form action="proses_alat_kesehatan.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Data Alat</h4>
      </div>
      <div class="modal-body">
               <div class="form-group">
                 <label for="tahun">Kode Alat:</label>
                 <input type="text" class="form-control" id="kode" placeholder="Masukan kode" name="kode">
             </div>

             <div class="form-group">
                 <label for="tahun">Nama Alat:</label>
                 <input type="text" class="form-control" id="nama_alat" placeholder="Masukan nama_alat" name="nama_alat">
             </div>
             <div class="form-group">
                 <label for="tahun">Gambar:</label>
                 <input type="file" class="form-control" id="gambar" placeholder="Masukan gambar" name="gambar">
             </div>

             <div class="form-group">
                 <label for="tahun">Keterangan:</label>
                 <input type="text" class="form-control" id="keterangan" placeholder="Masukan keterangan" name="keterangan">
             </div>

             <!--<div class="form-group">
                 <label for="nama">Pilih Alat:</label>
                 <select name="kode" class="form-control">
                 <?php
                      $query = $db->query("select * from `detail_alat`");
                      while ($row = $db->result($query)){
                    ?>
                    <option value="<?php echo $row['id_alat'];?>"><?php echo $row['nama_alat'];?></option>
                    <?php
                    }
                    ?>
                 </select>
             </div>-->

             <div class="form-group">
                 <label for="jumlah">Satuan</label>
                 <select name="satuan" class="form-control">
                   <option value="pcs">pcs</option>
                   <option value="buah">buah</option>
                 </select>
             </div> 
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="simpan" id="button" class="btn btn-primary">Simpan</button>
      </div>
    </div>
    </form>
  </div>
</div>


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
     <form action="edit_alat_kesehatan.php" method="post" enctype="multipart/form-data">
     <input type="hidden" name="id" value="<?php echo $data['id_alat'];?>">
     <input type="hidden" name="old_gambar" value="<?php echo $data['gambar'];?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Alat</h4>
      </div>
      <div class="modal-body">
               <div class="form-group">
                 <label for="tahun">Kode Alat:</label>
                 <input type="text" class="form-control" id="kode" placeholder="Masukan kode" name="kode" value="<?php echo $data['id_alat'];?>" disabled>
             </div>

             <div class="form-group">
                 <label for="tahun">Nama Alat:</label>
                 <input type="text" class="form-control" id="nama_alat" placeholder="Masukan nama_alat" name="nama_alat" value="<?php echo $data['nama_alat'];?>"">
             </div>
             <div class="form-group">

                 <label for="tahun">Gambar:</label><br>
                <img src="assets/images/alat/<?php echo $data['gambar'];?>"" width="100px">
                <br>
                <input type="checkbox" name="ganti" value="1"> Ganti
                 <input type="file" class="form-control" id="gambar" placeholder="Masukan gambar" name="gambar" value="<?php echo $data['gambar'];?>">
             </div>

             <div class="form-group">
                 <label for="tahun">Keterangan:</label>
                 <input type="text" class="form-control" id="keterangan" placeholder="Masukan keterangan" name="keterangan" value="<?php echo $data['keterangan'];?>">
             </div>

             <!--<div class="form-group">
                 <label for="nama">Pilih Alat:</label>
                 <select name="kode" class="form-control">
                 <?php
                      $query = $db->query("select * from `detail_alat`");
                      while ($row = $db->result($query)){
                    ?>
                    <option value="<?php echo $row['id_alat'];?>"><?php echo $row['nama_alat'];?></option>
                    <?php
                    }
                    ?>
                 </select>
             </div>-->

             <div class="form-group">
                 <label for="jumlah">Satuan</label>
                 <select name="satuan" class="form-control">
                  <option><?php echo $data['satuan'];?></option>
                   <option value="pcs">pcs</option>
                   <option value="buah">buah</option>
                 </select>
             </div> 
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="simpan" id="simpan" class="btn btn-primary">Simpan</button>
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
      $b =  $db->query("delete from `alat_kesehatan` where `id_alat`='$id'");
      if($b){
        $msg = "Suskes";
      }else {
        $msg = "Error ".$db->error();
      }

echo "<script>window.location=\"?msg=$msg\"</script>";
  
}
?>

<?php
}
?>

<script type="text/javascript">
  function konfirmasi() {
    var jawab = confirm("Anda yakin menghapus ini?");
    if(jawab){
      return true;
    }else {
      return false;
    }
  }

   $("#tanggal").datepicker();

   $("body").ready(function(){
      $("#gambar").change(function(){
        var file = $("#gambar").val();
        var format = file.split(".");
        if(format[1]=='mp4' || format[1]=='rar' || format[1]=='zip' || format[1]=='mkv')
        {
          alert("format file salah! pilih format gambar yang valid untuk melanjutkan.");
          $('#button').hide();
        }else {
          $('#button').show();
        }
      });
   });
</script>

<?php
   	include 'include/footer.php';
 ?>