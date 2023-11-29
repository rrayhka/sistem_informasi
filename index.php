<?php 
    include "koneksi.php";

    // require_once "koneksi.php";

    if(!isset($_SESSION['login'])){
        header("Location: login.php");
        exit();
    } else{
        $username = $_SESSION['username'];
        $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
        $user = mysqli_fetch_assoc($query);
    }
    // var_dump($_SESSION);
    // session_destroy();

    $query = "SELECT * FROM siswa";
    $siswa = mysqli_query($conn, $query);

    $no = 1;
    $page = 1;

    $sort = '';
    if (isset($_GET['sort'])){
        $sorts = $_GET['sort'];
        $urut = "sort=$_GET[sort]&";
        if ($_GET['sort'] == 'nisn'){
            $sort = "ORDER BY nisn";
        }else if ($_GET['sort'] == 'nama'){
            $sort = "ORDER BY nama";
        }else if ($_GET['sort'] == 'intelektual'){
            $sort = "ORDER BY intelektual";
        } else if ($_GET['sort'] == 'sikap'){
            $sort = "ORDER BY sikap";
        }
    }else{
        $sorts = '';
        $sort = '';
        $urut = '';
    }
    if(isset($_GET['tampil'])){
        $batas = $_GET['tampil'];
        $next = "tampil=$batas&&";
        // echo $key;
    }else{
        $batas = 5;
        $next = '';
    }
    if (isset($_GET['page'])) {
        // echo 'test';
        // $total_page = $_GET['page'];
        $page = $_GET['page'];
        $start = ($page * $batas) - $batas;
        $no = $start + 1;
        $query = "SELECT * FROM siswa $sort LIMIT $start, $batas";
        $siswa = mysqli_query($conn, $query);
    } else {
        // $total_page = 1;
        $start = ($page * $batas) - $batas;
        $no = 1;
        $query = "SELECT * FROM siswa $sort LIMIT $start, $batas";
        $siswa = mysqli_query($conn, $query);
    }
    $queryS = "SELECT * FROM siswa $sort";
    $total_page = ceil(mysqli_num_rows(mysqli_query($conn, $queryS))/$batas);
?>

<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <title>Data Siswa</title>
</head>

<body style="background-color: #e0e0eb;">
    <?php
    ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header" style="background-color: #a3a3c2;">
                <div class="row">
                    <div class="col mt-3">
                        <h3>Data Siswa</h3>
                    </div>
                    <div class="col-3 d-flex mt-3">
                        <form class="d-flex" role="search" action="index.php" method="get">
                            <input class="form-control me-2" type="search" value="<?= (isset($_GET['cari'])) ? $_GET['cari'] : '' ?>" placeholder="Search" name="cari" aria-label="Search">
                            <button class="btn btn-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col mb-5">
                        <div class="justify-content-around mb-2">
                            <a class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" aria-expanded="false">Banyak Data</a>
                            <ul class="dropdown-menu sm">
                                <a class="dropdown-item" href="?tampil=5">5</a>
                                <a class="dropdown-item" href="?tampil=10">10</a>
                                <a class="dropdown-item" href="?tampil=15">15</a>
                                <a class="dropdown-item" href="?tampil=20">20</a>
                                <a class="dropdown-item" href="?tampil=25">25</a>
                            </ul>
                        </div>
        
                        <table class="table table-striped" style="text-align: center;">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>
                                        NISN
                                    </th>
                                    <th>
                                        Nama
                                    </th>
                                    <th>
                                        Intelektual
                                    </th>
                                    <th>
                                        Sikap
                                    </th>
                                    <th>
                                        Sistem Lama
                                    </th>
                                    <th>
                                        Fuzzy Baru
                                    </th>
                                    <th>
                                        Akurasi
                                    </th>
                                    <th>
                                        Edit
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($siswa as $result): ?>
                                    <tr>
                                        <td>
                                            <?= $no ?>
                                        </td>
                                        <td>
                                            <?= $result['nisn'] ?>
                                        </td>
                                        <td>
                                            <?= $result['nama'] ?>
                                        </td>
                                        <td>
                                            <?= $result['intelektual'] ?>
                                        </td>
                                        <td>
                                            <?= $result['sikap'] ?>
                                        </td>
                                        <td>
                                            <?= $result['sistem_lama'] ?>
                                        </td>
                                        <td>
                                            <?= $result['fuzzy_baru'] ?>
                                        </td>
                                        <td>
                                            <?php if($result['akurasi'] == 0) : ?> 
                                                <a href="hitungAkurasi.php?nisn=<?= $result['nisn'] ?>" class="btn btn-primary">Hitung Akurasi</a>
                                            <?php else : ?>
                                                <?= $result['akurasi'] ?>
                                            <?php endif; ?>

                                        </td>
                                        <td>
                                            <a href="edit.php?nisn=<?= $result['nisn'] ?>" class="btn btn-warning">Edit</a>
                                        </td>
                                    </tr>
                                    <?php $no++ ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" <?php if($page > 1):?>href="?<?=$urut.$next?>page=<?= $page - 1?>" <?php endif;?>aria-label="Previous">
                                        <span aria-hidden="true">Previous</span>
                                    </a>
                                </li>
                                <?php //global $page;?>
                                </li>
                                <?php for ($i = 1; $i <= $total_page; $i++): ?>
                                    <?php if ($i == $page): ?>
                                        <li class="page-item active"><a class="page-link" href="?<?=$urut.$next?>page=<?= $i ?>">
                                                <?= $i ?>
                                            </a></li>
                                    <?php else: ?>
                                        <li class="page-item"><a class="page-link" href="?<?= $urut.$next?>page=<?= $i ?>">
                                                <?= $i ?>
                                            </a></li>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                <li>
                                    <a class="page-link" <?php if($page < $total_page):?>href="?<?= $urut.$next?>page=<?= $page + 1?>" <?php endif;?> aria-label="Next">
                                        <span aria-hidden="true">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>