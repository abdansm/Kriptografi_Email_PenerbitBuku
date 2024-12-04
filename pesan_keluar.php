<?php
session_start();
if (empty($_SESSION['username'])) {
    header("location:index.php?pesan=belum_login");
}

?>

<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Pesan Keluar</title>
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
            <a class="navbar-brand" href="utama.php"><img src="img/el_mail_logo.svg" class="logo"> El-Mail | Pesan Keluar </a>
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
    <a class="btn btn-primary ms-5 mt-1" href="tulis_pesan.php">Tulis Pesan</a>
    <br>
    <div class="container-sm">
        <table class="table table-secondary">
            <tr class="fw-bold">
                <td></td>
                <td>Penerima</td>
                <td>Subjek</td>
                <td>waktu</td>
                <td>Aksi</td>
            </tr>
            <?php
            include "koneksi.php";
            include "lib/time_convert.php";
            $username = $_SESSION['username'];
            $query = mysqli_query($konek, "Select `kepada`, `subjek`, `waktu`, `id_pesan` , `status` from pesan where dari = '$username' ORDER BY waktu");
            while ($data = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td> <?php if ($data['status'] == "readed") {
                            ?> <i><img src="img/opened_mail.svg" class="iconku"></i> <?php } else { ?>
                            <i><img src="img/closed_mail.svg" class="iconku"></i>
                        <?php } ?>
                    </td>
                    <td><?php echo $data['kepada']; ?></td>
                    <td><?php echo $data['subjek']; ?></td>
                    <td><?php $time = strtotime($data['waktu']);
                        echo timeAgo($time) ?></td>
                    <td><a class="btn btn-info p-1" href="buka_pesan.php?idpesan=<?= $data["id_pesan"]; ?>">Buka</a></td>
                </tr>
            <?php } ?>
        </table>

    </div>


</body>

</html>