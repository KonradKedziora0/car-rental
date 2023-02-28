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
            <h1>Twoje rezerwacje</h1>
        </div>
                <table>
                <tr><th> Odbiór-miejsce </th> <th> Odbiór-data </th> <th> Zwrot-miejsce </th> <th> Zwrot-data </th> <th> Samochód </th><th>Cena</th> <th> Potwierdzenie </th></tr>
        <?php 
            $idusera = $_SESSION['id'];
            $sql = "SELECT * FROM rezerwacja INNER JOIN samochod where rezerwacja.ID_usera = $idusera AND rezerwacja.samochod = samochod.ID ORDER BY rezerwacja.ID DESC";
            $result = $conn->query($sql);
            $count = 0;
            $potwierdzenie = 0;    
            
            while($car = $result->fetch_assoc()){
                $firstDate = strtotime($car['zwrot_data']);
                $secondDate = strtotime($car['odbior_data']);
                $diff = $firstDate-$secondDate;
                $diff = $diff/86400;
                $cena = $diff * $car['Cena'];
            $count ++;
            if($car['Potwierdzenie'] == 0){
                $potwierdzenie = "Oczekuje na zatwierdzenie";
            }else if ($car['Potwierdzenie'] == 1){
                $potwierdzenie = "Zatwierdzone";
            }
            else{
                $potwierdzenie = "Odrzucone";
            }
           
             echo "<tr>"."<td>".$car['odbior_miejsce']."</td>"."<td>".$car['odbior_data']."</td>"."<td>".$car['zwrot_miejsce']."</td>"."<td>".$car['zwrot_data']."</td>"."<td>".$car['Marka']." ".$car['Model']."</td>"."<td>".$cena."zł <td>".$potwierdzenie."</td>"."</tr>";
            
            }
             ?>
            </table>
        </div>
      
    </div>
</body>