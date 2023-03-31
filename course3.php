<html>
<head>
    <title>Php Database</title>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $db = new PDO("mysql:host=$servername;dbname=medical", $username, $password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>


<form action="?islem=ekle" method="post">
    Fullname: <input type="text" name="fullname" required><br>
    Department: <select name="department">
        <option>Computer Eng.</option>
        <option>Medical Eng.</option>
        <option>Electric Eng.</option>
        <option>Software Eng.</option>
    </select> <br>

    <br>
    City:
    <select name="city">
        <option>Ankara</option>
        <option>İstanbul</option>
        <option>Bursa</option>
        <option>Sinop</option>
    </select> <br>
    <input type="submit">
</form>

<?php
//Ekleme Komutu
if ($_REQUEST['islem']=="ekle"){
    $fullname = $_REQUEST['fullname'];
    $department = $_REQUEST['department'];
    $city = $_REQUEST['city'];
    $sql = "INSERT INTO university (fullname,department,city) VALUES ('$fullname', '$department','$city')";
    $db->exec($sql);
    echo "ADDED!!<br>";
}
?>
*******ÖĞRENCİ LİSTESİ******<br>
<?php

$sql="SELECT * FROM university";
foreach ($db->query($sql) as $data )
    echo $data['fullname']. "<br>";

?>
</body>
</html>