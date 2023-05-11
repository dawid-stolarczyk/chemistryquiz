<?php 
session_start();
if(isset($_SESSION["badanswer"])) {
    unset($_SESSION["badanswer"]);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cheamia quiz</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <div class="h1">
        <h1>Quiz na temat ...</h1>
    </div>
    <div class='input'>
        <form action="./php/startquiz.php" method="post">
        <input type="text" name='name' placeholder='Imię i nazwisko'>
    </div>
    <div class="button">
        <button type="submit" class="btn btn-secondary" name='startquiz'>Rozpocznij test</button>
        </form>
    </div>
    <footer>
        <div>
            <p>Dawid Stolarczyk</p>
            <p>Alan Mieczkowski</p>
            <p><a href="./admin/">Panel Nauczyciela</a></p>
        </div>
    </footer>
</body>
</html>