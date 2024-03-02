<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="admin/css/sweetalert.css">
  <script src="admin/js/jquery-2.1.4.min.js"></script>
  <script src="admin/js/sweetalert.min.js"></script>
</head>

<body>

</body>

</html>

<?php

require 'admin/koneksi.php';

// Memeriksa apakah NIS dan tanggal tersedia dalam POST
if (isset($_POST["nis"], $_POST["tanggal"])) {

  $nis = $_POST["nis"];
  date_default_timezone_set('Asia/Makassar');
  $tanggal = $_POST["tanggal"];

  // Mendapatkan waktu saat ini dengan zona waktu Asia/Makassar
  $waktu = date("H:i:s");

  // Menentukan status absensi (tepat waktu atau terlambat)
  $status_absen = '';
  if ($waktu >= '05:30:00' && $waktu <= '05:59:59') {
    $status_absen = 'Absen Cepat';
  } else if ($waktu >= '06:00:00' && $waktu <= '07:30:00') {
    $status_absen = 'Tepat Waktu';
  } else {
    $status_absen = 'Terlambat';
  }

  // Memeriksa apakah NIS sudah ada dalam tabel siswa
  $check_nis_query = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$nis'");

  if (mysqli_num_rows($check_nis_query) == 0) {
    echo "<script type='text/javascript'>
              setTimeout(function () { 
                swal({
                        title: 'NIS tidak terdaftar!',
                        text:  'Silakan hubungi admin',
                        type: 'error',
                        timer: 3000,
                        showConfirmButton: true
                    });   
              });  
              window.setTimeout(function(){ 
                window.location.replace('index.php');
              } ,900); 
              </script>";
    return false;
  }

  // Memeriksa apakah NIS sudah ada dalam tabel absen untuk tanggal yang sama
  $check_absen_query = mysqli_query($conn, "SELECT * FROM absen WHERE nis='$nis' AND tanggal='$tanggal'");

  // Jika NIS sudah ada dalam tabel absen
  if (mysqli_num_rows($check_absen_query) == 1) {
    echo "<script type='text/javascript'>
              setTimeout(function () { 
                swal({
                        title: 'Mohon Maaf Anda Sudah Absen!',
                        text:  'Silahkan Absen Pada Besok Hari',
                        type: 'warning',
                        timer: 3000,
                        showConfirmButton: true
                    });   
              });  
              window.setTimeout(function(){ 
                window.location.replace('index.php');
              } ,900); 
              </script>";
    return false;
  }

  // Jika NIS belum ada dalam tabel absen, lakukan pendaftaran absen
  else {
    $result = mysqli_query($conn, "INSERT INTO absen (nis, tanggal, waktu, keterangan) VALUES ('$nis', '$tanggal', '$waktu', '$status_absen')");

    if ($result) {
      echo "<script type='text/javascript'>
                  setTimeout(function () { 
                    swal({
                            title: 'Selamat Anda Berhasil Absen!',
                            text:  'Silahkan Masuk',
                            type: 'success',
                            timer: 3000,
                            showConfirmButton: true
                        });   
                  });  
                  window.setTimeout(function(){ 
                    window.location.replace('index.php');
                  } ,900); 
                  </script>";
    } else {
      echo "Error: " . mysqli_error($conn);
    }
  }
} else {
  echo "Data NIS dan tanggal tidak tersedia dalam permintaan.";
}

?>