<?php
// Include koneksi ke database
include '../koneksi.php';
session_start();

// Ambil nama pengguna dari URL
if(isset($_GET['user_name'])) {
    $user_name = $_GET['user_name'];
    
    // Query untuk mengambil informasi pengguna berdasarkan user_name
    $getUserQuery = "SELECT * FROM users WHERE user_name = '$user_name'";
    $getUserResult = mysqli_query($koneksi, $getUserQuery);

    // Pastikan ada hasil yang ditemukan
    if(mysqli_num_rows($getUserResult) > 0) {
        $userData = mysqli_fetch_assoc($getUserResult);
        
        // Assign data pengguna ke variabel
        $user_id = $userData['user_id'];
        $user_name = $userData['user_name'];
        $name = $userData['name'];
        $user_profile_path = $userData['user_profile_path'];
        $user_bio = $userData['user_bio'];
        $level_id = $userData['level_id'];
        $password = $userData['password'];
        $status = $userData['status'];
        $tele_chat_id = $userData['tele_chat_id'];
    } else {
        // Redirect ke halaman lain jika pengguna tidak ditemukan
        header("Location: error/not_found.php");
        exit();
    }
} else {
    // Redirect ke halaman lain jika user_name tidak disediakan
    // header("Location: error/not_found.php");
    header("Location: profile.php?user_name=$_SESSION[user_name]");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil Pengguna</title>
</head>
<body>
    <?php
    // Periksa apakah pengguna sudah login
    if(isset($_SESSION['user_id'])) {
        if(isset($_SESSION['user_name']) && $_SESSION['user_name'] !== $user_name)
 {
            ?>
            <!-- tampilan pengguna lain -->
            <p><a href="beranda.php">Beranda</a> | <a href="#">Share</a></p>
            <p>Informasi Pengguna:</p>
            <img src="../storage/profile/<?php echo $user_profile_path; ?>" alt="<?php echo $user_profile_path; ?>" max-width="300px">
            <ul>
                <li>User ID : <?php echo $user_id; ?></li>
                <li>User Name : <?php echo $user_name; ?></li>
                <li>Nama : <?php echo $name; ?></li>
                <li>Bio : <?php echo $user_bio; ?></li>
                <li>Level ID : <?php echo $level_id; ?></li>
                <li>Password : <?php echo $password; ?></li>
                <li>Status : <?php echo $status; ?></li>
                <li>Chat ID : <?php echo $tele_chat_id; ?></li>
            </ul>
            <?php
        } else {
            ?>
            <!-- tampilan untuk pengguna itu sendiri -->
            <p><a href="beranda.php">Beranda</a> | <a href="#">Share</a> | <a href="#">Edit Profil</a></p>
            <p>Informasi Saya:</p>
            <img src="../storage/profile/<?php echo $user_profile_path; ?>" alt="<?php echo $user_profile_path; ?>" max-width="300px">
            <ul>
                <li>User ID : <?php echo $user_id; ?></li>
                <li>User Name : <?php echo $user_name; ?></li>
                <li>Nama : <?php echo $name; ?></li>
                <li>Bio : <?php echo $user_bio; ?></li>
                <li>Level ID : <?php echo $_SESSION['level_id']; ?></li>
                <li>Password : <?php echo $password; ?></li>
                <li>Status : <?php echo $status; ?></li>
                <li>Chat ID : <?php echo $tele_chat_id; ?></li>
            </ul>
        <?php
        }

    } else {
        // tampilan pengguna lain (tapi belum login)
        // Pengguna belum login, tampilkan link login
        ?>
        <p><a href="beranda.php">Beranda</a> | <a href="#">Share</a> | <a href="../index.php">Login</a></p>
        <p>Informasi Pengguna:</p>
        <img src="../storage/profile/<?php echo $user_profile_path; ?>" alt="<?php echo $user_profile_path; ?>" max-width="300px">
        <ul>
            <li>User ID : <?php echo $user_id; ?></li>
            <li>User Name : <?php echo $user_name; ?></li>
            <li>Nama : <?php echo $name; ?></li>
            <li>Bio : <?php echo $user_bio; ?></li>
            <li>Level ID : <?php echo $level_id; ?></li>
            <li>Password : <?php echo $password; ?></li>
            <li>Status : <?php echo $status; ?></li>
            <li>Chat ID : <?php echo $tele_chat_id; ?></li>
        </ul>
        <?php
    }
    ?>
</body>
</html>
