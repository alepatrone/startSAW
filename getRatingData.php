<?php




include "../connect.php";
require_once "functions.php";
// Here the user id is harcoded.
// You can integrate your authentication code here to get the logged in user id

$userId = 0;
$conn = new mysqli("127.0.0.1", $dbusername, $dbpass, $database);

if (!empty($_GET)) {
    $id = $_GET['id'];
}

//$id=1;

$average=0;
$query = "SELECT * FROM reviews WHERE id_product = '" . $id . "' ";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$outputString = '';
//foreach ($result as $row) {
$userRating = productRating($userId, $id, $conn);
$totalRows = totalRating($id, $conn);


if($totalRows>0){
    $average = $userRating / $totalRows;
}


$average = round($average);

if($result->num_rows==0){

    $outputString .= 
    '<div class="form-group" id="review-form">
    <span class="star-rating star-5">
    <input type="radio" class = "rating_show" id="option5_show" name="star-radios_show" value="5" disabled>
    <label class="label_star" id="option5_label_show" for="option5_show"></label>
    <input type="radio"  class = "rating_show" id="option4_show" name="star-radios_show" value="4" disabled>
    <label class="label_star" id="option4_label_show" for="option4_show"></label>
    <input type="radio"  class = "rating_show" id="option3_show" name="star-radios_show" value="3" disabled >
    <label class="label_star" id="option3_label" for="option3_show"></label>
    <input type="radio"  class = "rating_show" id="option2_show" name="star-radios_show" value="2" disabled>
    <label class="label_star" id="option2_label_show" for="option2_show"></label>
    <input type="radio"  class = "rating_show" id="option1_show" name="star-radios_show" value="1" disabled>
    <label class="label_star" id="option1_label_show" for="option1_show"></label>
  </span>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
  $(":radio:not(:checked)").attr("disabled", true);
  </script>
  ';

}


else{
    $outputString .= ' 
    <div class="form-group" id="review-form">
    <span class="star-rating star-5">
    ';
    for ($count = 5; $count >= 1; $count--) {
        if($count == $average){
        $outputString .= '
        <input type="radio" class = "rating_show" id="option'.$count.'_show" name="star-radios_show" value="'.$count.'" checked >
        <label class="label_star" id="option'.$count.'_label_show" for="option'.$count.'_show" disabled></label>
        ';
        }
        else{
            $outputString .= '
     
            <input type="radio" class = "rating_show" id="option'.$count.'_show" name="star-radios_show" value="'.$count.'"disabled>
            <label class="label_star" id="option'.$count.'_label_show" for="option'.$count.'_show" disabled></label>
            ';
        }
    }
    $outputString .= '
    </span>
    </div>';

$outputString .= ' </ul> <h5>Total Reviews: ' . $totalRows . '</h5> </div> ';
}
echo $outputString;
