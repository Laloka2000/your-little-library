<?php 
require_once("fuggvenyek.php");
$user=jsonBeolvas("user.json");
$uj=[];
$maximumId=0;

if(!letezik("Email"))
{
    $hibak["Email"]="Nem adtál meg Email-t vagy üres!";
}else if(!filter_var($_POST["Email"],FILTER_VALIDATE_EMAIL))
{
    $hibak["Email"]="Helytelen e-mail formátum!";
}else 
{
    foreach( $user as $adat)
    {
        if($adat["Email"]==$_POST["Email"])
        {
            $hibak["Email"]="Ez a email cím már használt!";
            break;
        }
    }
}

if(!letezik("Felhasznalo"))
{
    $hibak["Felhasznalo"]="Nem adtál meg Felhasznaló nevet vagy üres!";
}else
{
    foreach( $user as $adat)
    {  
        if($adat["Felhasznalo"]==$_POST["Felhasznalo"])
        {
            $hibak["Felhasznalo"]="Ez a felhasználó név már foglalt!";
            break;
        }
    }
}

if(!letezik("Jelszo"))
{
    $hibak["Jelszo"]="Nem adtál meg Jelszót!";
}else if(!letezik("Jelszo2"))
{
    $hibak["Jelszo"]="Nem adtál meg Jelszó ismétlést!";
}else if($_POST["Jelszo"]!=$_POST["Jelszo2"])
{
    $hibak["Jelszo"]="Jelszavak nem egyeznek!";
}

foreach($user as $id )
{
    if($maximumId<$id["ID"])
    {
        $maximumId=$id["ID"];
    }
}
session_start();
if(empty($hibak))
{
    $uj["ID"]=$maximumId+1;
    $uj["Email"]=$_POST["Email"];
    $uj["Felhasznalo"]=$_POST["Felhasznalo"];
    $uj["Jelszo"]=password_hash($_POST["Jelszo"],PASSWORD_DEFAULT);
    jsonUjelem("user.json",$uj);
    session_unset();
    $_SESSION["Felhasznalo"]=$uj["Felhasznalo"];
    atiranyit("index");
}else
{
    $_SESSION["Hiba"]=$hibak;
    atiranyit("account");
}
?>