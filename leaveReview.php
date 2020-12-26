<?php

session_start();
include "../connect.php";
$con = new mysqli("127.0.0.1", $dbusername, $dbpass, $database);
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $con->connect_error;
    exit();
}

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION["user"];

$stars= $_POST['stars'];
$review = $_POST['review'];
$id_product = $_POST['id'];

$query = "SELECT * FROM reviews WHERE id_user = '" . $id_user . "' AND id_product= '" . $id_product . "'";

if ($result = $con->query($query)) {
    $row_cnt = $result->num_rows;
    if ($row_cnt != 0) {
        echo "You already left a review on this product";
        $result->free();
    } else {
        $query = "INSERT INTO reviews (id_user,id_product,review,rating) VALUES (" . $id_user . "," . $id_product . ",'" . $review . "','" . $stars . "')";
        $result = $con->query($query);
    }
}
$con->close();
