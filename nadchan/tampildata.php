<?php
session_start();
include "koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM data_siswa ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa</title>
    <style type="text/css">
        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000000;
            padding: 5px;
            vertical-align: middle;
        }

        .image-wrapper {
            width: 100px;
            height: 50px;
            border: 2px solid #000000;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .image-wrapper img {
            width: 100px;
            height: 50px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h3>DATA SISWA</h3>

    <?php
    if (isset($_SESSION['pesan'])) {
        echo $_SESSION['pesan'];
        unset($_SESSION['pesan']);
        echo '<br><br>';
    }
    ?>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Agama</th>
            <th>Tgl Lahir</th>
            <th>Foto</th>
            <th>Action</th>
        </tr>
        <?php if (mysqli_num_rows($query) > 0) { ?>
            <?php
            $no = 1;
            while ($data = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo htmlspecialchars($data['nama_siswa']); ?></td>
                    <td><?php echo htmlspecialchars($data['jns_kel']); ?></td>
                    <td><?php echo htmlspecialchars($data['alamat']); ?></td>
                    <td><?php echo htmlspecialchars($data['agama']); ?></td>
                    <td><?php echo htmlspecialchars($data['tgl_lhr']); ?></td>
                    <td>
                        <div class="image-wrapper">
                            <?php if (!empty($data['gambar']) && file_exists('foto/' . $data['gambar'])) { ?>
                                <img src="foto/<?php echo htmlspecialchars($data['gambar']); ?>" alt="foto-siswa">
                            <?php } ?>
                        </div>
                    </td>
                    <td>
                        <a href="hapusdata.php?id=<?php echo $data['id']; ?>">Delete</a> |
                        <a href="edit.php?id=<?php echo $data['id']; ?>">Update</a>
                    </td>
                </tr>
            <?php $no++; } ?>
        <?php } ?>
    </table>

    <br>
    <a href="form_input.html">Kembali ke input data</a>
</body>
</html>