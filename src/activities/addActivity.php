<?php
  include "../utility/header.php";
  echo '<p><u>Add Activity</p></u></div>';
?>

<div>
  <?php
    if($_FILES["pdfFile"]["type"] == 'application/pdf'){
      $newPdf = $_FILES["pdfFile"];
    }
    if($_FILES["docxFile"]["type"] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
      $newDocx = $_FILES["docxFile"];
    }
    if(isset($newPdf) || isset($newDocx)){
      $newActivityName = ucwords(trim(($_POST["activityName"]))); //trims activityName, and then capitalizes all words
      $dir = '../../resource/activities';
      $newActivityDir = "../../resource/activities/".str_replace(" ","_",$newActivityName);
      $filenames = scandir($dir);
      foreach($filenames as $file){
        $filename = str_replace("_"," ",$file);
        if($filename != '.' && $filename != '..'){
          if($filename == $newActivityName){
            exit("Activity already exists!");
          }
        }
      }
      if(!mkdir($newActivityDir)){
        header('Refresh: 5; URL=activities.php');
        exit("Unable to create new Activity! Please try again!");
      }
      else{
        if(isset($newPdf)){
          $tmpName = $_FILES["pdfFile"]["tmp_name"];
          $uploadedPdf = move_uploaded_file($tmpName, "$newActivityDir/$newActivityName.pdf");
        }
        if(isset($newDocx)){
          $tmpName = $_FILES["docxFile"]["tmp_name"];
          $uploadedDocx = move_uploaded_file($tmpName, "$newActivityDir/$newActivityName.docx");
        }
        if(isset($uploadedPdf) || isset($uploadedDocx)){
          echo "Successfully added $newActivityName to the database!";
        }
        else{
          exit("Could not upload document. Please try again");
        }
      }
    }
    else{
      header('Refresh: 2; URL=activities.php');
      exit("Please upload at least 1 document!");
    }
    $conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_development");
    if(!$conn){
      exit('Could not connect to database: '.mysqli_connect_error($conn));
    }
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,'INSERT INTO ACTIVITY VALUES(?,?,?)');
    $emptyString = "";//TODO remove this shit yo
    mysqli_stmt_bind_param($stmt,'sss',$newActivityName,$_POST["manpowerRequired"],$emptyString);
    mysqli_stmt_execute($stmt);
    if(mysqli_stmt_affected_rows($stmt) != 1){
      echo "There was a problem adding the activity into the database!<br>".mysqli_stmt_error($stmt);
    }
    else{
      echo "<p><u>Please remember to update the items required for the activity!<u></p>";
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  ?>
</div>
<div>
  <form action="updateItemsForActivity.php" method="post">
    <input type="hidden" name="programmeName" value="<?php echo ucwords(trim(($_POST["activityName"])))?>" method="post">
    <table class="center">
      <tr>
        <td class="left_cell">Item Name</td>
        <td class="right_cell">Quantity</td>
      </tr>
      <?php
        $conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_development");
        if(!$conn){
          exit('Could not connect to database: '.mysqli_connect_error($conn));
        }
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,'SELECT Name FROM ITEM');
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$itemName);
        while(mysqli_stmt_fetch($stmt)){
          echo "<tr><td class=\"left_cell\">$itemName</td><td class=\"right_cell\"><input type=\"number\" name=\"$itemName\" value=0 ></input></td></tr>";
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
      ?>
    </table>
    <p><button class="submit">Submit</button></p>
  </form>
</div>
    
<?php
  include "../utility/footer.php";
?>