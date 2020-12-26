function cartRedirect(id) {
  if (id == undefined) {
    location.href = "login.php";
  }
  else {
    location.href = "checkout.php?id=" + id;
  }
}

function cartEmpty(id) {
  var xhttp;
  if (id == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhr.open("GET", "cartempty.php?id=" + id, true);
  xhr.send();
}