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

$userid = $_GET['userid'];

$sql = mysqli_query($conn, "SELECT foto FROM user where userid='$userid'");
$data = mysqli_fetch_array($sql);
$foto = $data['foto'];
unlink("fotouser/$foto");

mysqli_query($conn, "DELETE FROM user WHERE userid='$userid'");

if ($sql) {
  echo "<script type='text/javascript'>
              setTimeout(function () { 
                swal({
                        title: 'Akun Ini Berhasil Dihapus Permanent',
                        text:  'Data Ini Akan Hilang!',
                        type: 'success',
                        timer: 3000,
                        showConfirmButton: true
                    });   
              });  
              window.setTimeout(function(){ 
                window.location.replace('user.php');
              } ,900); 
              </script>";
} else {
  echo "<script type='text/javascript'>
    setTimeout(function () { 
      swal({
              title: 'Akun Ini Gagal Dihapus Permanent',
              text:  'Silahkan Coba Lagi!',
              type: 'error',
              timer: 3000,
              showConfirmButton: true
          });   
    });  
    window.setTimeout(function(){ 
      window.location.replace('user.php');
    } ,900); 
    </script>";
}
?>