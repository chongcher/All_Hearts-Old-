<?php
  include "../utility/header.php";
?>
<div>
  <?php
    session_unset();
    session_destroy();
    header('Refresh: 1; URL=default.php');
  ?>
</div>
<?php
  include "../utility/footer.php";
?>