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
            if($perubahan == true){
                echo "New record created successfully";
                header("Location: index.php");
            }
            e5xit();
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
