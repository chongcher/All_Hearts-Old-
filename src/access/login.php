<?php
  session_start();
  require 'password.php';
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
      <p><u>Administrative Login</u></p>
    </div>
    <div>
      <?php
        $conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_users");
        if(!$conn){
          echo mysqli_connect_errno()."<br>";
          exit('Could not connect to database: '.mysqli_connect_error($conn));
        }
        $username = $_POST['username'];
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,'SELECT PasswordHash,Salt from user_credentials WHERE Username = ?');
        mysqli_stmt_bind_param($stmt,'s',$username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$hash,$salt);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        $clientHashedPassword = $_POST['password'];
        #$hashedPassword = hash_pbkdf2("sha512",$clientHashedPassword,$salt,1000); #Bluehost server does not support hash_pbkdf2 (PHP >= 5.5 required)
        $saltedPassword = $clientHashedPassword.$salt; #changed all $hashedPassword in the following lines to saltedPassword
        if(password_verify($saltedPassword, $hash)){
          $_SESSION['session'] = microtime(true);
          $_SESSION['username'] = $username;
          header("Location: welcome.php");
        }
        else{
          // remove all session variables
          session_unset();
          // destroy the session
          session_destroy();
          echo "Invalid NRIC or password! Please try again";
          header('Refresh: 1; URL=default.php');
        }
        ?>
    </div>
  </body>
</html>

<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha3.js"></script>