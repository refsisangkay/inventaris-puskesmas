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
                            <h3 class="panel-title">MASUK</h3>
                          </div>
                          <div class="panel-body">
                            <form action="proses_login.php" method="post" class="form-horizontal">
                              <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">Nama Pengguna</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="username" id="username" placeholder="Nama Pengguna">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">Kata Sandi</label>
                                <div class="col-sm-10">
                                  <input type="password" class="form-control" name="password" id="password" placeholder="Kata Sandi">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-primary">Sign in</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
<?php
    include 'include/footer.php';
 ?>