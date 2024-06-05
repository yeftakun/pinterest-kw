<?php

session_start();
include '../koneksi.php';

// query data level
$queryLevel = "SELECT * FROM level";
$resultLevel = mysqli_query($koneksi, $queryLevel);

// query data otp
$queryOTP = "SELECT * FROM otp";
$resultOTP = mysqli_query($koneksi, $queryOTP);

// query data posts
$queryPosts = "SELECT * FROM posts";
$resultPosts = mysqli_query($koneksi, $queryPosts);

// query data users
$queryUsers = "SELECT * FROM users";
$resultUsers = mysqli_query($koneksi, $queryUsers);

$levelRowIsEmpty = "";


if(isset($_SESSION['level_id'])) {
    if($_SESSION['level_id'] == 1) {
        // beranda admin
?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Admin Panel</title>
            <!-- Tambahkan CSS atau link ke file CSS eksternal di sini -->
            <link rel="stylesheet" type="text/css" href="../styles/style.css">
            <link rel="stylesheet" type="text/css" href="../styles/alert.css">
            <link rel="stylesheet" type="text/css" href="../styles/modal.css">
            <link rel="icon" type="image/png" href="../assets/ico/HitoriGotou.ico">
        </head>
        <body>

        <header>
            <div class="logo">
                <img src="../assets/ico/HitoriGotou.ico" alt="logo" width="50">
            </div>
            <div class="home-search-bar">
                <form action="search_result.php" method="GET">
                    <input type="text" name="search" id="searchInput" placeholder="Judul / #tag / username">
                    <input type="submit" value="Search">
                </form>
            </div>
            <div class="nav-to">
                <p><a href="beranda.php">Beranda</a></p>
            </div>
            <div class="nav-to">
                <p><a href="admin_panel.php">Admin Panel</a></p>
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
        <div class="panel-search-bar">
            <form action="" method="get">
                <input type="text" name="search" id="searchData" placeholder="Cari">
            </form>
        </div>
        <?php
        if(isset($GET['pesan'])) {
            if($_GET['pesan'] == "success_delete") {
                echo "<div class='done'>
                    Data berhasil dihapus.
                </div>";
            }
        } else if(isset($_GET['pesan'])) {
            if($_GET['pesan'] == "failed_delete") {
                echo "<div class='alert'>
                    Data gagal dihapus.
                </div>";
            }
        }
        ?>

        <div class="container">
            <h2>Level Table</h2>
            <a href="crud/add_data.php?page=level">Add Data</a>
            <!-- Tabel Level disini -->
            <table id="levelTable">
                <?php
                if (mysqli_num_rows($resultLevel) > 0) {
                    // Jika ada data yang sesuai
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Name</th>";
                    echo "<th>Control</th>";
                    echo "</tr>";

                    while($rowLevel = mysqli_fetch_assoc($resultLevel)) {
                        echo "<tr>";
                        echo "<td>".$rowLevel['level_id']."</td>";
                        echo "<td>".$rowLevel['level_name']."</td>";
                        echo "<td>";
                        echo "<a href='crud/edit_data.php?page=level&id=".$rowLevel['level_id']."'>Edit</a> | ";
                        // Tambahkan tombol delete dengan atribut data-id
                        echo "<a class='deleteBtn' data-id='".$rowLevel['level_id']."' data-page='level'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Data tidak ditemukan</td></tr>";
                }
                ?>
            </table>
        </div>

        <div class="container">
            <h2>OTP Table</h2>
            <a href="crud/add_data.php?page=otp">Add Data</a>
            <table id="otpTable">
                <!-- Tabel OTP disini -->
                <?php
                if (mysqli_num_rows($resultOTP) > 0) {
                    echo "<tr>";
                    echo "<th>User Name</th>";
                    echo "<th>OTP Code</th>";
                    echo "<th>Control</th>";
                    echo "</tr>";
                    while($rowOtp = mysqli_fetch_assoc($resultOTP)) {
                        echo "<tr>";
                        echo "<td>".$rowOtp['user_name']."</td>";
                        echo "<td>".$rowOtp['otp_code']."</td>";
                        echo "<td>";
                        echo "<a class='deleteBtn' data-id='".$rowOtp['id']."' data-page='otp'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<th>User Name</th>";
                    echo "<th>OTP Code</th>";
                    echo "<th>Control</th>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td colspan='3'>Data tidak ditemukan</td>";
                }
                ?>
            </table>
        </div>

        <div class="container">
            <h2>Posts Table</h2>
            <a href="crud/add_data.php?page=posts">Add Data</a>
            <table id="postsTable">
                <!-- Tabel Posts disini -->
                <?php
                if (mysqli_num_rows($resultPosts) > 0) {
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>User ID</th>";
                    echo "<th>Post Title</th>";
                    echo "<th>Post Description</th>";
                    echo "<th>Post Link</th>";
                    echo "<th>Post Img Path</th>";
                    echo "<th>Post Date</th>";
                    echo "<th>Control</th>";
                    echo "</tr>";
                    while($rowPost = mysqli_fetch_assoc($resultPosts)) {
                        echo "<tr>";
                        echo "<td>".$rowPost['post_id']."</td>";
                        echo "<td>".$rowPost['user_id']."</td>";
                        echo "<td>".$rowPost['post_title']."</td>";
                        echo "<td>".$rowPost['post_description']."</td>";
                        echo "<td>".$rowPost['post_link']."</td>";
                        echo "<td>".$rowPost['post_img_path']."</td>";
                        echo "<td>".$rowPost['create_in']."</td>";
                        echo "<td>";
                        echo "<a href='crud/edit_data.php?page=posts&id=".$rowPost['post_id']."'>Edit</a> | ";
                        echo "<a class='deleteBtn' data-id='".$rowPost['post_id']."' data-page='posts'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>User ID</th>";
                    echo "<th>Post Title</th>";
                    echo "<th>Post Description</th>";
                    echo "<th>Post Link</th>";
                    echo "<th>Post Img Path</th>";
                    echo "<th>Control</th>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td colspan='7'>Data tidak ditemukan</td>";
                }
                ?>
            </table>
        </div>

        <div class="container">
            <h2>Users Table</h2>
            <a href="crud/add_data.php?page=users">Add Data</a>
            <table id="usersTable">
                <!-- Tabel Users disini -->
                <?php
                if (mysqli_num_rows($resultUsers) > 0) {
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>User Name</th>";
                    echo "<th>Name</th>";
                    echo "<th>User Profile Path</th>";
                    echo "<th>User Bio</th>";
                    echo "<th>Level ID</th>";
                    echo "<th>Password</th>";
                    echo "<th>Status</th>";
                    echo "<th>Tele Chat ID</th>";
                    echo "<th>Control</th>";
                    echo "</tr>";
                    while($rowUser = mysqli_fetch_assoc($resultUsers)) {
                        echo "<tr>";
                        echo "<td>".$rowUser['user_id']."</td>";
                        echo "<td>".$rowUser['user_name']."</td>";
                        echo "<td>".$rowUser['name']."</td>";
                        echo "<td>".$rowUser['user_profile_path']."</td>";
                        echo "<td>".$rowUser['user_bio']."</td>";
                        echo "<td>".$rowUser['level_id']."</td>";
                        echo "<td>".$rowUser['password']."</td>";
                        echo "<td>".$rowUser['status']."</td>";
                        echo "<td>".$rowUser['tele_chat_id']."</td>";
                        echo "<td>";
                        echo "<a href='crud/edit_data.php?page=users&id=".$rowUser['user_id']."'>Edit</a> | ";
                        echo "<a class='deleteBtn' data-id='".$rowUser['user_id']."' data-page='users'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>User Name</th>";
                    echo "<th>Name</th>";
                    echo "<th>User Profile Path</th>";
                    echo "<th>User Bio</th>";
                    echo "<th>Level ID</th>";
                    echo "<th>Password</th>";
                    echo "<th>Status</th>";
                    echo "<th>Tele Chat ID</th>";
                    echo "<th>Control</th>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td colspan='10'>Data tidak ditemukan</td>";
                }
                ?>
            </table>
        </div>

        <!-- Modal konfirmasi penghapusan -->
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Apakah Anda yakin ingin menghapus data ini?</p>
                <button id="confirmDelete">Delete</button>
            </div>
        </div>

        <script>
        // Fungsi untuk menampilkan modal konfirmasi penghapusan
        function showModal(id, page) {
            var modal = document.getElementById("deleteModal");
            var confirmBtn = document.getElementById("confirmDelete");
            modal.style.display = "block";

            // Ketika tombol delete pada modal diklik, kirim permintaan penghapusan
            confirmBtn.onclick = function() {
                // Kirim permintaan penghapusan ke server melalui AJAX
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4) {
                        // Tampilkan pesan hasil penghapusan atau perbarui tampilan tabel
                        // Misalnya, muat ulang halaman setelah penghapusan selesai
                        if (xhr.status == 200) {
                            window.location.reload();
                        } else {
                            alert("Gagal menghapus data: " + xhr.responseText);
                        }
                    }
                };
                xhr.open("GET", "crud/delete_data.php?page=" + page + "&id=" + id, true);
                xhr.send();
            }
        }

        // Tambahkan event listener untuk tombol delete pada setiap baris tabel
        var deleteBtns = document.querySelectorAll(".deleteBtn");
        deleteBtns.forEach(function(btn) {
            btn.addEventListener("click", function() {
                var id = this.getAttribute("data-id");
                var page = this.getAttribute("data-page");
                showModal(id, page);
            });
        });


        // Fungsi untuk menutup modal saat tombol close diklik
        var closeBtn = document.querySelector(".close");
        closeBtn.onclick = function() {
            var modal = document.getElementById("deleteModal");
            modal.style.display = "none";
        }

        // Fungsi untuk menutup modal saat area di luar modal diklik
        window.onclick = function(event) {
            var modal = document.getElementById("deleteModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>

        <script>
            // Fungsi untuk melakukan pencarian dan menampilkan hanya baris yang sesuai
            function searchData(input) {
                // Konversi input menjadi huruf kecil untuk pencocokan yang tidak case-sensitive
                var searchText = input.toLowerCase();
                // Temukan semua tabel
                var tables = document.querySelectorAll("table");
                tables.forEach(function(table) {
                    // Temukan semua baris dalam tabel
                    var rows = table.getElementsByTagName("tr");
                    // Loop melalui semua baris, mulai dari 1 untuk melewati baris header
                    for (var i = 1; i < rows.length; i++) {
                        var row = rows[i];
                        // Dapatkan semua sel dalam baris
                        var cells = row.getElementsByTagName("td");
                        var found = false;
                        // Loop melalui semua sel dalam baris
                        for (var j = 0; j < cells.length; j++) {
                            var cell = cells[j];
                            // Periksa apakah teks dalam sel cocok dengan input pencarian
                            if (cell.textContent.toLowerCase().indexOf(searchText) > -1) {
                                found = true;
                                break; // Pergi ke baris berikutnya jika pencocokan ditemukan
                            }
                        }
                        // Tampilkan atau sembunyikan baris sesuai dengan hasil pencarian
                        if (found) {
                            row.style.display = ""; // Tampilkan baris
                        } else {
                            row.style.display = "none"; // Sembunyikan baris
                        }
                    }
                });
            }

            // Tambahkan event listener untuk memanggil fungsi pencarian saat nilai input berubah
            var searchInput = document.getElementById("searchData");
            searchInput.addEventListener("input", function() {
                searchData(this.value);
            });
        </script>

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