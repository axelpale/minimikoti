<?php
// Header Initialization

// Start session
session_start();

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
