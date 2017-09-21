<?php
    require_once 'system/init.php';

    if(isset($_POST['id']) && isset($_POST['stok_alat'])){
        $id = $_POST['id'];
        $stok_alat = $_POST['stok_alat'];
    
    $alat = $db->query("select * from `alat_kesehatan` where `id_alat`='$id_alat'")->fetch_array();

    //if($alat['stok_alat']<=0){
     //   $msg = "Stok Alat ".$alat['id_alat']." Kosong";
    //}else{


        $q = $db->query("UPDATE `alat_kesehatan` SET `stok_alat`='$stok_alat'");


        if($q){
            $msg = "Sukses";

        }else {
            $msg = "Gagal".$db->error();
        }
    //}
}else {
        $msg = "Data Tidak Boleh Kosong";
    }
header("Location: stok_alat.php?msg=".$msg);