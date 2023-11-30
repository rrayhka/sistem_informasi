<?php
    include "koneksi.php";
    if(isset($_SESSION['role'])) {
        $_SESSION['role'];
    } else {
        $_SESSION['role'] = '';
    }

    $batas = 5;
    $halaman = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
    $previous = $halaman - 1;
    $next = $halaman + 1;

    $data1 = mysqli_query($conn, "SELECT * FROM siswa");
    $jumlah_data = mysqli_num_rows($data1);
    $total_halaman = ceil($jumlah_data / $batas);
    $count = $halaman_awal + 1;

    $data = mysqli_query($conn, "SELECT * FROM siswa LIMIT $halaman_awal, $batas");

    $sort_int_desc = mysqli_query($conn, "SELECT * FROM siswa ORDER BY intelektual DESC LIMIT $halaman_awal, $batas");
    $sort_int_asc = mysqli_query($conn, "SELECT * FROM siswa ORDER BY intelektual LIMIT $halaman_awal, $batas");
    $sort_sikap_desc = mysqli_query($conn, "SELECT * FROM siswa ORDER BY sikap DESC LIMIT $halaman_awal, $batas");
    $sort_sikap_asc = mysqli_query($conn, "SELECT * FROM siswa ORDER BY sikap LIMIT $halaman_awal, $batas");
    $sort_akurasi_desc = mysqli_query($conn, "SELECT * FROM siswa ORDER BY akurasi DESC LIMIT $halaman_awal, $batas");
    $sort_akurasi_asc = mysqli_query($conn, "SELECT * FROM siswa ORDER BY akurasi LIMIT $halaman_awal, $batas");

    if (isset($_GET['sort'])) {
        $data_sort = $_GET;
        if ($data_sort['sort'] == 'ascInt') {
            $sort = $sort_int_asc;
        } elseif ($data_sort['sort'] == 'descInt') {
            $sort = $sort_int_desc;
        } elseif ($data_sort['sort'] == 'ascSikap') {
            $sort = $sort_sikap_asc;
        } elseif ($data_sort['sort'] == 'descSikap') {
            $sort = $sort_sikap_desc;
        } elseif ($data_sort['sort'] == 'ascAcc') {
            $sort = $sort_akurasi_asc;
        } elseif ($data_sort['sort'] == 'descAcc') {
            $sort = $sort_akurasi_desc;
        }
    } else {
        $sort = $data;
    }


    if (isset($_POST["search"])) {
        $search = $_POST["search"];
        $data = mysqli_query($conn, "SELECT * FROM siswa where nisn LIKE '%$search%' or nama LIKE '%$search%' or intelektual LIKE '%$search%' or sikap LIKE '%$search%' or akurasi LIKE '%$search%'");
        $sort = $data;
    }

    if(isset($_GET['hapus'])){
        $nisn = $_GET['hapus'];
        $query = "DELETE FROM siswa WHERE nisn = '$nisn'";
        $result = mysqli_query($conn, $query);
        if($result){
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Fuzzy</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">Fuzzy</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="btn-group ">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?= $_SESSION['username']; ?>
                    </button>
                    <div class="dropdown-menu">
                        <!-- <a class="dropdown-item" href="#"><?= ucfirst($_SESSION['username']); ?></a> -->
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <h1 class="mb-3">Daftar Siswa</h1>
        <div class="row">
            <div class="col-auto me-auto">
                <a href="addSiswa.php" class="btn btn-primary mb-3">Tambah Siswa</a>
            </div>
            <!-- live search -->
            <div class="col-auto">
                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search" name="search">
                        <div class="input-group-append">
                            <button class="btn btn-outline-info" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end live search -->
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nisn</th>
                        <th>Nama</th>
                        <th>
                            Intelektual
                            <?php if(isset($_GET['sort']) && $_GET['sort'] == 'ascInt') : ?>
                                <a href="?sort=descInt"><i class="fa-solid fa-arrow-up"></i></a>
                            <?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'descInt') : ?>
                                <a href="?sort=ascInt"><i class="fa-solid fa-arrow-down"></i></a>
                            <?php else : ?>
                                <a href="?sort=ascInt"><i class="fa-solid fa-arrow-up"></i></a>
                            <?php endif; ?>
                        </th>
                        <th>
                            Sikap siswa
                            <?php if(isset($_GET['sort']) && $_GET['sort'] == 'ascSikap') : ?>
                                <a href="?sort=descSikap"><i class="fa-solid fa-arrow-up"></i></a>
                            <?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'descSikap') : ?>
                                <a href="?sort=ascSikap"><i class="fa-solid fa-arrow-down"></i></a>
                            <?php else : ?>
                                <a href="?sort=ascSikap"><i class="fa-solid fa-arrow-up"></i></a>
                            <?php endif; ?>
                        </th>
                        <th>Sistem Lama</th>
                        <th>Fuzzy Baru</th>
                        <th>
                            Akurasi
                            <?php if(isset($_GET['sort']) && $_GET['sort'] == 'ascAcc') : ?>
                                <a href="?sort=descAcc"><i class="fa-solid fa-arrow-up"></i></a>
                            <?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'descAcc') : ?>
                                <a href="?sort=ascAcc"><i class="fa-solid fa-arrow-down"></i></a>
                            <?php else : ?>
                                <a href="?sort=ascAcc"><i class="fa-solid fa-arrow-up"></i></a>
                            <?php endif; ?>
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        while ($row = mysqli_fetch_array($sort)) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nisn'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['intelektual'] ?></td>
                                <td><?= $row['sikap'] ?></td>
                                <td><?= $row['sistem_lama'] ?></td>
                                <td><?= $row['fuzzy_baru'] ?></td>
                                <td>
                                    <?php if($row['akurasi'] == 0) : ?> 
                                        <a href="hitungAkurasi.php?nisn=<?= $row['nisn'] ?>" class="btn btn-primary">Hitung Akurasi</a>
                                    <?php else : ?>
                                        <?= $row['akurasi'] ?>%
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="edit.php?nisn=<?= $row['nisn'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="index.php?hapus=<?= $row['nisn'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                    <?php endwhile; ?>
                    <tr>
                        <td colspan="9">
                        <?php 
                            $count = mysqli_num_rows(mysqli_query($conn, "SELECT akurasi FROM siswa"));
                            $benar = mysqli_num_rows(mysqli_query($conn, "SELECT akurasi FROM siswa where akurasi > 95"));
                            $akurasi = ceil(($benar / $count) * 100);
                        ?>
                        Tingkat Akurasi Fuzzy Logic: <?= $akurasi ?>%
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item <?= ($halaman <= 1) ? "disabled" : ''; ?>">
                    <a class="page-link" href='<?= (!isset($_GET["sort"])) ? "?" : "?sort=$_GET[sort]&"; ?>page=<?= $previous ?>'>Previous</a>
                </li>
                <?php for ($x = 1; $x <= $total_halaman; $x++) { ?>
                    <li class="page-item <?= ($halaman == $x) ? "active" : ''; ?>">
                        <a class="page-link" href='<?= (!isset($_GET["sort"])) ? "?" : "?sort=$_GET[sort]&"; ?>page=<?= $x ?>'><?= $x ?></a>
                    </li>
                <?php } ?>
                <li class="page-item <?= ($halaman >= $total_halaman) ? "disabled" : ''; ?>">
                    <a class="page-link" href='<?= (!isset($_GET["sort"])) ? '?' : "?sort=$_GET[sort]&"; ?>page=<?= $next ?>'>Next</a>
                </li>
            </ul>
        </nav>
    </div>
</body>
</html>