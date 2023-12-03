<?php
include "koneksi.php";
include "functions.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
} else {
    $username = $_SESSION['username'];
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    $user = mysqli_fetch_assoc($query);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $intelektual = $_POST['intelektual'];
    $sistem_lama = $_POST['sistem_lama'];
    $sikap = $_POST['sikap'];
    $user = mysqli_query($conn, "SELECT * FROM siswa WHERE nisn = '$nisn'");
    $data = mysqli_fetch_assoc($user);

    $update_query = "UPDATE siswa SET nama='$nama', intelektual='$intelektual', sikap='$sikap', sistem_lama = '$sistem_lama' WHERE nisn='$nisn'";
    $result = mysqli_query($conn, $update_query);

    if ($result) {
        $weightAvarage = main($intelektual, $sikap, $nisn);
        $query1 = mysqli_query($conn, "UPDATE siswa SET fuzzy_baru = '$weightAvarage[0]' WHERE nisn = '$nisn'");
        if($query1){
            $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT fuzzy_baru, sistem_lama FROM siswa WHERE nisn = '$nisn'"));
            $akurasi = round(($data["fuzzy_baru"] / $data["sistem_lama"] * 100), 2);
            $query2 = "UPDATE siswa SET akurasi = '$akurasi' WHERE nisn = '$nisn'";
            $trueAkurasi = mysqli_query($conn, $query2);
                if($trueAkurasi){
                    $anyRow = mysqli_query($conn, "SELECT * FROM teladan WHERE nisn = '$nisn'");
                    if (mysqli_num_rows($anyRow) > 0){
                     mysqli_query($conn, "UPDATE teladan SET nilai = '$weightAvarage[0]', kategori = '$weightAvarage[1]' WHERE nisn = '$nisn'");
                    } else{
                        mysqli_query($conn, "INSERT INTO teladan VALUES ('$nisn', '$weightAvarage[1]', '$weightAvarage[0]')");
                    }
                    // echo "<script>window.location.href='index.php';</script>";
                }
            echo "<script>window.location.href='index.php';</script>";
        }
        exit();
    } else {
        echo "Update failed!";
    }
}

if (isset($_GET['nisn'])) {
    $nisn = $_GET['nisn'];
    $query = "SELECT * FROM siswa WHERE nisn='$nisn'";
    $result = mysqli_query($conn, $query);
    $student = mysqli_fetch_assoc($result);
} else {
    echo "Invalid student ID!";
    exit();
}
?>

<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Edit Student</title>
</head>
<body style="background-color: #e0e0eb;">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header" style="background-color: #a3a3c2;">
                <h3>Edit Student Information</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <input type="hidden" name="nisn" value="<?= $student['nisn'] ?>">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $student['nama'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="intelektual" class="form-label">Intelektual:</label>
                        <input type="text" class="form-control" id="intelektual" name="intelektual" value="<?= $student['intelektual'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="sikap" class="form-label">Sikap:</label>
                        <input type="text" class="form-control" id="sikap" name="sikap" value="<?= $student['sikap'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="sistem_lama" class="form-label">Sistem Lama</label>
                        <input type="text" class="form-control" id="sistem_lama" name="sistem_lama" value="<?= $student['sistem_lama'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
