<?php 

if(isset($_POST['startquiz'])) {
    session_start();
    if(isset($_SESSION["badanswer"])) {
    unset($_SESSION["badanswer"]);
    }
    if(isset($_SESSION["goodanswer"])) {
    unset($_SESSION["goodanswer"]);
    }
    if(isset($_SESSION["actualquestion"])) {
    unset($_SESSION["actualquestion"]);
    }
    $name = $_POST['name'];
    
    if($name == "") {
        header('Location: ../index.php');
    }else {
        $_SESSION['name'] = $name;
        $_SESSION['done'] = false;
    header('Location: ../test.php?question=1');
    }


}



?>