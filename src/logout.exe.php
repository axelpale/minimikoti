<?php
// Minimikoti
// logout.exe.php
	
// 100413

// Security level set to one. Now unlogged user is forwarded to login page
$SECURITY_LEVEL = 1;

// Start session
session_start();

// Database connection
require_once( "lib/connect.lib.php" );
$CONR = mysql_reader_connect();

// Security settings
require_once( "config/security.conf.php" );

// User authentication
require_once( "lib/usersession.lib.php" );
$user = new UserSession( $CONR );
if( $SECURITY_LEVEL > $user->getSecurityLevel() ) {
	// If user is not authorized, he will be thrown to a login page
	header( 'Location: login.php?msg=No%20permission' );
	die();
}

// Log user out
$user->logout();

// Close MySQL-connection
mysql_close($CONR);

// Forward user to frontpage
header( "Location: homes.php?msg=Kirjauduit%20ulos" );
die();

?>

