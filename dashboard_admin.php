<!DOCTYPE html>
<html>
<head>
	<title>Halaman admin - www.malasngoding.com</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="styles/alert.css">
</head>
<body>
	<?php 
	session_start();
	include 'koneksi.php';

	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level_id']!==1){ //level admin
		header("location:deniedpage.php");
		exit();
	}

	?>
	<h1>Halaman Admin</h1>

	<?php
	if ($_SESSION['level_id'] == 1) {
		$ME_ARE = "Admin";
	} elseif ($_SESSION['level_id'] == 2){
		$ME_ARE = "User";
	} else {
		$ME_ARE = "Unknown Status";
	}
	?>

	<p>Halo <b><?php echo $_SESSION['user_name']; ?></b> Anda telah login sebagai <b><?php echo $ME_ARE ?></b>.</p>
	<a href="logout.php">LOGOUT</a>

	<br/>
	<br/>

	<a><a href="https://www.malasngoding.com/membuat-login-multi-user-level-dengan-php-dan-mysqli">Membuat Login Multi Level Dengan PHP</a> - www.malasngoding.com</a>
</body>
</html>