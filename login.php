<?php
require_once("connect.php");

session_start(); 
if (isset($_SESSION["login"])){ 
  header("Location: indexuser.php"); 
  exit(); 
} 

if(isset($_POST["zaloguj"])){
    $login = $_POST['login'];
    $password = $_POST['haslo'];

        $sql = $conn->query("SELECT * FROM user WHERE login ='$login'");
        $row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
        $hash = $row['Haslo'];

    if(password_verify($password, $hash) && $row['Rola']=='user') {
        $_SESSION['login']=true;
        $_SESSION['name']=$login;
        $_SESSION['id']=$row['ID'];
        Header("Location: indexuser.php");
    }else if(password_verify($password, $hash) && $row['Rola'] == 'admin') {
        $_SESSION['loginADMIN']=true;
        $_SESSION['id']=$row['ID'];
        Header("Location: indexadmin.php");
    }else{
        $error_info = "Podano błędny login lub hasło. Spróbuj ponownie";
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
        <div class="formularz">
                                <form class="register-form" action="login.php" method="POST">
                                <input type="text"placeholder="Login" name="login" class="login-input"> 
                                <input type="password"placeholder="Hasło" name="haslo" class="login-input">
                                <h1></h1>   
                                <input type="submit" value="Zaloguj" class="btn btn-outline-dark" name="zaloguj">
                                <div class="text-danger"><?php if( isset($error_info) && $error_info != '' ) { echo $error_info; } ?></div>
                                </form>
                
                </div>
</body>
</html>