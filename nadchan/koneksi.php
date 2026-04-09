// tolong koneksi databasenya di ganti yaww ~nadchan (di hapus aja ini)
<?php
$koneksi = mysqli_connect("localhost", "root", "", "nadchanSECRET");

if (mysqli_connect_errno()){
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
?>
