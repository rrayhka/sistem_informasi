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
            <a class="navbar-brand" href="../menu/menu.php">Fuzzy</a>
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
                <!-- <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../orders/order.php">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../menu/menu.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://github.com/rrayhka" target="_blank">
                            <i class="bi bi-github">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                                    <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.20-.36-1.02.08-2.12 0 0 .67-.21 2.20.82.64-.18 1.32-.27 2.00-.27.68 0 1.36.09 2.00.27 1.53-1.04 2.20-.82 2.20-.82.44 1.10.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.20 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                                </svg>
                            </i>
                        </a>
                    </li>
                </ul> -->
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
                                        <?= $row['akurasi'] ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="edit.php?nisn=<?= $row['nisn'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                            </tr>
                    <?php endwhile; ?>
                    <tr>
                        <td colspan="9">
                        <?php 
                            $count = mysqli_num_rows(mysqli_query($conn, "SELECT akurasi FROM siswa"));
                            $benar = mysqli_num_rows(mysqli_query($conn, "SELECT akurasi FROM siswa where akurasi > 95"));
                            $akurasi = ($benar / $count) * 100;
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