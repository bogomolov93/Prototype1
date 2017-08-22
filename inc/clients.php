<?php
session_start(); 
include("functions.inc.php");
include("inc/footer.inc.php");
if (validate_user($_SESSION['service_user_id'], $_SESSION['code'])) {
//include("inc/head.php");
?>
<body>
<select class="selectpicker">
  <option>Mustard</option>
  <option>Ketchup</option>
  <option>Relish</option>
</select>

</body>
<?php
} else {
    include 'auth.php';
}
?>
