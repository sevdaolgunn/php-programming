<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Extracting Data From a Database</title>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $db = new PDO("mysql:host=$servername;dbname=phpcourse", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $oku = $db->query("SELECT * FROM informations",PDO::FETCH_ASSOC);

    //print_r($oku);

    if ($oku!=false && !empty($oku)){
        foreach ($oku as $veriler){
           // print_r($veriler);
            $ID=$veriler["ID"];
            $metin=$veriler["metin"];
            $durum=$veriler["durum"];
            echo "ID : ".$ID." Metin : ".$metin." Durum : ".$durum."<br>";
        }
    }


   //echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
</body>
</html>