<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <form method="post">
            <div class="form-group">
                <label for="intelektual">Masukkan Intelektual</label>
                <input type="text" name="intelektual" class="form-control">
            </div>
            <div class="form-group">
                <label for="sikap">Masukkan Sikap</label>
                <input type="text" name="sikap" class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

    function teladanBaik($a, $b, $z){
        return (($b - $a) * $z) + $a;
    }

    function teladanBuruk($a, $b, $z){
        return abs((($b - $a) * $z) - $b);
    }

    function teladanSedang($a, $b, $c, $z){
        $kiri = (($b - $a) * $z) + $a;
        $kanan = abs((($c - $b) * $z) - $c);
        return min($kiri, $kanan);
    }

    if(isset($_POST['submit'])){
        $intelektual = $_POST['intelektual'];
        $sikap = $_POST['sikap'];
        
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
        echo "<br> menampilkan nilai intelektual : <br>";
        var_dump($arrIntelektual);
        echo "<br>";
        echo "menemukan nilai sikap : <br>";
        var_dump($arrSikap);
        echo "<br>";




        // mencari aturan-aturan fuzzy
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

        echo "Menampilkan keys intelektual dan non values intelektual: <br>";
        var_dump($nonZeroKeysIntelektual, $nonZeroValuesIntelektual);
        echo "<br>";
        echo "Menemukan keys sikap dan non values sikap: <br>";
        var_dump($nonZeroKeysSikap, $nonZeroValuesSikap);
        echo "<br>";

        $arrTeladans = [];
        for($i = 0; $i < 2; $i++){
            if(isset($nonZeroKeysIntelektual[$i])){
                for($j = 0; $j < 2; $j++){
                    if(isset($nonZeroKeysSikap[$j])){
                        if($nonZeroKeysIntelektual[$i] == "buruk"){
                            if($nonZeroKeysSikap[$j] == "buruk"){
                                $teladan = "buruk";
                            } else if($nonZeroKeysSikap[$j] == "sedang"){
                                $teladan = "buruk";
                            } else if($nonZeroKeysSikap[$j] == "baik"){
                                $teladan = "sedang";
                            }
                            $arrTeladans[] = $teladan;
                        } else if($nonZeroKeysIntelektual[$i] == "sedang"){
                            if($nonZeroKeysSikap[$j] == "buruk"){
                                $teladan = "buruk";
                            } else if($nonZeroKeysSikap[$j] == "sedang"){
                                $teladan = "sedang";
                            } else if($nonZeroKeysSikap[$j] == "baik"){
                                $teladan = "baik";
                            }
                            $arrTeladans[] = $teladan;
                        } else if($nonZeroKeysIntelektual[$i] == "baik"){
                            if($nonZeroKeysSikap[$j] == "buruk"){
                                $teladan = "sedang";
                            } else if($nonZeroKeysSikap[$j] == "sedang"){
                                $teladan = "baik";
                            } else if($nonZeroKeysSikap[$j] == "baik"){
                                $teladan = "baik";
                            }
                            $arrTeladans[] = $teladan;
                        }
                    }
                }
            }
        }
        echo "Menemukan aturan fuzzy untuk variabel intelektual dan sikap: <br>";
        var_dump($arrTeladans);
        
        $a_predicates = [];
        // mencari a-predicate i 
        for($i = 0; $i < $jumlah_intelektual; $i++){
            for($j = 0; $j < $jumlah_sikap; $j++){
                $a_predicate_i = min($nonZeroValuesIntelektual[$i], $nonZeroValuesSikap[$j]);

                $a_predicates[] = $a_predicate_i;
            }
        }
        
        echo "Menemukan a-predicate i dengan nilai terendah: <br>";
        var_dump($a_predicates);

        $z_predicates = [];
        // mencari z-predicate i
        foreach($arrTeladans as $key => $value){
            if($value == "buruk"){
                $z_predicates[] = teladanBuruk(15, 25, $a_predicates[$key]);
            } else if($value == "sedang"){
                $z_predicates[] = teladanSedang(20, 25, 30, $a_predicates[$key]);
            } else if($value == "baik"){
                $z_predicates[] = teladanBaik(25, 35, $a_predicates[$key]);
            }
        }

        var_dump($z_predicates);

        $pembilang = 0;
        $penyebut = 0;
        $index = 0;
        while ($index <= count($a_predicates)-1) {
            $pembilang += $a_predicates[$index] * $z_predicates[$index];
            $penyebut += $a_predicates[$index];
            $index++;
        }
        $result = $pembilang / $penyebut;
        echo "Hasil perhitungan: <br>";
        echo $result;
    }