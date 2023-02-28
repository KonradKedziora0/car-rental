<?php
                 require_once("connect.php");
                 session_start(); 
if (!isset($_SESSION["login"])){ 
  header("Location: index.php"); 
  exit(); 
}
  if(isset($_POST["zarezerwuj-auto"])){
    $idusera = $_SESSION['id'];
    $samochod = $_POST["samochod"];
    
    $miejsceod = $_POST["miejsceod"];
    $dataod = $_POST["dataod"];
    
    $miejscedo = $_POST["miejscedo"];
    $datado = $_POST["datado"];
    
    $register = "INSERT INTO rezerwacja (odbior_miejsce, odbior_data, zwrot_miejsce, zwrot_data, samochod, ID_usera) VALUES ('$miejsceod', '$dataod', '$miejscedo', '$datado', '$samochod', '$idusera')";
    $wykoanie = $conn->query($register);
    $info = "Rezerwacja przebiegła pomyślnie. W przypadku pytań prosimy zadzwonić na 666333222. Dziękujęmy!";
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
             <span class="navitems" onclick="location.href='rezerwacjeUSER.php'">Rezerwacje</span>
            <span class="navitems" onclick="location.href='samochodyuser.php'">Samochody</span>
            <span class="navitems" onclick="location.href='logout.php'">Wyloguj</span>
            </div>
    </nav>
    <div class="auto"><img src="img/auto.jpg"> </div>
    <div id="container">
    <div class="top-title">
            <h1>Wypożyczalnia samochódów BartoliniCars</h1>
        </div>
        <div class="formularz">
         
                        <form action="indexuser.php" method="POST" >
                        <h2>Wypożycz samochód</h2>
                        <br>
                        <h2>Odbiór: </h2>
                                    <select class="wybierz" name="miejsceod" required>
                                        <option value="" disabled selected>Wybierz miejsce odbioru</option>
                                        <option value="Poznań">Poznań (ul. Kwasna 11)</option>
                                        <option value="Leszno">Leszno (ul. Kowalska 11)</option>
                                        <option value="Wrocław">Wrocław (ul. XX-lecia 11)</option> 
                                    </select>
                            <input type="text" id="from" placeholder="wybierz date" name="dataod" required> 
                            <label>Samochód trzeba odebrać do godziny 14:00</label>

                <h2>Zwrot:</h2>
                                <select class="wybierz" name="miejscedo" required>
                                <option value="" disabled selected>Wybierz miejsce zwrotu</option required>
                                        <option value="Poznań">Poznań (ul. Kwasna 11)</option>
                                        <option value="Leszno">Leszno (ul. Kowalska 11)</option>
                                        <option value="Wrocław">Wrocław (ul. XX-lecia 11)</option> 
                                </select>
                            <input type="text" placeholder="wybierz date" id="to" name="datado" required> 
                            <label>Samochód trzeba oddać do godziny 14:00</label> <br>

                            <select class="wybierz" name="samochod" required>
                            <option value="" disabled selected>Wybierz samochód</option required>                       
                                    <?php 
                                    $sql = "SELECT ID, Marka, Model, Rocznik, Silnik, Opis FROM samochod";
                                    $result = $conn->query($sql);
                                    $count = 0;
                                    while($car = $result->fetch_assoc()){
                                    $count ++;
                                    echo "<option value=" . $car['ID'].">" . $car['Marka'] ." ". $car['Model']. "</option>";
                                    }
                                    ?>
                            </select>
                                <div class="br"></div>
                                <input type="submit" value="Zarezerwuj" class="btn btn-outline-dark" name="zarezerwuj-auto">
                                <div class="text-success"><?php if( isset($info)) { echo $info; } ?></div>
                        </form>
                    

                        <div id="pytanie">
                            <form id="fr1">
                            <h2>Skontaktuj się z nami</h2>
                            <h5>Numer telefonu: 666333222</h5>
                            <h5>E-mail: bartolini@cars.com</h5>
                            
                            <a class="btn btn-outline-dark buttonSend" href="mailto:bartolini@cars.com">Wyślij wiadomość</a>
                        </div>
                        </form>
    </div>

       
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