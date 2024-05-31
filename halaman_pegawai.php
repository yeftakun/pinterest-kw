<!DOCTYPE html>
<html>
<head>
	<title>Halaman Pegawai - www.malasngoding.com</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="styles/alert.css">
</head>
<body>
	<?php 
	session_start();
	include 'koneksi.php';

	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level']!=="pegawai"){
		header("location:deniedpage.php");
		exit();
	}

	?>
	<h1>Halaman Pegawai</h1>

	<p>Halo <b><?php echo $_SESSION['username']; ?></b> Anda telah login sebagai <b><?php echo $_SESSION['level']; ?></b>.</p>
	<a href="logout.php">LOGOUT</a>

	<br/>
	<br/>

	<a><a href="https://www.malasngoding.com/membuat-login-multi-user-level-dengan-php-dan-mysqli">Membuat Login Multi Level Dengan PHP</a> - www.malasngoding.com</a>
</body>
</html>