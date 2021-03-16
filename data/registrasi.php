<?php 

session_start();

if (isset($_SESSION["login"]) ){
	header("location: login.php");
	exit;
}

require 'functions.php';

if (isset($_POST["register"])) {

	if (registrasi($_POST) > 0) {
		echo "<script>
			alert ('username baru berhasil ditambahkan');
		</script>";
	}else{
		echo mysqli_error($conn);
	}
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Registrasi</title>
	<style>


		.bodyregistrasi{
			background-image: url(img/img2.png);
			background-repeat: no-repeat;
			background-position: center;
			background-size: cover;
			margin: 220px;	
			background-color: #01a54e;		
		}

		.registrasibox {
			text-align: center;
			position: relative;
		}

		

	</style>
</head>
<body class="bodyregistrasi">
<div class="registrasibox">
	<h1>Halaman Registrasi</h1>

<form action="" method="post">					
			<label for="username">Username :</label><br>
			<input type="text" name="username" id="username" required>
			<br>
			<label for="password">password :</label><br>
			<input type="password" name="password" id="password" required>		
			<br>
			<label for="password2">konfirmasi password :</label><br>
			<input type="password" name="password2" id="password2" required>
			<br>
			<button type="submit" name="register">Register!</button>
			<button><a href="login.php" style="text-decoration: none; color: black;">Kembali</a></button>	
</form>
</div>


</body>
</html>