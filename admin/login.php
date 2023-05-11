<?php 

session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    header("Location: index.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel nauczyciela</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    <form action="login.php" method='post'>
        <input type="text" name='username' placeholder='login'>
        <input type="password" name='password' placeholder='hasło'>
        <input type="submit" name='login' value='Zaloguj'>
        <?php 
        

        if (isset($_SESSION["login_error"]) && !empty($_SESSION["login_error"])) {
            $login_error = $_SESSION['login_error'];
            echo "<p>$login_error</p>";
            unset($_SESSION["login_error"]);
            exit;
        }
        
        ?>
    </form>


    <?php 
    
    if(isset($_POST['login'])) {
        require '../php/connection.php';
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_hash = hash('sha256', $password);

        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password_hash'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0) {
            session_start();
            $_SESSION['logged_in'] = true;
            header("Location: index.php");
            exit;
        }else {
            session_start();
            $_SESSION['login_error'] = "Nie prawidłowe dane!";
            header("Location: login.php");
            exit;
        }
    }
    
    ?>
</body>
</html>