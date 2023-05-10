<?php 

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "chemiaquiz";

$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
if (!$conn) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}



?>