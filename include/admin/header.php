<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $title;?></title>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/master.css">

<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/master.js"></script>
</head>
<body>
 <div id="wrapper">
<?php
include_once 'include/sidebar.php';
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
  	<ul class="nav navbar-nav navbar-left">
      <li><a href="#menu-toggle" id="menu-toggle"><span class="glyphicon glyphicon-list"></span></a></li>
    </ul>

    <div class="navbar-header navbar-center">
      <a class="navbar-brand" href="index.php">Puskesmas Paniki Bawah</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> KELUAR</a></li>
    </ul>
  </div>
</nav>