<?php
function letezik($string){
    return isset($_POST[$string]) && strlen(trim($_POST[$string])) != 0;
}

function jsonBeolvas($filenev){
    return json_decode(file_get_contents($filenev),true);
}

function jsonKiir($filenev, $adat){
    file_put_contents($filenev, json_encode($adat, JSON_PRETTY_PRINT));
}

function atiranyit($oldal){
    header('Location:'.$oldal.'.php');
    die;
}

function jsonUjelem($filenev,$ujelem)
{
    $adat=jsonBeolvas($filenev);
    $adat[]=$ujelem;
    jsonKiir($filenev,$adat);
}
?>