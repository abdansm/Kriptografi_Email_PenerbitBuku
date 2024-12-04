<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Halaman Pendaftaran</title>
</head>
<style>
    .logo {
        width: 80px;
        height: 70px;
    }

    body {
        background-image:
            linear-gradient(rgba(0, 0, 0, 0.45),
                rgba(0, 0, 0, 0.45)), url(img/bg_img_rentbook.jpg);
        background-size: cover;
    }
</style>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>



    <!-- cek pesan notifikasi -->
    <?php

    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "passgagal") {
            $pesan = "Gagal membuat akun, Konfirmasi password tidak sesuai!";
        } else if ($_GET['pesan'] == "ada") {
            $pesan = "Gagal membuat akun, Nama pengguna sudah terpakai!";
        } else if ($_GET['pesan'] == "kosong") {
            $pesan = "Harap isi seluruh form!";
        }
    }
    ?>



    <div class="container-fluid vh-100" style="margin-top:200px">
        <div class="" style="margin-top:200px">
            <div class="d-flex justify-content-center">
                <div class="col-md-4 col-sm-12 p-5 bg-white">
                    <div class="p-3 text-center">
                        <h2 class="fw-bold"> <img src="img/el_mail_logo.svg" class="logo" />Buat Akun El-Mail</h2>
                    </div>

                    <?php
                    if (isset($_GET['pesan'])) { ?>
                        <div class="mb-3 text-center ">
                            <?php echo $pesan; ?>
                        </div>

                    <?php } ?>
                    <form method="POST" action="cek_daftar.php">

                        <div class="mb-2">
                            <input type="text" class="form-control" placeholder="Nama Pengguna" name="username">

                        </div>
                        <div class="mb-2">
                            <input type="password" name="password1" class="form-control" placeholder="Password" aria-describedby="passwordHelpBlock">
                        </div>

                        <div class="mb-2">
                            <input type="password" name="password2" class="form-control" placeholder="konfirmasi Password" aria-describedby="passwordHelpBlock">
                        </div>

                        <div class="mb-2 d-grid">
                            <button type="submit" name="submit" class="btn btn-primary">Daftar</button>
                        </div>
                        <div class="mb-2 text-center">
                            <p>Punya akun? silahkan <a href="index.php">Masuk</a></p>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>