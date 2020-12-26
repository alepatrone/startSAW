<?php
session_start();
include "../connect.php";
$con = new mysqli("127.0.0.1", $dbusername, $dbpass, $database);
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $con->connect_error;
    exit();
}

/*if (!empty($_GET)) {
    $id = $_GET['id'];
}*/

//if ($_SESSION["user"] === $id) {

    $firstname = $_POST['firstname'];
    $firstname = $con->real_escape_string($firstname);
    $lastname = $_POST['lastname'];
    $lastname = $con->real_escape_string($lastname);
    $email = $_POST['email'];
    $email = trim($email);
    $email = $con->real_escape_string($email);
    //$bio = $_POST['bio'];
   // $bio = $con->real_escape_string($bio);
   // $citta = $_POST['citta'];
   // $citta = $con->real_escape_string($citta);

    if (empty($_POST['firstname'])) {
        echo "errore inserimento nome\n";
    }

    if (empty($_POST['lastname'])) {
        echo "errore inserimento cognome\n";
    }

    if (empty($_POST['email'])) {
        echo "errore inserimento email\n";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "inserire un email valida!\n";
        }
    }

  /*  $query = "UPDATE users SET firstname='" . $firstname . "',lastname='" . $lastname . "',email='" . $email . "'
            ,bio='" . $bio . "',citta='" . $citta . "' WHERE id=$id";*/
             $query = "UPDATE users SET firstname='" . $firstname . "',lastname='" . $lastname . "',email='" . $email . "'
             , WHERE id=10";
    $res = $con->query($query);
    echo $query;
    //$row = $res->fetch_assoc();
    // $res->free();
    $con->close();

    header("Location: index.php");

/*} else {
    echo "Not logged as this user";
}*/
