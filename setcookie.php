<!DOCTYPE html>
<html lang="it">
<head>
    <title>Set cookie</title>
</head>

<body>

<?php

 // LEGGI IN VALORI RICEVUTI IN POST
 // CREA I PARAMETRI PER IL COOKIE
 // CREA IL COOKIE CON LA FUNZIONE setcookie();

    $cname="stile";
    $cvalue = $_POST['textcolor']."|".$_POST['bgcolor']."|".$_POST['fonts'];
    echo $cvalue;
    $cexpires = mktime(0,0,0,01,01,2021);
    setcookie($cname,$cvalue,$cexpires);
    
 // LA FUNZIONE header() RIMANDA ALL'HOME PAGE
 header("Location: index.php");
?>


</body>
</html>