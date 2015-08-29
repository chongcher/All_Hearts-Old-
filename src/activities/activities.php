<?php
  include "../utility/header.php";
  echo '<p><u>Activities</p></u></div>';
?>

<div>
  <?php
    $dir = '../../resource/activities';
    $filenames = scandir($dir);
    foreach($filenames as $file){
      if($file != '.' && $file != '..'){ #scandir returns . & .. for previous folders, refer to http://stackoverflow.com/questions/11048057/php-scandir-returns-extra-periods
        $fileDir = $dir."/$file/";
        $fileName = str_replace("_"," ",$file);
        echo "<p><form method='post' id=\"displayActivity\" action=\"displayActivity.php\">";
        echo "<input type=\"hidden\" name=\"fileDir\" value=\"$fileDir\"></input>";
        echo "<input type=\"hidden\" name=\"fileName\" value=\"$fileName\"></input>";
        echo "<button>$fileName</button>";
        echo "</form></p>";
      }
    }
  ?>
</div>
<div>
  <p><u>Utilities</u></p>
  <p><button id="addActivity" onclick="showAddActivityForm()" style="display:inline">Add Activity</button></p>
  <form action="addActivity.php" id="addActivityForm" method="post" enctype="multipart/form-data" style="display:none">
    <table class="center">
      <tr>
        <td class="left_cell">Name of Activity:</td>
        <td class="right_cell"><input type="text" name="activityName" id="activityName"></td>
      </tr>
      <tr>
        <td class="left_cell">Minimum Manpower Required:</td>
        <td class="right_cell"><input type="text" name="manpowerRequired" id="activityName"></td>
      </tr>
      <tr>
        <td class="left_cell">Upload PDF file:</td>
        <td class="right_cell"><input type="file" name="pdfFile" id="pdfFile"></td>
      </tr>
      <tr>
        <td class="left_cell">Upload DOCX file:</td>
        <td class="right_cell"><input type="file" name="docxFile" id="docxFile"></td>
      </tr>
    </table>
    <p><button class="submitButton" type="submit" name="SubmitAddActivityForm">Submit</button></p>
  </form>
  <p><button id="deleteActivity" onclick="showDeleteActivityForm()" style="display:inline">Delete Activity</button></p>
  <form action="deleteActivity.php" id="deleteActivityForm" method="post" style="display:none">
    <?php
      $dir = '../../resource/activities';
      $filenames = scandir($dir);
      foreach($filenames as $file){
        if($file != '.' && $file != '..'){ #scandir returns . & .. for previous folders, refer to http://stackoverflow.com/questions/11048057/php-scandir-returns-extra-periods
          $fileDir = $dir."/$file/";
          $fileName = str_replace("_"," ",$file);
          echo "$fileName <input type=\"radio\" name=\"deleteActivityName\" value=\"$fileName\">";
          echo "<br>";
        }
      }
    ?>
  <p><button class="submitButton" type="submit" name="SubmitDeleteActivityForm">Submit</button></p>
  </form>
</div>

<?php
  include "../utility/footer.php";
?>

<script>
function showAddActivityForm(){
  toggleDisplayStyle("addActivityForm");
  toggleDisplayStyle("addActivity");
  toggleDisplayStyle("deleteActivity");
}
function showDeleteActivityForm(){
  toggleDisplayStyle("addActivity");
  toggleDisplayStyle("deleteActivity");
  toggleDisplayStyle("deleteActivityForm");
}
</script>