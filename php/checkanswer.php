<?php
require './connection.php';
session_start();


    if(isset($_POST['answer'])) {
        $id = $_POST['id'];
        $answer = $_POST['answer'];

        $sql = "SELECT goodanswer FROM questions WHERE questionnumber='$id' AND goodanswer='$answer'";
        $result = mysqli_query($conn, $sql);
        $countsql = "SELECT COUNT(*) as total FROM questions";
        $countresult = mysqli_query($conn, $countsql);

        while ($row = mysqli_fetch_assoc($countresult)) { 
            $totalquestions = $row['total'];
        }


        if(mysqli_num_rows($result) > 0) {
            session_start();
            $goodanswers = $_SESSION["goodanswer"];
            $goodanswers++;
            $_SESSION["goodanswer"] = "$goodanswers";

            $badanswers = $_SESSION['badanswer'];
            $name = $_SESSION['name'];

            echo "<section style='display: flex; justify-content: center; align-items: center; height: 100vh;'>
            <div style='text-align: center;'>
            <h1 style='color: green;'>Poprawna odpowiedź!</h1>
            <h3>Za chwile zostaniesz przekierowany do następnego pytania.</h3>
            </div>
            </section>";
            if($id == $totalquestions) {
                $id=1;
                $_SESSION['actualquestion'] = $id;
                $_SESSION['done'] = true;

                $saveresults_sql = "INSERT INTO usersanswers(id, name, goodanswers, badanswers, totalquestions) VALUES ('', '$name', '$goodanswers', '$badanswers', '$totalquestions')";
                $saveresults_result = mysqli_query($conn, $saveresults_sql);

                header("Refresh: 2; url=../endtest.php");
                
            }else {
                $id++;
                $_SESSION['actualquestion'] = $id;
                header("Refresh: 2; url=../test.php?question=$id");
            }
        }else {
            session_start();
            $badanswers = $_SESSION["badanswer"];
            $badanswers++;
            $_SESSION["badanswer"] = "$badanswers";
            echo "<section style='display: flex; justify-content: center; align-items: center; height: 100vh;'>
            <div style='text-align: center;'>
            <h1 style='color: tomato;'>Błędna odpowiedź!</h1>
            <h3>Za chwile zostaniesz przekierowany do następnego pytania.</h3>
            </div>
            </section>";
            if($id == $totalquestions) {
                $id=1;
                $_SESSION['actualquestion'] = $id;
                $_SESSION['done'] = true;

                $goodanswers = $_SESSION['goodanswer'];
                $name = $_SESSION['name'];

                $saveresults_sql = "INSERT INTO usersanswers(id, name, goodanswers, badanswers, totalquestions) VALUES ('', '$name', '$goodanswers', '$badanswers', '$totalquestions')";
                $saveresults_result = mysqli_query($conn, $saveresults_sql);

                header("Refresh: 2; url=../endtest.php");
                }else {
                $id++;
                $_SESSION['actualquestion'] = $id;
                header("Refresh: 2; url=../test.php?question=$id");
            }
        }
    }


?>