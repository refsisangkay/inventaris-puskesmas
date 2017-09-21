<?php
    require_once 'system/init.php';

if(isset($_POST['kode']) && isset($_POST['nama_alat'])){

    if(!empty($_POST['kode']) && !empty($_POST['nama_alat'])){
    $target_dir = "assets/images/alat/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = true;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


    	$tanggal = date("Y-m-d");//date("Y-m-d", strtotime($_POST['tanggal']));
    	$id_alat = $_POST['kode'];
        $satuan = $_POST['satuan'];

    //if(isset($_POST['new')){
        $nama_alat = $_POST['nama_alat'];
        $keterangan = $_POST['keterangan'];
    //}

    
    // Check if image file is a actual image or fake image
    //if(isset($_POST["submit"])) {
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
        $error[] = "Sorry, your file was not uploaded.";
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


    $query = $db->query("INSERT INTO `detail_alat` (`id_alat`, `nama_alat`, `gambar`, `keterangan`) VALUES ('$id_alat', '$nama_alat', '$gambar', '$keterangan')");

    if($query && $uploadOk){
        $qalat = $db->query("INSERT INTO `alat_kesehatan` (`id_alat`, `satuan`) VALUES ('$id_alat', '$satuan')");
        if($qalat){
            $msg = "Sukses";
        }else {
            $error[] = "Error menambah alat" .$db->error();
        }
    }else {
    		$error[] = "Error" .$db->error();
    }
    

    if(isset($error))
    {
        $msg = implode(". ", $error);
        header("Location: alat_kesehatan.php?msg=".$msg);
    }else {
        header("Location: alat_kesehatan.php?msg=".$msg);
    }

    }else {
    $msg = "Data Tidak Boleh Kosong";
    header("Location: alat_kesehatan.php?msg=".$msg);
}


}else {
    $msg = "Harap memasukan data";
    header("Location: alat_kesehatan.php?msg=".$msg);
}
