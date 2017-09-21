
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    MENU
                </li>
                <li>
                    <a href="alat_kesehatan.php"><i class="fa fa-arrow-right"></i> Alat Kesehatan</a>
                </li>
                <li>
                    <a href="alat_masuk.php"><i class="fa fa-arrow-right"></i> Alat Kesehatan Masuk</a>
                </li>
                <li>
                    <a href="alat_keluar.php"><i class="fa fa-arrow-right"></i> Alat Kesehatan Keluar</a>
                </li>
                <li>
                    <a href="alat_rusak.php"><i class="fa fa-arrow-right"></i> Alat Kesehatan Rusak</a>
                </li>

                <?php if(isset($_SESSION['login'])) { ?>
                <li>
                    <a href="stok_alat.php"><i class="fa fa-arrow-right"></i> Stok Alat Kesehatan</a>
                </li>
                <?php } ?>
                
                 <li>
                    <a href="lihat_alat.php"><i class="fa fa-arrow-right"></i> Detail Alat Kesehatan</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->