<?php
  include "../utility/header.php";
  echo '<p><u>Bids</p></u></div>';
?>

<div>
  <p><button id="selectBidsByNameButton" onclick="showSelectBidsByNameForm()" style="display:inline">Select Bids by Name</button></p>
  <p><button id="selectBidsByTypeButton" onclick="showSelectBidsByTypeForm()" style="display:inline">Select Bids by Type</button></p>
  <p><button id="addNewProgrammeButton" onclick="showAddNewProgrammeForm()" style="display:inline">Add New Programme</button></p>
  <p><button id="addBidsButton" onclick="showAddBidsForm()" style="display:inline">Add Bids</button></p>
</div>
<div>
  <form action="selectBids.php" method="post" id="selectBidsByNameForm" style="display:none">
    <table>
      <tr>
        <td>Programme Name</td>
        <td><input type="text" name="programmeName"></input></td>
      </tr>
    </table>
    <button class="submitButton" type="submit">Submit</button>
  </form>
</div>
<div>
  <form action="viewBids.php" method="post" id="selectBidsByTypeForm" style="display:none">
    <table>
      <tr>
        <td>Programme Type</td>
        <td>
          <select name="programmeType">
          <option value="" SELECTED>--Type--</option>
          <?php
            $conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_development");
            if(!$conn){
              exit('Could not connect to database: '.mysqli_connect_error($conn));
            }
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,'SELECT TYPE FROM PROGRAMME GROUP BY TYPE');
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt,$type);
            while(mysqli_stmt_fetch($stmt)){
              echo "<option value=\"$type\">$type</option>";
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
          ?>
          </select>
        </td>
      </tr>
    </table>
    <button class="submitButton" type="submit">Submit</button>
  </form>
</div>
<div>
  <form action="addProgramme.php" method="post" id="addNewProgrammeForm" style="display:none">
    <table>
      <tr>
        <td class="left_cell">Programme Name:</td>
        <td class="right_cell"><input type="text" name="programmeName"></input></td>
      </tr>
      <tr>
        <td class="left_cell">Programme Type:</td>
        <td class="right_cell">
          <select name="programmeType" id="programmeType">
                <option value="" SELECTED>--Select Programme Type--</option>
                <option value="Corporate Team Building">Corporate Team Building</option>
                <option value="Corporate Team Bonding">Corporate Team Bonding</option>
                <option value="Corporate Retreat">Corporate Retreat</option>
                <option value="Youth Camp">Youth Camp</option>
                <option value="Youth Workshop">Youth Workshop</option>
          </select>
        </td>
      </tr>
      <tr>
        <td class="left_cell">Bid Deadline:</td>
        <td class="right_cell"><input type="datetime-local" name="bidDeadline" id="bidDeadline"></td>
      </tr>
      <tr>
        <td class="left_cell">Programme Start Date:</td>
        <td class="right_cell"><input type="date" name="programmeStartDate" id="programmeStartDate"></td>
      </tr>
      <tr>
        <td class="left_cell">Programme End Date:</td>
        <td class="right_cell"><input type="date" name="programmeEndDate" id="programmeEndDate"></td>
      </tr>
    </table>
    <button class="submitButton" type="submit">Submit</button>
  </form>
</div>
<div>
  <form action="addBids.php" method="post" id="addBidsForm" style="display:none">
    <table>
      <tr>
        <td colspan="2" class="left_cell">Programme Name</td>
        <td colspan="2" class="right_cell">
          <select name="programmeName">
            <?php
              $conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_development");
              if(!$conn){
                exit('Could not connect to database: '.mysqli_connect_error($conn));
              }
              $stmt = mysqli_stmt_init($conn);
              mysqli_stmt_prepare($stmt,'SELECT Name,StartDate FROM PROGRAMME WHERE StartDate > CURDATE()'); //only returns programmes that have not started, shortens the list
              mysqli_stmt_execute($stmt);
              mysqli_stmt_bind_result($stmt,$progName,$notUsed);
              while(mysqli_stmt_fetch($stmt)){
                echo "<option value=\"$progName\">$progName</option>";
              }
              mysqli_stmt_close($stmt);
              mysqli_close($conn);
            ?>
          </select>
        </td>
      </tr>
        <?php 
          $counter = 0;
          while($counter++ < 5){
            echo "<tr>";
            echo "<td>Company ($counter)</td>";
            echo "<td><input type=\"text\" name=\"companyName[]\"></input></td>";
            echo "<td>Amount</td>";
            echo "<td><input type=\"number\" name=\"bidAmount[]\" step=\"0.01\"></td>";
            echo "</tr>";
          }
        ?>
    </table>
    <button class="submitButton" type="submit">Submit</button>
  </form>
</div>

<?php
  include "../utility/footer.php";
?>

<script>
function showSelectBidsByNameForm(){
  toggleButtons();
  toggleDisplayStyle("selectBidsByNameButton");
  toggleDisplayStyle("selectBidsByNameForm");
}
function showSelectBidsByTypeForm(){
  toggleButtons();
  toggleDisplayStyle("selectBidsByTypeButton");
  toggleDisplayStyle("selectBidsByTypeForm");
}
function showAddNewProgrammeForm(){
  toggleButtons();
  toggleDisplayStyle("addNewProgrammeButton");
  toggleDisplayStyle("addNewProgrammeForm");
}
function showAddBidsForm(){
  toggleButtons();
  toggleDisplayStyle("addBidsButton");
  toggleDisplayStyle("addBidsForm");
}
function toggleButtons(){
  toggleDisplayStyle("selectBidsByNameButton");
  toggleDisplayStyle("selectBidsByTypeButton");
  toggleDisplayStyle("addNewProgrammeButton");
  toggleDisplayStyle("addBidsButton");
}
</script>