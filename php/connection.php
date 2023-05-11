<?php 

$host = "localhost";
$dbusername = "u905173113_chemistryquiz";
$dbpassword = "Dwp*C4]u";
$dbname = "u905173113_chemistryquiz";

$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
if (!$conn) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}



?>