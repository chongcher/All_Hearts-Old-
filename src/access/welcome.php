<?php
  include "../utility/header.php";
  function customError($errno,$errstr){
  echo("<p>Please log in first!</p>");
    header('Refresh: 2; URL=default.html');
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
  <div align="right" style="padding:5px">
    <iframe width=55% height=320px src="https://chatbox.com/#/p=v6sxBsewAb0SbhhB3MFjaBUrWTTTYBRA63ep0nA="></iframe>
  </div>
</div>

<div class="rightHalf">
  <div align="left" style="padding:5px" >
    <p><button onclick="location.href = '../activities/activities.php';">Activities</button></p>
    <p><button onclick="location.href = '../bids/bids.php';">Bids</button></p>
    <p><button onclick="location.href = '../logistics/logistics.php';">Logistics</button></p>
    <p><button onclick="location.href = '../manpower/manpower.php';">Manpower</button></p>
    <p><button onclick="location.href = '../payment/payment.php';">Payment</button></p>
    <p><button onclick="location.href = '../programmes/programmes.php';">Programmes</button></p>
    <p><button onclick="location.href = '../administration/administration.php';">User Administration</button></p>
  </div>
</div>
    
<?php
  include "../utility/footer.php";
?>
