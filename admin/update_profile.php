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

$userid = $_POST['userid'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$namalengkap = $_POST['namalengkap'];
$alamat = $_POST['alamat'];
$role = $_POST['role'];

if ($_FILES['foto']['name'] != "") {
    $rand = rand();
    $ekstensi = array("png", "jpeg", "jpg", "gif");
    $namafile = $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];
    $ext = pathinfo($namafile, PATHINFO_EXTENSION);

    if (!in_array($ext, $ekstensi)) {
        // echo '<script>alert("Data gagal diubah!"); window.location.href = "index.php"</script>';
        echo "<script type='text/javascript'>
              setTimeout(function () { 
                swal({
                        title: 'Proses Ubah Akun Kamu Gagal',
                        text:  'Harap Coba Lagi!',
                        type: 'error',
                        timer: 3000,
                        showConfirmButton: true
                    });   
              });  
              window.setTimeout(function(){ 
                window.location.replace('profile.php');
              } ,900); 
              </script>";
    } else {
        if ($ukuran < 20488000) {
            $sql = mysqli_query($conn, "SELECT foto FROM user where userid='$userid'");
            $data = mysqli_fetch_array($sql);
            $foto = $data['foto'];
            unlink("fotouser/$foto");

            $xx = $rand . '_' . $namafile;
            move_uploaded_file($_FILES['foto']['tmp_name'], 'fotouser/' . $rand . '_' . $namafile);
            mysqli_query($conn, "UPDATE user SET username='$username', password='$password', foto='$xx', email='$email', namalengkap='$namalengkap', alamat='$alamat', role='$role' WHERE userid='$userid'");
            // echo '<script>alert("Data berhasil diubah, harap login ulang!"); window.location.href = "index.php"</script>';
            // session_destroy();
            echo "<script type='text/javascript'>
              setTimeout(function () { 
                swal({
                        title: 'Akun Kamu Berhasil Diubah',
                        text:  'Harap Login Ulang!',
                        type: 'success',
                        timer: 3000,
                        showConfirmButton: true
                    });   
              });  
              window.setTimeout(function(){ 
                window.location.replace('profile.php');
              } ,900); 
              </script>";
            session_destroy();
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
	        window.location.replace('profile.php');
	      } ,900); 
	      </script>";
        }
    }
} else {
    mysqli_query($conn, "UPDATE user SET username='$username', password='$password', email='$email', namalengkap='$namalengkap', alamat='$alamat', role='$role' WHERE userid='$userid'");
    // echo '<script>alert("Data berhasil diubah, harap login ulang!"); window.location.href = "index.php"</script>';
    echo "<script type='text/javascript'>
              setTimeout(function () { 
                swal({
                        title: 'Akun Kamu Berhasil Diubah',
                        text:  'Harap Login Ulang!',
                        type: 'success',
                        timer: 3000,
                        showConfirmButton: true
                    });   
              });  
              window.setTimeout(function(){ 
                window.location.replace('profile.php');
              } ,900); 
              </script>";
    session_destroy();
}

// $sql = mysqli_query($conn, "UPDATE album SET namaalbum='$namaalbum', deskripsi='$deskripsi' WHERE albumid='$albumid'");

// if($sql) {
//     echo '<script>alert("Data berhasil diubah!"); window.location.href = "album.php"</script>';
// } else {
//     echo '<script>alert("Data gagal diubah!"); window.location.href = "album.php"</script>';
// }

?>