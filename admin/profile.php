<?php

include "koneksi.php";
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location:login.php");
}

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="js/color-modes.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
        .foto-user-profile {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            position: relative;
            left: 50%;
            transform: translateX(-50%);
        }

        .foto-user-profile-utama {
            width: 125px;
            height: 125px;
            border-radius: 50%;
            object-fit: cover;
            /* position: relative;
            left: 50%;
            transform: translateX(-50%); */
        }

        .foto-user-profile-nav {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .space-between-body {
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar-fixed {
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 3;
        }

        .container-margin {
            margin-top: 100px;
        }

        .space-between-card {
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            height: 100%;
        }

        .container-grid {
            display: grid;
            grid-template-areas: 'tentang-akun' 'semua-post';
        }

        .tentang-akun {
            grid-area: tentang-akun;
        }

        .semua-post {
            grid-area: semua-post;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>
</head>

<body class="space-between-body">

    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check2" viewBox="0 0 16 16">
            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
        </symbol>
        <symbol id="circle-half" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
        </symbol>
        <symbol id="moon-stars-fill" viewBox="0 0 16 16">
            <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
            <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
        </symbol>
        <symbol id="sun-fill" viewBox="0 0 16 16">
            <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
        </symbol>
    </svg>

    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
            <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
                <use href="#circle-half"></use>
            </svg>
            <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                        <use href="#sun-fill"></use>
                    </svg>
                    Light
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                        <use href="#moon-stars-fill"></use>
                    </svg>
                    Dark
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                        <use href="#circle-half"></use>
                    </svg>
                    Auto
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
        </ul>
    </div>

    <nav class="navbar navbar-expand-lg bg-primary navbar-dark navbar-fixed">
        <div class="container">
            <a class="navbar-brand" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Dashboard</a>
                    </li>
                    <?php
                    if ($_SESSION['role'] == "Admin") {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="kelas.php">Kelas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="jurusan.php">Jurusan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="siswa.php">Siswa</a>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kelas
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                            $sql_kelas = mysqli_query($conn, "SELECT * FROM kelas");
                            while ($data_kelas = mysqli_fetch_array($sql_kelas)) {
                            ?>
                                <li>
                                    <a class="dropdown-item" href="data_siswa_kelas.php?kelasid=<?= $data_kelas['kelasid'] ?>"><?= $data_kelas['namakelas'] ?></a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pilihan
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                            if ($_SESSION['role'] == "Admin") {
                            ?>
                                <li><a class="dropdown-item" href="register.php">Tambah Akun</a></li>
                                <li><a class="dropdown-item" href="user.php">Data User</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            <?php
                            }
                            ?>
                            <li><a class="dropdown-item" href="../index.php">QRSCAN</a></li>
                            <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="profile.php?userid=<?= $_SESSION['userid'] ?>" class="nav-link active" style="margin: 0; padding: 0;"><?= $_SESSION['namalengkap'] ?> <b>(<?= $_SESSION['role'] ?>)</b> <img src="fotouser/<?= $_SESSION['foto'] ?>" alt="" class="foto-user-profile-nav"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container container-margin mb-5">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-9 bg-body-tertiary py-3">
                <h5 class="display-6 fw-bold text-center">Akun Saya</h5>
                <form action="update_profile.php" method="post" enctype="multipart/form-data">
                    <?php
                    $userid = $_GET['userid'];
                    $sql = mysqli_query($conn, "SELECT * FROM user WHERE userid='$userid'");
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                        <input type="text" class="form-control mb-2" id="userid" name="userid" placeholder="klik dan ketik disini..." value="<?= $data['userid'] ?>" hidden>
                        <label for="inputFoto" style="display: block;" class="mb-3">
                            <img src="fotouser/<?= $data['foto'] ?>" alt="" class="foto-user-profile" id="imgFoto">
                        </label>
                        <input type="file" name="foto" id="inputFoto" class="form-control" hidden>
                        <label for="username">Username</label>
                        <input type="text" class="form-control mb-2" id="username" name="username" placeholder="klik dan ketik disini..." value="<?= $data['username'] ?>">
                        <label for="password">Password</label>
                        <input type="password" class="form-control mb-2" id="password" name="password" placeholder="klik dan ketik disini..." value="<?= $data['password'] ?>">
                        <label for="email">Email</label>
                        <input type="email" class="form-control mb-2" id="email" name="email" placeholder="klik dan ketik disini..." value="<?= $data['email'] ?>">
                        <label for="namalengkap">Nama Lengkap</label>
                        <input type="text" class="form-control mb-2" id="namalengkap" name="namalengkap" placeholder="klik dan ketik disini..." value="<?= $data['namalengkap'] ?>">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" class="form-control mb-2" id="alamat" cols="30" rows="5" placeholder="klik dan ketik disini..."><?= $data['alamat'] ?></textarea>
                        <input type="text" class="form-control mb-2" id="role" name="role" placeholder="klik dan ketik disini..." value="<?= $data['role'] ?>" hidden>
                        <input type="submit" value="Ubah" class="btn btn-success">
                        <button type="reset" class="btn btn-danger">Hapus</button>
                        <a href="index.php" class="btn btn-warning">Kembali</a>
                    <?php
                    }
                    ?>
                </form>
                <hr>
                <h6 class="card-subtitle my-2 text-center">Atau</h6>
                <hr>
                <form action="hapus_profile.php?userid=<?= $_SESSION['userid'] ?>" method="post" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?')" style="display: block;">
                    <button type="submit" class="btn btn-danger" style="width: 100%;">Hapus Permanent</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-primary text-light text-center py-3">
        <b class="text-light">Copyright © <?= date("Y") ?> Team RPL SMKN Labuang</b>
    </div>
</body>


<script src="js/image.js"></script>
<script src="js/bootstrap.js"></script>

</html>