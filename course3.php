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
if ($_REQUEST['islem'] == "sil")
{
    $id = $_REQUEST['id'];
    $sql="DELETE FROM students WHERE Id=$id ";
    $db->exec($sql);
    header("Location: ?durum=silindi");
}

//DÜZENLEME KOMUTU
if($_REQUEST['islem']=="duzenle" && $_SERVER['REQUEST_METHOD']=="POST")
{
    $id = $_REQUEST['id'];
    $fullname = $_REQUEST['fullname'];
    $department= $_REQUEST['department'];
    $city = $_REQUEST['city'];
    $sql = "UPDATE students SET fullname = '$fullname', department = '$department', city = '$city' WHERE Id = $id";
    $db->exec($sql);
    echo "<br> Düzenleme basarili";
    header("Location: ?durum=duzenlendi");
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
if($_REQUEST['islem']=="duzenle"){
    $id = $_REQUEST['id'];
    $sql = "SELECT * FROM students WHERE Id=$id";
    $sonuc = $db->prepare($sql);
    $sonuc->execute();
    $data = $sonuc->fetch(PDO::FETCH_ASSOC);

    if ($sonuc->rowCount()>0){
?>
<form action="?islem=duzenle&id=<?= $data['Id']?>" method="POST">
    Fullname <input type="text" name="fullname" value="<?=$data['fullname']?>"> <br>
    Department <input type="text" name="department" value="<?=$data['department']?>"> <br>
    City <select name="city">
        <option><?=$data['department']?></option>
        <option>Ankara</option>
        <option>İstanbul</option>
        <option>Bursa</option>
        <option>Sinop</option>
    </select>
    <input type="submit" value="submit">
</form>
<?php
    }
    else{
    echo "<br> Kayıt Bulunamadı";
    }
}
?>


*******ÖĞRENCİ LİSTESİ******<br>
<table style="border:1px solid" width="500" bgcolor="#fff8dc">
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Department</th>
        <th>City</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
<?php

$sql="SELECT * FROM students";
foreach ($db->query($sql) as $data ){


?>
    <tr align="center">
        <td><?=$data['id']?></td>
        <td><?=$data['fullname']?></td>
        <td><?=$data['department']?></td>
        <td><?=$data['city']?></td>
        <td><a href="?islem=duzenle&id=<?=$data['id'] ?>"> Edit</a></td>
        <td><a href="?islem = sil&id=<?=$data['id']?>" onclick="return confirm('are you sure?');">X</a></td>

    </tr>
    <?php
    }
?>



</table>
</body>
</html>