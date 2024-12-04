<?php
session_start();
if (empty($_SESSION['username'])) {
    header("location:index.php?pesan=belum_login");
}

$msg = "";
$pesan = "";

if (isset($_GET['msg'])) {
    if ($_GET['msg'] == "file_salah") {
        $msg = "Hanya menerima file PNG, JPG, jpeg";
    } else if ($_GET['msg'] == "text_long") {
        $msg = "Text terlalu panjang, gunakan gambar berkuran lebih besar";
    } else if ($_GET['msg'] == "gagal2") {
        $msg = "Proses unduh file gagal";
    }
}

if (isset($_GET['pesan'])) {
    $pesan = $_GET['pesan'];
}

?>

<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Steganografi</title>
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
            <a class="navbar-brand" href="utama.php"><img src="img/el_mail_logo.svg" class="logo"> El-Mail | Steganografi </a>
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

    <div class="container-sm">
        <?php echo $msg ?>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-encode-tab" data-bs-toggle="pill" data-bs-target="#pills-encode" type="button" role="tab" aria-controls="pills-encode" aria-selected="true">Encode</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-decode-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-decode" aria-selected="false">Decode</button>
            </li>

        </ul>
        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade" id="pills-encode" role="tabpanel" aria-labelledby="pills-encode-tab">
                <h3>Menyisipkan Pesan Rahasia</h3>
                <form action="stega_enkrip.php" method="post" enctype="multipart/form-data">
                    <table class="table table-secondary">
                        <thead>
                            <th width="15%"></th>
                            <th width="85%"></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><label>Isi Pesan</label></td>
                                <td><textarea name="isi_pesan" id="isi_pesan" class="form-control" rows="6" placeholder="Tulis pesan di sini ..." required></textarea></td>
                            </tr>
                            <tr>
                                <td><label>Upload file gambar</label></td>
                                <td><input class="form-control-file" type="file" id="file_encode" name="fileku1"></td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary mb-10" type="submit" id="tombol_encode" onclick="if(!confirm('sisipkan pesan ini?')){ event.preventDefault() }">Encode</button>
                </form>

            </div>

            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-decode-tab">
                <h3>Mengekstrak Pesan Rahasia</h3>
                <form action="stega_dekrip.php" method="post" enctype="multipart/form-data">
                    <table class="table table-secondary">
                        <thead>
                            <th width="15%"></th>
                            <th width="85%"></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><label>Upload file gambar</label></td>
                                <td><input class="form-control-file" type="file" id="file_decode" name="fileku2"></td>
                            </tr>
                            <tr>
                                <td><label>Isi Pesan</label></td>
                                <td><textarea name="isi_pesan" id="ekstrak_pesan" class="form-control" rows="6" placeholder="Pesan akan muncul di sini"><?php echo $pesan ?></textarea></td>
                            </tr>

                        </tbody>
                    </table>
                    <button class="btn btn-primary mb-10" type="submit" id="tombol_decode" onclick="if(!confirm('ekstrak gambar ini?')){ event.preventDefault() }">Decode</button>
                </form>
            </div>


        </div>






    </div>


</body>

</html>