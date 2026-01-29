<?php 

session_start();
if(!isset($_SESSION["Felhasznalo"]))
{
    atiranyit('account');
}
$Hiba=[];
if(isset($_SESSION["Hiba"]))
{
    $Hiba=$_SESSION["Hiba"];}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Feltöltés</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="feltdesing.css">
    <link rel="icon" tpye="image/png" href="Closed_Book_Icon.svg.png" size="32x32">
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
        <h1>Feltöltés</h1>
        <?php if(isset($_SESSION["eredmeny"])) 
        {
            if($_SESSION["eredmeny"]==1)
            {
                echo '<p> A feltöltés sikeres!</p>';
            }else
            {
                echo '<p> Sikertelen feltöltés!</p>';
            }
        }
        unset($_SESSION["eredmeny"]);
        ?>
            <form action="feldog.php" method="post" enctype="multipart/form-data">
                <div class="konyv">
                  <label for="szerzo"><b>Szerző</b></label>
                  <input type="text" name="szerzo" id="szerzo" required><br>
                  <p class="hiba"><?php if(isset($Hiba["szerzo"])){echo $Hiba["szerzo"];}?></p>
                  <label for="cim"><b>Cím</b></label>
                  <input type="text" name="cim" id="cim" required><br>
                  <p class="hiba"><?php if(isset($Hiba["cim"])){echo $Hiba["cim"];}?></p>
                  <label for="kategoria"><b>Kategória</b></label>
                  <input type="text" name="kategoria" id="kategoria" required><br>
                  <p class="hiba"><?php if(isset($Hiba["kategoria"])){echo $Hiba["kategoria"];}?></p>
                  <label for="boritokep"><b>Boritókép:</b></label>
                  <input type="file" name="boritokep" id="boritokep"><br>
                  <p class="hiba"><?php if(isset($Hiba["boritokep"])){echo $Hiba["boritokep"];}?></p>
                  <label for="tartalomfajl"><b>Könyv tartalma:</b></label>
                  <input type="file" name="tartalomfajl" id="tartalomfajl"><br>
                  <p class="hiba"><?php if(isset($Hiba["tartalomfajl"])){echo $Hiba["tartalomfajl"];}?></p>

                  <button type="submit" class="feltoltesbtn">Feltölt</button>
                  
                </div>
        </nav>
        <?php unset($_SESSION["Hiba"]);?>
    </body>
</head>
</html>