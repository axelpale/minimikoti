<?php
// Minimikoti
// thread.exe.php
	
// 100420

// Security settings
require_once( "config/security.conf.php" );

// Security level set to one. Now unlogged user is forwarded to login page
$SECURITY_LEVEL = DEFAULT_COMMENT_ADMIN_LEVEL;

// Start session
session_start();

// Database connection
require_once( "lib/connect.lib.php" );
$CONW = mysql_writer_connect();

// User authentication
require_once( "lib/usersession.lib.php" );
$user = new UserSession( $CONW );
if( $SECURITY_LEVEL > $user->getSecurityLevel() ) {
	// If user is not authorized, he will be thrown to a login page
	header( 'Location: login.php?msg=No%20permission' );
	die();
}

// Thread functions
require_once("lib/thread.lib.php");

// True if success
$valid_post = discardPost( $CONW, $_GET['postid'] );

echo mysql_error( $CONW );

// Close MySQL-connection
mysql_close($CONW);

// Forward user back to page where he/she came
$msg = "";
if( $valid_post ) {
	$msg = "Comment deleted";
} else {
	$msg = "There was an error";
}
header( "Location: home.php?hid=".$_GET['hid']."&pid=".$_GET['pid']."&msg=".$msg."#comments" );
die();

?>

