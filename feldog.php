<?php 
require_once("fuggvenyek.php");
session_start();
if(!isset($_SESSION["Felhasznalo"]))
{
    atiranyit("account");
}

//limit fájl és szöveg méret hibát dobni rá
$konyvek=jsonBeolvas("konyvek.json");
$uj=[];
$maximumId=0;
$target_dir = "konyvek/";
$target_file = $target_dir . basename($_FILES["boritokep"]["name"]);
$target_file2 = $target_dir . basename($_FILES["tartalomfajl"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
$hibak=[];

if(!letezik("szerzo"))
{
  $hibak["szerzo"]="Üres maradt a szerző!";
}

if(!letezik("cim"))
{
  $hibak["cim"]="Üres maradt a cim!";
}

if(!letezik("kategoria"))
{
  $hibak["kategoria"]="Üres maradt a kategoria!";
}

if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["boritokep"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $hibak["boritokep"]="Fájl nem kép.";
    $uploadOk = 0;
  }
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
  $hibak["boritokep"]="Csak JPG, JPEG, PNG fájl engedélyezet.";
  $uploadOk = 0;
}
if($imageFileType2 != "pdf")
{
  $hibak["tartalomfajl"]="Csak PDF fájl engedélyezett."; 
  $uploadOk=0;
}

if ($uploadOk == 0) {
  $hibak[]="Nem sikerült feltöltenni.";
} else {
  if (move_uploaded_file($_FILES["boritokep"]["tmp_name"], $target_file)) {
      
  } else {
    $hibak["boritokep"]="Nem sikerült feltölteni a Boritoképet!";
  }
  if (move_uploaded_file($_FILES["tartalomfajl"]["tmp_name"], $target_file2)) {
  }
  else {
    $hibak["tartalomfajl"]="Nem sikerült feltölteni a Könyv tartalmat!";
  }
}
if(empty($hibak))
{
  foreach($konyvek as $id )
  {
    if($maximumId<$id["ID"])
    {
        $maximumId=$id["ID"];
    }
  }
    $uj["ID"]=$maximumId+1;
    rename($target_file2,$target_dir.$uj["ID"]."tartalom.".$imageFileType2);
    rename($target_file,$target_dir.$uj["ID"]."kep.".$imageFileType);
    $uj["user"]=$_SESSION["Felhasznalo"];
    $uj["szerzo"]=$_POST["szerzo"];
    $uj["cim"]=$_POST["cim"];
    $uj["boritokep"]=$imageFileType;
    $uj["tartalom"]=$imageFileType2;
    $uj["kategoria"]=$_POST["kategoria"];
    jsonUjelem("konyvek.json",$uj);
    $_SESSION["eredmeny"]=1;
}else
{
    $_SESSION["eredmeny"]=2;
    $_SESSION["Hiba"]=$hibak;
} 
atiranyit("feltoltes");
?>