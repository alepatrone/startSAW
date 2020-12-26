<!DOCTYPE html>
<html lang="it">
<head>
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="css/stile.css">
    <link rel="stylesheet" href="css/all.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.0/css/font-awesome.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="js/utility.js"></script>
    <script src="js/script.js"></script>

    <style>
body {
    width: 550px;
    font-family: arial;
}

ul {
    margin: 0px;
    padding: 10px 0px 0px 0px;
}


.row-title {
    font-size: 20px;
    color: #00BCD4;
}

.review-note {
    font-size: 12px;
    color: #999;
    font-style: italic;
}
.row-item {
    margin-bottom: 20px;
    border-bottom: #F0F0F0 1px solid;
}
p.text-address {
    font-size: 12px;
}

input[type=text] {
  width: 130px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-repeat: no-repeat;
  padding: 5x 18px 40px;
  transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
  width: 100%;
}
</style>

</head>


<div class="menu">
  <?php
include 'navbar.php';
?>
</div>

<?php
include "../connect.php";
$con = new mysqli("127.0.0.1", $dbusername, $dbpass, $database);
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $con->connect_error;
    exit();
}

if (!empty($_GET)) {
    $id = $_GET['id'];
}

if (isset($_POST["addcart"])) {

    if (!isset($_SESSION["user"])) { //check isLogged
        header("Location: login.php");
        exit;
    }

    $query = "SELECT id_cart FROM cart WHERE id_user = '" . $_SESSION["user"] . "' AND id_product = '" . $id . "' ";

    if ($result = $con->query($query)) {
        $row = $result->fetch_assoc();
        if ($result->num_rows == 0) {
            $query = "INSERT INTO cart (id_user, id_product,quantity) values ( '" . $_SESSION["user"] . "',  $id, '1')";
            $con->query($query);
        } else {
            $q = "UPDATE cart SET quantity = quantity+1 WHERE id_user = '" . $_SESSION["user"] . "' AND id_product = '" . $id . "' ";
            $res = $con->query($q);
        }
    }
}

$query = "SELECT * FROM products where id='" . $id . "'";

if ($result = $con->query($query)) {
    while ($row = $result->fetch_assoc()) {

        echo '<tr>';
        echo '<td>' . $row["prodname"] . '</td>';
        echo "€";
        echo '<td>' . $row["price"] . '</td>';
        echo '<td><img src="images/' . $row["imageName"] . '" width="100" height="200""></a></td>';
        echo '</tr>';
        echo '<form action = "./show_product.php?id=' . $row["id"] . '" method = "POST">';
        echo '<input type="submit" name="addcart" value="Add To Cart">';
    }
    $result->free();
}

echo '<h2>Reviews</h2>';

$url = "'getRatingData.php?id=" . $id . "'";
$html = '<body onload="showReviewsData(' . $url . ')">';
echo $html;
echo "<h4> GLOBAL REVIEWS</h4>";
echo '
<div class="container">
<span id="products"></span>
</div>';

$unique = 100;

$query = "SELECT * FROM reviews where id_product=$id";
if ($result = $con->query($query)) {
    while ($row = $result->fetch_assoc()) {
        include 'getUserRatingData.php';
        $query2 = "SELECT * FROM users where id ='" . $row["id_user"] . "'";
        $res = $con->query($query2);
        $row2 = $res->fetch_assoc();
        echo '<td>' . $row2["firstname"] . '</td>';
        echo '  ';
        echo '<td>' . $row2["lastname"] . '</td>';
        echo '<br>';
        echo '<td>' . $row["review"] . '</td>';
    }
    $result->free();
}

$con->close();

$_POST['id'] = $id;

echo "<h3>Leave a Review</h3>";

echo '

<div class="form-group" id="review-form">
  <label id="rating" for="rating">RATING</label>
  <span class="star-rating star-5">
  <input type="radio" class = "rating" id="option5" name="star-radios" value="5">
  <label class="label_star" id="option5_label" for="option5"></label>
  <input type="radio"  class = "rating" id="option4" name="star-radios" value="4">
  <label class="label_star" id="option4_label" for="option4"></label>
  <input type="radio"  class = "rating" id="option3" name="star-radios" value="3">
  <label class="label_star" id="option3_label" for="option3"></label>
  <input type="radio"  class = "rating" id="option2" name="star-radios" value="2">
  <label class="label_star" id="option2_label" for="option2"></label>
  <input type="radio"  class = "rating" id="option1" name="star-radios" value="1">
  <label class="label_star" id="option1_label" for="option1"></label>
</span>
</div>
 <input type="text" id="review" name="review" placeholder="Leave a review..."><br><br>
  <input type="hidden" id="id" name="id" value="' . $id . '">
  <button  style="margin-top:0" type="submit" id="submit"  value="Leave a review">Leave a review</button>
  </form>

  <script type="text/javascript">

    $(document).ready(function(){
        $("#submit").click(function(){
    var stars = $(".rating:checked").val();
    var review = $("#review").val();
    var id = $("#id").val();
            if(review==""){
                alert("please Enter review");
            }
          else{
            $.ajax({
                type:"POST",
                url:"leaveReview.php",
                data:{
                stars:stars,
                review:review,
                id:id
                },
                 dataType: "text",
                crossDomain: true,
                cache:false,
                success:function(msg){
    if(1){
    alert("This review made our day! Thank you!");
    }else{
alert("message submission failed");
}
                }
            });
            }
        })
    });
   </script>
';

?>

<?php
include 'footer.php';
?>

</body>
</html>

<script type="text/javascript">
	function showReviewsData(url) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("products").innerHTML = this.responseText;
			}
		};
		xhttp.open("GET", url, true);
		xhttp.send();

	}//endFunction
</script>


