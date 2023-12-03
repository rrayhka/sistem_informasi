<?php
    include "koneksi.php";
    include "functions.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nisn = $_POST["nisn"];
        $nama = $_POST["nama"];
        $intelektual = $_POST["intelektual"];
        $sikap = $_POST["sikap"];
        $sistem_lama = $_POST["sistem_lama"];

        $sql = "INSERT INTO siswa (nisn, nama, intelektual, sikap, sistem_lama) VALUES ('$nisn', '$nama', '$intelektual', '$sikap', '$sistem_lama')";

        if (mysqli_query($conn, $sql)) {
            $perubahan = main($intelektual, $sikap, $nisn);
            $query = mysqli_query($conn, "UPDATE siswa SET fuzzy_baru = '$perubahan[0]' WHERE nisn = '$nisn'");
            if($query){
                $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT fuzzy_baru, sistem_lama FROM siswa WHERE nisn = '$nisn'"));
                $akurasi = round(($data["fuzzy_baru"] / $data["sistem_lama"] * 100), 2);
                $query1 = "UPDATE siswa SET akurasi = '$akurasi' WHERE nisn = '$nisn'";
                // mysqli_query($conn, $query1);
                $trueAkurasi = mysqli_query($conn, $query1);
                if($trueAkurasi){
                    mysqli_query($conn, "INSERT INTO teladan VALUES ('$nisn', '$perubahan[1]', '$perubahan[0]')");
                    echo "<script>window.location.href='index.php';</script>";
                }
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tambah Siswa</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container mt-3">
        <h2>Tambah Siswa</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="nisn">NISN:</label>
                <input type="text" class="form-control" id="nisn" placeholder="Enter NISN" name="nisn" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" placeholder="Enter Nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="intelektual">Intelektual:</label>
                <input type="text" class="form-control" id="intelektual" placeholder="Enter Intelektual" name="intelektual" required>
            </div>
            <div class="form-group">
                <label for="sikap">Sikap Siswa:</label>
                <input type="text" class="form-control" id="sikap" placeholder="Enter Sikap Siswa" name="sikap" required>
            </div>
            <div class="form-group">
                <label for="sistem_lama">Sistem Lama:</label>
                <input type="text" class="form-control" id="sistem_lama" placeholder="Enter Sistem Lama" name="sistem_lama" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>
