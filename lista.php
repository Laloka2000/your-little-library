<?php
require_once("fuggvenyek.php");
session_start();
if(!isset($_SESSION["Felhasznalo"]))
{
 atiranyit("account");
}
$konyvek=jsonBeolvas("konyvek.json");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" tpye="image/png" href="Closed_Book_Icon.svg" size="32x32">
    <title>Document</title>
</head>
<body>
<nav>
            <ul id="menu1">
				<li><a href= "index.php">Főoldal</a></li>
				<li><a href= "lista.php">Saját gyűjtemény</a></li>
				<li><a href= "feltoltes.php">Feltöltés</a></li>
               <?php if(isset($_SESSION["Felhasznalo"]))
                         {
                             echo '<li class="jobb"><a href="logout.php">Kilépes</a></li>';
                             echo '<li class="jobb">'.$_SESSION["Felhasznalo"].'</li>';
                        }else {
                            echo '<li class="jobb"><a href="account.php">Belépés/Regisztráció</a></li>';
                        }
                ?>            
			</ul>
        </nav>
        <div>
    <?php
    foreach ($konyvek as $konyv) {
        if($konyv["user"]==$_SESSION["Felhasznalo"])
        {
            echo "<a href=\"konyvek/".$konyv["ID"]."tartalom.".$konyv["tartalom"]."\""."> <img src=\"konyvek/".$konyv["ID"]."kep.".$konyv["boritokep"]."\""." width=\"150\"></a>";
            echo "<p style='color:black; font-size: x-large; font-family: Trebuchet MS, sans-serif; font-style: italic;'>".$konyv["szerzo"]."</p>";
            echo "<p style='color:black; font-size: x-large; font-family: Trebuchet MS, sans-serif; font-style: italic;'>".$konyv["cim"]."</p>";
            echo "<p style='color:black; font-size: x-large; font-family: Trebuchet MS, sans-serif; font-style: italic;'>".$konyv["kategoria"]."</p>";
        }
    }
    ?>
    </div>
    <style>
body {
  color: #111;
  font-size: larger;
  background-image: url("clouds.png");
  display: grid;
  text-align: center;
  background-size: cover;
  margin-top: 25px;
  margin-bottom: 50px;
}
    #menu1 {
  float: center;
  width: 100%;
  padding: 0;
  margin: 0 0 1em 0;
  list-style-type: none;
  background-color: rgb(224, 224, 224);
  }
#menu1 li { display: inline }

#menu1 a {
    float: left;
    padding: 0.25em 1em;
    margin: 0.25em 0 0.25em 1em;
    color: rgb(102, 102, 0);
    text-decoration: none;
}
.jobb
{
    float: right;
}
#menu1 a:hover {background-color: rgb(0, 0, 102)}
  
*{
  box-sizing: border-box;
}

    </style>
</body>
</html>