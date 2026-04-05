<!DOCTYPE html>
<html>
<head>
    <title>Halaman Pencarian</title>
    <style type="text/css">
        * {
            font-family: "Trebuchet MS";
        }

        h1 {
            text-transform: uppercase;
            color: salmon;
        }

        table {
            border: 1px solid #ddeeee;
            border-collapse: collapse;
            border-spacing: 0;
            width: 70%;
            margin: 10px auto 10px auto;
        }

        th,
        td {
            border: 1px solid #ddeeee;
            padding: 20px;
            text-align: left;
        }
    </style>
</head>
<body>
    <center><h1>Pencarian Nama Siswa</h1></center>
    <form method="GET" action="pencarian.php" style="text-align: center;">
        <label>kata Pencarian : </label>
        <input type="text" name="kata_cari" value="<?php if(isset($_GET['kata_cari'])) { echo $_GET['kata_cari']; } ?>" />
        <button type="submit">Cari</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Agama</th>
                <th>Tgl Lahir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //untuk include kan koneksi
            include('koneksi.php');

            //jika kita klik cari, maka yang tampil query cari ini
            if(isset($_GET['kata_cari'])) {
                //menampung variabel kata_cari dari form pencarian
                $kata_cari = $_GET['kata_cari'];

                //jika hanya ingin mencari berdasarkan nama_siswa, silahkan hapus dari awal OR
                //jika ingin mencari 1 ketentuan saja query nya ini : SELECT * FROM data_siswa WHERE nama_siswa like '%".$kata_cari."%'
                $query = "SELECT * FROM data_siswa WHERE nama_siswa like '%" . $kata_cari . "%' ORDER BY id ASC";
            } else {
                //jika tidak ada pencarian, default yang dijalankan query ini
                $query = "SELECT * FROM data_siswa ORDER BY id ASC";
            }

            $result = mysqli_query($koneksi, $query);

            if(!$result){
                die ("Query Error : ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
            }

            //kalau ini melakukan foreach atau perulangan
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row['nama_siswa']; ?></td>
                    <td><?php echo $row['jns_kel']; ?></td>
                    <td><?php echo $row['alamat']; ?></td>
                    <td><?php echo $row['agama']; ?></td>
                    <td><?php echo $row['tgl_lhr']; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>
