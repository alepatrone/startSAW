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



 <h1 style="text-align:center">Your Course to Success</h1>
<p>

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
$i = 0;
if ($result = $con->query($query)) {
    echo '<div class = "allProd" style="text-align:center">';
    while ($row = $result->fetch_assoc()) {

        if ($i == 4) {
            echo '<br>';
        }
        echo '
        <div class = "product">
        <a href="show_product.php?id=' . $row["id"] . '"><img src="images/' . $row["imageName"] . '" width="200px" height="200px"></a> <br>
        ' . $row["prodname"] . '<br>' . $row["price"] . '€</div>';
        $i++;
    }
    $result->free();
    echo '</div>';
}

$con->close();
?>
<?php
include 'footer.php';
?>

</body>
</html>