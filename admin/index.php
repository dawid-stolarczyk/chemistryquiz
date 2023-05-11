<?php

session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyniki</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</head>

<body>
    <?php
        require '../php/connection.php';
   
        $sql = 'SELECT * FROM usersanswers';
        $results = mysqli_query($conn, $sql);
    if(mysqli_num_rows($results) > 0) {
     echo "<div class='table-responsive'>
        <table class='table'>
            <thead>
                <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Imię i Nazwisko</th>
                    <th scope='col'>Poprawnych odpowiedzi</th>
                    <th scope='col'>Ilość zdobytych procent</th>
                </tr>
            </thead>
            <tbody>";
                
                while ($row = mysqli_fetch_assoc($results)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $goodanswers = $row['goodanswers'];
                    $badanswers = $row['badanswers'];
                    $totalquestions = $row['totalquestions'];

                    $percent = ($goodanswers / $totalquestions) * 100;

                echo "<tr>
                    <th scope='row'>$id</th>
                    <td>$name</td>
                    <td>". $goodanswers ."pkt na ". $totalquestions ."pkt</td>
                    <td>". $percent ."%</td>
                </tr>";
                }
            }else {
                    echo "Brak danych do wyświetlenia";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>