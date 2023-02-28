<?php
require_once('connect.php');
session_start();

if (!isset($_SESSION["login"])){ 
    header("Location: index.php"); 
    exit(); 
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
            <span class="navitems" onclick="location.href='rezerwacjeUSER.php'">Rezerwacje</span>
            <span class="navitems" onclick="location.href='samochodyuser.php'">Samochody</span>
            <span class="navitems" onclick="location.href='logout.php'">Wyloguj</span>
    </nav>
    <div class="auto"><img src="img/auto.jpg"> </div>
    <div id="container">
    <div class="top-title">
            <h1>Nasze samochody</h1>
        </div>
       
        <?php 
            $sql = "SELECT Marka, Model, Rocznik, Silnik, Opis, Image, Cena FROM samochod";
            $result = $conn->query($sql);
            $count = 0;
            while($car = $result->fetch_assoc()){
             $count ++;
             echo " <div class='auto-list'>";
             echo "<h3>".$car['Marka'].' '.$car['Model']."</h3>";
             echo "<img src=img/".$car['Image'].">";
             echo "<h4> Silnik: ".$car['Silnik']."</h4>";
             echo "<h4> Rocznik: ".$car['Rocznik']."</h4>";
             echo "<h4> Opis:".$car['Opis']."</h4>";
             echo "<h4> Cena za dobę: ".$car['Cena']."zł </h4>";
             echo "</div>";
            }
             ?>
        </div>
      
    </div>
</body>