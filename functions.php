<?php

function productRating($userId, $productId, $conn)
{
    $sum = 0;
    $avgQuery = "SELECT rating FROM reviews WHERE id_product = '" . $productId . "'";
    $total_row = 0;
    
    if ($result = $conn->query($avgQuery)) {
        // Return the number of rows in result set
        $total_row = mysqli_num_rows($result);
    } // endIf
    
    
    if ($total_row > 0) {
        foreach ($result as $row) {
           
            $sum += round($row["rating"]);
        } // endForeach
    } // endIf

    return $sum;
}
 // endFunction
function totalRating($productId, $conn)
{
    $totalVotesQuery = "SELECT COUNT(*) AS righe FROM reviews WHERE id_product = '" . $productId . "'";
    
    if ($result = $conn->query($totalVotesQuery)) {
        // Return the number of rows in result set
        $row = $result->fetch_assoc();
        // Free result set
        mysqli_free_result($result);
    } // endIf

    return $row["righe"];;
}//endFunction

function userRating($id, $conn)
{
    $avgQuery = "SELECT rating FROM reviews WHERE id = '" . $id . "'";
    
    if ($result2 = $conn->query($avgQuery)) {
      $row2 = $result2->fetch_assoc();
      return $row2["rating"];
    } // endIf
    
    return 0;
}
