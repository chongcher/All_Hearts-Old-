<?php
  include "../utility/header.php";
  echo '<p><u>Select Bids</p></u></div>';
?>

<div>
  <form action="viewBids.php" method="post">
    <table>
      <tr>
        <td>
          <?php
            $programmeName = "%".$_POST["programmeName"]."%";
            $query = "SELECT Name FROM PROGRAMME WHERE Name LIKE ?";
            $conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_development");
            if(!$conn){
              exit('Could not connect to database: '.mysqli_connect_error($conn));
            }
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$query);
            mysqli_stmt_bind_param($stmt,'s',$programmeName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt,$programmeName);
            while(mysqli_stmt_fetch($stmt)){
              echo "<input type=\"radio\" name=\"programmeName\" value=\"$programmeName\">$programmeName</input><br>";
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
          ?>
        </td>
      </tr>
      <tr>
        <td colspan=2><button class=\"submitButton\" type=\"submit\">Submit</button></td>
      </tr>
    </table>
  </form>
</div>
    
<?php
  include "../utility/footer.php";
?>