<?php
require_once("connect.php");
//Sprawdzanie czy user ma uprawnienia admina
session_start(); 
    if (!isset($_SESSION["loginADMIN"])){ 
        header("Location: index.php"); 
    exit(); 
} 

//Dodawanie samochodu
if(isset($_POST['dodaj'])){

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "img/" . $filename;

    $cena = $_POST['cena'];
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $rocznik = $_POST['rocznik'];
    $silnik = $_POST['silnik'];
    $opis = $_POST['opis'];
    move_uploaded_file($tempname, $folder);

            $add = "INSERT INTO samochod (Marka, Model, Rocznik, Silnik, Opis, Image, Cena) VALUES('$marka', '$model', '$rocznik', '$silnik','$opis', '$filename', '$cena')";
            $execute = $conn->query($add);   

            header("Location: samochodyADMIN.php");
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
        </div>
        <div class="br"></div>
        <div class="formularz-rejestracyjny">
            <form action="dodajauto.php" method="POST" enctype="multipart/form-data" >
            <input type="text"placeholder="Marka" name="marka" class="register-input" required> 
            <input type="text"placeholder="Model" name="model" class="register-input" required>
            <input type="text"placeholder="Rocznik" name="rocznik" class="register-input" required>
            <input type="text"placeholder="Silnik" name="silnik" class="register-input" required> 
            <input type="number"placeholder="Cena za dobę" name="cena" class="register-input" required> 
            <br>
            Dodaj zdjęcie samochodu
            <br>
            <input type="file" name="uploadfile" class="register-input" required>
            <br>
            Opis samochodu
            <br>
            <textarea name="opis" class="register-input" style="width: 800px; height:200px"></textarea>
            </label>
                    <div class="br"></div>
                 <button type="submit" class="btn btn-outline-dark" name="dodaj">Dodaj</button>
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