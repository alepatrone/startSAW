<?php
include 'navbar.php';
include "../connect.php";
$con = new mysqli("127.0.0.1", $dbusername, $dbpass, $database);
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $con->connect_error;
    exit();
}

$idcheck = -1;
if (!empty($_POST)) {
    $idcheck = $_POST['id'];
}

if (!empty($_SESSION["user"])) {
    $id = $_SESSION["user"];
}


if (!empty($_SESSION["user"])) {

    $firstname = $_POST['firstname'];
    $firstname = $con->real_escape_string($firstname);
    $lastname = $_POST['lastname'];
    $lastname = $con->real_escape_string($lastname);
    $email = $_POST['email'];
    $email = trim($email);
    $email = $con->real_escape_string($email);
    if (isset($_POST['bio'])) {
        $bio = $_POST['bio'];
        $bio = $con->real_escape_string($bio);
    }
    if (isset($_POST['citta'])) {
        $citta = $_POST['citta'];
        $citta = $con->real_escape_string($citta);
    }

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

    $query = "UPDATE users SET firstname='" . $firstname . "', lastname='" . $lastname . "', email='" . $email . "'
            , bio='" . $bio . "', citta='" . $citta . "' WHERE id=$id";
    $res = $con->query($query);
    $con->close();

    header("Location: show_profile.php?id=" . $id . "");

} else {
    echo '<div class="centertext" >';
    echo 'Not logged as this user';
    echo '</div>';

    include "footer.php";
}
