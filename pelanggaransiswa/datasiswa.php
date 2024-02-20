<?php 

include 'enc.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <style>
        /* Reset CSS untuk menghilangkan margin dan padding bawaan browser */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Gaya umum untuk halaman */
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0; /* Warna latar belakang halaman */
    margin: 0;
    padding: 0;
}

/* Gaya header */
.header {
    background-color: #007bff; /* Warna latar belakang header */
    color: #fff; /* Warna teks header */
    text-align: center;
    padding: 20px;
}

.header h1 {
    margin: 0;
    padding: 0;
    font-size: 24px;
}

/* Gaya konten */
.content {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff; /* Warna latar belakang konten */
    border: 1px solid #ddd; /* Garis pinggir konten */
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Bayangan konten */
}

/* Tombol "Kelas" */
#showClassesButton {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

/* Daftar kelas */
#kelasContainer {
    margin-top: 20px;
    padding: 10px;
    border: 1px solid #ddd;
    max-width: 300px;
    background-color: #f5f5f5;
}

#kelasContainer ul {
    list-style-type: none;
    padding: 0;
}

#kelasContainer ul li {
    margin-bottom: 5px;
    font-size: 16px;
    cursor: pointer;
}

/* Gaya kontainer siswa */
.siswa-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

/* Gaya kartu siswa */
.siswa-card {
    flex-basis: calc(33.33% - 20px);
    border: 1px solid #ddd;
    padding: 10px;
    margin-bottom: 20px;
    text-align: center;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.siswa-card h2 {
    font-size: 18px;
    margin-bottom: 10px;
}

/* Gaya tombol "Kembali" */
.button {
    display: block;
    margin-top: 20px;
    text-align: center;
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
}

.button:hover {
    background-color: #0056b3; /* Warna saat tombol dihover */
}

    </style>
</head>
<body>
    <div class="header">
        <h1>Data Siswa</h1>
    </div>
    <div class="content">
        <div class="filter-container">
            <label for="filterKelas">Filter Kelas:</label>
            <select id="filterKelas">
                <option value="Semua">Pilih data</option>
                <?php
                include 'koneksi.php';
                $sql = "SELECT DISTINCT kelas_siswa FROM ddatas";
                $result = $koneksi->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['kelas_siswa'] . '">' . $row['kelas_siswa'] . '</option>';
                }
                ?>
            </select>
            <label for="searchInput">Cari Siswa:</label>
            <input type="text" id="searchInput" placeholder="Nama Siswa">
            <button id="searchButton">Cari</button>
        </div>
        <div id="siswaContainer"></div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const filterKelas = document.getElementById("filterKelas");
            const searchInput = document.getElementById("searchInput");
            const searchButton = document.getElementById("searchButton");
            const siswaContainer = document.getElementById("siswaContainer");

            function tampilkanDataSiswa() {
                const kelas = filterKelas.value;
                const kataKunci = searchInput.value;

                fetch(`get_data_siswa.php?kelas=${kelas}&kata_kunci=${kataKunci}`)
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.length > 0) {
                            siswaContainer.innerHTML = "";
                            data.forEach((siswa) => {
                                const siswaCard = document.createElement("div");
                                siswaCard.className = "siswa-card";
                                siswaCard.innerHTML = `
                                    <h2>${siswa.nama_siswa}</h2>
                                    <p>Kelas: ${siswa.kelas_siswa}</p>
                                    <p>Pelanggaran: ${siswa.nama_pelanggaran}</p>
                                    <p>Point: ${siswa.point_pelanggaran}</p>
                                    <p>Kategori: ${siswa.kategori_pelanggaran}</p>
                                `;
                                siswaContainer.appendChild(siswaCard);
                            });
                        } else {
                            siswaContainer.innerHTML = "Data siswa tidak ditemukan.";
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                    });
            }

            // Event listener untuk tombol "Cari"
            searchButton.addEventListener("click", tampilkanDataSiswa);

            // Event listener ketika input atau pilihan filter berubah
            filterKelas.addEventListener("change", tampilkanDataSiswa);
            searchInput.addEventListener("input", tampilkanDataSiswa);

            // Tampilkan data siswa pertama kali saat halaman dimuat
            tampilkanDataSiswa();
        });
    </script>
</body>
</html>