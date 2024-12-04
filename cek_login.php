<?php
session_start();
// menghubungkan dengan koneksi
include "koneksi.php"; //username, root, password, nama database 

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($konek, "select * from karyawan where username='$username' ") or die(mysqli_error($konek));

// menghitung jumlah data yang ditemukan
if ($data) {

	$cek = mysqli_num_rows($data);

	if ($cek == 1) {
		$hasil1 = [];
		while ($row = mysqli_fetch_array($data)) {
			$hasil[] = $row;
		}
		foreach ($hasil as $row) {
			$_SESSION['role'] = $row["role"];
			$hashedpass = $row["password"];
		}

		if (password_verify($password, $hashedpass)) {
			$_SESSION['username'] = $username;
			$_SESSION['statuslog']   = "login";
			$_SESSION['key'] = "akusiaptuancrab";

			header("location:utama.php");
		} else {
			session_destroy();
			header("location:index.php?pesan=gagal");
		}
	} else {
		header("location:index.php?pesan=gagal");
	}
} else {
	header("location:index.php?pesan=gagal");
}
