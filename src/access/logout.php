<?php
  session_start();
?>
<!DOCTYPE html>
<meta charset="utf-8">

<html>
  <head>
    <link rel="stylesheet" type="text/css" href='../default.css'>
    <title>All Hearts Adventure and Training</title>
    <link rel="icon" href="../../img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon"> 
  </head>

  <body>
    <div>
      <img src='../../img/allheartsheader.jpg' alt="All Hearts Adventure and Training logo">
      <p><u>Logging out!</u></p>
    </div>
    <div>
      <?php
        session_unset();
        session_destroy();
        header('Refresh: 1; URL=default.php');
      ?>
    </div>
  </body>
</html>