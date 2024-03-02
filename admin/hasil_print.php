<?php
include "koneksi.php";
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location:login.php");
} else if (isset($_SESSION['userid']) && $_SESSION['role'] != "Admin") {
    header("Location:index.php");
}
//load file tcpdf
require_once("tcpdf/tcpdf.php");

// create new PDF document
// $pdf = new TCPDF ('PDF_PAGE_ORIENTATION', 'PDF_UNIT', 'PDF_PAGE_FORMAT', true, 'UTF-8', false);
$pdf = new TCPDF('l', 'mm', 'F4', true, 'UTF-8', true);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

//$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setMargins(3, 3, 3);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, 1);

// add a page
$pdf->AddPage();

// set font
$pdf->setFont('helvetica', '', 12);

// $pdf->cell(0, 10, "Data Absensi Harian SMKN Labuang", 1, 50, 'C');
$pdf->setAutoPageBreak(true, 0);

$tanggal = $_POST['tanggal'];
$kelasid = $_POST['kelasid'];

$tanggal_dari_database = $tanggal;

// Ubah format tanggal menggunakan strtotime() dan date()
$tanggal_baru = date('d-m-Y', strtotime($tanggal_dari_database));

$conn = mysqli_connect("localhost", "root", "", "absen");
$sql = "SELECT * FROM kelas WHERE kelasid = '$kelasid'";
$result = mysqli_query($conn, $sql);
$namakelas = '';
while ($row = mysqli_fetch_assoc($result)) {
    // Ambil nilai namakelas dari hasil query
    $namakelas = $row['namakelas'];
}

function fetch_data()
{
    $output = '';

    $conn = mysqli_connect("localhost", "root", "", "absen");
    date_default_timezone_set('Asia/Makassar');
    $tanggal = $_POST['tanggal'];
    $kelasid = $_POST['kelasid'];

    $sql = "SELECT siswa.*, jurusan.*, absen.*, kelas.*
    FROM siswa 
    INNER JOIN absen ON siswa.nis = absen.nis 
    INNER JOIN jurusan ON siswa.jurusanid = jurusan.jurusanid 
    INNER JOIN kelas ON siswa.kelasid = kelas.kelasid
    WHERE absen.tanggal = '$tanggal' AND siswa.kelasid = '$kelasid'
    ORDER BY siswa.nama ASC";
    $result = mysqli_query($conn, $sql);

    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        // Tanggal dalam format 'tahun-bulan-tanggal' dari database
        $tanggal_dari_database = $row['tanggal'];

        // Ubah format tanggal menggunakan strtotime() dan date()
        $tanggal_baru = date('d-m-Y', strtotime($tanggal_dari_database));

        $output .= '
        <tr>
            <td align="center">' . $no++ . '.</td>
            <td align="left">' . $row['nama'] . '</td>
            <td align="center">' . $row['nis'] . '</td>
            <td align="center">' . $row['namakelas'] . '</td>
            <td align="left">' . $row['kepanjangan'] . '</td> 
            <td align="center">' . $row['jk'] . '</td> 
            <td align="center">' . $row['waktu'] . ' WITA</td> 
            <td align="center">' . $tanggal_baru . '</td> 
            <td align="center">' . $row['keterangan'] . '</td> 
        </tr>';
    }
    return $output;
}

$content = '';
$content = '
<table border="1" style="padding-top: 6px; padding-bottom: 6px;">
<tr bgcolor="skyblue">
    <th align="center" width="30px"><b>No</b></th>
    <th align="center" width="188px"><b>Nama Peserta</b></th>
    <th align="center" width="60px"><b>NIS</b></th>
    <th align="center" width="80px"><b>Kelas</b></th>
    <th align="center" width="190px"><b>Jurusan</b></th>
    <th align="center" width="90px"><b>Jenis Kelamin</b></th>
    <th align="center" width="90px"><b>Waktu</b></th>
    <th align="center" width="90px"><b>Tanggal</b></th>
    <th align="center" width="90px"><b>Keterangan</b></th>
</tr>';

$content .= fetch_data(); // Menggunakan output dari fetch_data()
$content .= '
</table>';

// Mengatur teks tambahan sebelum tabel
$content = '
<table width="100%" border="0">
    <tr>
        <td width="100px" align="center"><img src="logo/logo1.jpg" width="65px"></td>
        <td width="710px" align="center">
        <br>
        <b>
DAFTAR ABSENSI HARIAN SISWA<br> 
UPTD SMK NEGERI LABUANG<br>
Jl. Poros Majene, Laliko, Campalagian, Kabupaten Polewali Mandar, Sulawesi Barat 91353, Indonesia<br>
<font style="font-weight: normal;">Telp: 0822-9232-4449</font>
        </b>
        </td>
        <td width="100px" align="center"><img src="logo/logo-provinsi-sulawesi-barat.jpg" width="65px"></td>
    </tr>
</table>
<hr style="height: 2px;">
<table>
    <tr>
        <td>Tanggal : ' . $tanggal_baru . '</td>
        <td align="right">Kelas : ' . $namakelas . '</td>
        
    </tr>
</table>
<hr style="height: 3px; color: white;">
' . $content;

// Set judul halaman
$title = 'Data Absensi Siswa Kelas ' . $namakelas . ' ' . $tanggal_baru . ' UPTD SMK Negeri Labuang';

// Mengatur judul halaman
$pdf->SetTitle($title);

// output the HTML content
$pdf->writeHTML($content, true, true, true, true, '');

// reset pointer to the last page
$pdf->lastPage();
// -------------------------------------------------------------

// Close and output PDF document
$pdf->Output('Data Absensi Siswa Kelas ' . $namakelas . ' ' . $tanggal_baru . ' UPTD SMK Negeri Labuang.pdf', 'I');
