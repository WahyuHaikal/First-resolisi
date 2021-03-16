<?php 

session_start();

if (!isset($_SESSION["login"]) ){
	header("location: login.php");
	exit;


}

require'functions.php';
//cek apakah tombol submit sudah ditekan atau belum

if (isset($_POST["submit"])) {




// cek apakah data berhaasil ditambahkan atau tidak
	if (tambah($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "<script>
				alert('data gagal ditambahkan!');
				document.location.href = '';
			</script>
		";
	}
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Tambah data mahasiswa</title>
	<style>
		.tambahbox{
			display: flex;
			justify-content: center;
		}

		.tambahbox ul li {
			margin-top: 5px;
		}

		.bodytambah{
			background-image: url(img/img2.png);
			background-repeat: no-repeat;
			background-position: center;
			background-size: cover;
			margin: 50px;
			background-color: #01a54e;	
		}

		h1 {
			text-align: center;
		}

	</style>
</head>
<body class="bodytambah">
	<h1>Tambah data mahasiswa</h1>
<div class="tambahbox">	


<form action="" method="post" enctype="multipart/form-data">
	
		<ul>
			<li>
				<label for="nama">Nama :</label><br>
				<input type="text" name="nama" id="nama" size="35" required>
			</li>
			<li>
				<label for="tanggallahir">Nim :</label><br>
				<input type="text" name="nim" id="nim" size="35" required>
			</li>
				<li>
				<label for="jeniskelamin">Jenis Kelamin :</label>
				L <input type="radio" name="jeniskelamin" id="jeniskelamin" value="L" required
				value="<?= $mhs ["jeniskelamin"]; ?>"> 
				P <input type="radio" name="jeniskelamin" id="jeniskelamin" value="P" required
				value="<?= $mhs ["jeniskelamin"]; ?>"> 
			</li>
			<li>
				<label for="tanggallahir">Tanggal Lahir :</label><br>
				<input type="date" name="tanggallahir" id="tanggallahir" required>
			</li>
			<li>
				<label for="jurusan">Jurusan :</label><br>
				<input type="text" name="jurusan" id="jurusan" size="35" required>
			</li>
			<li>
				<label for="agama">Agama :</label>
				<select name="agama" id="agama">
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
				<input type="email" name="email" id="email" size="35" required>
			</li>
			<li>
				<label for="alamat">Alamat :</label><br>
				<input type="text" name="alamat" id="alamat" size="35" required>
			</li>
			<li>
				<label for="notelp">No.Telp :</label><br>
				<input type="char" name="notelp" id="notelp" size="35" required>
			</li>
			<li>
				<label for="gambar">Gambar :</label><br>
				<input type="file" name="gambar" id="gambar">
			</li>
			<li>
				<button type="submit" name="submit">Tambah Data!</button>
				<button ><a href="index.php" style="text-decoration: none; color: black;">Kembali</a></button>
			</li>

		</ul>
	
</form>
</div>
</body>
</html>