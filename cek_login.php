<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['user_name'];
$password = $_POST['password'];


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"select * from users where user_name='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){

	$data = mysqli_fetch_assoc($login);

	// cek jika user login sebagai admin
	if($data['level_id']==1){

		// buat session login dan username
		$_SESSION['user_name'] = $username;
		$_SESSION['level_id'] = 1;
		// alihkan ke halaman dashboard admin
		header("location:dashboard_admin.php");

	// cek jika user login sebagai user
	}else if($data['level_id']==2){
		// buat session login dan username
		$_SESSION['user_name'] = $username;
		$_SESSION['level_id'] = 2;
		// alihkan ke halaman dashboard user
		header("location:dashboard_user.php");
	
	}else{

		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
	}

	
}else{
	header("location:index.php?pesan=gagal");
}



?>