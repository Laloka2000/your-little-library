<?php
session_start();
$Hiba=[];
if(isset($_SESSION["Hiba"]))
{
    $Hiba=$_SESSION["Hiba"];
}
?>

<!DOCTYPE html>
<html lang="hun">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="accdesing.css">
    <link rel="icon" tpye="image/png" href="Closed_Book_Icon.svg" size="32x32">
    <title>Kezdőlap</title>
</head>
<body>
<h2>Belépés</h2>
        <form form action="/login.php" method="post">
            <label>Felhasználó név:<input name="Felhasznalologin" type="text" required></label><br><br>
            <label>Jelszó:<input name="Jelszologin" type="password" required></label><br><br>
            <p class="hiba"><?php if(isset($Hiba["login"])){echo $Hiba["login"];}?></p>
            <input type="submit" value="Belépés">
        </form>    
        <h2>Ha még nem regisztrált itt tudja meg tenni!</h2>
        <form form action="/register.php" method="post">
            <label>Email:<input name="Email" id="email" type="email" required></label><p class="hiba"><?php if(isset($Hiba["Email"])){echo $Hiba["Email"];}?></p>
            <label>Felhasználó név:<input name="Felhasznalo" type="text" required></label>
            <p class="hiba"><?php if(isset($Hiba["Felhasznalo"])){echo $Hiba["Felhasznalo"];}?></p>
            <label>Jelszó:<input name="Jelszo" type="password" required></label><br><br>
            <label>Jelszó újra:<input name="Jelszo2" type="password" required></label><br><br>
            <p class="hiba"><?php if(isset($Hiba["Jelszo"])){echo $Hiba["Jelszo"];}?></p>
            <input type="submit" value="Regisztráció">
        </form>
</body>
</html>
<?php if(isset($_SESSION["Hiba"]))unset($_SESSION["Hiba"])?>