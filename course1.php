<?php

echo "merhaba php";
$a = 4;
$b = 5;
$toplam = $a + $b;

echo "Toplam = ". $toplam;
echo "<br>";
$sehirler = array("Ankara", "İstanbul", "Bursa", "Sinop");
print_r($sehirler);
echo "<br>";
print($sehirler);
echo "<br>";
foreach ($sehirler as $sehir){
    echo $sehir. "<br>";
}
for ($i = 0; $i<sizeof($sehirler); $i++){
    echo $i. " - ".$sehirler[$i]."<br>";
}
echo "<br>";
echo "<hr>";
echo $str = substr("hello world",3,5);
echo "<br> uzunluk =". strlen($str);



?>