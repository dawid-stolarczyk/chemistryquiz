<?php
require './connection.php';

if(isset($_POST['answer'])) {
    $id = $_POST['id'];
    $answer = $_POST['answer'];

    $sql = "SELECT goodanswer FROM questions WHERE questionnumber='$id' AND goodanswer='$answer'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $id++;
        header("Location: ../test.php?question=$id");
    }else {
        session_start();
        $badanswers = $_SESSION["badanswer"];
        $badanswers++;
        $_SESSION["badanswer"] = "$badanswers";
        $id++;
        header("Location: ../test.php?question=$id");
    }
}

?>