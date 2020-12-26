<!DOCTYPE html>
<html lang="it">
<head>
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="css/stile.css">
    <link rel="stylesheet" href="css/all.css">
    <script src="js/script.js"></script>

</head>

<body>

<div class="menu">
  <?php
include 'navbar.php';
?>
</div>

 <h1 style="text-align:center">Products</h1>
<p>

<table id="users">
<tr>
    <th><a href="index.php?ord=firstname">Firstname</li></th>
    <th><a href="index.php?ord=lastname">Lastname</th>
    <th><a href="index.php?ord=email">Email</th>
    <th>Edit</th>
    <th>Erase</th>
  </tr>

  <?php

include "../connect.php";

$con = new mysqli("127.0.0.1", $dbusername, $dbpass, $database);
$query = "SELECT * FROM products";

if (!empty($_GET)) {
    if ($_GET['ord'] == 'prodname') {
        $query .= " ORDER BY prodname";
    }
    if ($_GET['ord'] == 'price') {
        $query .= " ORDER BY price";
    }
    if ($_GET['ord'] == 'available') {
        $query .= " ORDER BY available";
    }
}

if ($result = $con->query($query)) {
    while ($row = $result->fetch_assoc()) {

        echo '<tr>';
        echo '<td>' . $row["prodname"] . '</td>';
        echo '<td>' ."€". $row["price"] . '</td>';
        echo '<td>' . $row["available"] . '</td>';
        echo '<td><a href="show_product.php?id=' . $row["id"] . '"><img src="images/' . $row["imageName"] . '" width="100" height="200""></a></td>';
        echo '<td><a style="text-align:center;display:block;" href="show_profile.php?id=' . $row["id"] . '"> <i class="fas fa-edit"></i></a></td>';
        echo '</tr>';

    }
    $result->free();
}
$con->close();
?>
<?php
include 'footer.php';
?>

</body>
</html>