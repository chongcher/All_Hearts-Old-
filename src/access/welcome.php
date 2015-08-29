<?php
  include "../utility/header.php";
  function customError($errno,$errstr){
  echo("<p>Please log in first!</p>");
    header('Refresh: 2; URL=default.php');
    exit();
  }
  set_error_handler("customError");
  //check session variables
  $session = $_SESSION['session'];
  $username = $_SESSION['username'];
  //restore error handler
  restore_error_handler();
  echo "<u>Welcome $username!</u></div>";
  checkSessionValidity();
?>

<div class="leftHalf">
  <div align="right" style="padding:15px">
    <iframe width=75% height=340px src="https://chatbox.com/#/p=v6sxBsewAb0SbhhB3MFjaBUrWTTTYBRA63ep0nA="></iframe>
  </div>
</div>

<div class="rightHalf">
  <div align="left" style="padding:15px" >
      <p><button onclick="location.href = '../activities/activities.php';" style="width:200px">Activities</button></p>
      <p><button onclick="location.href = '../bids/bids.php';" style="width:200px">Bids</button></p>
      <p><button onclick="location.href = '../logistics/logistics.php';" style="width:200px"><strike>Logistics</strike></button></p>
      <p><button onclick="location.href = '../manpower/manpower.php';" style="width:200px"><strike>Manpower</strike></button></p>
      <p><button onclick="location.href = '../payment/payment.php';" style="width:200px"><strike>Payment</strike></button></p>
      <p><button onclick="location.href = '../programmes/programmes.php';" style="width:200px"><strike>Programmes</strike></button></p>
      <p><button onclick="location.href = '../administration/administration.php';" style="width:200px"><strike>User Administration</strike></button></p>
  </div>
</div>

<?php
  include "../utility/footer.php";
?>
