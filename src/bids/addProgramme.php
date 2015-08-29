<?php
  include "../utility/header.php";
  echo '<p><u>Add Bids</u></p></div>';
?>
<div>
  <table class="bordered">
    <tr class="bordered">
    </tr>
    <?php
      $programmeName = (isset($_POST["programmeName"]) ? $_POST["programmeName"] : null);
      $programmeType = (isset($_POST["programmeType"]) ? $_POST["programmeType"] : null);
      $bidDeadline = (isset($_POST["bidDeadline"]) ? $_POST["bidDeadline"] : null);
      $programmeStartDate = (isset($_POST["programmeStartDate"]) ? $_POST["programmeStartDate"] : null);
      $programmeEndDate = (isset($_POST["programmeEndDate"]) ? $_POST["programmeEndDate"] : null);
      $conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_development");
      if(!$conn){
        exit('Could not connect to database: '.mysqli_connect_error($conn));
      }
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,'INSERT INTO PROGRAMME VALUES(?,?,?,?,?,NULL,NULL)');
      mysqli_stmt_bind_param($stmt,'sssss',$programmeName,$programmeType,$bidDeadline,$programmeStartDate,$programmeEndDate);
      mysqli_stmt_execute($stmt);
      if(mysqli_stmt_affected_rows($stmt) == 1){
          echo "Successfully added $programmeName!";
      }
      else{
        echo "<br>Error! Please check your data and try again!";
      }
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
    ?>
  </table>
</div>
    
<?php
  include "../utility/footer.php";
?>