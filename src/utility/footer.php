        </div> <!-- close element -->
      </div> <!-- close inner-container -->
    </div> <!-- close outer-container -->
    <div class="back">
    <?php
      if(basename($_SERVER["PHP_SELF"]) == 'default.php' || basename($_SERVER["PHP_SELF"]) == 'logout.php'){
        echo "All Hearts Adventure and Training © 2015"; //do not show back button when in login/logout
      }
      else if(basename($_SERVER["PHP_SELF"]) == 'welcome.php'){
        echo "<button class=\"backButton\" id=\"backButton\" onclick=\"location.href = 'logout.php';\" style=\"display:inline\">Logout</button>";
      }
      else if(basename($_SERVER["PHP_SELF"]) == 'activities.php' || basename($_SERVER["PHP_SELF"]) == 'administration.php' || basename($_SERVER["PHP_SELF"]) == 'bids.php' || basename($_SERVER["PHP_SELF"]) == 'logistics.php' || basename($_SERVER["PHP_SELF"]) == 'manpower.php' || basename($_SERVER["PHP_SELF"]) == 'payment.php' || basename($_SERVER["PHP_SELF"]) == 'programmes.php'){
        echo "<button class=\"backButton\" id=\"backButton\" onclick=\"location.href = '../access/welcome.php';\" style=\"display:inline\">Back</button>";
      }
      else{
        $currentDir = basename(getcwd()).".php";
        echo "<button class=\"backButton\" id=\"backButton\" onclick=\"location.href = '$currentDir'\" style=\"display:inline\">Back</button>";
      }
    ?>
    </div>
  </body>
</html>

<script>
function toggleDisplayStyle($formName){
  $currentDisplayStyle = document.getElementById($formName).style.display;
  if($currentDisplayStyle == "inline"){
    document.getElementById($formName).style.display="none";
  } else{
    document.getElementById($formName).style.display="inline";
  }
}
</script>