<?php
session_start();
include '../../koneksi.php';

if(isset($_SESSION['level_id'])) {
    if($_SESSION['level_id'] == 1) {
        // khusus admin
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
            if($page == "level") {
                echo "<h1>Comming Soon</h1>";
                ?>
                <h3>Add Level page</h3>
                <?php
            } elseif($page == "otp") {
                // add data otp
                echo "<h1>Comming Soon</h1>";
                ?>
                <h3>Add OTP page</h3>
                <?php
            } elseif($page == "posts") {
                // add data posts
                echo "<h1>Comming Soon</h1>";
                ?>
                <h3>Add Post page</h3>
                <?php
            } elseif($page == "users") {
                // add data users
                ?>
                <h3>Add Users page</h3>
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