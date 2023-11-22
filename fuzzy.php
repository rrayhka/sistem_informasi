
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form method="post">
            <label for="intelektual">Masukkan Intelektual</label>
            <input type="text" name="intelektual"><br>
            <label for="sikap">Masukkan Sikap</label>
            <input type="text" name="sikap"><br>
            <button type="submit" name="submit">Submit</button>
        </form>
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

////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
        






















        // mencari nilai tertinggi dari nilai intelektual
        $maxValueIntelektual = max($arrIntelektual); 
        $keysMaxIntelektual = array_keys($arrIntelektual, $maxValueIntelektual);
        // memformat angka tertinggi menjadi 1 angka dibelakang koma
        $numberFormatted = number_format($maxValueIntelektual, 1);

        // mencari nilai tertinggi dari nilai sikap
        $maxValueSikap = max($arrSikap); 
        $keysMaxSikap = array_keys($arrSikap, $maxValueSikap);
        // memformat angka tertinggi menjadi 1 angka dibelakang koma
        $numberFormatted = number_format($maxValueSikap, 1);

        // aturan fuzzy
        // for($i = 1; $i <= 9; $i++){
        //     if()
        // }
    }