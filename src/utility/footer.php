        </div>
      </div>
    </div>
    <div class="back">
    <?php
      //echo '</div>'; //for element
      //echo '</div>'; //for inner-container
      //echo '</div>'; //for outer-container
      //echo '<div class=\"back\">';
      if(basename($_SERVER["PHP_SELF"]) == 'default.php'){
        echo "All Hearts Adventure and Training © 2015"; //do not show back button when in login/logout
      }
      else if(basename($_SERVER["PHP_SELF"]) == 'welcome.php'){
        //TODO logout button
      }
      else if(basename($_SERVER["PHP_SELF"]) == 'activities.php' || basename($_SERVER["PHP_SELF"]) == 'administration.php' || basename($_SERVER["PHP_SELF"]) == 'bids.php' || basename($_SERVER["PHP_SELF"]) == 'logistics.php' || basename($_SERVER["PHP_SELF"]) == 'manpower.php' || basename($_SERVER["PHP_SELF"]) == 'payment.php' || basename($_SERVER["PHP_SELF"]) == 'programmes.php'){
        echo "<button class=\"backButton\" id=\"backButton\" onclick=\"location.href = '../access/welcome.php';\" style=\"display:inline\">Back</button>";
      }
      else{
        $currentDir = basename(getcwd()).".php";
        echo "<button class=\"backButton\" id=\"backButton\" onclick=\"location.href = '$currentDir'\" style=\"display:inline\">Back</button>";
      }
      echo '</div>';
      echo '</body>';
      echo '</html>';
    ?>
    </div>
  </body>
</html>