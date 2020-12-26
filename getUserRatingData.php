<?php

require_once "functions.php";

$userId = 0;

$id_review = $row["id"];


$outputString = '';


$userRating = userRating($id_review, $con);


$outputString .= ' 
    <div class="form-group" id="review-form">
    <span class="star-rating star-5">
    ';
    for ($count = 5; $count >= 1; $count--) {
        if($count == $userRating){
        $outputString .= '
        <input type="radio" class = "rating_show'.$count.'" id="option'.$count.'_user_show'.$count.'" name="star-radios_user_show'.$unique.'" value="'.$count.'" checked >
        <label class="label_star" id="option'.$count.'_user_label_show'.$count.'" for="option'.$count.'_user_show'.$unique.'"disabled></label>
        ';
        }
        else{
            $outputString .= '
     
            <input type="radio" class = "rating_show'.$count.'" id="option'.$count.'_user_show'.$count.'" name="star-radios_user_show'.$unique.'" value="'.$count.'"disabled>
            <label class="label_star" id="option'.$count.'_user_label_show'.$count.'" for="option'.$count.'_user_show'.$unique.'"disabled></label>
            ';
        }
        $unique +=1;
    }
    $outputString .= '
    </span>
    </div> ';

//$outputString .= ' </ul> <p class="review-note"> Review '.$id_review.'</p> </div> ';


echo $outputString;

?>