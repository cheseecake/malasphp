<?php
session_start();
include "koneksi.php"; // masukan konekasi DB
// ambil variable ID dari URL
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

$get_data = mysqli_query($koneksi, "select gambar from data_siswa where id='$id'");
$row = mysqli_fetch_assoc($get_data);
$gambar = $row ? $row['gambar'] : '';

//Proses query hapus data
$del = mysqli_query($koneksi, "delete from data_siswa where id='$id'");
if ($del) 
{
    if (!empty($gambar) && file_exists('foto/' . $gambar)) {
        unlink('foto/' . $gambar);
    }

    $_SESSION['pesan'] = '<font color=green>OK, 1 data berhasil dihapus.</font>';
    header("location:pencarian.php"); // kembali ke tampil data
    exit;
}
else 
{
    echo "Gagal hapus data!";
}
?>
