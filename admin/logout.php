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
session_destroy();
// echo '<script>alert("Proses Logout telah berhasil!"); window.location.href = "login.php"</script>';
echo "<script type='text/javascript'>
	      setTimeout(function () { 
	        swal({
	                title: 'Proses Log Out Telah Berhasil',
	                text:  'Sampai Jumpa!',
	                type: 'success',
	                timer: 3000,
	                showConfirmButton: true
	            });   
	      });  
	      window.setTimeout(function(){ 
	        window.location.replace('login.php');
	      } ,900); 
	      </script>";

?>