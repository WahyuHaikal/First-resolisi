<?php 
// koneksi ke database
$conn = mysqli_connect("localhost","root","", "phpdasar");

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result) ){
		$rows[] = $row;
	}
	return $rows;
}
function tambah($data){
	global $conn;

	$nama = htmlspecialchars($data["nama"]);
	$nip = htmlspecialchars($data["nip"]);
	$jeniskelamin = htmlspecialchars($data["jeniskelamin"]);
	$tanggallahir = htmlspecialchars($data["tanggallahir"]);
	$mapel = htmlspecialchars($data["mapel"]);
	$agama = htmlspecialchars($data["agama"]);
	$email = htmlspecialchars($data["email"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$notelp = htmlspecialchars($data["notelp"]);

	// upload gambar
	$gambar = upload();
	if (!$gambar) {
		return false;
	}
	$query = "INSERT INTO guru
				VALUES
				('','$nama','$nip','$jeniskelamin','$tanggallahir','$mapel','$agama','$email','$alamat','$notelp','$gambar')
				";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function upload(){

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if ($error === 4) {
		echo "<script>
				alert('pilih gambar terlebih dahulu');
			</script>";
		return false;
	}

	// cek apakah yang diupload adlah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg','png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
				alert('yang anda upload bukan gambar!');
			</script>";
		return false;
	}

// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000) {
		echo "<script>
				alert('ukuran gambar terlalu besar!');
			</script>";
		return false;
	}

	// jika lolos pengecekkan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar; 


	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

	return $namaFileBaru;


}

function hapus($id){

	global $conn;
	mysqli_query($conn, "DELETE FROM guru WHERE id = $id");
	return mysqli_affected_rows($conn);
}



function ubah($data){
	global $conn;

	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$nip = htmlspecialchars($data["nip"]);
	$jeniskelamin = htmlspecialchars($data["jeniskelamin"]);
	$tanggallahir = htmlspecialchars($data["tanggallahir"]);
	$mapel = htmlspecialchars($data["mapel"]);
	$agama = htmlspecialchars($data["agama"]);
	$email = htmlspecialchars($data["email"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$notelp = htmlspecialchars($data["notelp"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);
	

// cek apakah user pilih gambar baru atau tidak
	if($_FILES['gambar']['error'] === 4 ){
		$gambar = $gambarLama;
	}else{
		$gambar = upload();

	}
	


	$query = "UPDATE guru SET
				nama = '$nama',
				nip = '$nip',
				jeniskelamin = '$jeniskelamin',
				tanggallahir = '$tanggallahir',
				mapel = '$mapel',
				agama = '$agama',
				email = '$email',
				alamat = '$alamat',
				notelp = '$notelp',
				gambar = '$gambar'
				WHERE id = $id
				";
	mysqli_query($conn, $query);


	return mysqli_affected_rows($conn);

}

// '%$keyword%' adalah pencarian dengan segala keyword yang ada didalam data.
function cari ($keyword){
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
		return query ($query);
}

function registrasi($data) {
	global $conn;


	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM user 
		WHERE username = '$username'");

		if (mysqli_fetch_assoc($result)) {
			echo "<script>
					alert('username sudah terdaftar!');
				</script>";
				return false;
		}


	// cek konfirmasi password
	if ($password !== $password2) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
				</script>";
				return false;
		}
		// enkripsi password
		$password = password_hash($password, PASSWORD_DEFAULT);


		// tambahkan userrbaru ke database
		mysqli_query($conn, "INSERT INTO user VALUES('','$username', '$password')");

		return mysqli_affected_rows($conn);


	}

?>
