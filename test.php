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
        session_start();                    
        if (!isset($_SESSION['goodanswer'])) {
            $_SESSION['goodanswer'] = 0;
         }
        if (!isset($_SESSION['badanswer'])) {
            $_SESSION['badanswer'] = 0;
         }
        if (isset($_SESSION['done'])) {
            $done = $_SESSION['done'];
            if ($done == true) {
                header("Location: index.php");
             }else {}
         }


        if(isset($_SESSION['name'])) {

                $name = $_SESSION['name'];
                
                

                    if(isset($_GET['question'])) {

                        $nrquestion=$_GET['question'];

                        if(isset($_SESSION['actualquestion'])) {
                        $actualquestion = $_SESSION['actualquestion'];
                        }else {
                            $actualquestion = 1; 
                        }

                        if($actualquestion == $nrquestion) {

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
                                
                                
                                if(isset($_SESSION['badanswer'])) {

                                $badanswers = $_SESSION["badanswer"];

                                }else {
                                    $badanswers = 0;
                                }


                                echo "<section class='questioncontainer'>
                                <div>
                                <p>$question</p>
                                </div>
                                <p class='badanswers'>Błędne odpowiedzi: $badanswers</p>
                        </section>
                            <section class='answerscontainer'>
                            <div>
                                <form action='./php/checkanswer.php' method='post'>
                                <input type='number' value='$questionnumber' name='id' hidden>
                                <div class='firstanswer answerbutton'><button type='submit' name='answer' value='1'><p>$firstanswer</p></button></div>
                                <div class='secondanswer answerbutton'><button type='submit' name='answer' value='2'><p>$secondanswer</p></button></div>
                                <div class='thirdanswer answerbutton'><button type='submit' name='answer' value='3'><p>$thirdanswer</p></button></div>
                                <div class='fourthanswer answerbutton'><button type='submit' name='answer' value='4'><p>$fourthanswer</p></button></div>
                                </form>
                            </div>
                            </section>";

                            }

                        }
                    }else {
                        header("Location: test.php?question=$actualquestion");
                    }
                }
            }
        
    
    
    ?>


</body>
</html>