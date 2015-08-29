<?php
  include "../utility/header.php";
  echo '<p><u>View Bids</u></p></div>';
?>
<div>
  <table class="bordered">
    <tr class="bordered">
    </tr>
    <?php
      if(isset($_POST["programmeType"])){
        $type = $_POST["programmeType"];
        $query = "SELECT b.ProgrammeName, b.Company, b.Amount FROM BID as b, PROGRAMME as p WHERE b.ProgrammeName = p.Name AND p.Type = \"$type\"";
      }
      else if(isset($_POST["programmeName"])){
        $name = $_POST["programmeName"];
        $query = "SELECT * FROM BID WHERE ProgrammeName = \"$name\"";
      }
      else{
        print_r($_POST);
        exit("An error has occured. Whutttttt");
      }
      $conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_development");
      if(!$conn){
        exit('Could not connect to database: '.mysqli_connect_error($conn));
      }
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$query);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt,$progName,$company,$amount);
      $previousProg = "";
      while(mysqli_stmt_fetch($stmt)){
        if($previousProg != $progName){
          echo "<tr class=\"bordered\"><td class=\"bordered\" colspan=\"2\">$progName</td></tr>";
          echo "<tr class=\"bordered\"><td class=\"bordered\"><u>Company</u></td><td class=\"bordered\"><u>Amount</u></td></tr>";
        }
        echo "<tr class=\"bordered\"><td class=\"bordered\">$company</td><td class=\"bordered\">$amount</td></tr>";
        $previousProg = $progName;
      }
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
    ?>
  </table>
</div>
    
<?php
  include "../utility/footer.php";
?>