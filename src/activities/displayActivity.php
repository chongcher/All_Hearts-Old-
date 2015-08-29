<?php
  include "../utility/header.php";
  $filename = $_POST["fileName"];
  echo "<p><u>$filename</p></u></div>";
?>

<div>
  <?php
    $fileDir = $_POST["fileDir"];
    $filenames = scandir($fileDir);
    foreach($filenames as $file){
      if($file != '.' && $file != '..'){ #scandir returns . & .. for previous folders, refer to http://stackoverflow.com/questions/11048057/php-scandir-returns-extra-periods
        $filePath = $fileDir.$file;
        $fileType = pathinfo($filePath,PATHINFO_EXTENSION);
        if($fileType == 'pdf'){
          echo "<object data=\"$filePath\" type=\"application/pdf\">";
          echo "<embed src=\"$filePath\" type=\"application/pdf\" />";
          echo "</object>";
        }
      }
    }
    foreach($filenames as $file){
      if($file != '.' && $file != '..'){ #scandir returns . & .. for previous folders, refer to http://stackoverflow.com/questions/11048057/php-scandir-returns-extra-periods
        $filePath = $fileDir.$file;
        $fileType = pathinfo($filePath,PATHINFO_EXTENSION);
        //echo "<p><button href=\"$filePath\">Download as ".$fileType."</button></p>";
        echo "<p><a href=\"$filePath\">Download .$fileType</a></p>";
      }
    }
  ?>
</div>
    
<?php
  include "../utility/footer.php";
?>