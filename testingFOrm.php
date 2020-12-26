
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="css/all.css">
<link rel="stylesheet" type="text/css" href="css/stile.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.0/css/font-awesome.css" rel="stylesheet" />
<body>


<div class="form-group" id="review-form">
    <label id="rating" for="rating">RATING</label>
    <span class="star-rating star-5">
    <input type="radio" class = "rating" id="option5" name="star-radios" value="5" >
    <input type="radio" class = "rating" id="option5" name="star-radios" value="5">
    <label class="label_star" id="option5_label" for="option5"></label>
    <input type="radio"  class = "rating" id="option4" name="star-radios" value="4">
    <label class="label_star" id="option4_label" for="option4"></label>
    <input type="radio"  class = "rating" id="option3" name="star-radios" value="3" >
    <label class="label_star" id="option3_label" for="option3"></label>
    <input type="radio"  class = "rating" id="option2" name="star-radios" value="2">
    <label class="label_star" id="option2_label" for="option2"></label>
    <input type="radio"  class = "rating" id="option1" name="star-radios" value="1">
    <label class="label_star" id="option1_label" for="option1"></label>
  </span>
  </div>

<script>
$(":radio:not(:checked)").attr("disabled", true);

</script>
</body>
</html>