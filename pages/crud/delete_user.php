<?php
session_start();

// Include file koneksi database
include '../../koneksi.php';

// Memeriksa apakah pengguna telah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php?pesan=needlogin");
    exit(); // Stop further execution
}

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memeriksa apakah tombol "Hapus Akun" ditekan
    if (isset($_POST['delete_account'])) {
        // Memeriksa apakah inputan pengguna sesuai dengan konfirmasi yang benar
        $delete_confirmation = $_POST['delete_confirmation'];
        $expected_confirmation = "hapus-akun-" . $_SESSION['user_name'];
        
        if ($delete_confirmation == $expected_confirmation) {
            // Query untuk menghapus akun pengguna beserta postingan dan profilnya
            $user_id = $_SESSION['user_id'];

            // Hapus gambar postingan yang diupload user dari direktori "storage/posting/"
            $queryPostPath = "SELECT post_img_path FROM posts WHERE user_id = $user_id;";
            $resultPostPath = mysqli_query($koneksi, $queryPostPath);
            while ($rowPostPath = mysqli_fetch_assoc($resultPostPath)) {
                $post_img_path = $rowPostPath['post_img_path'];
                unlink("../../storage/posting/$post_img_path");
            }

            // Hapus foto profil dari direktori "storage/profile/" kecuali default.png
            $queryProfilePath = "SELECT user_profile_path FROM users WHERE user_id = $user_id AND user_profile_path != 'default.png';";
            $resultProfilePath = mysqli_query($koneksi, $queryProfilePath);
            $rowProfilePath = mysqli_fetch_assoc($resultProfilePath);
            $user_profile_path = $rowProfilePath['user_profile_path'];
            unlink("../../storage/profile/$user_profile_path");

            // Hapus akun dari tabel users
            $queryDeleteUser = "DELETE FROM users WHERE user_id = $user_id";
            mysqli_query($koneksi, $queryDeleteUser);

            // menghapus semua session
            session_destroy();

            // mengalihkan halaman ke halaman beranda
            header("location:../error/goodbye.php");
            exit();
        } else {
            // Jika inputan pengguna tidak sesuai dengan konfirmasi yang benar
            header("location:edit_profile.php?pesan=invalidconfirmation");
        }
    }
}
?>
