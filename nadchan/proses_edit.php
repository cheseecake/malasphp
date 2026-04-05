<?php
include 'koneksi.php';
// menyimpan data kedalam variabel
$id = mysqli_real_escape_string($koneksi, $_POST['id']);

$nama_siswa = mysqli_real_escape_string($koneksi, $_POST['nama_siswa']);
$jns_kel = mysqli_real_escape_string($koneksi, $_POST['jns_kel']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$agama = mysqli_real_escape_string($koneksi, $_POST['agama']);
$tgl_lhr = mysqli_real_escape_string($koneksi, $_POST['tgl_lhr']);
$gambar = isset($_POST['gambar_lama']) ? mysqli_real_escape_string($koneksi, $_POST['gambar_lama']) : '';

if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
    $img_name = $_FILES['gambar']['name'];
    $img_tmp = $_FILES['gambar']['tmp_name'];
    $ekstensi = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
    $ekstensi_diizinkan = array('jpg', 'jpeg', 'png', 'gif', 'webp');

    if (!in_array($ekstensi, $ekstensi_diizinkan, true)) {
        echo '<script>alert("Format gambar tidak didukung")</script>';
        echo '<script>window.location="edit.php?id=' . $id . '"</script>';
        exit;
    }

    $img_name = uniqid('img_', true) . '.' . $ekstensi;
    if (!move_uploaded_file($img_tmp, 'foto/' . $img_name)) {
        echo '<script>alert("Upload gambar gagal")</script>';
        echo '<script>window.location="edit.php?id=' . $id . '"</script>';
        exit;
    }

    if (!empty($gambar) && file_exists('foto/' . $gambar)) {
        unlink('foto/' . $gambar);
    }

    $gambar = mysqli_real_escape_string($koneksi, $img_name);
}

$update = mysqli_query($koneksi, "update data_siswa set nama_siswa='$nama_siswa', jns_kel='$jns_kel', alamat='$alamat', agama='$agama', tgl_lhr='$tgl_lhr', gambar='$gambar' where id='$id'");

if ($update) {
    header("location:pencarian.php");
    exit;
}

echo 'Gagal ' . mysqli_error($koneksi);
?>
