<!DOCTYPE html>
<html lang="it">
<head>
    <title>Form</title>
    <style>
    <?php
      // PARTE 2 DEL LABORATORIO
      // RIDEFINISCI LO STILE DEL TAG <body> USANDO 
      // I VALORI MEMORIZZATI NEL COOKIE
    ?>
    </style>
</head>
<ul>
<div>
    <form action="./setcookie.php" method="POST">

    <label for="color">Text color: </label>
    <input type="color" id="textcolor" name="textcolor" value="#22c3de"> 

    <label for="color">Background color: </label>
    <input type="color" id="bgcolor" name="bgcolor" value="#4f4f4f"> 

    <label for="fonts">Font: </label> 
    <select name="fonts" id="fonts">
          <option value = "">Select font family</option>
          <option value="Arial">Arial</option>
          <option value="'Comic Sans MS'">Comic Sans</option>
          <option value="sans-serif">Sans-serif</option>
          <option value="Courier">Courier</option>
          <br><br>
    <input type= "submit" value= "Submit">
    </div>
</form>

</select>

<body>
</body>

</html>