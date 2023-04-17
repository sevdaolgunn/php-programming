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
    $db = new PDO("mysql:host=$servername;dbname=university", $username, $password);
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
    $sql = "INSERT INTO students (fullname,department,city) VALUES ('$fullname', '$department','$city')";
    $db->exec($sql);
    echo "ADDED!!<br>";
    header("Location: ?islem=eklendi");//boş kayıt eklenmesini engelleme
}

//SİLME KOMUTU
if ($_REQUEST['islem']=="sil"){
    $ID = $_REQUEST['ID'];
    $sql = "DELETE FROM students WHERE ID=$ID";
    $db->exec($sql);
    header("Location: ?islem=silindi");
}
?>
*******ÖĞRENCİ LİSTESİ******<br>
<table style="border:1px solid">
    <tr>
        <th>Full Name</th>
        <th>Department</th>
        <th>City</th>
        <th>Delete</th>
    </tr>
<?php

$sql="SELECT * FROM students";
foreach ($db->query($sql) as $data ){


?>
    <tr>
        <td><?=$data['fullname']?></td>
        <td><?=$data['department']?></td>
        <td><?=$data['city']?></td>
        <td><a href="?islem = sil&id=<?=$data['ID']?>">X</a></td>

    </tr>
    <?php
    }
?>



</table>
</body>
</html>