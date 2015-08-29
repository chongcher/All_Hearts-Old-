<?php
  include "../utility/header.php";
  echo '<p><u>Delete Activity</p></u></div>';
?>

<div>
  <?php
    $activity = $_POST["deleteActivityName"];
    $dir = '../../resource/activities/'.str_replace(" ","_",$activity);
    //deletes all files in $dir
    $objects = scandir($dir);
    foreach ($objects as $object) {
      if ($object != "." && $object != "..") {
        if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
      }
    }
    $successfulDeletion = rmdir($dir);
    if(!$successfulDeletion){
      echo "An error has occurred: The files in the directory could not be removed. Please try again";
    }
    else{
      $conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_development");
      if(!$conn){
        exit('Could not connect to database: '.mysqli_connect_error($conn));
      }
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,'DELETE FROM ACTIVITY,REQUIRES USING ACTIVITY INNER JOIN REQUIRES WHERE ACTIVITY.Name = ? AND ACTIVITY.Name = REQUIRES.Activity');
      echo mysqli_stmt_error($stmt);
      mysqli_stmt_bind_param($stmt,'s',$activity);
      mysqli_stmt_execute($stmt);
      $affectedRows = mysqli_stmt_affected_rows($stmt);
      if($affectedRows >= 1){
        echo "Successfully deleted $activity!";
      }
      else{
        echo "An error has occurred. No activity was deleted! Please try again";
      }
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
    }
  ?>
</div>
    
<?php
  include "../utility/footer.php";
?>