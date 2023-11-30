<?php
	session_start();
	include 'koneksi.php';
	include 'enc.php';
    if( isset($_POST['login']) ){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$data = mysqli_query($koneksi,"select * from users where username='$username' and password='$password'");
		$cek = mysqli_num_rows($data);
		
		if($cek > 0){
		$_SESSION['username'] = $username;
		$_SESSION['status'] = "login";
		header("location:admin/index.php");
		}else{
			header("location:login.php?pesan=gagal");
		
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Login | to page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif
  }

  body {
    height: 100vh;
    animation: backgroundAnimation 10s ease infinite;
    background: radial-gradient(aqua 13%, rgb(235, 135, 202));
  }

  @keyframes backgroundAnimation {
    0% {
      background-position: 0% 0%;
    }
    100% {
      background-position: 100% 100%;
    }
  }

  .container {
    margin: 50px auto;
  }

    #forgot {
      min-width: 100px;
      margin-left: auto;
      text-decoration: none
    }

    a:hover {
      text-decoration: none
    }

    .form-inline label {
      padding-left: 10px;
      margin: 0;
      cursor: pointer
    }

    .btn.btn-primary {
      margin-top: 20px;
      border-radius: 15px
    }

    .btn.btn-primary:hover{
      margin-top: 20px;
      border-radius: 15px;
      background-color: #00FFFF;
      border: none
    }

    .panel {
      width: 300;
      height: 400px;
      box-shadow: 20px 20px 80px rgb(218, 218, 218);
      border-radius: 12px
    }

    .input-field {
      border-radius: 5px;
      padding: 5px;
      display: flex;
      align-items: center;
      cursor: pointer;
      border: 1px solid #ddd;
      color: #4343ff
    }

    input[type='text'],
    input[type='password'] {
      border: none;
      outline: none;
      box-shadow: none;
      width: 100%
    }

    .fa-eye-slash.btn {
      border: none;
      outline: none;
      box-shadow: none
    }

    img {
      width: 40px;
      height: 40px;
      object-fit: cover;
      border-radius: 50%;
      position: relative
    }

    a[target='_blank'] {
      position: relative;
      transition: all 0.1s ease-in-out
    }

    .bordert {
      border-top: 1px solid #aaa;
      position: relative
    }

    .bordert:after {
      content: "selengkap nya";
      position: absolute;
      top: -13px;
      left: 33%;
      background-color: #fff;
      padding: 0px 8px
    }
    .text-danger {
      color: red;
      font-size: 14px;
      margin-top: -10px;
      margin-bottom: 10px;
    }

    @media(max-width: 360px) {
      #forgot {
        margin-left: 0;
        padding-top: 10px
      }

      body {
        height: 100%
      }

      .container {
        margin: 30px 0
      }

      .bordert:after {
        left: 25%
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="offset-md-2 col-lg-5 col-md-7 offset-lg-4 offset-md-3">
        <div class="panel border bg-white">
          <div class="panel-body p-3">
            <form action="" method="POST">
              <div class="form-group py-2">
                <div class="input-field"> <span class="far fa-user p-2"></span> <input type="text" id="username" name="username" placeholder="Username" required> </div>
              </div>
              <div class="form-group py-1 pb-2">
                <div class="input-field"> <span class="fas fa-lock px-2"></span> <input type="password" id="password" name="password" placeholder="Enter your Password" required> <button class="btn bg-white text-muted"> <span class="far fa-eye-slash"></span> </button> </div>
              </div>
              <?php if (isset($_GET['pesan']) && $_GET['pesan'] === 'gagal') {
                      echo '<p class="text-danger">Username or password is incorrect.</p>';
                    }
              ?>
              <div class="form-inline"> <input type="checkbox" name="remember" id="remember"> <label for="remember" class="text-muted">Remember me</label> <a href="#" id="forgot" class="font-weight-bold">Forgot password?</a> </div>
              <button type="sumbit" name="login" class="btn btn-primary btn-block mt-3">Login</button>
              <div class="text-center pt-4 text-muted">to dasboaard home? <a href="index.php">Home</a> </div>
            </form>
          </div>
          <div class="mx-3 my-2 py-2 bordert">
            <div class="text-center py-3"> <a href="https://wwww.facebook.com" target="_blank" class="px-2"> <img src="https://www.dpreview.com/files/p/articles/4698742202/facebook.jpeg" alt=""> </a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<body>
</html>
