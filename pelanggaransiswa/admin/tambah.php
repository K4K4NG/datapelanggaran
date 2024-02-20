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

if (isset($_POST['getpelanggaran'])) {
    $namaSiswaId = $_POST['nama'];
    $kelasSiswaId = $_POST['kelas'];
    $pointPelanggaran = $_POST['point'];
    $pelanggaranId = $_POST['pelanggaran'];
    $kelaminSiswaId = $_POST['kelamin'];
    $kategoriPelanggaranId = $_POST['kategori'];
    $sql = "INSERT INTO data_pelanggaran (nama_pelanggaran, point_pelanggaran,kategori_pelanggaran) VALUES ('$pelanggaranId', '$pointPelanggaran', '$kategoriPelanggaranId')";
    $sql2 = "INSERT INTO siswa_siswi (nama_siswa, kelas_siswa,jenis_kelamin) VALUES ('$namaSiswaId', '$kelasSiswaId', '$kelaminSiswaId')";
    if (mysqli_query($koneksi, $sql2)) {
        echo "Data siswa dan pelanggaran berhasil disisipkan.";
        header("location:admin.php");
    } else {
        echo "Error: " . $sql2 . "<br>" . mysqli_error($koneksi);
    }
    if (mysqli_query($koneksi, $sql)) {
        echo "Data siswa dan pelanggaran berhasil disisipkan.";
            header("location:admin.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa SMK </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
    </header>
	<?php include 'sidebar.php'; ?>
    <section id="content">
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Menambahkan Siswa Pelanggaran</h1>
					<ul class="breadcrumb">
						<li>
							<a class="active" href="index.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="admin.php">Admin</a>
						</li>
                        <li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="#">tambah</a>
						</li>
					</ul>
				</div>
                <div class="container contact-form">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="nama" id="nama" placeholder="Nama siswa *" class="form-control">
                                        <?php
                                            $result = $koneksi->query("select * from siswa_smkn");
                                            while ($tampil = $result->fetch_assoc()) {
                                                echo '<option value="' . $tampil['nama_siswa'] . '">' . $tampil['nama_siswa'] . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="kelas" id="kelas" placeholder="Kelas siswa *" class="form-control">
                                        <?php
                                            $result = $koneksi->query("select * from macam_kelas");
                                            while ($tampil = $result->fetch_assoc()) {
                                                echo '<option value="' . $tampil['kelas_kelas'] . '">' . $tampil['kelas_kelas'] . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="kategori" id="kategori" placeholder="Kategori pelanggaran *" class="form-control">
                                        <option value="Sedang">Sedang</option>
                                        <option value="Berat">Berat</option>
                                        <option value="Ringan">Ringan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="kelamin" id="kelamin" placeholder="Kelamin siswa *" class="form-control">
                                        <option value="Laki Laki">Laki Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="point" id="point" placeholder="Point siswa *" class="form-control">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                        <option value="60">60</option>
                                        <option value="70">70</option>
                                        <option value="80">80</option>
                                        <option value="90">90</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <input type="submit" name="getpelanggaran" class="btnContact" value="Masukan" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <input type="text" name="pelanggaran" id="pelanggaran" class="form-control" placeholder="Pelanggaran siswa *" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
			</div>
        </main>
    </section>

    <style>
        .contact-form{
            background: #fff;
            margin-top: 10%;
            margin-bottom: 5%;
            width: 70%;
        }
        .contact-form .form-control{
            border-radius:1rem;
        }
        .contact-image{
            text-align: center;
        }
        .contact-image img{
            border-radius: 6rem;
            width: 11%;
            margin-top: -3%;
            transform: rotate(29deg);
        }
        .contact-form form{
            padding: 14%;
        }
        .contact-form form .row{
            margin-bottom: -7%;
        }
        .contact-form h3{
            margin-bottom: 8%;
            margin-top: -10%;
            text-align: center;
            color: #0062cc;
        }
        .contact-form .btnContact {
            width: 50%;
            border: none;
            border-radius: 1rem;
            padding: 1.5%;
            background: #dc3545;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
        }
        .btnContactSubmit {
            width: 50%;
            border-radius: 20px;
            padding: 1.5%;
            color: #fff;
            background-color: #0062cc;
            border: none;
            cursor: pointer;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const showNavbar = (toggleId, navId, bodyId, headerId) =>{
            const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId)
            if(toggle && nav && bodypd && headerpd){
                toggle.addEventListener('click', ()=>{
                    nav.classList.toggle('show')
                    toggle.classList.toggle('bx-x')
                    bodypd.classList.toggle('body-pd')
                    headerpd.classList.toggle('body-pd')
                })}
            }
            showNavbar('header-toggle','nav-bar','body-pd','header')
            const linkColor = document.querySelectorAll('.nav_link')
            function colorLink(){
                if(linkColor){
                    linkColor.forEach(l=> l.classList.remove('active'))
                    this.classList.add('active')
                }
            }
            linkColor.forEach(l=> l.addEventListener('click', colorLink))
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>