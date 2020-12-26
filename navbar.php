<script type="text/javascript" src = "js/script.js"></script>
<script type="text/javascript" src="jquery-1.3.2.js"> </script>

<link rel="stylesheet" href="css/all.css">




<?php

session_start();

echo '

<nav>


  <ul id="menu">
  <li style="float:left"><a class = "active" href="index.php">Ecommerce Website</a></li>';

if (!isset($_SESSION["user"])) {
    echo '<li><a onclick="cartRedirect()"><i class="fas fa-shopping-cart"></i></a> </li>'; //shopping cart icon
    echo '<li><a href="login.php">Login</a> </li>';
    echo '<li><a href="registration.php">Register</a></li>';
} else {
    $id = $_SESSION["user"];
    echo '<li><a onclick="cartRedirect(' . $id . ')"><i class="fas fa-shopping-cart"></i></a> </li>';
    echo '<li><a href="show_profile.php?id='.$id.'">Pagina Riservata</a> </li>';
    echo '<li><a href="logout.php">Logout</a></li>';

}

echo "</ul>";

echo "</nav>";
//<li><a href="checkout.php" id="shoppingCart"><i class="fas fa-shopping-cart"></i></a> </li>'; //shopping cart icon
//<li><a onclick="cartRedirect()"><i class="fas fa-shopping-cart"></i></a> </li>'; //shopping cart icon
