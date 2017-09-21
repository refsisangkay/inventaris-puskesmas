<?php
    require_once 'system/init.php';

    if(isset($_POST['id'])){
        $id =$_POST['id'];
        $id_alat = $_POST['kode'];
    	$tanggal = date("Y-m-d", strtotime($_POST['tanggal']));
    	$id_alat = $_POST['kode'];
        $satuan = $_POST['satuan'];

    //if(isset($_POST['new')){
        $nama_alat = $_POST['nama_alat'];
        $keterangan = $_POST['keterangan'];
    //}

    $target_dir = "assets/images/alat/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = true;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if($_POST['ganti']=='1') {
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = true;
        } else {
            $error[] = "File is not an image.";
            $uploadOk = false;
        }
    //}
   /* // Check if file already exists
    if (file_exists($target_file)) {
        $error[] = "Sorry, file already exists.";
        $uploadOk = false;
    }*/
    // Check file size
    if ($_FILES["gambar"]["size"] > 500000) {
        $error[] = "Sorry, your file is too large.";
        $uploadOk = false;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $error[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = false;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == false) {
        //$error[] = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    $temp = explode(".", $_FILES["gambar"]["name"]);
    $gambar = round(microtime(true)) . '.' . end($temp);
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_dir . $gambar)) {
            //$error[] = "The file ". basename( $_FILES["pas_foto"]["name"]). " has been uploaded.";
            // Success
        } else {
            $error[] = "Sorry, there was an error uploading your file.";
        }
    }
}else {
    $gambar = $_POST['old_gambar'];
}

    $query = $db->query("UPDATE `detail_alat` SET `nama_alat`='$nama_alat', `gambar`='$gambar', `keterangan`='$keterangan' WHERE `id_alat`='$id'");

    if($query){
        $qalat = $db->query("UPDATE `alat_kesehatan` SET `satuan`='$satuan' WHERE `id_alat`='$id'");
        if($qalat){
            $msg = "Sukses";
        }else {
            $error[] = "Error mengedit alat" .$db->error();
        }
    }else {
    		$error[] = "Error" .$db->error();
    }
    
}else {
    $error[] = "Data Tidak Boleh Kosong";
}

if(isset($error))
{
    $msg = implode(". ", $error);
    header("Location: alat_kesehatan.php?msg=".$msg);
}else {
    header("Location: alat_kesehatan.php?msg=".$msg);
}