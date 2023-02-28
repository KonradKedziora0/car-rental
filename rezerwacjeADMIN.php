 <?php
require_once('connect.php');
session_start();

if (!isset($_SESSION["loginADMIN"])){ 
    header("Location: index.php"); 
    exit(); 
}
if(isset($_POST["akceptacja"])){
    $id = $_POST["id"];
    $register = "UPDATE rezerwacja SET potwierdzenie = 1 WHERE ID = '$id'";
    $wykoanie = $conn->query($register);
    $info = "Zatwierdziłeś rezerwację";
    }

    if(isset($_POST["odrzucenie"])){
        $id = $_POST["id"];
        $register = "UPDATE rezerwacja SET potwierdzenie = 2 WHERE ID = '$id'";
        $wykoanie = $conn->query($register);
        $info = "Odrzuciłeś rezerwację";
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
            <span class="navitems" onclick="location.href='samochodyuser.php'">Samochody</span>
            <span class="navitems" onclick="location.href='rezerwacjeUSER.php'">Rezerwacje</span>
            <span class="navitems" onclick="location.href='logout.php'">Wyloguj</span>
    </nav>
    <div class="auto"><img src="img/auto.jpg"> </div>
    <div id="container">
    <div class="top-title">
            <h1>Twoje rezerwacje</h1>
        </div>
             <table>
               <tr><th> Odbiór-miejsce </th> <th> Odbiór-data </th> <th> Zwrot-miejsce </th> <th> Zwrot-data </th> <th> Samochód </th> <th> Potwierdzenie </th> <th> E-mail </th> <th> Cena </th> <th> Akcja </th></tr>
        <?php 
            $idusera = $_SESSION['id'];
            $sql = "SELECT rezerwacja.ID, rezerwacja.odbior_miejsce, rezerwacja.odbior_data, rezerwacja.zwrot_miejsce, rezerwacja.zwrot_data, rezerwacja.samochod, rezerwacja.Potwierdzenie, samochod.Marka, samochod.Model, samochod.Cena ,user.Email FROM rezerwacja INNER JOIN samochod INNER JOIN user where rezerwacja.samochod = samochod.ID AND rezerwacja.ID_usera = user.id ORDER BY rezerwacja.ID DESC;";
            $result = $conn->query($sql);
            $count = 0;
            $potwierdzenie = 0;    
            while($car = $result->fetch_assoc()){
                $count ++;
                $firstDate = strtotime($car['zwrot_data']);
                $secondDate = strtotime($car['odbior_data']);
                $diff = $firstDate-$secondDate;
                $diff = $diff/86400;
                $cena = $diff * $car['Cena'];
                if($car['Potwierdzenie'] == 0){
                    $potwierdzenie = "Oczekuje na zatwierdzenie";
                }else if ($car['Potwierdzenie'] == 1){
                    $potwierdzenie = "Zatwierdzone";
                }
                else{
                    $potwierdzenie = "Odrzucone";
                }
                echo "<tr>"."<td>".$car['odbior_miejsce']."</td>"."<td>".$car['odbior_data']."</td>"."<td>".$car['zwrot_miejsce']."</td>"."<td>".$car['zwrot_data']."</td>"."<td>".$car['Marka']." ".$car['Model']."</td>"."<td>".$potwierdzenie."</td>"."<td>".$car['Email']."</td>"."<td>".$cena."zł </td> <td><form method='post' action='rezerwacjeADMIN.php'><input type='submit' class='text-success' value='Zatwierdź' name='akceptacja'></input> <input type='submit' class='text-danger' value='Odrzuć' name='odrzucenie'></input> <input type='text' hidden name='id' value=".$car['ID']."></input></form>"."</td>"."</tr>";
            }
             ?>
             </table>
        </div>
      
    </div>
</body>