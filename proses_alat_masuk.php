<?php
    require_once 'system/init.php';

    if(isset($_GET['kode'])){
    	$tanggal = $_GET['tanggal'];
    	$asal = $_GET['asal'];
    	$tanggal = date("Y-m-d");//, strtotime($_GET['tanggal']));
    	$id_alat = $_GET['kode'];
    	$jumlah = $_GET['jumlah'];
        $satuan = $_GET['satuan'];
        $tahun = $_GET['tahun'];
        $tahun = date("Y");


            $masuk = $db->query("INSERT INTO `transaksi` (`type`, `id_alat`, `tanggal`) VALUES ('masuk', '$id_alat', '$tanggal')");
                    $qtransaksi = $db->query("select id_transaksi from `transaksi` where `id_alat`='$id_alat' order by `id_transaksi` desc limit 1");
                    if($qtransaksi->num_rows>0)
                    {
                        $id_transaksi = $qtransaksi->fetch_array()['id_transaksi'];
                    }else {
                        $id_transaksi = 1;
                    }
                    
            $alat = $db->query("select * from `alat_kesehatan` where `id_alat`='$id_alat'")->fetch_array();

            if($masuk){

                    $ok = $db->query("INSERT INTO `alat_masuk` (`id_transaksi`,`id_alat`,`jumlah_masuk`, `tahun`, `asal`) VALUES ('$id_transaksi','$id_alat','$jumlah', '$tahun', '$asal')");

                        $jumlah_alat = $alat['stok_alat']+$jumlah;

                        $stok = $db->query("UPDATE `alat_kesehatan` SET `stok_alat`='$jumlah_alat' WHERE `id_alat`='$id_alat'");
                    if($ok){
    		          $msg = "Sukses";
                  }else {
                    $msg = "Gagal ($id_transaksi) ".$db->error();
                  }
            }else {
                $msg = "Error transaksi".$db->error();
            }
    }else {
    	$msg = "Data Tidak Boleh Kosong";
    }

header("Location: alat_masuk.php?msg=".$msg);