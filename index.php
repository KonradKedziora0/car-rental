<?php
session_start(); 
if (isset($_SESSION["login"])){ 
  header("Location: indexuser.php"); 
  exit(); 
} 
if (isset($_SESSION["loginADMIN"])){ 
    header("Location: indexadmin.php"); 
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
            <span class="navitems" onclick="location.href='login.php'">Logowanie</span>
            <span class="navitems" onclick="location.href='registeruser.php'">Rejestracja</span>
            <span class="navitems" onclick="location.href='samochody.php'">Samochody</span>
    </nav>
    <div class="auto"><img src="img/auto.jpg"> </div>
    <div id="container">
        <div class="top-title">
            <h1>Wypożyczalnia samochódów BartoliniCars</h1>
        </div>
        <div>
            Aby wypożyczyć samochód, musisz być zalogwany!
            Jeśli nie masz jeszcze konta. Założ je <a href="registeruser.php">tutaj!</a>
            <br>
            <br>
            <form id="fr1">
                            <h2>Skontaktuj się z nami</h2>
                            <h5>Numer telefonu: 666333222</h5>
                            <h5>E-mail: bartolini@cars.com</h5>
                            
                            <a class="btn btn-outline-dark buttonSend" href="mailto:bartolini@cars.com">Wyślij wiadomość</a>
        </div>
        <div id="pytanie">
                            
                        </div>
     

   <script src="./bootstrap/jquery.js"></script>
   <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
   <script >
   var dateToday = new Date();
var dates = $("#from, #to").datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 3,
    minDate: dateToday,
    onSelect: function(selectedDate) {
        var option = this.id == "from" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
});

   </script>



 
</body>