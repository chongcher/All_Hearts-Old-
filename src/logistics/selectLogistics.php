<?php
  include "../utility/header.php";
  echo '<p><u>Select Logistics</p></u></div>';
?>

<div>
  <?php
    if($_POST["logisticsName"] == "" && $_POST["logisticsType"] == ""){
      header('Refresh: 1; URL=default.html');
      exit("Information entered is incomplete. Please try again.");
    }
    else{
      $nextAction = $_POST["nextAction"];
      echo "<form action=$nextAction.php method=\"post\">";
      echo "<table><tr><td>Item Name</td><td><select name=\"itemName\">";
    }
    $query = "SELECT Name FROM ITEM";
    if($_POST["logisticsName"] != ""){
      $logisticsName = '%'.$_POST["logisticsName"].'%';
      $query = $query." WHERE Name LIKE \"$logisticsName\"";
    }
    else{
      $logisticsType = $_POST["logisticsType"];
      $query = $query." WHERE Type LIKE \"$logisticsType\"";
    }
    $conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_development");
    if(!$conn){
      exit('Could not connect to database: '.mysqli_connect_error($conn));
    }
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$query);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$itemName);
    while(mysqli_stmt_fetch($stmt)){
      echo "<option value=\"$itemName\">$itemName</option>";
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    echo "</select></td></tr>";
    if($nextAction == "deleteLogistics"){
      echo "<tr><td>Quantity to delete</td><td><input type=\"number\" name=\"deleteQuantity\" value=0></input></td></tr>";
    }
    echo "</table>";
    echo "<button class=\"submitButton\" type=\"submit\">Submit</button>";
    echo "</form>";
  ?>
</div>
    
<?php
  include "../utility/footer.php";
?>