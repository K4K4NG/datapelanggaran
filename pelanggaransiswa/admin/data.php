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

if (isset($_POST['nama']) && isset($_POST['kelas'])) {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];

    // Menggunakan GROUP BY untuk mengambil hanya satu data per kelas
    $query = "SELECT * FROM siswa_smkn WHERE nama_siswa LIKE '%$nama%' AND kelas_siswa LIKE '%$kelas%'";
    $result = mysqli_query($koneksi, $query);
} else {
    // Jika input kosong, tampilkan semua data siswa
    $query = "SELECT * FROM siswa_smkn";
    $result = mysqli_query($koneksi, $query);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Data Data siswa</title>
</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
    </header>
    <?php 
        include 'sidebar.php';
    ?>
    <section id="content">
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Siswa</h1>
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
							<a class="active" href="data.php">Data</a>
						</li>
					</ul>
			    </div>
            </div>
            <div class="tambah-siswa">
                <div class="box">
                    <a class='bx bx-plus' href="tambah-siswa.php"> Tambah Data</a>
                </div>
            </div>
        </main>
    </section>
    <form method="post" action="" class="search-form">
    <input type="text" name="nama" placeholder="Cari berdasarkan nama">
    <select name="kelas">
        <option value="">Pilih Kelas</option>
        <?php
        $query_kelas = "SELECT DISTINCT kelas_siswa FROM siswa_smkn";
        $result_kelas = mysqli_query($koneksi, $query_kelas);

        while ($row_kelas = mysqli_fetch_assoc($result_kelas)) {
            $kelas_siswa = $row_kelas['kelas_siswa'];
            echo "<option value='$kelas_siswa'>$kelas_siswa</option>";
        }
        ?>
    </select>
    <button type="submit">Cari</button>
</form>

    <table class="custom-table">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>KELAS</th>
                <th>NISN</th>
                <th>QUERY</th>
            </tr>
        </thead>
        <tbody>
        <?php
$no = 1;
if (mysqli_num_rows($result) > 0) {
    while ($tampil = mysqli_fetch_array($result)) {
?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $tampil['nama_siswa']; ?></td>
            <td><?php echo $tampil['kelas_siswa']; ?></td>
            <td><?php echo $tampil['nisn_siswa']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $tampil['id']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                <a href="hapus.php?id=<?php echo $tampil["id"]; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
<?php
    }
} else {
    // Tampilkan pesan jika tidak ada hasil pencarian yang cocok
    echo '<tr><td colspan="5">Data kelas ini tidak terdaftar</td></tr>';
}
?>

        </tbody>
    </table>
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
    <style>
        .custom-table {
            margin: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-collapse: collapse;
            width: 100%;
        }

        .custom-table th,
        .custom-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        .custom-table th {
            background-color: #f2f2f2;
        }

        .custom-table tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");:root{--header-height: 3rem;--nav-width: 68px;--first-color: #4723D9;--first-color-light: #AFA5D9;--white-color: #F7F6FB;--body-font: 'Nunito', sans-serif;--normal-font-size: 1rem;--z-fixed: 100}*,::before,::after{box-sizing: border-box}body{position: relative;margin: var(--header-height) 0 0 0;padding: 0 1rem;font-family: var(--body-font);font-size: var(--normal-font-size);transition: .5s}a{text-decoration: none}.header{width: 100%;height: var(--header-height);position: fixed;top: 0;left: 0;display: flex;align-items: center;justify-content: space-between;padding: 0 1rem;background-color: var(--white-color);z-index: var(--z-fixed);transition: .5s}.header_toggle{color: var(--first-color);font-size: 1.5rem;cursor: pointer}.header_img{width: 35px;height: 35px;display: flex;justify-content: center;border-radius: 50%;overflow: hidden}.header_img img{width: 40px}.l-navbar{position: fixed;top: 0;left: -30%;width: var(--nav-width);height: 100vh;background-color: var(--first-color);padding: .5rem 1rem 0 0;transition: .5s;z-index: var(--z-fixed)}.nav{height: 100%;display: flex;flex-direction: column;justify-content: space-between;overflow: hidden}.nav_logo, .nav_link{display: grid;grid-template-columns: max-content max-content;align-items: center;column-gap: 1rem;padding: .5rem 0 .5rem 1.5rem}.nav_logo{margin-bottom: 2rem}.nav_logo-icon{font-size: 1.25rem;color: var(--white-color)}.nav_logo-name{color: var(--white-color);font-weight: 700}.nav_link{position: relative;color: var(--first-color-light);margin-bottom: 1.5rem;transition: .3s}.nav_link:hover{color: var(--white-color)}.nav_icon{font-size: 1.25rem}.show{left: 0}.body-pd{padding-left: calc(var(--nav-width) + 1rem)}.active{color: var(--white-color)}.active::before{content: '';position: absolute;left: 0;width: 2px;height: 32px;background-color: var(--white-color)}.height-100{height:100vh}@media screen and (min-width: 768px){body{margin: calc(var(--header-height) + 1rem) 0 0 0;padding-left: calc(var(--nav-width) + 2rem)}.header{height: calc(var(--header-height) + 1rem);padding: 0 2rem 0 calc(var(--nav-width) + 2rem)}.header_img{width: 40px;height: 40px}.header_img img{width: 45px}.l-navbar{left: 0;padding: 1rem 1rem 0 0}.show{width: calc(var(--nav-width) + 156px)}.body-pd{padding-left: calc(var(--nav-width) + 188px)}}
        :root {
	        --poppins: 'Poppins', sans-serif;
	        --lato: 'Lato', sans-serif;
	        --light: #F9F9F9;
	        --blue: #3C91E6;
	        --light-blue: #CFE8FF;
	        --grey: #eee;
	        --dark-grey: #AAAAAA;
	        --dark: #342E37;
	        --red: #DB504A;
	        --yellow: #FFCE26;
	        --light-yellow: #FFF2C6;
	        --orange: #FD7238;
	        --light-orange: #FFE0D3;
        }
        #content {
	        position: flex;
	        width: calc(100%);
	        left: 280px;
	        transition: .3s ease;
        }

        #content main {
	        width: 100%;
	        padding: 36px 24px;
	        font-family: var(--poppins);
	        max-height: calc(100vh - 56px);
	        overflow-y: auto;
        }
        #content main .tambah-siswa {
	        display: flex;
	        align-items: center;
	        justify-content: space-between;
	        grid-gap: 16px;
	        flex-wrap: wrap;
        }
        #content main .tambah-siswa .box a {
            display: block;
	        font-size: 15px;
            color: var(--blue);
        }
        #content main .head-title {
	        display: flex;
	        align-items: center;
	        justify-content: space-between;
	        grid-gap: 16px;
	        flex-wrap: wrap;
        }
        #content main .head-title .left h1 {
	        font-size: 36px;
	        font-weight: 600;
	        margin-bottom: 10px;
	        color: var(--dark);
        }
        #content main .head-title .left .breadcrumb {
	        display: flex;
	        align-items: center;
	        grid-gap: 16px;
        }
        #content main .head-title .left .breadcrumb li {
        	color: var(--dark);
        }
        #content main .head-title .left .breadcrumb li a {
        	color: var(--dark-grey);
	        pointer-events: none;
        }
        #content main .head-title .left .breadcrumb li a.active {
	        color: var(--blue);
	        pointer-events: unset;
        }
    </style>
    <style>@import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");:root{--header-height: 3rem;--nav-width: 68px;--first-color: #4723D9;--first-color-light: #AFA5D9;--white-color: #F7F6FB;--body-font: 'Nunito', sans-serif;--normal-font-size: 1rem;--z-fixed: 100}*,::before,::after{box-sizing: border-box}body{position: relative;margin: var(--header-height) 0 0 0;padding: 0 1rem;font-family: var(--body-font);font-size: var(--normal-font-size);transition: .5s}a{text-decoration: none}.header{width: 100%;height: var(--header-height);position: fixed;top: 0;left: 0;display: flex;align-items: center;justify-content: space-between;padding: 0 1rem;background-color: var(--white-color);z-index: var(--z-fixed);transition: .5s}.header_toggle{color: var(--first-color);font-size: 1.5rem;cursor: pointer}.header_img{width: 35px;height: 35px;display: flex;justify-content: center;border-radius: 50%;overflow: hidden}.header_img img{width: 40px}.l-navbar{position: fixed;top: 0;left: -30%;width: var(--nav-width);height: 100vh;background-color: var(--first-color);padding: .5rem 1rem 0 0;transition: .5s;z-index: var(--z-fixed)}.nav{height: 100%;display: flex;flex-direction: column;justify-content: space-between;overflow: hidden}.nav_logo, .nav_link{display: grid;grid-template-columns: max-content max-content;align-items: center;column-gap: 1rem;padding: .5rem 0 .5rem 1.5rem}.nav_logo{margin-bottom: 2rem}.nav_logo-icon{font-size: 1.25rem;color: var(--white-color)}.nav_logo-name{color: var(--white-color);font-weight: 700}.nav_link{position: relative;color: var(--first-color-light);margin-bottom: 1.5rem;transition: .3s}.nav_link:hover{color: var(--white-color)}.nav_icon{font-size: 1.25rem}.show{left: 0}.body-pd{padding-left: calc(var(--nav-width) + 1rem)}.active{color: var(--white-color)}.active::before{content: '';position: absolute;left: 0;width: 2px;height: 32px;background-color: var(--white-color)}.height-100{height:100vh}@media screen and (min-width: 768px){body{margin: calc(var(--header-height) + 1rem) 0 0 0;padding-left: calc(var(--nav-width) + 2rem)}.header{height: calc(var(--header-height) + 1rem);padding: 0 2rem 0 calc(var(--nav-width) + 2rem)}.header_img{width: 40px;height: 40px}.header_img img{width: 45px}.l-navbar{left: 0;padding: 1rem 1rem 0 0}.show{width: calc(var(--nav-width) + 156px)}.body-pd{padding-left: calc(var(--nav-width) + 188px)}}</style>
</body>
</html>