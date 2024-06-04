<?php
session_start();
$lama = '';
include '../koneksi.php';

// Query untuk mengambil data gambar dan informasi pengguna
if (isset($_GET['post_id'])) { // jika header ada parameter post_id
    $query = "SELECT users.user_name, users.name, users.user_profile_path, posts.* from posts join users on posts.user_id = users.user_id where post_id = '$_GET[post_id]'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    $queryTime = "SELECT current_timestamp() as timenow;";
    $resultTime = mysqli_query($koneksi, $queryTime);
    $rowTime = mysqli_fetch_assoc($resultTime);
    // Waktu posting
    $postingTime = strtotime($row['create_in']);

    // Waktu saat ini
    $currentTime = strtotime($rowTime['timenow']);

    // Hitung selisih waktu dalam detik
    $timeDifference =  $currentTime - $postingTime;

    // Ubah selisih waktu menjadi format yang diinginkan
    if ($timeDifference < 60) {
        // Baru saja
        $timeAgo = "Baru saja";
    } elseif ($timeDifference < 3600) {
        // Tampilkan hanya dalam menit
        $minutes = floor($timeDifference / 60);
        $timeAgo = "$minutes mnt";
    } elseif ($timeDifference < 86400) {
        // Tampilkan hanya dalam jam
        $hours = floor($timeDifference / 3600);
        $timeAgo = "$hours j";
    } elseif ($timeDifference < 2592000) {
        // Tampilkan hanya dalam hari
        $days = floor($timeDifference / 86400);
        $timeAgo = "$days hri";
    } elseif ($timeDifference < 31536000) {
        // Tampilkan hanya dalam bulan
        $months = floor($timeDifference / 2592000);
        $timeAgo = "$months bln";
    } else {
        // Tampilkan hanya dalam tahun
        $years = floor($timeDifference / 31536000);
        $timeAgo = "$years thn";
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Image</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/alert.css">
</head>
<body>
    
    <?php

// Pastikan ada hasil yang ditemukan
if ($row > 0) {
    // cek jika sudah login
        if (isset($_SESSION['user_name'])) {
            // cek apakah user yang login sama dengan user yang upload
            if ($_SESSION['user_name'] == $row['user_name']) {
                // tampilan gambar yang diupload user sendiri
                ?>
                    <div class="container">
                        <div class="box">
                            <!-- Tampilkan gambar dari direktori "../storage/posting/" -->
                            <div class="img-preview">
                                <img src="../storage/posting/<?php echo $row['post_img_path']; ?>" alt="<?php echo $row['post_title']; ?>">
                            </div>
                            <div class="control">
                                <p><a href="beranda.php">Kembali</a> | 
                                <a href="../storage/posting/<?php echo $row['post_img_path']; ?>" download>
                                    Download
                                </a> | 
                                <a href="#" id="copyButton" class="copyButton">Copy URL</a> | 
                                <a href="#">Delete</a></p>
                            </div>
                            <div class="img-attribute">
                                <h2><?php echo $row['post_title']; ?></h2>
                                <p><?php echo $timeAgo; ?></p>
                                <p><?php echo $row['post_description']; ?></p>
                                <div class="posted-by">
                                    <!-- Tampilkan foto profil dari direktori "../storage/profile/" -->
                                    <a href="<?php echo 'profile.php?user_name=' . $row['user_name']; ?>">
                                        <img src="../storage/profile/<?php echo $row['user_profile_path']; ?>" alt="pp" width="50px">
                                        <p><?php echo $row['name']; ?></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                echo '<h1>Ini gambar yang diupload oleh Anda sendiri</h1>';
            } else {
                // tampilan gambar yang diupload user lain
                ?>

                    <div class="container">
                        <div class="box">
                            <!-- Tampilkan gambar dari direktori "../storage/posting/" -->
                            <div class="img-preview">
                                <img src="../storage/posting/<?php echo $row['post_img_path']; ?>" alt="<?php echo $row['post_title']; ?>">
                            </div>
                            <div class="control">
                                <p><a href="beranda.php">Kembali</a> | 
                                <a href="../storage/posting/<?php echo $row['post_img_path']; ?>" download>
                                    Download
                                </a> | 
                                <a href="#" id="copyButton" class="copyButton">Copy URL</a>
                            </div>
                            <div class="img-attribute">
                                <h2><?php echo $row['post_title']; ?></h2>
                                <p><?php echo $timeAgo; ?></p>
                                <p><?php echo $row['post_description']; ?></p>
                                <div class="posted-by">
                                    <!-- Tampilkan foto profil dari direktori "../storage/profile/" -->
                                    <a href="<?php echo 'profile.php?user_name=' . $row['user_name']; ?>">
                                        <img src="../storage/profile/<?php echo $row['user_profile_path']; ?>" alt="pp" width="50px">
                                        <p><?php echo $row['name']; ?></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                echo '<h1>Ini gambar yang diupload oleh user lain</h1>';
            }
        } else {
            // tampilan jika pengguna belum login
            echo '<h1>Ini gambar yang diupload oleh user lain, tapi anda belum login</h1>';
            ?>
            <div class="container">
                <div class="box">
                    <!-- Tampilkan gambar dari direktori "../storage/posting/" -->
                    <div class="img-preview">
                        <img src="../storage/posting/<?php echo $row['post_img_path']; ?>" alt="<?php echo $row['post_title']; ?>">
                    </div>
                    <div class="control">
                        <p><a href="beranda.php">Kembali</a> | 
                        <a href="../storage/posting/<?php echo $row['post_img_path']; ?>" download>
                            Download
                        </a> | 
                        <a href="#" id="copyButton" class="copyButton">Copy URL</a>
                    </div>
                    <div class="img-attribute">
                        <h2><?php echo $row['post_title']; ?></h2>
                        <p><?php echo $timeAgo; ?></p>
                        <p><?php echo $row['post_description']; ?></p>
                            <div class="posted-by">
                            <!-- Tampilkan foto profil dari direktori "../storage/profile/" -->
                            <a href="<?php echo 'profile.php?user_name=' . $row['user_name']; ?>">
                                <img src="../storage/profile/<?php echo $row['user_profile_path']; ?>" alt="pp" width="50px">
                                <p><?php echo $row['name']; ?></p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
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

    <script src="../script/alert-time.js"></script>
    <script src="../script/copy-to-clipboard.js"></script>

</body>
</html>