<?php
// Minimikoti
// vote.exe.php
	
// 100502

// Security level set to zero. Now unlogged user is ok
$SECURITY_LEVEL = 0;

// Messages
$msg_success = "home_rating_success";
$msg_failure = "home_rating_failure";
$msg_already = "home_rating_already";

// Forward
$forward_success = "home.php?hid=".$_GET['hid']."&pid=".$_GET['pid']."&msg=".$msg_success;
$forward_failure = "home.php?hid=".$_GET['hid']."&pid=".$_GET['pid']."&msg=".$msg_failure;
$forward_already = "home.php?hid=".$_GET['hid']."&pid=".$_GET['pid']."&msg=".$msg_already;

// Start session
session_start();

// Check if user has voted this target already.
if( is_null( $_SESSION['voted'] ) )
{
   $_SESSION['voted'] = array_fill(0,8,false);
}
else
{
   if( $_SESSION['voted'][ $_GET['hid'] ] )
   {
      // User have voted already
      header( 'Location: '.$forward_already );
      die();
   }
   // Value is set true on succesfull vote. See below.
}
   

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

// Home voting functions
require_once("lib/vote.lib.php");

// Load voting
$vote = new Vote($_GET['hid'], $CONW, false);
$valid_vote = $vote->vote($_GET['points']);

// Close MySQL-connection
mysql_close($CONW);

// Forward user back to page where he/she came
if( $valid_vote ) {
   // Set as voted
   $_SESSION['voted'][ $_GET['hid'] ] = true;
	header( "Location: ".$forward_success );
	die();
}
// else
header( "Location: ".$forward_failure );
die();

?>

