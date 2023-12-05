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

    function main($intelektual, $sikap, $perilaku, $nisn){
        $intelektual = $_POST['intelektual'];
        $sikap = $_POST['sikap'];
        $perilaku = $_POST['perilaku'];
        
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



        // mencari aturan fuzzy dan nilai Z berdasarkan jurnal https://repository.uinjkt.ac.id/dspace/bitstream/123456789/5784/1/ADHI%20GUFRON-FST.pdf
        // di halaman 108
        $Z = [];
        $arrTeladans = [];
        for($i = 0; $i < 2; $i++){
            if(isset($nonZeroKeysIntelektual[$i])){
                for($j = 0; $j < 2; $j++){
                    if(isset($nonZeroKeysSikap[$j])){
                        for($k = 0; $k < 2; $k++){
                            if(isset($nonZeroKeysPerilaku[$k])){
                                if($nonZeroKeysIntelektual[$i] == "buruk"){
                                    $z_int = 0.6;
                                    if($nonZeroKeysSikap[$j] == "buruk"){
                                        $z_sik = 0.6;
                                        if($nonZeroKeysPerilaku[$k] == "buruk"){
                                            $z_per = 0.6;
                                            $teladan = "buruk";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "sedang"){
                                            $z_per = 0.7;
                                            $teladan = "buruk";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "baik"){
                                            $z_per = 0.8;
                                            $teladan = "sedang";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        }
                                        $arrTeladans[] = $teladan;
                                        $Z[] = $rumus;
                                    } else if($nonZeroKeysSikap[$j] == "sedang"){
                                        $z_sik = 0.7;
                                        if($nonZeroKeysPerilaku[$k] == "buruk"){
                                            $z_per = 0.6;
                                            $teladan = "buruk";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "sedang"){
                                            $z_per = 0.7;
                                            $teladan = "sedang";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "baik"){
                                            $z_per = 0.8;
                                            $teladan = "baik";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        }
                                        $arrTeladans[] = $teladan;
                                        $Z[] = $rumus;
                                    } else if($nonZeroKeysSikap[$j] == "baik"){
                                        $z_sik = 0.8;
                                        if($nonZeroKeysPerilaku[$k] == "buruk"){
                                            $z_per = 0.6;
                                            $teladan = "sedang";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "sedang"){
                                            $z_per = 0.7;
                                            $teladan = "baik";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "baik"){
                                            $z_per = 0.8;
                                            $teladan = "baik";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        }
                                        $arrTeladans[] = $teladan;
                                        $Z[] = $rumus;
                                    }
                                } else if($nonZeroKeysIntelektual[$i] == "sedang"){
                                    $z_int = 0.7;
                                    if($nonZeroKeysSikap[$j] == "buruk"){
                                        $z_sik = 0.6;
                                        if($nonZeroKeysPerilaku[$k] == "buruk"){
                                            $z_per = 0.6;
                                            $teladan = "buruk";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "sedang"){
                                            $z_per = 0.7;
                                            $teladan = "buruk";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "baik"){
                                            $z_per = 0.8;
                                            $teladan = "sedang";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        }
                                        $arrTeladans[] = $teladan;
                                        $Z[] = $rumus;
                                    } else if($nonZeroKeysSikap[$j] == "sedang"){
                                        $z_sik = 0.7;
                                        if($nonZeroKeysPerilaku[$k] == "buruk"){
                                            $z_per = 0.6;
                                            $teladan = "buruk";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "sedang"){
                                            $z_per = 0.7;
                                            $teladan = "sedang";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "baik"){
                                            $z_per = 0.8;
                                            $teladan = "baik";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        }
                                        $arrTeladans[] = $teladan;
                                        $Z[] = $rumus;
                                    } else if($nonZeroKeysSikap[$j] == "baik"){
                                        $z_sik = 0.8;
                                        if($nonZeroKeysPerilaku[$k] == "buruk"){
                                            $z_per = 0.6;
                                            $teladan = "sedang";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "sedang"){
                                            $z_per = 0.7;
                                            $teladan = "baik";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "baik"){
                                            $z_per = 0.8;
                                            $teladan = "baik";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        }
                                        $arrTeladans[] = $teladan;
                                        $Z[] = $rumus;
                                    }
                                } else if($nonZeroKeysIntelektual[$i] == "baik"){
                                    $z_int = 0.8;
                                    if($nonZeroKeysSikap[$j] == "buruk"){
                                        $z_sik = 0.6;
                                        if($nonZeroKeysPerilaku[$k] == "buruk"){
                                            $z_per = 0.6;
                                            $teladan = "buruk";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "sedang"){
                                            $z_per = 0.7;
                                            $teladan = "buruk";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "baik"){
                                            $z_per = 0.8;
                                            $teladan = "sedang";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        }
                                        $arrTeladans[] = $teladan;
                                        $Z[] = $rumus;
                                    } else if($nonZeroKeysSikap[$j] == "sedang"){
                                        $z_sik = 0.7;
                                        if($nonZeroKeysPerilaku[$k] == "buruk"){
                                            $z_per = 0.6;
                                            $teladan = "buruk";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "sedang"){
                                            $z_per = 0.7;
                                            $teladan = "sedang";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "baik"){
                                            $z_per = 0.8;
                                            $teladan = "baik";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        }
                                        $arrTeladans[] = $teladan;
                                        $Z[] = $rumus;
                                    } else if($nonZeroKeysSikap[$j] == "baik"){
                                        $z_sik = 0.8;
                                        if($nonZeroKeysPerilaku[$k] == "buruk"){
                                            $z_per = 0.6;
                                            $teladan = "sedang";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "sedang"){
                                            $z_per = 0.7;
                                            $teladan = "baik";
                                            $rumus = ($z_int * $nonZeroValuesIntelektual[$i]) + ($z_sik * $nonZeroValuesSikap[$j]) +  ($z_per * $nonZeroValuesPerilaku[$k]) + 73;
                                        } else if($nonZeroKeysPerilaku[$k] == "baik"){
                                            $z_per = 0.8;
                                            $teladan = "baik";
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

        // mencari nilai A predicate
        $a_predicates = [];
        for($i = 0; $i < $jumlah_intelektual; $i++){
            for($j = 0; $j < $jumlah_sikap; $j++){
                for($k = 0; $k < $jumlah_perilaku; $k++){
                    $a_predicate_i = round(min($nonZeroValuesIntelektual[$i], $nonZeroValuesSikap[$j], $nonZeroValuesPerilaku[$k]), 3);
                    $a_predicates[] = $a_predicate_i;
                }
            }
        }
        
        // mencari nilai weight avarage
        $pembilang = 0;
        $penyebut = 0;
        $index = 0;
        while ($index <= count($a_predicates)-1) {
            $pembilang += $a_predicates[$index] * $Z[$index];
            $penyebut += $a_predicates[$index];
            $index++;
        }
        $weightAvarage = round(($pembilang / $penyebut), 2);

        // mencari kategori
        if(isset($weightAvarage)){
            $kategori = [
                "buruk" => buruk($weightAvarage, 15, 25),
                "sedang" => sedang($weightAvarage, 20, 25, 30),
                "baik" => bagus($weightAvarage, 25, 35),
            ];
        }
        $arrResult = [
            $weightAvarage, array_keys($kategori, max($kategori))[0]
        ];
        return $arrResult;
    }
?>