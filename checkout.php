<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="mystyle.css" />
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" type="text/css" href="css/stile.css">

</head>

<script type="text/javascript" src="jquery-1.3.2.js"> </script>
<script type="text/javascript">


$(document).ready(function() {

$("#display").click(function() {

  $.ajax({    //create an ajax request to display.php
    type: "GET",
    url: "cartempty.php?id=12",
    dataType: "html",   //expect html to be returned
    success: function(response){
        $("#responsecontainer").html(response);
        //alert(response);
    }

});
});
});
</script>

<body>
    <?php
include 'navbar.php';
include "../connect.php";
?>

    <?php

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

if (!empty($_GET)) {
    $id = $_GET['id'];
}

$con = new mysqli("127.0.0.1", $dbusername, $dbpass, $database);
$query = "SELECT * FROM cart WHERE  id_user='" . $id . "'";
$result = $con->query($query);

$total = 0;

if ($result = $con->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $q2 = "SELECT * FROM products WHERE id = '" . $row["id_product"] . "'";
        $res = $con->query($q2);
        $r = $res->fetch_assoc();

        echo '<td><a href="show_product.php?id=' . $r["id"] . '"><img src="images/' . $r["imageName"] . '" width="100" height="200""></a></td>';
        echo '  ';
        echo $r["prodname"] . '  ';

        echo 'Prezzo €' . $r["price"];
        $total += $r["price"] * $row["quantity"];

        echo '  Quantity:   ';
        echo $row["quantity"];
        echo '<br>';
    }

    $result->free();

}

echo "<br>TOTALE: " . $total;


echo '<form action = "./cartempty.php?id=' . $_SESSION["user"] . '" method = "POST">';
echo '<input type="submit" name="buy" value="BUY">';
?>



    </div>
    </div>
    </form>

    <?php
include "footer.php";
?>
</body>

</html>