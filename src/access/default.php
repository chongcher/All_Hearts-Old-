<?php
  include "../utility/header.php";
  echo '<p><u>Welcome!</p></u></div>';
?>

<div>
  <form method='post' id="login" action="login.php">
  <table class="center">
    <tr>
      <td class="left_cell">NRIC</td>
      <td class="right_cell"><input type="text" id="username" name="username"></td>
    </tr>
    <tr>
      <td class="left_cell">Password</td>
      <td class="right_cell"><input type="password" id = "password" name="password"></td>
    </tr>
  </table>
  <p><button onclick="getUsernameAndPassword()">Login</button></p>
  </form>
</div>

<?php
  include "../utility/footer.php";
?>

<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha3.js"></script>
<script>
function getUsernameAndPassword() {
  var credentials = document.getElementById("login");
  var username = credentials.elements[0].value;
  var password = credentials.elements[1].value;
  if(username == ""){
    window.alert("Username cannot be empty!");
  }
  else if(password == ""){
    window.alert("Password cannot be empty!");
  }
  else{
    var hashedPassword = CryptoJS.SHA3(username.concat(password), { outputLength: 512 });
    document.getElementById("username").value = username;
    document.getElementById("password").value = hashedPassword;
    document.forms["login"].submit();
  }
}
</script>