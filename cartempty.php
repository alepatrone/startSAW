<?php

include "../connect.php";

$con = new mysqli("127.0.0.1", $dbusername, $dbpass, $database);
$stmt = $con->prepare("DELETE FROM cart WHERE id_user = ?");

$id = $_GET['id'];

$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->close();
header("Location: checkout.php?id=$id");


?>

