<?php 
session_start();

if (!isset($_SESSION["login"]) ){
	header("location: login.php");
	exit;


}
require'functions.php';
//cek apakah tombol submit sudah ditekan atau belum


// ambil data di url

$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];


if (isset($_POST["submit"])) {



// cek apakah data berhaasil ditambahkan atau tidak
	if (ubah($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "<script>
				alert('data gagal diubah!');
				document.location.href = '';
			</script>
		";
	}
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Ubah Data Mahasiswa</title>
	<style>
		.ubahbox{
			display: flex;
			justify-content: center;
		}

		.ubahbox ul li {
			margin-top: 5px;
		}

		.bodybox{
			background-image: url(img/img2.png);
			background-repeat: no-repeat;
			background-position: center;
			background-size: cover;
			background-color: #01a54e;
		}

		h1 {
			text-align: center;
		}

	</style>
</head>
<body class="bodybox">
	<h1>UBAH DATA MAHASISWA</h1>
<div class="ubahbox">
	


	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
		<input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
		<ul>
			<li>
				<label for="nama">Nama :</label><br>
				<input type="text" name="nama" id="nama" size="42" required
				value="<?= $mhs ["nama"]; ?>">
			</li>
			<li>
				<label for="nim">Nim :</label><br>
				<input type="text" name="nim" id="nim" size="42"required
				value="<?= $mhs ["nim"]; ?>">
			</li>
			<li>
				<label for="jeniskelamin">Jenis Kelamin :</label><br>
				L <input type="radio" name="jeniskelamin" id="jeniskelamin" value="L" required
				value="<?= $mhs ["jeniskelamin"]; ?>"> 
				P <input type="radio" name="jeniskelamin" id="jeniskelamin" value="P" required
				value="<?= $mhs ["jeniskelamin"]; ?>"> 
			</li>
			<li>
				<label for="tanggallahir">Tanggal Lahir :</label><br>
				<input type="date" name="tanggallahir" id="tanggallahir" size="42"required>
			</li>

			<li>
				<label for="jurusan">Jurusan :</label><br>
				<input type="text" name="jurusan" id="jurusan" size="42"required
				value="<?= $mhs ["jurusan"]; ?>">
			</li>
			<li>
				<label for="agama">Agama :</label><br>
				<select name="agama" id="agama">
					<option>-</option>
					<option>Islam</option>
					<option>Kristen</option>
					<option>Hindu</option>
					<option>Protestan</option>
					<option>Katolik</option>
					<option>Budha</option>
				</select required>

			</li>
			<li>
				<label for="email">Email :</label><br>
				<input type="email" name="email" id="email" size="42"required
				value="<?= $mhs ["email"]; ?>">
			</li>
			<li>
				<label for="alamat">Alamat :</label><br>
				<input type="text" name="alamat" id="alamat" size="42"required
				value="<?= $mhs ["alamat"]; ?>">
			</li>
			<li>
				<label for="notelp">No.Telp :</label><br>
				<input type="number" name="notelp" id="notelp" size="42"required
				value="<?= $mhs ["notelp"]; ?>">
			</li>
			<li>
				<label for="gambar">Gambar :</label><br>
				<img src="img/<?= $mhs ['gambar']; ?>">	<br>
				<input type="file" name="gambar" id="gambar">
			</li>
			<li>
				<button type="submit" name="submit">ubah Data!</button>
				<button><a href="index.php" style="text-decoration: none; color: black;">Kembali</a></button>
			</li>

		</ul>
</div>



</form>



</body>
</html>