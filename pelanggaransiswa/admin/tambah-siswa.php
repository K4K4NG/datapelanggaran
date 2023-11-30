<?php

include 'enc.php';

    $host="localhost";
    $user="root";
    $password="";
    $db="web_login";
    $koneksi = mysqli_connect($host,$user,$password,$db);
    if (!$koneksi){
          die("Koneksi gagal:".mysqli_connect_error());
    }
    
    session_start();
    if($_SESSION['status']!="login"){
        header("location:/pelanggaransiswa/login.php?pesan=belum_login");
    }
	
	if( isset($_POST['getsiswa']) ){
        $nisn = $_POST['nisn'];
		$nama = $_POST['nama'];
		$kelas = $_POST['kelas'];
		$jeniskelamin = $_POST['jenis-kelamin'];

		$sql = "INSERT INTO siswa_smkn (nisn_siswa, nama_siswa, kelas_siswa, jenis_kelamin) VALUES ('$nisn','$nama','$kelas','$jeniskelamin');";
		$result = mysqli_query($koneksi, $sql);

		if (!$result) {
			die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
		} else {
			header("Location: data.php");
			exit();
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

        <div class="container contact-form">
            <form action="" method="post">
                <h3>Menambahkan Siswa Pelanggaran</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="nama" class="form-control" placeholder="Nama siswa *" value="" />
                        </div>
                        <div class="form-group">
                            <select name="kelas" id="kelas" class="form-control">
                                <option value="XI Oracle">XI Oracle</option>
                                <option value="X Oracle">X Oracle</option>
                                <option value="XII Oracle">XII Oracle</option>
                                <option value="X PPLG">X PPLG</option>
                                <option value="XI PPLG">XI PPLG</option>
                                <option value="XII PPLG">XII PPLG</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="nisn" class="form-control" placeholder="Nisn Siswa *" value="" />
                        </div>
                        <div class="form-group">
                            <button type="submit" name="getsiswa" class="btn btn-primary btn-sm" > Masukan </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="jenis-kelamin" id="kelamin" class="form-control" style="width: 100%; height: 60px;">
                                <option value="Laki Laki">Laki Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>

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
        .contact-form .btn {
            width: 50%;
            border: none;
            border-radius: 20px;
            padding: 1.5%;
            text-align: center;
            font-weight: 600;
            cursor: pointer;
        }
    </style>
    <script>
        var inputKelas = document.querySelector('input[name="kelas"]');
        var selectKelas = document.getElementById('kelas');
        inputKelas.addEventListener('input', function() {
            selectKelas.value = inputKelas.value;
        });
    </script>
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