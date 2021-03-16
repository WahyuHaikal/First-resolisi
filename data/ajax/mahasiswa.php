<?php 
require '../functions.php';

$keyword = $_GET["keyword"];


$query = "SELECT * FROM mahasiswa
		WHERE
		nama LIKE  '%$keyword%' OR
		nim LIKE  '%$keyword%' OR
		jeniskelamin LIKE  '%$keyword%' OR
		tanggallahir LIKE  '%$keyword%' OR
		jurusan LIKE  '%$keyword%' OR
		agama LIKE  '%$keyword%' OR
		email LIKE  '%$keyword%' OR
		alamat LIKE  '%$keyword%' OR
		notelp LIKE  '%$keyword%'
		";
$mahasiswa = query($query);

?>
<table border="2" cellpadding="15 " cellspacing="0">
	<tr>
		<th>No.</th>
		<th>Aksi</th>
		<th>Gambar</th>
		<th>Nama</th>
		<th>Nim</th>
		<th>Jenis Kelamin</th>
		<th>Tanggal Lahir</th>
		<th>Jurusan</th>
		<th>agama</th>
		<th>Email</th>
		<th>Alamat</th>
		<th>No.Telp</th>
	</tr>

<?php $i = 1; ?>
<?php foreach ($mahasiswa as $row) : ?>
	<tr>

		<td><?= $i; ?></td>
		<td>
			<a href="ubah.php?id=<?= $row ["id"]; ?>">Ubah</a> |
			<!-- onclick javascript -->
			<a href="hapus.php?id=<?= $row ["id"]; ?>" onclick="return confirm('Yakin?');">Hapus</a>
		</td>
		<td><img src="img/<?= $row["gambar"]; ?>"width="30"></td>
		<td><?= $row["nama"]; ?></td>
		<td><?= $row["nim"]; ?></td>
		<td><?= $row["jeniskelamin"]; ?></td>
		<td><?= $row["tanggallahir"]; ?></td>
		<td><?= $row["jurusan"]; ?></td>
		<td><?= $row["agama"]; ?></td>
		<td><?= $row["email"]; ?></td>
		<td><?= $row["alamat"]; ?></td>
		<td><?= $row["notelp"]; ?></td>
	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>

</table>