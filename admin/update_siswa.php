<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/sweetalert.css">
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
</head>

<body>

</body>

</html>
<?php

include "koneksi.php";
session_start();

$idsiswa = $_POST['idsiswa'];
$nis = $_POST['nis'];
$nama = $_POST['nama'];
$kelasid = $_POST['kelasid'];
$jurusanid = $_POST['jurusanid'];
$jk = $_POST['jk'];

if ($_FILES['fotosiswa']['name'] != "") {
    $rand = rand();
    $ekstensi = array("png", "jpg", "jpeg", "gif");
    $namafile = $_FILES['fotosiswa']['name'];
    $ukuran = $_FILES['fotosiswa']['size'];
    $ext = pathinfo($namafile, PATHINFO_EXTENSION);

    if (!in_array($ext, $ekstensi)) {
        echo "<script type='text/javascript'>
        setTimeout(function () { 
          swal({
                  title: 'Data Gagal Diubah',
                  text:  'Silahkan Coba Lagi!',
                  type: 'error',
                  timer: 3000,
                  showConfirmButton: true
              });   
        });  
        window.setTimeout(function(){ 
          window.location.replace('siswa.php');
        } ,900); 
        </script>";
    } else {
        if ($ukuran < 204488000) {
            $sql = mysqli_query($conn, "SELECT fotosiswa FROM siswa where idsiswa='$idsiswa'");
            $data = mysqli_fetch_array($sql);
            $fotosiswa = $data['fotosiswa'];
            unlink("fotosiswa/$fotosiswa");

            $xx = $rand . '_' . $namafile;
            move_uploaded_file($_FILES['fotosiswa']['tmp_name'], 'fotosiswa/' . $rand . '_' . $namafile);
            mysqli_query($conn, "UPDATE siswa SET nis='$nis', nama='$nama', fotosiswa='$xx', kelasid='$kelasid', jurusanid='$jurusanid', jk='$jk' where idsiswa='$idsiswa'");
            echo "<script type='text/javascript'>
              setTimeout(function () { 
                swal({
                        title: 'Data Berhasil Diubah',
                        text:  'Data Segera Ditampilkan!',
                        type: 'success',
                        timer: 3000,
                        showConfirmButton: true
                    });   
              });  
              window.setTimeout(function(){ 
                window.location.replace('siswa.php');
              } ,900); 
              </script>";
        } else {
            echo "<script type='text/javascript'>
              setTimeout(function () { 
                swal({
                        title: 'Ukuran Gambar Terlalu Besar',
                        text:  'Silahkan Cari Gambar Lain Atau Perkecil Size Gambar!',
                        type: 'warning',
                        timer: 3000,
                        showConfirmButton: true
                    });   
              });  
              window.setTimeout(function(){ 
                window.location.replace('siswa.php');
              } ,900); 
              </script>";
        }
    }
} else {
    mysqli_query($conn, "UPDATE siswa SET nis='$nis', nama='$nama', kelasid='$kelasid', jurusanid='$jurusanid', jk='$jk' where idsiswa='$idsiswa'");
    echo "<script type='text/javascript'>
              setTimeout(function () { 
                swal({
                        title: 'Data Berhasil Diubah',
                        text:  'Data Segera Ditampilkan!',
                        type: 'success',
                        timer: 3000,
                        showConfirmButton: true
                    });   
              });  
              window.setTimeout(function(){ 
                window.location.replace('siswa.php');
              } ,900); 
              </script>";
}
?>