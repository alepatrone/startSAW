<!DOCTYPE html>
<html>

<head>
    <title>FormCSS</title>
    <link rel="stylesheet" href="mystyle.css" />
    <link rel="stylesheet" type="text/css" href="css/stile.css">
    <link rel="stylesheet" href="css/all.css">
</head>

<body>
    <?php
include 'navbar.php';
?>
    <div class="mainFrame">
        <div class="frame">
            <form action="./registration.php" method="POST">
                <?php

if (isset($_POST["submit"])) {
    include "../connect.php";

    $con = new mysqli("127.0.0.1", $dbusername, $dbpass, $database);

    if ($con->connect_errno) {
        echo "Failed to connect to MySQL: " . $con->connect_error;
        exit();
    }

    $email = $_POST['email'];
    $email = trim($email);
    $email = $con->real_escape_string($email);
    $email = htmlspecialchars($email);
    $nome = $_POST['firstname'];
    $nome = trim($nome);
    $nome = $con->real_escape_string($nome);
    $nome = htmlspecialchars($nome);
    $cognome = $_POST['lastname'];
    $cognome = trim($cognome);
    $cognome = $con->real_escape_string($cognome);
    $cognome = htmlspecialchars($cognome);
    $password = $_POST['pass'];
    $password = trim($password);
    $password = htmlspecialchars($password);
    $confPass = $_POST['confirm'];
    $confPass = trim($confPass);
    $confPass = htmlspecialchars($confPass);

    if (empty($_POST['email'])) {
        echo "errore inserimento email\n";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "inserire un email valida!\n";
        }
    }
    if (empty($_POST['pass'])) {
        echo "errore inserimento password\n";
    } else {
        $password = trim($password);
    }
    //tolgo gli eventuali caratteri sbagliati in più

    if (empty($_POST['firstname'])) {
        echo "errore inserimento nome\n";
    }

    if (empty($_POST['lastname'])) {
        echo "errore inserimento cognome\n";
    }

    if (empty($_POST['confirm'])) {
        echo "errore inserimento password di conferma\n";
    } else {
        $confPass = trim($confPass);
    }
    //tolgo gli eventuali caratteri sbagliati in più

    if ($password != $confPass) {
        echo "la password non corrisponde alla sua conferma\n";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
    }
    //funzione

    echo "utente registrato con successo!\n";
    echo nl2br("\n\n");
    echo "<a href=\"index.php\">Homepage</a>";
    $query = "INSERT INTO users (firstname, lastname, email, password) values(
                                    '" . $nome . "', '" . $cognome . "','" . $email . "', '" . $hash . "')";
    $res = $con->query($query);

    $con->close();
} else {

    $url = 'checkemail.php';
    echo '<div class ="input-group"> ';
    echo '  <span class ="input-group-addon"><i class="far fa-user"></i></i></span>';

    echo '<input type="text" id="firstname" name="firstname" placeholder="Firstname"><br><br>';
    echo '</div>';
    echo '<input type="text" id="lastname" name="lastname" placeholder="Lastname"><br><br>

    <input type="email" id="email" name="email"  placeholder="E-mail"><br><br>
        <input type="password" id="pass" name="pass" placeholder="Password"><br><br>
        <input type="password" id="confirm" name="confirm" placeholder="Confirm Password"><br><br>
      
      </form>
        <input type="submit" name="submit" value="Submit">';

}

?>


                <?php
include "footer.php";

?>
</body>

</html>