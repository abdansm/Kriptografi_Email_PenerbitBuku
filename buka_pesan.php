<?php
session_start();
if (empty($_SESSION['username'])) {
    header("location:index.php?pesan=belum_login");
}

include "koneksi.php";

if (isset($_GET['idpesan'])) {
    $idpesan = $_GET['idpesan'];
}



$username = $_SESSION['username'];
$query = mysqli_query($konek, "Select * from pesan where id_pesan = '$idpesan' ");


while ($data = mysqli_fetch_array($query)) {
    $dari = $data["dari"];
    $kepada = $data["kepada"];
    $subjek = $data["subjek"];
    $isi_pesan = $data["isi_pesan"];
    $tanggal = $data["waktu"];
    $status = $data["status"];
    $fileku = $data["file"];
}
if ($username == $kepada || $username == $dari) {
    if ($status == "unread" && $username == $kepada) {
        $query = mysqli_query($konek, "update pesan set status = 'readed' where id_pesan = '$idpesan' ") or die(mysqli_error($konek));
        mysqli_close($konek);
    }
    require_once('lib/vigenere.php');
    //php camellia-256-ofb Dec Example  
    $c = base64_decode($isi_pesan);
    $ivlen = openssl_cipher_iv_length($method = "camellia-256-ofb");
    $iv = substr($c, 0, $ivlen);
    $ciphertext_raw = substr($c, $ivlen);
    $plaintext = openssl_decrypt($ciphertext_raw, $method, $_SESSION['key'], $options = OPENSSL_RAW_DATA, $iv);
    $original_plaintext = decrypt_vig($_SESSION['key'], $plaintext);
} else {
    header("location:utama.php?pesan=ilegal");
}





?>

<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Pesan</title>
</head>
<style>
    .iconku {
        width: 30px;
        height: 33px;
    }

    .logo {
        width: 45px;
        height: 35px;
    }

    body {
        background-color: #e2e3e5;
    }
</style>


<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <nav class="navbar fixed-top navbar-light" style="background-color: #3dbaf9;">
        <div class="container-fluid">
            <a class="navbar-brand" href="utama.php"><img src="img/el_mail_logo.svg" class="logo"> El-Mail | Buka Pesan </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="background-color: #3dbaf9;">
                <div class="offcanvas-header">
                    <h4 class="offcanvas-title "><?php echo "{$_SESSION['role']} {$_SESSION['username']} "; ?></h4>
                    <button type="button" class="btn-close btn btn-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="utama.php">Halaman Utama</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="pesan_keluar.php">Pesan keluar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="stegano.php">Steganografi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="logout.php">Keluar</a>
                        </li>
                </div>
            </div>
        </div>
    </nav>
    <br><br><br>
    <br>


    <br>
    <div class="container-sm">
        <div class="row">
            <div class="col-md-7 p-3">
                <h3 class="mb-3"><?= $subjek ?></h3>
                <table class="table border table-borderless">
                    <thead class="table-light">
                        <tr class="fw-bold">
                            <td>Kepada</td>
                            <td on><?= $kepada ?></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tr>
                        <td>Tanggal</td>
                        <td><?= $tanggal ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td id="isipesan2"><?= $original_plaintext ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Lampiran File</td>
                        <td> <a href="download_decrypt.php?idpesan=<?= $idpesan ?>&file=<?= $fileku ?>&dari=<?= $dari ?>"><?= $fileku ?></a> </td>
                        <td></td>
                    </tr>
                </table>

            </div>

        </div>
    </div>



</body>

</html>