<!DOCTYPE html>
<meta charset="utf-8">
<?php
  //UTILITY FUNCTIONS
  function checkSessionValidity(){
    checkSessionStarted();
    checkSessionTimeout();
    checkUserPermissions();
  }
  function checkSessionStarted(){
    if(!isset($_SESSION['username'])){
      echo "Please login first!";
      logout();
    }
    else{
      $username = $_SESSION['username'];
      #check if username is in sql database
      $conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_users");
      if(!$conn){
        exit('Could not connect to database:'.mysqli_connect_error($conn));
      }
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,'SELECT COUNT(Username) FROM user_credentials WHERE Username LIKE ?');
      mysqli_stmt_bind_param($stmt,'s',$username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt,$count);
      mysqli_stmt_fetch($stmt);
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
      if($count != 1){
        echo "Username not found.";
        logout();
      }
    }
  }
  function checkSessionTimeout(){
    //Check for timeout: inactive 900 seconds
    $currentMicroTime = microtime(true);
    $sessionMicroTime = $_SESSION['session'];
    $username = $_SESSION['username'];
    if($currentMicroTime > ($sessionMicroTime + 900)){
      echo "</div><div><h3>Your session has timed out. Please log in again</h3></div>";
      logout();
    }
    else{
      $_SESSION['session'] = $currentMicroTime;
    }
  }
  function checkUserPermissions(){
    $currentWorkingDirectory = getcwd();
    $lastBackslash = strrpos($currentWorkingDirectory,"/");
    $currentFolder = substr($currentWorkingDirectory,$lastBackslash+1);
    
  }
  function logout(){
    session_unset();
    session_destroy();
    header('Refresh: 1; URL="../login/default.php"');
    exit();
  }
  //END UTILITY FUNCTIONS
  if(!isset($_SESSION))
  { 
    session_start();//http://stackoverflow.com/questions/871858/php-pass-variable-to-next-page
  }
?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href='../style.css'>
    <title>All Hearts</title>
    <link rel="icon" href="../../img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon"> 
  </head>
  <body>
    <img src='../../img/allheartsheader.jpg' alt="All Hearts Adventure and Training logo" height="70%">
    <div class="outer-container">
      <div class="inner-container">
        <div class="element">
          <div>
          <!--checkSessionValidity(); -->