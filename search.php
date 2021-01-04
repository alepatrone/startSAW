<!DOCTYPE html>
<html lang="it">
<head>
    <title>Search</title>
    <link rel="stylesheet" type="text/css" href="css/stile.css">
    <link rel="stylesheet" href="css/all.css">
    <script src="js/script.js"></script>
</head>
<?php

include '../connect.php';
$con = new mysqli("127.0.0.1", $dbusername, $dbpass, $database);
$search = $_POST['search'];
$search = htmlspecialchars($search);
echo '<div class="menu">';
include 'navbar.php';

$i = 0;
$query = "SELECT * FROM products WHERE prodname LIKE '%" . $search . "%'";
if ($result = $con->query($query)) {
    echo '<div class = "allProd" style="text-align:center">';
    $total_row = mysqli_num_rows($result);
    if ($total_row == 0) {
        echo '<h2> No products were found matching your selection</h2>';
        echo '<a href="index.php">Go back to Homepage</a>';
      
    } else {
        echo '<h2> Products matching your selection </h2>';
        while ($row = $result->fetch_assoc()) {

            if ($i == 4) {
                echo '<br>';
            }
            echo '
        
        <a href="show_product.php?id=' . $row["id"] . '"><img src="images/' . $row["imageName"] . '" width="200px" height="200px"></a> <br>
        ' . $row["prodname"] . '<br>' . $row["price"] . '€</div>';
            $i++;
        }
        $result->free();
        
    }
}

echo '</div>';
$con->close();

include 'footer.php';
?>

</html>