<?php
include "koneksi.php"; //username, root, password, nama database 

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($konek, "select * from karyawan where username='$username' ") or die(mysqli_error($konek));

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if (empty($username) || empty($password1) || empty($password2)) {
    header("location:daftar.php?pesan=kosong");
} else if ($cek > 0) {
    header("location:daftar.php?pesan=ada");
} else if ($password1 != $password2) {
    header("location:daftar.php?pesan=passgagal");
} else {
    $hashedpass = password_hash($password1, PASSWORD_BCRYPT);
    $query = "insert into karyawan values('$username','$hashedpass','editor')";
    $hasil = mysqli_query($konek, $query) or die(mysqli_error($konek));
    header("location:index.php?pesan=sukses");
}
