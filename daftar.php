<?php
// Include koneksi ke database
include 'koneksi.php';

// Pesan kesalahan
$errorMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $userName = $_POST['user_name'];
    $name = $_POST['name'];
    $bio = $_POST['bio'];
    $password = $_POST['password'];

    // Inisialisasi direktori dan nama file default
    $uploadDir = 'storage/profile/';
    $defaultImage = 'default.png';

    // Cek apakah user_name sudah ada dalam database
    $checkUsernameQuery = "SELECT COUNT(user_name) AS total FROM users WHERE user_name = '$userName'";
    $checkUsernameResult = mysqli_query($koneksi, $checkUsernameQuery);
    $row = mysqli_fetch_assoc($checkUsernameResult);
    $totalUsername = $row['total'];
    
    if ($totalUsername > 0) {
        $errorMsg = "Username sudah digunakan. Silakan pilih username lain.";
    } else {
        // Fungsi untuk mendapatkan ekstensi file
        function getFileExtension($filename) {
            return pathinfo($filename, PATHINFO_EXTENSION);
        }

        // Fungsi untuk mendapatkan nama file tanpa ekstensi
        function getFileNameWithoutExtension($filename) {
            return pathinfo($filename, PATHINFO_FILENAME);
        }

        // Validasi ukuran file
        if ($_FILES['image']['size'] > 0 && $_FILES['image']['size'] > 512 * 1024) {
            header("location:daftar.php?pesan=filetoolarge");
		    exit();
        } else {
            // Validasi ekstensi file
            if ($_FILES['image']['size'] > 0) {
                $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
                $imageExtension = getFileExtension($_FILES['image']['name']);
                if (!in_array($imageExtension, $allowedExtensions)) {
                    header("location:daftar.php?pesan=unsupportedfile");
                    exit();
                }
            }

            // Proses upload gambar jika ada
            if (empty($errorMsg) && $_FILES['image']['size'] > 0) {
                $fileName = $_FILES['image']['name'];
                $filePath = $uploadDir . $fileName;
                $i = 1;
                while (file_exists($filePath)) {
                    $newFileName = getFileNameWithoutExtension($fileName) . '-' . $i . '.' . $imageExtension;
                    $filePath = $uploadDir . $newFileName;
                    $i++;
                }
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
                    $errorMsg = "Gagal mengunggah file gambar.";
                }
                // Set $filePath hanya dengan nama file
                $filePath = basename($filePath);
            } else {
                // Gunakan gambar default jika tidak ada gambar yang diunggah
                $filePath = $defaultImage;
            }

            // Query untuk memasukkan data ke database
            $insertQuery = "INSERT INTO users (user_name, name, user_profile_path, user_bio, level_id, password, status) VALUES ('$userName', '$name', '$filePath', '$bio', 2, '$password', 'Nonaktif')";
            // Jalankan query
            if (empty($errorMsg) && mysqli_query($koneksi, $insertQuery)) {
                // Redirect ke halaman sukses dengan alert jika berhasil
                header("Location: index.php?pesan=registered");
                exit();
            } elseif (empty($errorMsg)) {
                $errorMsg = "Gagal memasukkan data ke database: " . mysqli_error($koneksi);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="icon" type="image/png" href="assets/ico/HitoriGotou.ico">
    <link rel="stylesheet" href="styles/alert.css">
</head>
<body>
    <?php
    if(isset($_GET['pesan'])){
        if($_GET['pesan']=="filetoolarge"){
            echo "<div class='alert'>File gambar tidak boleh lebih dari 512KB</div>";
        }
    }
    if(isset($_GET['pesan'])){
        if($_GET['pesan']=="unsupportedfile"){
            echo "<div class='alert'>Format file tidak didukung. Hanya JPG, JPEG, PNG, dan GIF yang diperbolehkan.</div>";
        }
    }
    ?>
    <div class="header">
        <h1>Daftar</h1>
        <p><a href="index.php">Kembali</a></p>
    </div>
    <div class="form">
        <form method="POST" enctype="multipart/form-data" class="form">
            <!-- Tampilkan pesan kesalahan jika ada -->
            <?php if (!empty($errorMsg)) { ?>
                <div class="alert"><?php echo $errorMsg; ?></div>
            <?php } ?>
            <label for="user_name">Username:</label>
            <input type="text" id="user_name" name="user_name" required>

            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" required>

            <!-- <label for="image" class="uploadimg">Upload Profile Image</label>
            <input type="file" id="image" name="image" accept="image/*">
            <img id="image-preview" src="#" alt="image-preview" style="display: none;">  -->
            <!-- Added image preview with display: none -->

            <label for="bio">Bio</label>
            <textarea id="bio" name="bio" placeholder="About you" rows="5" required></textarea>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button class="button" type="submit">Daftar</button>
        </form>
    </div>

    <script src="script/preview-img.js"></script>
    <script src="script/alert-time.js"></script>
</body>
</html>