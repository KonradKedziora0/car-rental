<?php
require_once("connect.php");

session_start(); 
if (!isset($_SESSION["loginADMIN"])){ 
  header("Location: index.php"); 
  exit(); 
} 

if(isset($_POST['usun2'])){
    $idsamochodu3 = $_POST['idsamochodu2'];
 
            $remove = "DELETE FROM samochod WHERE ID='$idsamochodu3'";
            $execute = $conn->query($remove);

           
              
            header("Location:samochodyADMIN.php");

        }
        if(!isset($_POST['usun'])){
            header("Location:samochodyADMIN.php");
            die;
        }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BartoliniCars</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">

</head>
<body> 
    <nav>
    <span id="navtitle"  onclick="location.href='index.php'">BartoliniCars</span>
            <span class="navitems" onclick="location.href='index.php'">Strona główna</span>
            <span class="navitems" onclick="location.href='dodajauto.php'">Dodaj auto</span>
            <span class="navitems" onclick="location.href='samochodyADMIN.php'">Samochody</span>
            <span class="navitems" onclick="location.href='rezerwacjeADMIN.php'">Rezerwacje</span>
            <span class="navitems" onclick="location.href='logout.php'">Wyloguj</span>
    </nav>
    </nav>
    <div class="auto"><img src="img/auto.jpg"> </div>
    <div id="container">
        <div class="top-title">
            <h1>Wypożyczalnia samochódów BartoliniCars</h1>
            <h2>Usuń samochód</h2>
        </div>
        <div class="br"></div>
        <div class="formularz-rejestracyjny">
            <form action="usunauto.php" method="POST" enctype="multipart/form-data" >
            <?php
            if(isset($_POST['usun'])){
                $idsamochodu = $_POST['idsamochodu'];
            }
            $sql = "SELECT ID, Marka, Model, Rocznik, Silnik, Opis, Image, Cena FROM samochod where ID = $idsamochodu";
            $result = $conn->query($sql);
            $count = 0;
            while($car = $result->fetch_assoc()){
            echo "<input type='text' placeholder='ID' name='idsamochodu2' hidden value='".$car['ID']."' class='register-input' required readonly >"; 
            echo "<input type='text' placeholder='Marka' name='marka' value='".$car['Marka'] ."' class='register-input' required readonly >"; 
            echo "<input type='text' placeholder='Model' name='model' value='".$car['Model']."' class='register-input' required readonly >"; 
            echo "<input type='text' placeholder='Rocznik' name='rocznik' value='".$car['Rocznik']."' class='register-input' required readonly >"; 
            echo "<input type='text' placeholder='Silnik' name='silnik' value='".$car['Silnik']."' class='register-input' required readonly>"; 
            echo "<input type='number' placeholder='Cena za dobę' name='cena' value='".$car['Cena']."' class='register-input' required readonly>"; 
            echo "<br>";
            echo "Edytuj zdjęcie samochodu";
            echo "<br>";
            echo "<input type='file' name='uploadfile' class='register-input' >";
            echo "<br>";
            echo "Edytuj opis samochodu";
            echo "<br>";
            echo "<textarea name='opis' class='register-input' style='width: 800px; height:200px'readonly>".$car['Opis']."</textarea>";
            echo "</label>";
            }
            ?>
                    <div class="br"></div>
                 <input name="usun2" type="submit"class="btn btn-outline-dark"  value="Usuń"></button>
                 <div class="text-danger">
                    <?php if( isset($error_info) && $error_info != '' ) { echo $error_info; } ?>
                 </div>
                 <div class="text-success">
                    <?php
                            if( isset($info) && $info != '' ) { echo $info; }
                 ?></div>

            </form>
        </div>

</br>
</br>
   

    </div>

   <script src="./bootstrap/jquery.js"></script>
   <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>

</body>