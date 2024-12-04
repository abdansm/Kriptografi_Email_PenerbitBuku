<?php
session_start();
require "lib/aes.php";
require "lib/aesctr.php";
require "lib/download_file.php";
$namafile = $_GET['file'];
$dari = $_GET['dari'];
$idpesan = $_GET['idpesan'];
$target_dir = "uploads/{$dari}/" . $namafile;

//$i = 1;
//$namadup = $i . "_" . $namafile;
//$targetdup = "uploads/{$dari}/" . $namadup;
//while (file_exists($targetdup)) {
//    $i++;
//    $namadup = $i . "_" . $namafile;
//    $targetdup = "uploads/{$dari}/" . $namadup;
//}

//if ()) {

$namaFile2 = file_get_contents($target_dir);
// dekrip file
$encFile = AesCtr::decrypt($namaFile2, $_SESSION['key'], 128);
$dekrip = file_put_contents($target_dir, $encFile);

//header('Content-type: application/octet-stream');
//header("Content-Type: " . mime_content_type($target_dir));
//header("Content-Disposition: attachment; filename=" . basename($target_dir));
//while (ob_get_level()) {
//    ob_end_clean();
//}

//readfile($target_dir);
download($target_dir);

$namaFile3 = file_get_contents($target_dir);
// dekrip file
$encFile1 = AesCtr::encrypt($namaFile3, $_SESSION['key'], 128);
$enkrip = file_put_contents($target_dir, $encFile1);
