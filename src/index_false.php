<?php
// Minimikoti
// public_login.php, for test users

// Start session
session_start();

// Security settings
require_once( "config/security.conf.php" );

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fi" xml:lang="fi">
<head>
	<title>Construction Site</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="css/structure.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/basic.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/public_login.css" type="text/css" media="screen" />

</head>
<body>

<div class="container">

<?php
// Login limiter for brute force attacks 
if($_SESSION['fails'] < MAX_FAILED_LOGINS) {
?>

<h1>Enter to Construction Site</h1>

<form action="" method="post">
<div>
	<div>Username</div>
	<div><input id='un_field' type='text' name='username' disabled='disabled' /></div>
</div>

<div>
	<div>Password</div>
	<div><input id='pw_field' type='password' name='password' disabled='disabled' /></div>
</div>

<div><input type='submit' value='Enter' /></div>
</form>

<script type='text/javascript'>
	<!--
	document.getElementById('un_field').focus();
	//-->
</script>

<?php
// end of login limiter
} else {
  echo "<div class='note'>You have failed too many times.</div>\n";
}

?>

</div> <!-- container -->

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try{
var pageTracker = _gat._getTracker("UA-16344244-1");
pageTracker._trackPageview();
} catch(err) {}
</script>

</body>
</html>
