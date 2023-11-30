<?php
    require "koneksi.php";
    $nisn = $_GET["nisn"];
    $sql = "SELECT * FROM siswa WHERE nisn = '$nisn'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($query);
    var_dump($data);
    $akurasi = round(($data["fuzzy_baru"] / $data["sistem_lama"] * 100), 2);
    if(mysqli_query($conn, "UPDATE siswa SET akurasi = '$akurasi' WHERE nisn = '$nisn'")) {
        header("Location: index.php");
    } else{
        echo mysqli_error($conn);
    }
?>