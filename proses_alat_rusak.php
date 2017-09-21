<?php
    require_once 'system/init.php';

    if(isset($_GET['kode'])){
    	$id_alat = $_GET['kode'];
    	$jumlah = $_GET['jumlah'];

    	$query = $db->query("INSERT INTO `alat_rusak` (`id_alat`,`jumlah_rusak`) VALUES ('$id_alat','$jumlah')");
    $alat = $db->query("select * from `alat_kesehatan` where `id_alat`='$id_alat'")->fetch_array();

    if($alat['stok_alat']<=0){
        $msg = "Stok Alat ".$alat['id_alat']." Kosong";
    }else{

    	if($query){

            $jumlah_alat = $alat['stok_alat']-$jumlah;
    		$stok = $db->query("UPDATE `alat_kesehatan` SET `stok_alat`='$jumlah_alat'WHERE `id_alat`='$id_alat'");
                        
                        if($stok){
                            $msg = "Sukses";
                        }else {
                            $msg = "Gagal".$db->error();
                        }
    	}else {
    		$msg = "Error".$db->error();
    	}
    }
    }else {
    	$msg = "Data Tidak Boleh Kosong";
    }

header("Location: alat_rusak.php?msg=".$msg);