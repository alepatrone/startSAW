<?php
session_start();
include "../connect.php";
$con = new mysqli("127.0.0.1", $dbusername, $dbpass, $database);
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $con->connect_error;
    exit();
}


$email = $_POST['email'];
$email = trim($email);
$email = $con->real_escape_string($email);

//$totalVotesQuery = "SELECT COUNT(*) AS righe FROM reviews WHERE id_product = '" . $productId . "'";

/*if ($result = $conn->query($totalVotesQuery)) {
    // Return the number of rows in result set
    $row = $result->fetch_assoc();
    // Free result set
    mysqli_free_result($result);
} // endIf
*/

$query = "SELECT COUNT(*) AS righe FROM users WHERE email='" . $email . "'";
$res = $con->query($query);
$row = $res->fetch_assoc();

if ($row["righe"] > 0) {
    echo "ko";
} 
else echo "ok";

$res->free();
$con->close();
?>
