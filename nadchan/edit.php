<!DOCTYPE html>
<html>
<head>
    <title>CRUD PHP dan MySQLi</title>
    <style type="text/css">
        .image-wrapper {
            width: 100px;
            height: 50px;
            border: 2px solid #000000;
        }

        img {
            width: 100px;
            height: 50px;
        }
    </style>
</head>
<body>
<h2>Halaman Edit Siswa </h2>
<br/>
<h3>EDIT DATA SISWA</h3>
<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "select * from data_siswa where id='$id'");
while ($d = mysqli_fetch_array($data)) {
?>
    <form method="post" action="proses_edit.php" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Nama</td>
                <td>
                    <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
                    <input type="hidden" name="gambar_lama" value="<?php echo htmlspecialchars($d['gambar']); ?>">
                    <input type="text" name="nama_siswa" value="<?php echo htmlspecialchars($d['nama_siswa']); ?>">
                </td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>
                    <label>
                        <input type="radio" name="jns_kel" value="Laki-laki" <?php if (strcasecmp($d['jns_kel'], 'Laki-laki') === 0) echo 'checked'; ?>>Laki-laki
                    </label>
                    <label>
                        <input type="radio" name="jns_kel" value="Perempuan" <?php if (strcasecmp($d['jns_kel'], 'Perempuan') === 0) echo 'checked'; ?>>Perempuan
                    </label>
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat" rows="3" cols="30"><?php echo htmlspecialchars($d['alamat']); ?></textarea></td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>
                    <select name="agama">
                        <option value="Islam" <?php if (strcasecmp($d['agama'], 'Islam') === 0) echo 'selected'; ?>>Islam</option>
                        <option value="Katolik" <?php if (strcasecmp($d['agama'], 'Katolik') === 0) echo 'selected'; ?>>Katolik</option>
                        <option value="Kristen" <?php if (strcasecmp($d['agama'], 'Kristen') === 0) echo 'selected'; ?>>Kristen</option>
                        <option value="Hindu" <?php if (strcasecmp($d['agama'], 'Hindu') === 0) echo 'selected'; ?>>Hindu</option>
                        <option value="Budha" <?php if (strcasecmp($d['agama'], 'Budha') === 0) echo 'selected'; ?>>Budha</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td><input type="date" name="tgl_lhr" value="<?php echo htmlspecialchars($d['tgl_lhr']); ?>"></td>
            </tr>
            <tr>
                <td>Upload Foto</td>
                <td>
                    <div class="image-wrapper">
                        <?php if (!empty($d['gambar']) && file_exists('foto/' . $d['gambar'])) { ?>
                            <img src="foto/<?php echo htmlspecialchars($d['gambar']); ?>" alt="foto-siswa">
                        <?php } ?>
                    </div>
                    <br>
                    <input type="file" name="gambar" id="fileToUpload" accept="image/*">
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="SIMPAN"></td>
            </tr>
        </table>
    </form>
<?php
}
?>
</body>
</html>