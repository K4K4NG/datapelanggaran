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
    <link rel="stylesheet" href="style.css">
    <title>Dashboar Admin</title>
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
					<h1>Admin</h1>
					<ul class="breadcrumb">
						<li>
							<a class="active" href="index.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="admin.php">Admin</a>
						</li>
					</ul>
				</div>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-group' ></i>
					<?php
					$data = mysqli_query($koneksi, "SELECT MAX(id) AS max_id FROM users");
					$max_id = mysqli_fetch_assoc($data)['max_id'];
					if (!empty($max_id)) {
    					echo '<span class="text">';
    					echo '<h3>' . $max_id . '</h3>';
    					echo '<p>Pengguna</p>';
    					echo '</span>';
					} else {
    					echo '<span class="text">';
    					echo '<p>Tidak ada data tersedia.</p>';
    					echo '</span>';
					}
					?>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<?php
					$data = mysqli_query($koneksi, "SELECT MAX(id) AS max_id FROM siswa_siswi");
					$max_id = mysqli_fetch_assoc($data)['max_id'];
					if (!empty($max_id)) {
    					echo '<span class="text">';
    					echo '<h3>' . $max_id . '</h3>';
    					echo '<p>Pelanggar</p>';
    					echo '</span>';
					} else {
    					echo '<span class="text">';
    					echo '<p>Tidak ada data tersedia.</p>';
    					echo '</span>';
					}
					?>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Siswa pelanggar</h3>
						<a class='bx bx-plus' href="tambah.php"></a>
					</div>
					<table>
						<thead>
							<tr>
								<th>Siswa</th>
								<th>Pelanggaran</th>
								<th>Kelas</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
            				$no = 1;
            				$data = mysqli_query($koneksi, "select * from ddatas");
            				while ($tampil = mysqli_fetch_array($data)) {
            				?>
							<tr>
								<td>
									<p><?php echo $tampil['nama_siswa']; ?></p>
								</td>
								<td>
									<p><?php echo $tampil['nama_pelanggaran']; ?></p>
								</td>
								<td>
									<p><?php echo $tampil['kelas_siswa']; ?></p>
								</td>
								<td>
   	 								<p>
        							<span class="status <?php echo $tampil['kategori_pelanggaran']; ?>"><?php echo $tampil['kategori_pelanggaran']; ?></span>
        							<a class='bx bx-trash' href="delete.php?id=<?php echo $tampil['id']; ?>"></a>
    								</p>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="todo">
					<div class="head">
						<h3>Pelanggaran</h3>
					</div>
					<ul class="todo-list">
						<li class="Berat">
							<p>Berat</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="Sedang">
							<p>Sedang</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="Ringan">
							<p>Ringan</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
					</ul>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>

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
	<script>
    // Check for the 'success' query parameter in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const successMessage = urlParams.get('success');

    // Display a notification if the 'success' parameter is present
    if (successMessage) {
        alert(successMessage);
    }
	</script>
</body>
</html>
