<?php
include 'koneksi.php';

// Inisialisasi filter kelas dan kata kunci pencarian
$kelas = $_GET['kelas'];
$kataKunci = $_GET['kata_kunci'];

// Query SQL untuk mengambil data siswa sesuai dengan filter kelas dan pencarian
$sql = "SELECT * FROM ddatas WHERE kelas_siswa LIKE '%$kelas%' AND nama_siswa LIKE '%$kataKunci%'";
$result = $koneksi->query($sql);

$dataSiswa = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dataSiswa[] = array(
            'nama_siswa' => $row['nama_siswa'],
            'kelas_siswa' => $row['kelas_siswa'],
            'nama_pelanggaran' => $row['nama_pelanggaran'],
            'point_pelanggaran' => $row['point_pelanggaran'],
            'kategori_pelanggaran' => $row['kategori_pelanggaran']
        );
    }
}

echo json_encode($dataSiswa);

$koneksi->close();
?>
