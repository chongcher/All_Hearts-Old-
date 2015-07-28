<?php
  include "../utility/header.php";
  echo '<p><u>Add Logistics</u></p></div>';
?>

<div>
  <?php
    if(!isset($_POST["purchaseSource"]) || !isset($_POST["purchaseDate"])){
      header( "refresh:2; url=logistics.php" );
      exit("Purchase Date or Purchase Source cannot be empty! Please try again!");
    }
    else{
      $purchaseSource = $_POST["purchaseSource"];
      $purchaseDate = $_POST["purchaseDate"];
    }
    // Gets item names from database, to check that items already exist
    $databaseItemNames = array();
    $conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_development");
    if(!$conn){
      exit('Could not connect to database:'.mysqli_connect_error($conn));
    }
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,'SELECT t1.Name, t2.Count, t3.MaxID FROM (SELECT Name FROM ITEM) AS t1 LEFT OUTER JOIN (SELECT ItemName,COUNT(ItemName) AS Count FROM ITEM_DETAILS GROUP BY ItemName) AS t2 ON t1.Name = t2.ItemName LEFT OUTER JOIN (SELECT MAX(ID) AS MaxID FROM ITEM_DETAILS) as t3 ON TRUE');
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$databaseItemName,$databaseItemCount,$maxID);
    while(mysqli_stmt_fetch($stmt)){
      array_push($databaseItemNames,$databaseItemName);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    // If items exist, update quantity. Else, add to $notInDatabase for further processing
    $notInDatabase = array("itemName" => array());
    $counter = 0;
    while($counter++ <= 10 && isset($_POST["itemName$counter"]) && $_POST["itemName$counter"] != ""){
      $itemName = $_POST["itemName$counter"];
      $itemQuantity = $_POST["itemQuantity$counter"];
      $itemPrice = $_POST["itemPrice$counter"];
      $itemExpiryDate = $_POST["itemExpiryDate$counter"];
      $itemShelfNo = $_POST["itemShelfNo$counter"];
      if(!in_array($itemName,$databaseItemNames)){
        array_push($notInDatabase["itemName"],$itemName);
        $notInDatabase["$itemName"."quantity"] = $itemQuantity;
        $notInDatabase["$itemName"."price"] = $itemPrice;
        $notInDatabase["$itemName"."expiryDate"] = $itemExpiryDate;
        $notInDatabase["$itemName"."shelfNo"] = $itemShelfNo;
      }
      else{
        do{
          $conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_development");
          if(!$conn){
            exit('Could not connect to database:'.mysqli_connect_error($conn));
          }
          $stmt = mysqli_stmt_init($conn);
          $newID = uniqid("",true);
          mysqli_stmt_prepare($stmt,"INSERT INTO ITEM_DETAILS (ID,ItemName,PurchaseSource,PurchaseDate,ExpiryDate,Price,ShelfNo) VALUES(\"$newID\",\"$itemName\",\"$purchaseSource\",\"$purchaseDate\",\"$itemExpiryDate\",\"$itemPrice\",\"$itemShelfNo\")");
          mysqli_stmt_execute($stmt);
          echo mysqli_error($conn);
          while(mysqli_stmt_fetch($stmt)){
            array_push($databaseItemNames,$databaseItemName);
          }
          mysqli_stmt_close($stmt);
          mysqli_close($conn);
        } while(--$itemQuantity > 0);
      }
    }
    // If no further items to be processed, display completion message
    // Else, display form to fill up description and classification
    if(count($notInDatabase["itemName"]) == 0){
      echo "<div>Added all items to database!</div>";
    }
    else{
      echo "<div>";
      echo "  <form action=\"addNewItemToDatabase.php\"; id=\"addNewItemToDatabaseForm\" name=\"addNewItemToDatabaseForm\" method=\"post\">";
      echo "    <table class=\"center\">";
      echo "      <tr>";
      echo "        <td>Item Name</td>";
      echo "        <td>Item Description</td>";
      echo "        <td>Item Type</td>";
      echo "      </tr>";
      $counter = 0;
      foreach($notInDatabase["itemName"] as $name){
        // Print form to fill in description, classification
        $counter++;
        echo "    <tr>";
        echo "      <td class=\"center_cell\"><input type=\"text\" name=\"itemName".$counter."\" id=\"itemName".$counter."\" value=\"$name\"></td>";
        echo "      <td class=\"center_cell\"><textarea rows=10 cols=15 name=\"itemDescription".$counter."\" id=\"itemDescription".$counter."\"></textarea></td>";
        echo "      <td class=\"center_cell\"><select id=\"itemType".$counter."\" name=\"itemType".$counter."\"><option value=\"expendable\">Expendable</option><option value=\"nonExpendable\">Non-Expendable</option><option value=\"perishable\">Perishable</option></select></td>";
        echo "      <td class=\"center_cell\"><input type=\"text\" name=\"purchaseSource".$counter."\" id=\"purchaseSource".$counter."\" value=\"$purchaseSource\" style=\"display:none\"></td>";
        echo "      <td class=\"center_cell\"><input type=\"date\" name=\"purchaseDate".$counter."\" id=\"purchaseDate".$counter."\" value=\"$purchaseDate\" style=\"display:none\"></td>";
        echo "      <td class=\"center_cell\"><input type=\"text\" name=\"itemQuantity".$counter."\" id=\"itemQuantity".$counter."\" value=\"".$notInDatabase[$name."quantity"]."\" style=\"display:none\"></td>";
        echo "      <td class=\"center_cell\"><input type=\"date\" name=\"itemExpiryDate".$counter."\" id=\"itemExpiryDate".$counter."\" value=\"".$notInDatabase[$name."expiryDate"]."\" style=\"display:none\"></td>";
        echo "      <td class=\"center_cell\"><input type=\"number\" name=\"itemPrice".$counter."\" id=\"itemPrice".$counter."\" value=\"".$notInDatabase[$name."price"]."\" style=\"display:none\"></td>";
        echo "      <td class=\"center_cell\"><input type=\"text\" name=\"itemShelfNo".$counter."\" id=\"itemShelfNo".$counter."\" value=\"".$notInDatabase[$name."shelfNo"]."\" style=\"display:none\"></td>";
        echo "    </tr>";
      }
      echo "    </table>";
      echo "    <input type=\"text\" name=\"finalCount\" id=\"finalCount\" value=\"$counter\" style=\"display:none\">";
      echo "    <button class=\"submitButton\" name=\"submitAddNewitemToDatabaseForm\">Submit</button>";
      echo "  </form>";
      echo "</div>";
    }
  ?>
</div>
    
<?php
  include "../utility/footer.php";
?>