<?php
  include "../utility/header.php";
  echo '<p><u>FUCTION_NAME</p></u></div>';
?>

<div>
  
</div>
    
<?php
  include "../utility/footer.php";
?>

<?php
$conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_development");
if(!$conn){
  exit('Could not connect to database: '.mysqli_connect_error($conn));
}
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt,'');
mysqli_stmt_bind_param($stmt,'s',);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt,,);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>