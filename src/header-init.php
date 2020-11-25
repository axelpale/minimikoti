<?php
// Header Initialization

// Start session
session_start();

// Database connection
require_once( "lib/connect.lib.php" );
$CONR = mysql_reader_connect();

// Security settings
require_once( "config/security.conf.php" );



// Parameter: $SECURITY_LEVEL
if( is_null( $SECURITY_LEVEL ) ) {
	$SECURITY_LEVEL = DEFAULT_PAGE_LEVEL;
}



// User authentication
require_once( "lib/usersession.lib.php" );
$user = new UserSession( $CONR );
if( $SECURITY_LEVEL > $user->getSecurityLevel() ) {
	// If user is not authorized, he will be thrown to a login page
	if( DEFAULT_PAGE_LEVEL > $user->getSecurityLevel()) {
		header( 'Location: '.UNAUTHORIZED_FORWARD_2.'?msg=No%20permission' );
	} else {
		header( 'Location: '.UNAUTHORIZED_FORWARD.'?msg=No%20permission' );
	}
	die();
}

// Localization
require_once( "config/localization.conf.php" ); // Load localization settings
require_once( "lib/localization.lib.php" );
require_once( "config/textdata.php" );
if( is_null( $_SESSION["lang"] ) || !ENABLE_LOCALIZATION ) {
	$_SESSION["lang"] = "fi"; // Set default, even if localization is off
}
if( !is_null( $_GET["lang"] ) && ENABLE_LOCALIZATION ) {
	if( $_GET["lang"] == "fi" ) $_SESSION["lang"] = "fi";
	if( $_GET["lang"] == "en" ) $_SESSION["lang"] = "en";
}
$lang = new Localization( $_SESSION["lang"], $textdata );

// Name of this page. Used for language change
$dirpices = explode("/", $_SERVER['PHP_SELF']);
$CURRENTPAGE = end($dirpices);

?>
