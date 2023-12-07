<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Fuzzy</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="username">Intelektual</label>
                                <input type="text" class="form-control" name="intelektual" id="intelektual" required>
                            </div>
                            <div class="form-group">
                                <label for="sikap">Sikap Siswa</label>
                                <input type="text" class="form-control" name="sikap" id="sikap" required>
                            </div>
                            <div class="form-group">
                                <label for="perilaku">Perilaku</label>
                                <input type="text" class="form-control" name="perilaku" id="perilaku">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Hitung</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


<?php
    function buruk($x, $a, $b){
        if($x <= $a){
            return 1;
        } else if($x >= $b){
            return 0;
        } else{
            return ($b - $x) / ($b - $a);
        }
    }

    function sedang($x, $a, $b, $c){
        if($x <= $a || $x >= $c){
            return 0;
        } else if($a < $x && $x < $b) {
            return ($x -$a) / ($b - $a);
        } else if($b < $x && $x < $c) {
            return ($c - $x) / ($c - $b);
        } else{
            return 1;
        }
    }

    function bagus($x, $a, $b){
        if ($x <= $a){
            return 0;
        } else if($x >= $b){
            return 1;
        } else{
            return ($x - $a) / ($b - $a);
        }
    }

    if(isset($_POST['submit'])){
        $intelektual = $_POST['intelektual'];
        $sikap = $_POST['sikap'];
        $perilaku = $_POST['perilaku'];
        // var_dump($intelektual, $sikap, $perilaku);
        echo "<div class='container'>";
        echo "<br>";
        echo "<table class='table table-bordered table-striped table-hover text-center'>";
        echo "<thead class='table-primary'>";
        echo "<th> Intelektual </th> <th> Sikap Siswa </th> <th> Perilaku </th>";
        echo "</thead>";
        echo "<tbody>";
        echo "<tr>";
        echo "<td> $intelektual </td> <td> $sikap </td> <td> $perilaku </td>";
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
        // echo "</div>";
        // mencari nilai untuk variable intelektual
        $intelektual_buruk = buruk($intelektual, 15, 30);
        $intelektual_sedang = sedang($intelektual, 25, 30, 35);
        $intelektual_baik = bagus($intelektual, 30, 45);
        $arrIntelektual = [
            "buruk" => $intelektual_buruk,
            "sedang" => $intelektual_sedang,
            "baik" => $intelektual_baik
        ];

        // mencari nilai untuk variable sikap
        $sikap_buruk = buruk($sikap, 5, 8);
        $sikap_sedang = sedang($sikap, 6.5, 8, 9.5);
        $sikap_baik = bagus($sikap, 8, 11);
        $arrSikap = [
            "buruk" => $sikap_buruk,
            "sedang" => $sikap_sedang,
            "baik" => $sikap_baik
        ];

        // mencari nilai untuk variable perilaku
        $perilaku_buruk = buruk($perilaku, 4, 6);
        $perilaku_sedang = sedang($perilaku, 5, 6, 7);
        $perilaku_baik = bagus($perilaku, 6, 8);
        $arrPerilaku = [
            "buruk" => $perilaku_buruk,
            "sedang" => $perilaku_sedang,
            "baik" => $perilaku_baik
        ];
        // echo "<br> menampilkan nilai intelektual : <br>";
        // var_dump($arrIntelektual);
        // echo "<br>";
        // echo "menemukan nilai sikap : <br>";
        // var_dump($arrSikap);
        // echo "<br>";
        // echo "menemukan nilai perilaku : <br>";
        // var_dump($arrPerilaku);
        echo "<br>";
        echo "<table class='table table-bordered table-striped table-hover text-center'>";
        echo "<thead class='table-primary'>";
        echo "<th colspan='3'> Menentukan Derajat Keanggotaan </th>";
        echo "</thead>";
        echo "<tbody>";
        echo "<tr class='table-secondary'>";
        echo "<td colspan='3'> Derajat Keanggotaan Intelektual </td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td> Buruk = $intelektual_buruk </td> <td> Sedang = $intelektual_sedang </td> <td> Baik = $intelektual_baik </td>";
        echo "</tr>";
        echo "<tr class='table-secondary'>";
        echo "<td colspan='3'> Derajat Keanggotaan Sikap Siswa </td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td> Buruk = $sikap_buruk </td> <td> Sedang = $sikap_sedang </td> <td> Baik = $sikap_baik </td>";
        echo "</tr>";
        echo "<tr class='table-secondary'>";
        echo "<td colspan='3'> Derajat Keanggotaan Perilaku </td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td> Buruk = $perilaku_buruk </td> <td> Sedang = $perilaku_sedang </td> <td> Baik = $perilaku_baik </td>";
        echo "</tr>";
        echo "</table>";


        $nonZeroKeysIntelektual = array_keys(array_filter($arrIntelektual, function($value) {
            return $value !== 0;
        }));
        $nonZeroValuesIntelektual = array_values(array_filter($arrIntelektual, function($value) {
            return $value !== 0;
        }));
        $jumlah_intelektual = count($nonZeroKeysIntelektual);

        $nonZeroKeysSikap = array_keys(array_filter($arrSikap, function($value) {
            return $value !== 0;
        }));
        $nonZeroValuesSikap = array_values(array_filter($arrSikap, function($value) {
            return $value !== 0;
        }));
        $jumlah_sikap = count($nonZeroKeysSikap);

        $nonZeroKeysPerilaku = array_keys(array_filter($arrPerilaku, function($value) {
            return $value !== 0;
        }));

        $nonZeroValuesPerilaku = array_values(array_filter($arrPerilaku, function($value) {
            return $value !== 0;
        }));
        $jumlah_perilaku = count($nonZeroKeysPerilaku);
        

        // echo "Menampilkan keys intelektual dan non values intelektual: <br>";
        // var_dump($nonZeroKeysIntelektual, $nonZeroValuesIntelektual);
        // echo "<br>";
        // echo "Menemukan keys sikap dan non values sikap: <br>";
        // var_dump($nonZeroKeysSikap, $nonZeroValuesSikap);
        // echo "<br>";
        // echo "Menemukan keys perilaku dan non values perilaku: <br>";
        // var_dump($nonZeroKeysPerilaku, $nonZeroValuesPerilaku);

        echo "<br>";
        echo "<h2 style='text-align: center;'>Langkah selanjutnya adalah menentukan aturan-aturan fuzzy</h2>";
        echo "<br>";
        echo "<h3 style='text-align: center;'>Disini kami menggunakan 27 rule, kombinasi antara semua himpuan setiap 3 variable</h3> <br>";
        echo "<br>";
        echo "<ol style='text-align: left;' class='list-group'>"
        ."<li>[R1] = IF Intelektual Buruk AND Sikap Siswa Buruk AND Perilaku Buruk Then Teladan Buruk</li>".
        "<li>[R2] = IF Intelektual Buruk AND Sikap Siswa Buruk AND Perilaku Sedang Then Teladan Buruk</li>".
        "<li>[R3] = IF Intelektual Buruk AND Sikap Siswa Buruk AND Perilaku Baik Then Teladan Sedang</li>".
        "<li>[R4] = IF Intelektual Buruk AND Sikap Siswa Sedang AND Perilaku Buruk Then Teladan Buruk</li>".
        "<li>[R5] = IF Intelektual Buruk AND Sikap Siswa Sedang AND Perilaku Sedang Then Teladan Sedang</li>".
        "<li>[R6] = IF Intelektual Buruk AND Sikap Siswa Sedang AND Perilaku Baik Then Teladan Baik</li>".
        "<li>[R7] = IF Intelektual Buruk AND Sikap Siswa Baik AND Perilaku Buruk Then Teladan Sedang</li>".
        "<li>[R8] = IF Intelektual Buruk AND Sikap Siswa Baik AND Perilaku Sedang Then Teladan Baik</li>".
        "<li>[R9] = IF Intelektual Buruk AND Sikap Siswa Baik AND Perilaku Baik Then Teladan Baik</li>".
        "<li>[R10] = IF Intelektual Sedang AND Sikap Siswa Buruk AND Perilaku Buruk Then Teladan Buruk</li>".
        "<li>[R11] = IF Intelektual Sedang AND Sikap Siswa Buruk AND Perilaku Sedang Then Teladan Buruk</li>" .
        "<li>[R12] = IF Intelektual Sedang AND Sikap Siswa Buruk AND Perilaku Baik Then Teladan Sedang</li>" .
        "<li>[R13] = IF Intelektual Sedang AND Sikap Siswa Sedang AND Perilaku Buruk Then Teladan Buruk</li>" .
        "<li>[R14] = IF Intelektual Sedang AND Sikap Siswa Sedang AND Perilaku Sedang Then Teladan Sedang</li>" .
        "<li>[R15] = IF Intelektual Sedang AND Sikap Siswa Sedang AND Perilaku Baik Then Teladan Baik</li>" .
        "<li>[R16] = IF Intelektual Sedang AND Sikap Siswa Baik AND Perilaku Buruk Then Teladan Sedang</li>" .
        "<li>[R17] = IF Intelektual Sedang AND Sikap Siswa Baik AND Perilaku Sedang Then Teladan Baik</li>" .
        "<li>[R18] = IF Intelektual Sedang AND Sikap Siswa Baik AND Perilaku Baik Then Teladan Baik</li>" .
        "<li>[R19] = IF Intelektual Baik AND Sikap Siswa Buruk AND Perilaku Buruk Then Teladan Buruk</li>" .
        "<li>[R20] = IF Intelektual Baik AND Sikap Siswa Buruk AND Perilaku Sedang Then Teladan Buruk</li>" .
        "<li>[R21] = IF Intelektual Baik AND Sikap Siswa Buruk AND Perilaku Baik Then Teladan Sedang</li>" .
        "<li>[R22] = IF Intelektual Baik AND Sikap Siswa Sedang AND Perilaku Buruk Then Teladan Buruk</li>" .
        "<li>[R23] = IF Intelektual Baik AND Sikap Siswa Sedang AND Perilaku Sedang Then Teladan Sedang</li>" .
        "<li>[R24] = IF Intelektual Baik AND Sikap Siswa Sedang AND Perilaku Baik Then Teladan Baik</li>" .
        "<li>[R25] = IF Intelektual Baik AND Sikap Siswa Baik AND Perilaku Buruk Then Teladan Sedang</li>" .
        "<li>[R26] = IF Intelektual Baik AND Sikap Siswa Baik AND Perilaku Sedang Then Teladan Baik</li>" .
        "<li>[R27] = IF Intelektual Baik AND Sikap Siswa Baik AND Perilaku Baik Then Teladan Baik</li>";
        echo "</ol>";
        echo "<br>";

        echo "<p><b>NOTE:</b> Kami hanya memproses derajat keanggotan di setiap variabel yang tidak bernilai 0. Jika ada derajat keanggotaan di variabel bernilai 0, kami akan mengabaikannya.</p>";

        $Z = [];
        $arrTeladans = [];
        // $rules= [];
        echo "<table class=\"table table-striped table-bordered text-center table-hover\">";
        echo "<thead class=\"table-primary\">";
        echo "<tr>";
        echo "<th>Intelektual</th>";
        echo "<th>Sikap</th>";
        echo "<th>Perilaku</th>";
        echo "<th>Teladan</th>";
        echo "</tr>";
        echo "</thead>";
        for($i = 0; $i < 2; $i++){
            if(isset($nonZeroKeysIntelektual[$i])){
                for($j = 0; $j < 2; $j++){
                    if(isset($nonZeroKeysSikap[$j])){
                        for($k = 0; $k < 2; $k++){
                            if(isset($nonZeroKeysPerilaku[$k])){
                                if($nonZeroKeysIntelektual[$i] == "buruk"){
                                    echo "<tr>";
                                    echo "<td>buruk</td>";
                                    $z_int = 0.6;
                                    if($nonZeroKeysSikap[$j] == "buruk"){
                                        echo "<td>buruk</td>";
                                        $z_sik = 0.6;
                                        if($nonZeroKeysPerilaku[$k] == "buruk"){
                                            echo "<td>buruk</td>";
                                            $z_per = 0.6;
                                            $teladan = "buruk";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "sedang"){
                                            echo "<td>sedang</td>";
                                            $z_per = 0.7;
                                            $teladan = "buruk";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "baik"){
                                            echo "<td>baik</td>";
                                            $z_per = 0.8;
                                            $teladan = "sedang";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        }
                                        $arrTeladans[] = $teladan;
                                        $Z[] = $rumus;
                                    } else if($nonZeroKeysSikap[$j] == "sedang"){
                                        echo "<td>sedang</td>";
                                        $z_sik = 0.7;
                                        if($nonZeroKeysPerilaku[$k] == "buruk"){
                                            echo "<td>buruk</td>";
                                            $z_per = 0.6;
                                            $teladan = "buruk";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "sedang"){
                                            echo "<td>sedang</td>";
                                            $z_per = 0.7;
                                            $teladan = "sedang";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "baik"){
                                            echo "<td>baik</td>";
                                            $z_per = 0.8;
                                            $teladan = "baik";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        }
                                        $arrTeladans[] = $teladan;
                                        $Z[] = $rumus;
                                    } else if($nonZeroKeysSikap[$j] == "baik"){
                                        echo "<td>baik</td>";
                                        $z_sik = 0.8;
                                        if($nonZeroKeysPerilaku[$k] == "buruk"){
                                            echo "<td>buruk</td>";
                                            $z_per = 0.6;
                                            $teladan = "sedang";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "sedang"){
                                            echo "<td>sedang</td>";
                                            $z_per = 0.7;
                                            $teladan = "baik";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "baik"){
                                            echo "<td>baik</td>";
                                            $z_per = 0.8;
                                            $teladan = "baik";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        }
                                        $arrTeladans[] = $teladan;
                                        $Z[] = $rumus;
                                    }
                                } else if($nonZeroKeysIntelektual[$i] == "sedang"){
                                    echo "<tr>";
                                    echo "<td>sedang</td>";
                                    $z_int = 0.7;
                                    if($nonZeroKeysSikap[$j] == "buruk"){
                                        echo "<td>buruk</td>";
                                        $z_sik = 0.6;
                                        if($nonZeroKeysPerilaku[$k] == "buruk"){
                                            echo "<td>buruk</td>";
                                            $z_per = 0.6;
                                            $teladan = "buruk";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "sedang"){
                                            echo "<td>sedang</td>";
                                            $z_per = 0.7;
                                            $teladan = "buruk";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "baik"){
                                            echo "<td>baik</td>";
                                            $z_per = 0.8;
                                            $teladan = "sedang";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        }
                                        $arrTeladans[] = $teladan;
                                        $Z[] = $rumus;
                                    } else if($nonZeroKeysSikap[$j] == "sedang"){
                                        echo "<td>sedang</td>";
                                        $z_sik = 0.7;
                                        if($nonZeroKeysPerilaku[$k] == "buruk"){
                                            echo "<td>buruk</td>";
                                            $z_per = 0.6;
                                            $teladan = "buruk";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "sedang"){
                                            echo "<td>sedang</td>";
                                            $z_per = 0.7;
                                            $teladan = "sedang";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "baik"){
                                            echo "<td>baik</td>";
                                            $z_per = 0.8;
                                            $teladan = "baik";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        }
                                        $arrTeladans[] = $teladan;
                                        $Z[] = $rumus;
                                    } else if($nonZeroKeysSikap[$j] == "baik"){
                                        echo "<td>baik</td>";
                                        $z_sik = 0.8;
                                        if($nonZeroKeysPerilaku[$k] == "buruk"){
                                            echo "<td>buruk</td>";
                                            $z_per = 0.6;
                                            $teladan = "sedang";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "sedang"){
                                            echo "<td>sedang</td>";
                                            $z_per = 0.7;
                                            $teladan = "baik";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "baik"){
                                            echo "<td>baik</td>";
                                            $z_per = 0.8;
                                            $teladan = "baik";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k])+ 73;
                                        }
                                        $arrTeladans[] = $teladan;
                                        $Z[] = $rumus;
                                    }
                                } else if($nonZeroKeysIntelektual[$i] == "baik"){
                                    echo "<tr>";
                                    echo "<td>baik</td>";
                                    $z_int = 0.8;
                                    if($nonZeroKeysSikap[$j] == "buruk"){
                                        echo "<td>buruk</td>";
                                        $z_sik = 0.6;
                                        if($nonZeroKeysPerilaku[$k] == "buruk"){
                                            echo "<td>buruk</td>";
                                            $z_per = 0.6;
                                            $teladan = "buruk";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "sedang"){
                                            echo "<td>sedang</td>";
                                            $z_per = 0.7;
                                            $teladan = "buruk";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "baik"){
                                            echo "<td>baik</td>";
                                            $z_per = 0.8;
                                            $teladan = "sedang";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        }
                                        $arrTeladans[] = $teladan;
                                        $Z[] = $rumus;
                                    } else if($nonZeroKeysSikap[$j] == "sedang"){
                                        echo "<td>sedang</td>";
                                        $z_sik = 0.7;
                                        if($nonZeroKeysPerilaku[$k] == "buruk"){
                                            echo "<td>buruk</td>";
                                            $z_per = 0.6;
                                            $teladan = "buruk";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "sedang"){
                                            echo "<td>sedang</td>";
                                            $z_per = 0.7;
                                            $teladan = "sedang";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "baik"){
                                            echo "<td>baik</td>";
                                            $z_per = 0.8;
                                            $teladan = "baik";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        }
                                        $arrTeladans[] = $teladan;
                                        $Z[] = $rumus;
                                    } else if($nonZeroKeysSikap[$j] == "baik"){
                                        echo "<td>baik</td>";
                                        $z_sik = 0.8;
                                        if($nonZeroKeysPerilaku[$k] == "buruk"){
                                            echo "<td>buruk</td>";
                                            $z_per = 0.6;
                                            $teladan = "sedang";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "sedang"){
                                            echo "<td>sedang</td>";
                                            $z_per = 0.7;
                                            $teladan = "baik";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "baik"){
                                            echo "<td>baik</td>";
                                            $z_per = 0.8;
                                            $teladan = "baik";
                                            echo "<td>$teladan</td>";
                                            echo "</tr>";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        }
                                        $arrTeladans[] = $teladan;
                                        $Z[] = $rumus;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        echo "</table>";
        echo "<br>";
        echo "<h3>Langkah selanjutnya adalah menentukan a predicates:</h3> <br>";
        // var_dump($nonZeroKeysIntelektual, $nonZeroKeysSikap, $nonZeroKeysPerilaku);
        // echo "Menemukan aturan fuzzy untuk variabel intelektual dan sikap dan perilaku: <br>";
        // var_dump($arrTeladans, $Z);
        
        echo "<table class=\"table table-striped table-bordered text-center table-hover\">";
        echo "<thead class=\"table-primary\">";
        echo "<tr>";
        echo "<th>Intelektual</th>";
        echo "<th>Sikap</th>";
        echo "<th>Perilaku</th>";
        echo "<th>A predicates_i</th>";
        echo "</tr>";
        echo "</thead>";
        $a_predicates = [];
        for($i = 0; $i < $jumlah_intelektual; $i++){
            for($j = 0; $j < $jumlah_sikap; $j++){
                for($k = 0; $k < $jumlah_perilaku; $k++){
                    echo "<tr>";
                    echo "<td>$nonZeroValuesIntelektual[$i]</td>";
                    echo "<td>$nonZeroValuesSikap[$j]</td>";
                    echo "<td>$nonZeroValuesPerilaku[$k]</td>";
                    $a_predicate_i = round(min($nonZeroValuesIntelektual[$i], $nonZeroValuesSikap[$j], $nonZeroValuesPerilaku[$k]), 3);
                    echo "<td>$a_predicate_i</td>";
                    echo "</tr>";
                    $a_predicates[] = $a_predicate_i;
                }
            }
        }
        echo "</table>";
        
        // echo "Menemukan a-predicate i keseluruhan: <br>";
        // var_dump($a_predicates);
        echo "<br>";
        echo "<h3>Langkah selanjutnya adalah menghitung Z predicates_i:</h3> <br>";
        echo "<p>Menentukan Z predicates_i keseluruhan pada langkah ini kami menggunakan rumus berdasarkan dari jurnal https://repository.uinjkt.ac.id/dspace/bitstream/123456789/5784/1/ADHI%20GUFRON-FST.pdf di halaman 108</p> <br>";
        echo "<table class=\"table table-striped table-bordered text-center table-hover\">";
        echo "<thead class=\"table-primary\">";
        echo "<tr>";
        echo "<th>Z Predicates-i</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        $index = 0;
        while ($index <= count($Z)-1) {
            echo "<tr>";
            echo "<td>$Z[$index]</td>";
            echo "</tr>";
            $index++;
        }
        echo "</tbody>";
        echo "</table>";
        
        echo "<br>";
        echo "<h3>Langkah selanjutnya adalah menghitung Weight Avarage:</h3> <br>";

        echo '<div style="font-size: 18px; font-weight: bold; text-align: center;">';
        echo '<span id="defuzzifikasi"></span>';
        echo '</div>';
        echo '<script>';
        echo "var rumus = '\\\\text{Defuzzifikasi Weighted Average} = \\\\frac{\\\\sum_{i=1}^{n} A_i \\\\times Z_i}{\\\\sum_{i=1}^{n} A_i}';";
        echo "document.getElementById('defuzzifikasi').innerHTML = '\\\\(' + rumus + '\\\\)';";
        echo '</script>';


        $pembilang = 0;
        $penyebut = 0;
        $index = 0;
        echo "<br>";
        echo "<table class=\"table table-striped table-bordered text-center table-hover\">";
        echo "<thead class=\"table-primary\">";
        echo "<tr>";
        echo "<th colspan=2>Implementai Rumus Weight Avarage</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        echo "<tr class=\"table-info\">";
        echo "<td>Pembilang</td>";
        echo "<td>Penyebut</td>";
        echo "</tr>";
        while ($index < count($a_predicates)) {
            echo "<tr>";
            echo "<td>$a_predicates[$index] * $Z[$index] </td>";
            echo "<td>$a_predicates[$index]</td>";
            echo "</tr>";
            $pembilang += $a_predicates[$index] * $Z[$index];
            $penyebut += $a_predicates[$index];
            $index++;
        }
        $weightAvarage = round(($pembilang / $penyebut), 2);
        echo "<tr>";
        echo "<td>Hasil = $pembilang</td>";
        echo "<td>Hasil = $penyebut</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td colspan=2 class=\"table-success\">Hasil  Akhir= $weightAvarage</td>";
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
        // echo $weightAvarage;
        if(isset($weightAvarage)){
            $kategori = [
                "buruk" => buruk($weightAvarage, 15, 25),
                "sedang" => sedang($weightAvarage, 20, 25, 30),
                "baik" => bagus($weightAvarage, 25, 35),
            ];
            // var_dump($kategori);
            // $max = array_keys($kategori, max($kategori))[0];
            // echo "<br>";
            // echo "Hasil klasifikasi: <br>";
            // echo $max;
        }

    }
?>