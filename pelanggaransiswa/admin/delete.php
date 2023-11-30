<?php
include 'enc.php';

$host = "localhost";
$user = "root";
$password = "";
$db = "web_login";
$koneksi = mysqli_connect($host, $user, $password, $db);
if (!$koneksi) {
    die("Koneksi gagal:" . mysqli_connect_error());
}

session_start();
if ($_SESSION['status'] != "login") {
    header("location:/pelanggaransiswa/login.php?pesan=belum_login");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Perform a LEFT JOIN query to delete student records from both tables
    $deleteQuery = "DELETE siswa_siswi,data_pelanggaran FROM siswa_siswi LEFT JOIN data_pelanggaran ON siswa_siswi.id = data_pelanggaran.id WHERE siswa_siswi.id = '$id'";
    
    $deleteResult = mysqli_query($koneksi, $deleteQuery);

    if ($deleteResult) {
        header("location:admin.php?success=Data berhasil dihapus");
        exit;
    } else {
        echo "Deletion failed: " . mysqli_error($koneksi);
        exit;
    }    
} else {
    echo "Invalid student ID.";
    exit;
}
?>
