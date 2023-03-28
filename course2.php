<html>
<body>
<?php
if ($_REQUEST["islem"]=="kaydet" and $_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $email = $_POST["email"];
    echo "<br> Name:".$name;
    echo "<br> E-mail:".$email;
}

?>

<form action="?islem=kaydet" method="post">
    Name: <input type="text" name="name" required><br>
    E-mail: <input type="email" name="email"><br>
    Gender: <input type="radio" name="gender" value="male"> Male
            <input type="radio" name="gender" value="male"> Female
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


</body>
</html>