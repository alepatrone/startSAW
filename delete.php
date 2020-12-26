<?php

include "../connect.php";
include "navbar.php";

$con = new mysqli("127.0.0.1", $dbusername, $dbpass, $database);

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

print_r($_SESSION["user"]);

if (!empty($_GET)) {
    $id = $_GET['id'];
}

if ($_SESSION["user"] === $id) {
    $query = "DELETE FROM users WHERE id='" . $_SESSION["user"] . "'";
    $con->query($query);

    echo "<br><a href=\"index.php\">Homepage\t</a>";
} else {
    echo "Not logged as this user";
}
?>
