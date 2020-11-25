<?php
// Minimikoti
// thread.exe.php
	
// 100420

// Security level set to one. Now unlogged user is forwarded to login page
$SECURITY_LEVEL = 0;

// Start session
session_start();

// Database connection
require_once( "lib/connect.lib.php" );
$CONW = mysql_writer_connect();

// Security settings
require_once( "config/security.conf.php" );

// User authentication
require_once( "lib/usersession.lib.php" );
$user = new UserSession( $CONW );
if( $SECURITY_LEVEL > $user->getSecurityLevel() ) {
	// If user is not authorized, he will be thrown to a login page
	header( 'Location: login.php?msg=No%20permission' );
	die();
}

// Thread functions
require_once("config/thread.conf.php");
require_once("lib/thread.lib.php");

// TEST START
require_once("securimage/securimage.php");

$securimage = new Securimage();

if ($securimage->check($_POST['captcha_code']) == false) {
   // the code was incorrect
   // handle the error accordingly with your other error checking
  
   header( "Location: home.php?hid=".$_GET['hid']."&pid=".$_GET['pid']."&msg=thread_invalid_code" );
   die();

}

// TEST END

// True if success
$valid_post = addPost( $CONW, $_GET['hid'], 0,
                       $_POST['topic'], MAX_TOPIC_LENGTH,
                       $_POST['body'], MAX_DATA_LENGTH,
                       MIN_TOPIC_LENGTH, MIN_DATA_LENGTH );

// Close MySQL-connection
mysql_close($CONW);

// Forward user back to page where he/she came
$msg = "";
if( $valid_post ) {
	$msg = "home_comment_success";
} else {
	$msg = "home_comment_failure";
}
header( "Location: home.php?hid=".$_GET['hid']."&pid=".$_GET['pid']."&msg=".$msg."#comments" );
die();

?>

