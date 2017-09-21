<?php
	require_once 'system/init.php';

	session_destroy();
	header("Location: masuk.php");