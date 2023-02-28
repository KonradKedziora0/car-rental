<?php
                 require_once("connect.php");
                 session_start(); 
if (!isset($_SESSION["loginADMIN"])){ 
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
             <div class="float">
            <span class="navitems" onclick="location.href='index.php'">Strona główna</span>
            <span class="navitems" onclick="location.href='dodajauto.php'">Dodaj auto</span>
            <span class="navitems" onclick="location.href='samochodyADMIN.php'">Samochody</span>
            <span class="navitems" onclick="location.href='rezerwacjeADMIN.php'">Rezerwacje</span>
            <span class="navitems" onclick="location.href='logout.php'">Wyloguj</span>
            </div>
    </nav>
    <div class="auto"><img src="img/auto.jpg"> </div>
    <div id="container">
    <div class="top-title">
            <h1>Wypożyczalnia samochódów BartoliniCars</h1>
        </div>
       

       
    </div>
</body>