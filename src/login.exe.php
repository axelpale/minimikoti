<?php

// Start session for user authentication
session_start();

// Security settings
require_once( "config/security.conf.php" );

// User class
require_once( "lib/usersession.lib.php" );

// Database connection functions
require_once( "lib/connect.lib.php" );

// MySQL-connection
$CONW = mysql_writer_connect();

// Indicator for succesful login
$valid_login = false;

// If fail-counter is not yet set, format fail-counter
if(!isset($_SESSION['fails'])) $_SESSION['fails'] = 0;

// Check is login failed too many times and if not, try to log in
if( $_SESSION['fails'] < MAX_FAILED_LOGINS || !ENABLE_LOGIN_LOCK ) {

	// Login
	$valid_login = UserSession::login($_POST['username'], $_POST['password'], $CONW );
	
	if($valid_login) {
		$_SESSION['fails'] = 0; // Reset fail-counter
	} else {
		$_SESSION['fails']++; // Increase fail-counter by one
	}
}
	
// Close MySQL-connections
mysql_close($CONW);

// Forward
if($valid_login) {
	header( "Location: ".LOGIN_SUCCESS_FORWARD );
	die();
} else {
	// On failed login execution is cancelled for few seconds.
	// The purpose is to slow down possible brute force intrusion.
	// The time depends on fail-counter. More fails means bigger sleep times.
	// 1 fail  = 1.5 sec
	// 2 fails = 2.0 sec
	// 3 fails = 4.5 sec
	// 5 fails = 12.5 sec
	// 10 fails = 50 sec
	if( ENABLE_LOGIN_LOCK ) {
		sleep( $_SESSION['fails'] * $_SESSION['fails'] / 2 );
	}

	$msg = "Kirjautuminen epäonnistui";

	header("Location: ".LOGIN_FAILURE_FORWARD."?msg=".$msg);
	die();
}
?>
