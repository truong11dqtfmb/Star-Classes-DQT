<?php
session_start();
if (!isset($_SESSION['mail_admin']) || !isset($_SESSION['phone_admin'])) {
  header('Location: admin/login.php');
  return;
}
?>

<?php
include_once("_header.php");
?>
<div class="container">
  <?php
  include_once("../Database/config.php");
  include_once("_thong_ke.php");
  ?>
</div>

</div>
</div>
<?php
include_once("_footer.php");
?>