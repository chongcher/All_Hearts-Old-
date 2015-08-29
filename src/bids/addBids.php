<?php
  include "../utility/header.php";
  echo '<p><u>Add Bids</u></p></div>';
?>
<div>
  <table class="bordered">
    <tr class="bordered">
    </tr>
    <?php
      $query = "INSERT INTO BID VALUES ";
      $queryStarted = false;
      $progName = $_POST["programmeName"];
      $counter = 0;
      foreach($_POST["companyName"] as $companyName){
        if(isset($companyName) && $companyName != ''){
          $bidAmount = $_POST["bidAmount"][$counter];
          if($queryStarted){
            $query = $query.",(\"$progName\",\"$companyName\",\"$bidAmount\")";
          }
          else{
            $query = $query."(\"$progName\",\"$companyName\",\"$bidAmount\")";
            $queryStarted = true;
          }
        }
        $counter++; //syncs $companyName[] and $bidAmount[]
      }
      if($queryStarted){
        $conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_development");
        if(!$conn){
          exit('Could not connect to database: '.mysqli_connect_error($conn));
        }
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$query);
        mysqli_stmt_execute($stmt);
        if(mysqli_stmt_affected_rows($stmt) == 0){
          echo "An error has occured! Please try again!<br>";
          echo mysqli_stmt_error($stmt);
        }
        else{
          echo "Successfully added bids into database!";
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
      }
    ?>
  </table>
</div>
    
<?php
  include "../utility/footer.php";
?>