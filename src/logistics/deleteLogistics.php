<?php
  include "../utility/header.php";
  echo '<p><u>Delete Logistics</p></u></div>';
?>

<div>
  <?php
  $itemName = $_POST["itemName"];
  $deleteQuantity = $_POST["deleteQuantity"];
  if($itemName == "" || $deleteQuantity == 0){
    exit("Information entered is incomplete. Please try again.");
  }
  $itemIDs = array();
  $itemInfo = array();
  $deletedIDs = array();
  $counter = 0;
  $conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_development");
  if(!$conn){
    exit('Could not connect to database: '.mysqli_connect_error($conn));
  }
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt,'SELECT ID,ShelfNo,ExpiryDate FROM ITEM_DETAILS WHERE ItemName = ? ORDER BY ExpiryDate,ID ASC');
  mysqli_stmt_bind_param($stmt,'s',$itemName);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt,$itemID,$itemShelfNo,$itemExpiryDate);
  while(mysqli_stmt_fetch($stmt)){
    $itemIDs[] = $itemID;
    $itemInfo["$itemID"] = array($itemShelfNo,$itemExpiryDate);
  }
  mysqli_stmt_close($stmt);
  if($deleteQuantity > count($itemIDs)){
    exit("Quantity entered is greater than remaining stores. Please try again.");
  }
  $query = "(";
  while($deleteQuantity > $counter){
    if($counter != 0){
      $query = $query.",\"$itemIDs[$counter]\"";
    }
    else{
      $query = $query."\"$itemIDs[$counter]\"";
    }
    $deletedIDs[] = $itemIDs[$counter];
    $counter++;
  }
  $query = "DELETE FROM ITEM_DETAILS WHERE ID IN ".$query.")";
  $stmt2 = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt2,$query);
  mysqli_stmt_execute($stmt2);
  if(mysqli_stmt_affected_rows($stmt2) > 0){
    //print deleted info
    echo "<table>";
    echo "<tr><td>Item ID</td><td>Item Shelf No</td><td>Item Expiry Date</td></tr>";
    while(count($deletedIDs) > 0){
      $deletedID = array_pop ($deletedIDs);
      $deletedShelfNo = $itemInfo[$deletedID][0];
      $deletedExpiry = $itemInfo[$deletedID][1];
      echo "<tr><td>$deletedID</td><td>$deletedShelfNo</td><td>$deletedExpiry</td></tr>";
    }
    echo "</table>";
  }
  else{
    echo "Could not delete items! Please try again!<br>";
    echo mysqli_stmt_error($stmt2);
  }
  mysqli_stmt_close($stmt2);
  mysqli_close($conn);
  ?>
</div>
    
<?php
  include "../utility/footer.php";
?>