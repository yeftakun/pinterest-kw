<?php
session_start();
include '../../koneksi.php';

if(isset($_SESSION['level_id'])) {
    if($_SESSION['level_id'] == 1) {
        // khusus admin
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
            if($page == "level") {
                // add data level
                ?>
                <h1>Add Level page</h1>
                <?php
            } elseif($page == "otp") {
                // add data otp
                ?>
                <h1>Add OTP page</h1>
                <?php
            } elseif($page == "posts") {
                // add data posts
                ?>
                <h1>Add Post page</h1>
                <?php
            } elseif($page == "users") {
                // add data users
                ?>
                <h1>Add Users page</h1>
                <?php
            } else {
                header("location:../error/not_found.php");
            }
        }
    } else {
        header("location:../error/deniedpage.php");
    }
} else {
    header("location:../../index.php?pesan=needlogin");
}
?>