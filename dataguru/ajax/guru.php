<?php 
require '../functions.php';

$keyword = $_GET["keyword"];


$query = "SELECT * FROM guru
		WHERE
		nama LIKE  '%$keyword%' OR
		nip LIKE  '%$keyword%' OR
		jeniskelamin LIKE  '%$keyword%' OR
		tanggallahir LIKE  '%$keyword%' OR
		mapel LIKE  '%$keyword%' OR
		agama LIKE  '%$keyword%' OR
		email LIKE  '%$keyword%' OR
		alamat LIKE  '%$keyword%' OR
		notelp LIKE  '%$keyword%'
		";
$guru = query($query);

?>
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
		<th>agama</th>
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