<?php
session_start();
include "koneksi.php";
require "lib/aes.php";
require "lib/aesctr.php";
require 'lib/vigenere.php';
$kepada = $_POST["kepada"];
$subjek = $_POST["subjek"];
$isi_pesan = $_POST["isi_pesan"];
$dari = $_SESSION['username'];
$status = "unread";
date_default_timezone_set('Asia/Jakarta');
$waktu = date("Y-m-d H:i:s");

if (!empty($_FILES["fileku"]["name"])) {
    $target_dir = "uploads/{$dari}/";
    $namafile = basename($_FILES["fileku"]["name"]);
    $target_file = $target_dir . $namafile;

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (file_exists($target_file)) {
        header("location:utama.php?pesan=tersedia");
    } else {

        $chipertext1 = encrypt_vig($_SESSION['key'], $isi_pesan);


        $method = "camellia-256-ofb"; // metode cipher menggunakan Camellia
        $ivlen = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($ivlen);  // membuat random IV
        $ciphertext_raw = openssl_encrypt($chipertext1, $method, $_SESSION['key'], $options = OPENSSL_RAW_DATA, $iv);
        $ciphertext2 = base64_encode($iv . $ciphertext_raw);




        if (move_uploaded_file($_FILES["fileku"]["tmp_name"], $target_file)) {


            //enkrip file
            $namaFile1 = file_get_contents($target_file);
            $encFile = AesCtr::encrypt($namaFile1, $_SESSION['key'], 128);
            $enkrip = file_put_contents($target_file, $encFile);
            $query = "insert into pesan values('','$dari','$kepada','$subjek','$ciphertext2','$waktu','$status','$namafile')";
            $hasil = mysqli_query($konek, $query) or die(mysqli_error($konek));
            header("location:utama.php?pesan=berhasil");
        } else {
            header("location:utama.php?pesan=gagal");
        }
    }
} else {

    $chipertext1 = encrypt_vig($_SESSION['key'], $isi_pesan);

    $method = "camellia-256-ofb"; // metode cipher menggunakan Camellia
    $ivlen = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($ivlen);  // membuat random IV
    $ciphertext_raw = openssl_encrypt($chipertext1, $method, $_SESSION['key'], $options = OPENSSL_RAW_DATA, $iv);
    $ciphertext2 = base64_encode($iv . $ciphertext_raw);

    $query = "insert into pesan values('','$dari','$kepada','$subjek','$ciphertext2','$waktu','$status','')";
    $hasil = mysqli_query($konek, $query) or die(mysqli_error($konek));
    header("location:utama.php?pesan=berhasil");
}
