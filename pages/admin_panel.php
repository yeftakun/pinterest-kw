<?php

session_start();
include '../koneksi.php';

if(isset($_SESSION['level_id'])) {
    if($_SESSION['level_id'] == 1) {
        // beranda admin
?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Admin Panel</title>
            <!-- Tambahkan CSS atau link ke file CSS eksternal di sini -->
        </head>
        <body>

        <div class="container">
            <h2>Level Table</h2>
            <a href="crud/add_data.php?page=level">Add Data</a>
            <table>
                <!-- Tabel level disini -->
            </table>
        </div>

        <div class="container">
            <h2>OTP Table</h2>
            <a href="crud/add_data.php?page=otp">Add Data</a>
            <table>
                <!-- Tabel OTP disini -->
            </table>
        </div>

        <div class="container">
            <h2>Posts Table</h2>
            <a href="crud/add_data.php?page=posts">Add Data</a>
            <table>
                <!-- Tabel Posts disini -->
            </table>
        </div>

        <div class="container">
            <h2>Users Table</h2>
            <a href="crud/add_data.php?page=users">Add Data</a>
            <table>
                <!-- Tabel Users disini -->
            </table>
        </div>

        </body>
        </html>

<?php
    } else {
        // jika bukan admin
        header("location:error/deniedpage.php");
    }
} else {
    // jika belum login
    header("location:../index.php?pesan=needlogin");
}

?>