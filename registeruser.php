<?php
require_once("connect.php");

session_start(); 
if (isset($_SESSION["login"])){ 
  header("Location: indexuser.php"); 
  exit(); 
} 
if(isset($_POST['zarejestruj'])){
    $login = $_POST['login'];
    $password = $_POST['haslo'];
    $email = $_POST['email'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $telefon = $_POST['telefon'];
    $rola = "user";

    $user_query = "SELECT login FROM user WHERE Login= '$login'";
    $user_result = $conn->query($user_query);

    $email_query = "SELECT email FROM user WHERE Email= '$email'";
    $email_result = $conn->query($email_query);

    $num_length = strval($telefon);

    if($user_result->num_rows>0 || $email_result->num_rows>0){
            $error_info = "Podany login lub e-mail jest już zajęty. Spróbuj ponownie";
        }else if(strlen($password)<7){
            $error_info = "Hasło musi mieć conajmniej 8 znaków";
        }else if(strlen($num_length)!=9){
            $error_info = "Numer telefonu musi mieć 9 cyfr";
        }
        else{
            $hashPassword = password_hash($password,PASSWORD_ARGON2I);
            $register = "INSERT INTO user (Login, Haslo, Email,Imie, Nazwisko, Rola, Telefon ) VALUES('$login', '$hashPassword', '$email', '$imie','$nazwisko', '$rola', '$telefon')";
            $execute = $conn->query($register);

            $info = "Rejestracja pomyślna";
        }
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
        <div class="br"></div>
        <div class="formularz-rejestracyjny">
            <form action="registeruser.php" method="POST" >
            <input type="text"placeholder="Login" name="login" class="register-input" required> 
            <input type="password"placeholder="Hasło" name="haslo" class="register-input" required>
            <input type="email"placeholder="E-mail" name="email" class="register-input" required>
            <input type="text"placeholder="Imię" name="imie" class="register-input" required>
            <input type="text"placeholder="Nazwisko" name="nazwisko" class="register-input" required>
            <input type="number"placeholder="Numer telefonu" name="telefon" class="register-input" required>
            <label class="check-text">
            <input type="checkbox" required> Oświadczam, że zapoznałem się z <a href="regulamin.php">regulaminem</a>
            </label>
                    <div class="br"></div>
                 <button type="submit" class="btn btn-outline-dark" name="zarejestruj">Zarejestruj</button>
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
            Dzięki rejestracji będziesz mógł wypożyczyć samochód.

    </div>

   <script src="./bootstrap/jquery.js"></script>
   <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>

</body>