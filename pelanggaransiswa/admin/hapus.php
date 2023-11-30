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

    // Delete the student data based on the ID
    $deleteQuery = "DELETE FROM siswa_smkn WHERE id = $id";
    $deleteResult = mysqli_query($koneksi, $deleteQuery);

    if ($deleteResult) {
        header("location:data.php"); // Redirect to the data page after deletion
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
