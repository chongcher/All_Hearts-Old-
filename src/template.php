<?php
  include "../utility/header.php";
  echo '<p><u>Manpower</p></u></div>';
?>

<div>
  <p><button id="Button" onclick="Form()" style="display:inline"></button></p>
  <p><button id="Button" onclick="Form()" style="display:inline"></button></p>
</div>
<div>
  <form action=".php" method="post" id="Form" style="display:none">
  </form>
</div>

<?php
  include "../utility/footer.php";
?>

<script>
function Form(){
  toggleButtons();
  toggleDisplayStyle("");
}
function toggleButtons(){
  toggleDisplayStyle("");
}
</script>
------------------------------------------------------------------------------------------------------------------------
  <?php
    $conn = mysqli_connect("box1011.bluehost.com","allhear1_webapp","9BE&ZkWGTZcDrtj6","allhear1_development");
    if(!$conn){
      exit('Could not connect to database: '.mysqli_connect_error($conn));
    }
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,'');
    mysqli_stmt_bind_param($stmt,'s',);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,,);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  ?>