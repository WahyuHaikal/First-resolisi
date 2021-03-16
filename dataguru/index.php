<?php 

session_start();

if (!isset($_SESSION["login"]) ){
	header("location: login.php");
	exit;


}
require 'functions.php';
// ORDER BY id DESC (besar ke kecil)/ ASC(kecil ke besar)
$guru = query("SELECT * FROM guru");

// tombol cari ditekan
if (isset($_POST["cari"])) {
	$guru = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
	<style>
		.bodyindex{
			background-image: url(img/img2.png);
			background-repeat: repeat-x;
			background-position: center;
			background-size: cover;
			background-color: #01a54e;			
		}

		h1 {
			text-align: center;
			font-size: 50px;
		}

	</style>

</head>
<body class="bodyindex">



<h1>Data Guru</h1>



<form style="" action="" method="post">
<a href="tambah.php" style="text-decoration: none; margin-right:650px;">Tambah data guru</a>
	<!-- input size(panjang pencarian), autofocus(langsung isi pencarian), autocomplete(history pencarian) -->
<input type="text" name="keyword" size="40" autofocus placeholder="masukan keyword pencarian..." autocomplete="off" id="keyword"
>
<button type="text" name="cari" id="tombol-cari" >Cari!</button>
<button type="text" name="refresh" >Refresh!</button>
<button type="button" name="kembali"><a style="text-decoration: none; color: black ;" href="../homedata.html">Kembali</a></button>
</form>

<br>
<div id="container">
<table border="2" cellpadding="15 " cellspacing="0">
	<tr>
		<th>No.</th>
		<th>Aksi</th>
		<th>Gambar</th>
		<th>Nama</th>
		<th>nip</th>
		<th>Jenis Kelamin</th>
		<th>Tanggal Lahir</th>
		<th>mapel</th>
		<th>Agama</th>
		<th>Email</th>
		<th>Alamat</th>
		<th>No.Telp</th>
	</tr>

<?php $i = 1; ?>
<?php foreach ($guru as $row) : ?>
	<tr>

		<td><?= $i; ?></td>
		<td>
			<a href="ubah.php?id=<?= $row ["id"]; ?>">Ubah</a> |
			<!-- onclick javascript -->
			<a href="hapus.php?id=<?= $row ["id"]; ?>" onclick="return confirm('Yakin?');">Hapus</a>
		</td>
		<td><img src="img/<?= $row["gambar"]; ?>"width="30"></td>
		<td><?= $row["nama"]; ?></td>
		<td><?= $row["nip"]; ?></td>
		<td><?= $row["jeniskelamin"]; ?></td>
		<td><?= $row["tanggallahir"]; ?></td>
		<td><?= $row["mapel"]; ?></td>
		<td><?= $row["agama"]; ?></td>
		<td><?= $row["email"]; ?></td>
		<td><?= $row["alamat"]; ?></td>
		<td><?= $row["notelp"]; ?></td>
	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>

</table>
</div>
<script src="js/script.js"></script>

</body>
</html>