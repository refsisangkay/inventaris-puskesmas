<?php
    require_once 'system/init.php';

    if(isset($_GET['kode'])){
        $tanggal = date("Y-m-d");//, strtotime($_GET['tanggal']));
        $id_alat = $_GET['kode'];
        $penyaluran = $_GET['penyaluran'];
        $jumlah = $_GET['jumlah'];

        $transaksi = $db->query("INSERT INTO `transaksi` (`type`, `id_alat`, `tanggal`) VALUES ('keluar', '$id_alat', '$tanggal')");
                $qtransaksi = $db->query("select id_transaksi from `transaksi` where `id_alat`='$id_alat' order by `id_transaksi` desc limit 1");
                if($qtransaksi->num_rows>0)
                {
                    $id_transaksi = $qtransaksi->fetch_array()['id_transaksi'];
                }else {
                    $id_transaksi = 1;
                }

    $alat = $db->query("select * from `alat_kesehatan` where `id_alat`='$id_alat'")->fetch_array();

    if($alat['stok_alat']<=0){
        $msg = "Stok Alat ".$alat['id_alat']." Kosong";
    }else{
    if(($alat['stok_alat']-5)>=$jumlah){
        if($transaksi){

                $keluar = $db->query("INSERT INTO `alat_keluar` (`id_transaksi`,`id_alat`,`jumlah_keluar`,`penyaluran`) VALUES ('$id_transaksi','$id_alat','$jumlah','$penyaluran')");


                if($keluar){
                        $jumlah_alat = $alat['stok_alat']-$jumlah;

                        $stok = $db->query("UPDATE `alat_kesehatan` SET `stok_alat`='$jumlah_alat' WHERE `id_alat`='$id_alat'");
                        
                        if($stok){
                            $msg = "Sukses";
                        }else {
                            $msg = "Gagal";//.$db->error();
                        }

                }else {
                    $msg = "Transaksi Gagal";//.$db->error();
                }
            }else {
                $msg = "Error transaksi ";//.$db->error();
            }

            }else {
            $msg = "Stok tidak mencukupi";//.$db->error();
        }
    }
}else {
        $msg = "Data Tidak Boleh Kosong";
    }
header("Location: alat_keluar.php?msg=".$msg);