<?php
session_start();
if (empty($_SESSION['username'])) {
    header("location:index.php?pesan=belum_login");
}

?>

<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Tulis Pesan</title>
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






    <nav class="navbar fixed-top navbar-light" style="background-color: #3dbaf9;">
        <div class="container-fluid">
            <a class="navbar-brand" href="utama.php"><img src="img/el_mail_logo.svg" class="logo"> El-Mail | Tulis Pesan</a>
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
        <form action="olah_tulis_pesan.php" method="post" enctype="multipart/form-data">
            <table class="table table-secondary">
                <tr>
                    <td><label>Kepada</label></td>
                    <td><input type="text" id="kepada" name="kepada" placeholder="Nama Penerima" required></td>
                </tr>
                <tr>
                    <td><label>Subjek</label></td>
                    <td><input class="form-control form-control-sm" type="text" id="subjek" name="subjek" placeholder="Subjek" required></td>
                </tr>
                <tr>
                    <td><label>Isi Pesan</label></td>
                    <td><textarea name="isi_pesan" id="isi_pesan" class="form-control" rows="6" placeholder="Tulis pesan di sini ..." required></textarea></td>
                </tr>
                <tr>
                    <td><label>Lampiran file</label></td>
                    <td><input class="form-control-file" type="file" id="fileku" name="fileku"></td>
                </tr>

            </table>
            <button class="btn btn-primary mb-10" type="submit" onclick="if(!confirm('kirim pesan ini?')){ event.preventDefault() }">Submit</button>
        </form>
    </div>



</body>

</html>