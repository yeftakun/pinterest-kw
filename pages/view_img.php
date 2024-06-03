<?php
session_start();
include '../koneksi.php';

// Query untuk mengambil data gambar dan informasi pengguna
if (isset($_GET['post_id'])) { // jika header ada parameter post_id
    $query = "SELECT users.user_name, users.name, users.user_profile_path, posts.* from posts join users on posts.user_id = users.user_id where post_id = '$_GET[post_id]'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);

    // Pastikan ada hasil yang ditemukan
    if ($row > 0) {
        // cek jika sudah login
        if (isset($_SESSION['user_name'])) {
            // cek apakah user yang login sama dengan user yang upload
            if ($_SESSION['user_name'] == $row['user_name']) {
                // tampilan gambar yang diupload user sendiri
                echo '<h1>Ini gambar yang diupload oleh Anda sendiri</h1>';
            } else {
                // tampilan gambar yang diupload user lain
                echo '<h1>Ini gambar yang diupload oleh user lain</h1>';
            }
        } else {
            // tampilan jika pengguna belum login
            echo '<h1>Ini gambar yang diupload oleh user lain, tapi anda belum login</h1>';
        }
        // while ($row) {
        // }
    } else {
        // tampilan jika tidak ada hasil yang ditemukan
        // echo '<h1>Tidak ada gambar yang ditemukan</h1>';
        header("location:error/not_found.php");
    }
    // Bebaskan hasil query
    mysqli_free_result($result);
    
    // Tutup koneksi ke database
    mysqli_close($koneksi);
} else {                            // jika header tidak ada parameter post_id
    // header("location:beranda.php?pesan=show-error");
    header("location:beranda.php");
}

?>
