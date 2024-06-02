<?php
session_start();
include '../koneksi.php';

// cek apakah yang mengakses halaman ini sudah login
// if($_SESSION['level_id']!==2){ //level user
    // 	header("location:error/deniedpage.php");
    // 	exit();
    // }

// if ($_SESSION['level_id'] == 1) {
//     $ME_ARE = "Admin";
// } elseif ($_SESSION['level_id'] == 2){
//     $ME_ARE = "User";
// } else {
//     $ME_ARE = "Unknown Status";
// }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Beranda</title>
	<link rel="stylesheet" type="text/css" href="../styles/style.css">
	<link rel="stylesheet" type="text/css" href="../styles/alert.css">
	<link rel="icon" type="image/png" href="../assets/ico/HitoriGotou.ico">
</head>
<body>
    
    <?php
    // KEADAAN HALAMAN BERANDA
    if(isset($_SESSION['level_id'])) {
        if($_SESSION['level_id'] == 1) {
            ?>
            <!-- beranda admin -->
            <header>
                <div class="logo">
                    <img src="../assets/ico/HitoriGotou.ico" alt="logo" width="50">
                </div>
                <div class="home-search-bar">
                    <!-- Buat search bar -->
                </div>
                <div class="nav-to">
                    Beranda
                </div>
                <div class="nav-to">
                    Posting
                </div>
                <div class="profile-pic">
                    <a href="profile.php?user_name=<?php echo $_SESSION['user_name']; ?>">
                        <?php
                        echo '<img src="../storage/profile/' . $_SESSION['user_profile_path'] . '" alt="' . $_SESSION['user_profile_path'] . '" width="50px"';
                    ?>
                    </a>
                </div>
                <div class="logout">
                    <a href="../logout.php">LOGOUT</a>
                </div>
            </header>
            <p>Halaman Admin</p>
            <!-- <?php
                echo '<img src="../storage/profile/' . $_SESSION['user_profile_path'] . '" alt="' . $_SESSION['user_profile_path'] . '" max-width="300px">';
            ?>
            <ul>
                <li>User ID : <?php echo $_SESSION['user_id']; ?></li>
                <li>User ID : <?php echo $_SESSION['user_name']; ?></li>
                <li>User ID : <?php echo $_SESSION['name']; ?></li>
                <li>Bio : <?php echo $_SESSION['user_bio']; ?></li>
                <li>Level ID : <?php echo $ME_ARE; ?></li>
                <li>Password : <?php echo $_SESSION['password']; ?></li>
                <li>Status : <?php echo $_SESSION['status']; ?></li>
                <li>Chat ID : <?php echo $_SESSION['tele_chat_id']; ?></li>
            </ul> -->
        
            <?php
        } elseif($_SESSION['level_id'] == 2) {
            ?>
            <!-- beranda user -->
            <header>
                <div class="logo">
                    <img src="../assets/ico/HitoriGotou.ico" alt="logo" width="50">
                </div>
                <div class="home-search-bar">
                    <!-- Buat search bar -->
                </div>
                <div class="nav-to">
                    Beranda
                </div>
                <div class="nav-to">
                    Posting
                </div>
                <div class="profile-pic">
                    <a href="profile.php?user_name=<?php echo $_SESSION['user_name']; ?>">
                        <?php
                        echo '<img src="../storage/profile/' . $_SESSION['user_profile_path'] . '" alt="' . $_SESSION['user_profile_path'] . '" width="50px"';
                    ?>
                    </a>
                </div>
                <div class="logout">
                    <a href="../logout.php">LOGOUT</a>
                </div>
            </header>
            <p>Halaman User</p>
            <!-- <?php
                echo '<img src="../storage/profile/' . $_SESSION['user_profile_path'] . '" alt="' . $_SESSION['user_profile_path'] . '" max-width="300px">';
            ?>
            <ul>
                <li>User ID : <?php echo $_SESSION['user_id']; ?></li>
                <li>User ID : <?php echo $_SESSION['user_name']; ?></li>
                <li>User ID : <?php echo $_SESSION['name']; ?></li>
                <li>Bio : <?php echo $_SESSION['user_bio']; ?></li>
                <li>Level ID : <?php echo $ME_ARE; ?></li>
                <li>Password : <?php echo $_SESSION['password']; ?></li>
                <li>Status : <?php echo $_SESSION['status']; ?></li>
                <li>Chat ID : <?php echo $_SESSION['tele_chat_id']; ?></li>
            </ul> -->
        
            <?php
        }
    } else {
        ?>
        <!-- beranda belum login -->
        <header>
                <div class="logo">
                    <img src="../assets/ico/HitoriGotou.ico" alt="logo" width="50">
                </div>
                <div class="home-search-bar">
                    <!-- Buat search bar -->
                </div>
                <div class="nav-to">
                    Beranda
                </div>
                <div class="nav-to">
                    <a href="../index.php">LOGIN</a>
                </div>
            </header>
            <p>Halaman ketika belum login</p>
        <?php
    }
    ?>

	<br/>
	<br/>
</body>
</html>