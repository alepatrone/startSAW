<script type="text/javascript" src = "js/script.js"></script>

<link rel="stylesheet" href="css/all.css">
<link rel="stylesheet" type="text/css" href="css/stile.css">



<?php

session_start();
echo '


<nav>

<div class="topnav">

<a class="active" href="index.php">Ecommerce Website</a>';
if (!isset($_SESSION["user"])) {
  echo '<div class="search-container">';
  echo '<a href="registration.php">Register</a>';
  echo '<a href="login.php">Login</a> ';
    echo '<a onclick="cartRedirect()"><i class="fas fa-shopping-cart"></i></a>'; //shopping cart icon
    echo '</div>';
} else {
    $id = $_SESSION["user"];
    echo '<div class="search-container">';
    echo '<a href="show_profile.php?id='.$id.'">Pagina Riservata</a>';
    echo '<a href="logout.php">Logout</a>';
    echo '<a onclick="cartRedirect(' . $id . ')"><i class="fas fa-shopping-cart"></i></a> 
    </div>';
}
echo '<div class="search-container">

<form name = "form_search" action = "search.php" method = "POST"><input type = "text" placeholder = "Search" name = "search"> <button type = "submit" name = "subsearch"><i class="fas fa-search"></i></button></form>';

echo '</div>';
echo '</div>';
echo "</ul>";
echo "</div>";
echo "</nav>";
echo '</div>
<div class="content">';


//<li><a href="checkout.php" id="shoppingCart"><i class="fas fa-shopping-cart"></i></a> </li>'; //shopping cart icon
//<li><a onclick="cartRedirect()"><i class="fas fa-shopping-cart"></i></a> </li>'; //shopping cart icon
