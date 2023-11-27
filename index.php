<?php
    require_once "koneksi.php";

    if(!isset($_SESSION['login'])){
        header("Location: login.php");
        exit();
    } else{
        $username = $_SESSION['username'];
        $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
        $user = mysqli_fetch_assoc($query);
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <title>Document</title>
    </head>
    <body>
        <div class="container mt-5">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
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
                    </thead>
                    <tbody>
                        <?php 
                            $query = mysqli_query($conn, "SELECT * FROM siswa");
                            while($siswa = mysqli_fetch_assoc($query)){ ?>
                                <tr>
                                    <td>
                                        <?= $siswa['nisn'] ?>
                                    </td>
                                    <td>
                                        <?= $siswa['nama'] ?>
                                    </td>
                                    <td>
                                        <?= $siswa['intelektual'] ?>
                                    </td>
                                    <td>
                                        <?= $siswa['sikap'] ?> 
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>