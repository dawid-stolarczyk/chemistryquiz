<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koniec testu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h3 {
            margin: 10px;
        }

        h5 {
            margin: 10px;
        }
    </style>
</head>

<body>

    <?php 
        require './php/connection.php';
        session_start();
         if(isset($_SESSION['done']) && $_SESSION['done'] == true){

            

                $goodanswers = $_SESSION['goodanswer'];
                $name = $_SESSION['name'];

                $sql = "SELECT * FROM questions";
                $result = mysqli_query($conn, $sql);
                $countsql = "SELECT COUNT(*) as total FROM questions";
                $countresult = mysqli_query($conn, $countsql);

                while ($row = mysqli_fetch_assoc($countresult)) { 
                    $totalquestions = $row['total'];  
                }
                

                $percent = ($goodanswers / $totalquestions) * 100;

                echo "
                <section style='display: flex; justify-content: center; align-items: center; height: 100vh;'>
                <div style='text-align: center;'>
                <h3>Koniec testu.</h3>
                <h5>Gratuluje ". $name .". </h5>
                <p>Masz <b>$goodanswers</b> na <b>$totalquestions</b> poprawnych odpowiedzi. <br>
                W sumie zdobyłeś <b>". $percent ."%</b>. <br>
                <small>Wynik zostanie wysłany do nauczyciela.</small></p>
                </div>
                </section>";

            
         }else {
             header("Location: index.php");
         }
    
    
    
    ?>
</body>

</html>