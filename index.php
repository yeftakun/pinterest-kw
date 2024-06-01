<!DOCTYPE html>
<html>
<head>
	<title>Membuat Login Multi User Level Dengan PHP dan MySQLi - www.malasngoding.com</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="styles/alert.css">
	<link rel="icon" type="image/png" href="assets/ico/HitoriGotou.ico">
</head>
<body>
 
	<h1>NAMA APLIKASINYA</h1>

	<?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
		}
	}
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="registered"){
			echo "<div class='done'>Berhasil daftar, tunggu validasi admin</div>";
		}
	}
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="unvalidated"){
			echo "<div class='alert'>Akun belum divalidasi oleh admin</div>";
		}
	}
	?>
 
	<div class="kotak_login">
		<p class="tulisan_login">Silahkan login</p>
 
		<form action="cek_login.php" method="post">
			<label>Username</label>
			<input type="text" name="user_name" class="form_login" placeholder="Username .." required="required">
 
			<label>Password</label>
			<input type="password" name="password" class="form_login" placeholder="Password .." required="required">
 
			<input type="submit" class="tombol_login" value="LOGIN">
 
			<br/>
			<br/>
			<center>
				<a class="link" href="daftar.php">Daftar</a>
			</center>
		</form>
		
	</div>
 
	<script src="script/alert-time.js"></script>
</body>
</html>