<?php
// Minimikoti
// login.php

$TITLE = "login_title";
$BREADCRUMB = array(
	"bread_title" => "homes.php",
	"bread_login" => "login.php"
);
require_once( "header.php" );
?>

<?php
// Login limiter for brute force attacks 
if($_SESSION['fails'] < MAX_FAILED_LOGINS) {
?>

<form action="login.exe.php" method="post">
<div>
	<div><?php echo $lang->getText("login_username"); ?></div>
	<div><input id='un_field' type='text' name='username' /></div>
</div>

<div>
	<div><?php echo $lang->getText("login_password"); ?></div>
	<div><input id='pw_field' type='password' name='password' /></div>
</div>

<div><input type='submit' value='<?php echo $lang->getText("login_button"); ?>' /></div>
</form>

<script type='text/javascript'>
	<!--
	document.getElementById('un_field').focus();
	//-->
</script>

<?php
// end of login limiter
} else {
  echo "<div class='note'>Olet epäonnistunut kirjautumisessa liian monta kertaa</div>\n";
}

?>

<?php
require_once( "footer.php" );
?>
