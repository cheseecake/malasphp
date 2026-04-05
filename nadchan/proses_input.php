<?php
include 'koneksi.php';

$nama_siswa = mysqli_real_escape_string($koneksi, $_POST['nama_siswa']);
$jns_kel = mysqli_real_escape_string($koneksi, $_POST['jns_kel']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$agama = mysqli_real_escape_string($koneksi, $_POST['agama']);
$tgl_lhr = mysqli_real_escape_string($koneksi, $_POST['tgl_lhr']);

$gambar = '';
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
    $nama_file = $_FILES['gambar']['name'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    $ekstensi = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    $ekstensi_diizinkan = array('jpg', 'jpeg', 'png', 'gif', 'webp');

    if (!in_array($ekstensi, $ekstensi_diizinkan, true)) {
        echo '<script>alert("Format gambar tidak didukung")</script>';
        echo '<script>window.location="form_input.html"</script>';
        exit;
    }

    $gambar = uniqid('img_', true) . '.' . $ekstensi;
    if (!move_uploaded_file($tmp_file, 'foto/' . $gambar)) {
        echo '<script>alert("Upload gambar gagal")</script>';
        echo '<script>window.location="form_input.html"</script>';
        exit;
    }
}

$input = mysqli_query($koneksi, "insert into data_siswa set nama_siswa='$nama_siswa', jns_kel='$jns_kel', alamat='$alamat', agama='$agama', tgl_lhr='$tgl_lhr', gambar='$gambar'");

if($input){
    echo '<script>alert("Tambah Data Berhasil")</script>';
    echo '<script>window.location="pencarian.php"</script>';
}else{
    echo 'Gagal '.mysqli_error($koneksi);
}
?>