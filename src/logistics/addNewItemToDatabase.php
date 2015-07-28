<?php
  include "../utility/header.php";
  echo '<p><u>Add New Item</p></u></div>';
?>

<div>
  <?php
    //get variables from previous form
    $counter = $_POST["finalCount"];
    while($counter > 0){
      //add new item to ITEM table
      $itemName = $_POST["itemName$counter"];
      $itemDescription = $_POST["itemDescription$counter"];
      $itemType = $_POST["itemType$counter"];
      $purchaseSource = $_POST["purchaseSource$counter"];
      $purchaseDate = $_POST["purchaseDate$counter"];
      $itemExpiryDate = $_POST["itemExpiryDate$counter"];
      $itemPrice = $_POST["itemPrice$counter"];
      $itemShelfNo = $_POST["itemShelfNo$counter"];
      $conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_development");
      if(!$conn){
        exit('Could not connect to database:'.mysqli_connect_error($conn));
      }
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,"INSERT INTO ITEM (Name,Description,Type) VALUES(\"$itemName\",\"$itemDescription\",\"$itemType\")");
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
      //add ($itemQuantity) of items to ITEM_DETAILS table
      $itemQuantity = $_POST["itemQuantity$counter"];
      while($itemQuantity > 0){
        $newID = uniqid("",true);
        $conn2 = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_development");
        if(!$conn2){
          exit('Could not connect to database:'.mysqli_connect_error($conn2));
        }
        $stmt2 = mysqli_stmt_init($conn2);
        mysqli_stmt_prepare($stmt2,"INSERT INTO ITEM_DETAILS (ID,ItemName,PurchaseSource,PurchaseDate,ExpiryDate,Price,ShelfNo) VALUES(\"$newID\",\"$itemName\",\"$purchaseSource\",\"$purchaseDate\",\"$itemExpiryDate\",\"$itemPrice\",\"$itemShelfNo\")");
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
        mysqli_close($conn2);
        $itemQuantity--;
      }
      $counter--;
    }
    echo "Successfully added items to database!";
  ?>
</div>
    
<?php
  include "../utility/footer.php";
?>