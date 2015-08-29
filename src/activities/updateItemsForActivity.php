<?php
  include "../utility/header.php";
  echo "<p><u>Update Activity Items</p></u></div>";
?>

<div>
  <?php
    $itemsToAdd = array_keys($_POST);
    $programmeName = $_POST["programmeName"];
    $query = "INSERT INTO REQUIRES VALUES ";
    $queryStarted = false;
    foreach($itemsToAdd as $i){
      if($i != "programmeName" && $_POST[$i] != 0){
        $formattedName = str_replace("_"," ",$i);
        if(!$queryStarted){
          $query = $query."(\"$programmeName\",\"$formattedName\",$_POST[$i])";
          $queryStarted = true;
        }
        else{
          $query = $query.",(\"$programmeName\",\"$formattedName\",$_POST[$i])";
        }
      }
    }
    if($queryStarted){
      $conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_development");
      if(!$conn){
        exit('Could not connect to database: '.mysqli_connect_error($conn));
      }
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$query);
      if(mysqli_stmt_execute($stmt)){
        echo "Successfully added all items!";
      }
      else{
        echo "An error has occurred! Please try again</br>";
        echo mysqli_stmt_error($stmt);
      }
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
    }
  ?>
</div>
    
<?php
  include "../utility/footer.php";
?>