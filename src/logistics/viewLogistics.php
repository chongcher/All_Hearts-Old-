<?php
  include "../utility/header.php";
  echo '<p><u>View Logistics</u></p></div>';
?>
<div>
  <table class="bordered">
    <tr class="bordered">
      <td class="bordered">Name</td>
      <td class="bordered">Description</td>
      <td class="bordered">Type</td>
      <td class="bordered">Expiry Date</td>
      <td class="bordered">Shelf No</td>
      <td class="bordered">Quantity</td>
    </tr>
    <?php
      $query = "SELECT t1.Name,t1.Description,t1.Type,t2.Quantity,t2.shelfNo,t2.expiryDate FROM (SELECT * FROM ITEM) as t1, (SELECT itemName,shelfNo,expiryDate,COUNT(ItemName) as Quantity FROM ITEM_DETAILS GROUP BY ItemName,shelfNo) as t2 WHERE t1.Name = t2.ItemName ";
      if($_POST["nextAction"] != "viewAllLogistics"){
        $itemName = $_POST["itemName"];
        $query = $query." AND t1.Name = \"$itemName\" ORDER BY t1.type";
      }
      else{
        $query = $query." ORDER BY t1.type";
      }
      $conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_development");
      if(!$conn){
        exit('Could not connect to database: '.mysqli_connect_error($conn));
      }
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$query);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt,$itemName,$itemDescription,$itemType,$itemQuantity,$itemExpiry,$itemShelfNo);
      while(mysqli_stmt_fetch($stmt)){
        echo "<tr class=\"bordered\"><td class=\"bordered\">$itemName</td><td class=\"bordered\">$itemDescription</td><td class=\"bordered\">$itemType</td><td class=\"bordered\">$itemExpiry</td><td class=\"bordered\">$itemShelfNo</td><td class=\"bordered\">$itemQuantity</td></tr>";
      }
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
    ?>
  </table>
</div>
    
<?php
  include "../utility/footer.php";
?>