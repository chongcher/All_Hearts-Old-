<?php
  include "../utility/header.php";
  echo '<p><u>Logistics</p></u></div>';
?>

<div>
  <p>
    <form action="viewLogistics.php" method="post">
      <input type="hidden" name="nextAction" value="viewAllLogistics"></input>
      <button id="viewAllLogisticsButton" style="display:inline">View All Logistics</button>  
    </form>
  </p>
  <p>
    <button id="addLogisticsButton" onclick="showAddLogisticsForm()" style="display:inline">Add Logistics</button>
    <form id="addLogisticsForm" action="addLogistics.php" method="post" style="display:none">
      <table class="center" id="addLogisticsTable">
        <tr>
          <td class="center_cell">Date of Purchase</td>
          <td class="center_cell"><input type="date" name="purchaseDate" value="<?php echo date('Y-m-d'); ?>"></td>
        </tr>
        <tr>
          <td class="center_cell">Purchase Source</td>
          <td class="center_cell"><input type="text" name="purchaseSource" id="purchaseSource"></td>
        </tr>
        <tr class="blank_row">
          <td colspan=4></td>
        </tr>
        <tr>
          <td class="center_cell">Name of Item</td>
          <td class="center_cell">Quantity</td>
          <td class="center_cell">Price Per Unit <br>(Including GST)</td>
          <td class="center_cell">Expiry Date</td>
          <td class="center_cell">Shelf No</td>
        </tr>
        <?php
          $counter = 0;
          while($counter++ <= 10){
            echo '<tr>';
            echo "  <td class=\"center_cell\"><input type=\"text\" name=\"itemName$counter\" id=\"itemName$counter\"></td>";
            echo "  <td class=\"center_cell\"><input type=\"number\" name=\"itemQuantity$counter\" id=\"itemQuantity$counter\" min=\"0\"></td>";
            echo "  <td class=\"center_cell\"><input type=\"number\" name=\"itemPrice$counter\" id=\"itemPrice$counter\" step=\"0.01\" min=\"0\"></td>";
            echo "  <td class=\"center_cell\"><input type=\"date\" name=\"itemExpiryDate$counter\" id=\"itemExpiryDate$counter\"></td>";
            echo "  <td class=\"center_cell\"><input type=\"text\" name=\"itemShelfNo$counter\" id=\"itemShelfNo$counter\"></td>";
            echo '</tr>';
          }
        ?>
      </table>
      <button class="submitButton" type="submit" id="submitAddLogisticsForm">Submit</button>
    </form>
  </p>
  <p>
    <button id="viewLogisticsButton" onclick="showViewLogisticsForm()" style="display:inline">View Logistics</button>
    <form id="viewLogisticsForm" action="selectLogistics.php" method="post" style="display:none">
      <table class="center" id="viewLogisticsTable">
        <tr>
          <td class="left_cell">Name</td>
          <td class="right_cell">
            <input type="text" name="logisticsName"></input>
          </td>
        </tr>
        <tr>
          <td class="left_cell">Type</td>
          <td class="right_cell">
            <select name="logisticsType">
              <option value="" selected>None</option>
              <option value="expendable">Expendable</option>
              <option value="non-expendable">Non-Expendable</option>
              <option value="perishable">Perishable</option>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan=2><input type="hidden" name="nextAction" value="viewLogistics"></input></td>
        </tr>
        <tr>
          <td colspan=2><button class="submitButton" type="submit" name="submitViewLogisticsForm">Submit</button></td>
        </tr>
      </table>
    </form>
  </p>
  <p>
    <button id="deleteLogisticsButton" onclick="showDeleteLogisticsForm()" style="display:inline">Delete Logistics</button>
    <form class="center" id="deleteLogisticsForm" action="selectLogistics.php" method="post" style="display:none">
      <table>
        <tr>
          <td class="left_cell">Name</td>
          <td class="right_cell">
            <input type="text" name="logisticsName"></input>
          </td>
        </tr>
        <tr>
          <td class="left_cell">Type</td>
          <td class="right_cell">
            <select name="logisticsType">
              <option value="" selected>None</option>
              <option value="expendable">Expendable</option>
              <option value="non-expendable">Non-Expendable</option>
              <option value="perishable">Perishable</option>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan=2><input type="hidden" name="nextAction" value="deleteLogistics"></input></td>
        </tr>
        <tr>
          <td colspan=2><button class="submitButton" type="submit" name="submitDeleteLogisticsForm">Submit</button></td>
        </tr>
      </table>
    </form>
  </p>
</div>
    
<?php
  include "../utility/footer.php";
?>

<script>
function hideButtons(){
  toggleDisplayStyle("viewAllLogisticsButton");
  toggleDisplayStyle("addLogisticsButton");
  toggleDisplayStyle("viewLogisticsButton");
  toggleDisplayStyle("deleteLogisticsButton");
}
function showAddLogisticsForm(){
  hideButtons();
  toggleDisplayStyle("addLogisticsForm");
}
function showViewLogisticsForm(){
  hideButtons();
  toggleDisplayStyle("viewLogisticsForm");
}
function showDeleteLogisticsForm(){
  hideButtons();
  toggleDisplayStyle("deleteLogisticsForm");
}
</script>