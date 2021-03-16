<?php 
session_start();
require 'functions.php';


// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key']) ){
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];



	// ambil username berdasarkan id
	$result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	// cek cookie dan username
	if ($key === hash('sha256', $row['username'])) {
		$_SESSION['login'] = true;
	}
}


if (isset($_SESSION["login"]) ){
	header("location: index.php");
	exit;
}



if (isset($_POST["Login"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];


	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");


	// cek username
	if (mysqli_num_rows($result) === 1 ) {
		

		// cek password
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row["password"]) ) {
			// set session
			$_SESSION["login"] = true;

			// cek remember me
			if (isset($_POST["remember"])) {
				// buat cookie

				setcookie('id', $row['id'], time() + 60);
				setcookie('key', hash('sha256', $row['username']),
					time()+60);
			}


		header("location: ../homedata.html");
		exit;
		}
	}

	$error = true;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Halaman Login</title>
	<!-- <link rel="stylesheet" href="style.css"> -->
	<style>


		.bodylogin{
			background-image: url(img/img2.png);
			background-repeat: no-repeat;
			background-position: center;
			background-size: cover;
			margin: 220px auto;
			background-color: #01a54e;
		}

		.loginbox {
			text-align: center;
			position: relative;
		}

		

	</style>
</head>
<body class="bodylogin">
<div class="loginbox">

<h1>Halaman Login</h1>

<?php if (isset($error)) :?>
	<p style="color: red; font-style:italic;" >username / password salah!</p>
<?php endif; ?>
<form action="" method="post">
	<div>	
		<input type="text" name="username" id="username" placeholder="Username" autocomplete="off" autofocus Srequired>
	</div>
	<br>
	<div>
		<input type="password" name="password"  id="password" placeholder="Password" required>
	</div>
	<div>
		<input type="checkbox" name="remember" id="remember">
		<label style="padding-right: 70px;" for="remember">remember me</label>
		<input type="checkbox" hidden>
	</div>	
	<div>		
		<button style="margin-right:45px;"class="btn" type="submit" name="Login">Login!</button>
		<button class="btnr"><a href="registrasi.php" style="text-decoration: none; color: black;">Registrasi</a></button>
	</div>
		<button style="margin-top: 5px;"><a style="text-decoration: none; color: black; padding: 0 56px 0 56px;" href="../home.html">Kembali</a></button>
</div>
</form>
</body>
</html>