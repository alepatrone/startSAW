<?php
session_start();
include "../connect.php";
$con = new mysqli("127.0.0.1", $dbusername, $dbpass, $database);
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $con->connect_error;
    exit();
}


echo "<script type='text/javascript'>alert('CIAO');</script>";

$email = $_POST['email'];
$email = trim($email);
$email = $con->real_escape_string($email);

$totalVotesQuery = "SELECT COUNT(*) AS righe FROM reviews WHERE id_product = '" . $productId . "'";

if ($result = $conn->query($totalVotesQuery)) {
    // Return the number of rows in result set
    $row = $result->fetch_assoc();
    // Free result set
    mysqli_free_result($result);
} // endIf

return $row["righe"];

$query = "SELECT COUNT(*) AS righe FROM users WHERE email='" . $email . "'";
$res = $con->query($query);
$row = $res->fetch_assoc();

echo "<script type='text/javascript'>alert('".$row["righe"]."');</script>";
if ($row["righe"] > 0) {
    echo "ko";
} 

$res->free();
$con->close();
?>
