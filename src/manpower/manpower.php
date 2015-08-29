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