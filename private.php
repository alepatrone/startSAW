<!DOCTYPE html>
<html lang="it">
<head>
    <title>Private Area</title>
    <link rel="stylesheet" type="text/css" href="css/stile.css">


</head>

<body>
<div class='centertext'>
<div class="menu">
<?php

include 'navbar.php';

include "../connect.php";
$con = new mysqli("127.0.0.1", $dbusername, $dbpass, $database);
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $con->connect_error;
    exit();
}

if (!empty($_GET)) {
    $id = $_GET['id'];
}

if ($_SESSION["user"] === $id) {

    $firstname = $_POST['firstname'];
    $firstname = $con->real_escape_string($firstname);
    $lastname = $_POST['lastname'];
    $lastname = $con->real_escape_string($lastname);
    $email = $_POST['email'];
    $email = trim($email);
    $email = $con->real_escape_string($email);

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

    $query = "UPDATE users SET firstname='" . $firstname . "',lastname='" . $lastname . "',email='" . $email . "' WHERE id=$id";
    $res = $con->query($query);
    echo $query;
    //$row = $res->fetch_assoc();
    // $res->free();
    $con->close();

    header("Location: index.php");

} else {
    echo "Not logged as this user";
}

echo "<h2>";
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

echo "<br>This is your private page";
echo "</h2>";

?>
<br>

<a href="index.php">Homepage</a>
<a href="logout.php">Logout</a>

</div>
<?php
include "footer.php";
?>

</body>
</html>


