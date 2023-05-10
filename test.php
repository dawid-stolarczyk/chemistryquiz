<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php 
                            if(isset($_GET['question'])){
                                $questionnumber = $_GET['question'];
                                echo "pytanie nr $questionnumber";
                            }else {
                                echo "Błąd";
                            } ?></title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./css/test.css">
</head>
<body>
    <?php 
        require 'php/connection.php';

        if (!isset($_SESSION['badanswers'])) {
            $_SESSION['badanswers'] = 0;
         }

        if(isset($_POST['startquiz'])) {

                $name = $_POST['name'];
                
                if($name == "") {
                    header("Location: index.php");
                }else {

                    if(isset($_GET['question'])) {

                        $nrquestion=$_GET['question'];

                        $sql = "SELECT * FROM questions WHERE questionnumber='$nrquestion'";
                        $result = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0) {

                            while ($row = mysqli_fetch_assoc($result)) {
                                $questionnumber = $_GET['question'];
                                $question = $row['question'];
                                $firstanswer = $row['firstanswer'];
                                $secondanswer = $row['secondanswer'];
                                $thirdanswer = $row['thirdanswer'];
                                $fourthanswer = $row['fourthanswer'];
                                $goodanswer = $row['goodanswer'];
                                
                                session_start();
                                $badanswers = $_SESSION["badanswer"];

                                echo "<section class='questioncontainer'>
                                <div>
                                    <p>$question</p>
                                    </div>
                                    <div>
                                    <p>Błędne odpowiedzi: $badanswers</p>
                                    </div>
                            </section>
                            <section class='answerscontainer'>
                                <form action='./php/checkanswer.php' method='post'>
                                <input type='number' value='$questionnumber' name='id' hidden>
                                <div class='firstanswer answerbutton'><button type='submit' name='answer' value='1'>$firstanswer</button></div>
                                <div class='secondanswer answerbutton'><button type='submit' name='answer' value='2'>$secondanswer</button></div>
                                <div class='thirdanswer answerbutton'><button type='submit' name='answer' value='3'>$thirdanswer</button></div>
                                <div class='fourthanswer answerbutton'><button type='submit' name='answer' value='4'>$fourthanswer</button></div>
                            </section>";

                            }

                        }
                    }
                }
        }
    
    
    ?>
</body>
</html>