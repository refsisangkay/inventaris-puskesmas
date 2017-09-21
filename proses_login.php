<?php
    require_once 'system/init.php';

    if(!empty($_POST['username']) && !empty($_POST['password'])){
    	$username = $_POST['username'];
    	$password = md5($_POST['password']);
    	
    	
        if($crud->login($username, $password)){
            $data = $crud->getUserByUsername($username);

    		$_SESSION['login'] = $data->id_pengguna;
            header("Location: index.php");
    	}else {
    		$msg = "Login Gagal";
            header("Location: masuk.php?msg=".$msg);
    	}
    }else {
    	$msg = "Username dan Password Kosong!";
        header("Location: masuk.php?msg=".$msg);
    }