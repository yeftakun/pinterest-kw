<?php

// KEADAAN HALAMAN PROFIL
if(isset($_SESSION['user_id'])) {
    if(isset($_SESSION['user_name']) && $_SESSION['user_name'] !== $user_name) {
        // profil user lain
    } else {
        // profil pribadi
    }
} else {
    // profil belum login
}

// KEADAAN HALAMAN BERANDA
if(isset($_SESSION['level_id'])) {
    if($_SESSION['level_id'] == 1) {
        // beranda admin
    } elseif($_SESSION['level_id'] == 2) {
        // beranda user
    }
} else {
    // beranda belum login
}

?>