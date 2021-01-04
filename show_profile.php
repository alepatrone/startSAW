<!DOCTYPE html>
<html>

<head>
    <title>FormCSS</title>
    <link rel="stylesheet" href="mystyle.css" />
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/stile.css">
</head>

<body>
<div class="menu">
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
$stmt = $con->prepare("SELECT * FROM users WHERE id=?");

if ($stmt !== false) {
    $stmt->bind_param('i', $id);
}
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();

if ($_SESSION["user"] !== $id) {
    echo '<div class="centertext">';
    echo "<br><h1>Impossibile modificare questi dati, non appartengono al tuo account</h1>";
    echo '<a href="index.php">Homepage</a>';
    echo "</div>";
} else {

    echo "<h1 style='text-align:center'>Ciao " . $row['firstname'] . " " . $row['lastname'] . "</h1>";
    echo '<div class="mainFrame">
        <div class="frame">';

    echo '<form action = "update_profile.php" method = "POST">';
    echo '<input type="hidden" id="id" name="id" value="' . $id . '">';
    echo '<input type="text" id="firstname" name="firstname" value="' . $row['firstname'] . '" required><br><br>';
    echo '<input type="text" id="lastname" name="lastname" value="' . $row['lastname'] . '" required><br><br>';
    echo '<input type="email" id="email" name="email" value="' . $row['email'] . '" onchange="checkemail(\'checkemail.php\')"" required><br><br>';
    echo '<div id="emailerror" class="error"></div><br>';
    echo '<input type="text" id="citta" name="citta" placeholder = "Città" value="' . $row['citta'] . '" ><br><br>';
    echo '<input type="text" id="bio" name="bio" placeholder = "Bio" value="' . $row['bio'] . '"><br><br>';
    
    echo '<input type="submit" value="Submit">';
}
?>

<script src="js/utility.js"></script>


<script
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>

<script>
function checkemail(url){
    let usermail = document.getElementById("email").value;
    document.getElementById("email").innerHTML = "You selected: " + usermail;
    $.post(url,
    {email:usermail},
    function(data, status){
        if(status=="success"){
            console.log(data);
            if(data=="ko"){
                $('#emailerror').html("Email already in use, try a different one");
            }
            else{
                $('#emailerror').html("");
            }
        }
        else{
                alert("Something went wrong");
        }
    });
}
</script>

    </div>
    </div>
    </form>

    <?php
include "footer.php";
?>
</body>

</html>