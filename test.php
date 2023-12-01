<?php
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
        if(isset($_GET["submit"])){
            $x = $_GET["x"];
            $y = $_GET["y"];

            $arrX = [
                "buruk" => buruk(15, 25, $x),
                "sedang" => sedang(20, 25, 30, $x),
                "bagus" => bagus(25, 35, $x)
            ];

            $arrY = [
                "buruk" => buruk(),
                "sedang" => sedang($y, 5, 10, 15),
                "bagus" => bagus($y, 10, 15)
            ];
        }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="get">
        <label for="x">Input X</label>
        <input type="text" name="x" id="x"><br>
        <label for="y">Input Y</label>
        <input type="text" name="y" id="y"><br>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>