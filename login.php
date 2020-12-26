<!DOCTYPE html>
<html>
    <head>
        <title>FormCSS</title>
   <link rel="stylesheet" href="mystyle.css" />
   <link rel="stylesheet" href="css/all.css">
   <link rel="stylesheet" type="text/css" href="css/stile.css">

    </head>
    <body>
    <?php
include 'navbar.php';
?>
    <?php

if (isset($_POST["submit"])) {

    include "../connect.php";

    $con = new mysqli("127.0.0.1", $dbusername, $dbpass, $database);

    $email = $_POST["email"];
    $pwd = $_POST['pass'];

    $pwd = trim($pwd);

    $query = "SELECT * FROM users WHERE email='" . $email . "'";

    if ($results = $con->query($query)) {
        $row = $results->fetch_assoc();

        if ($results->num_rows >= 1) {

            $nome = $row["firstname"];

            if (password_verify($pwd, $row["password"])) {

                echo "<div class='centertext'>";

                echo "<br><h1>Welcome $nome!</h1></br>";
                $_SESSION["user"] = $row['id'];
                echo "<div class='myelement'>";
                echo "<br><a href=\"index.php\">Homepage\t</a>";
                echo "<a href=\"private.php\">Private Area\t</a>";
                echo "<a href=\"logout.php\">Logout</a>";
                echo "</div>";
                echo "</div>";
            } else {
                echo "Password non valida";
            }
        } else {
            echo "Users not in the database";
            echo "<br><a href=\"login.php\">Login</a></br>";
        }
        $results->free();
    }
    $con->close();

} else {

    echo '
        <div class="mainFrame">
        <div class="frame">
        <form action = "./login.php" method = "POST">

        <input type="email" id="email" name="email" placeholder="E-mail"><br><br>

        <input type="password" id="pass" name="pass" placeholder="Password"><br><br>

        <input type="submit" name ="submit" value="Submit">
        </div>
        </form>';

}
?>

    <?php
include "footer.php";
?>
    </body>
</html>