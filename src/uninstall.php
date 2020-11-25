<?php
// Minimikoti uninstallation


// ### UNINSTALLATION PARAMETERS ###

define( ENABLE_UNINSTALLATION, TRUE ); // default TRUE
define( ECHO_SQL_COMMANDS, FALSE ); // default FALSE
define( ECHO_DEBUG, TRUE ); // default TRUE

define( DROP_DATABASE_USERS, FALSE ); // drop database users, default FALSE


// ### UNINSTALLATION BEGINS ###

// uninstallation begins
if( !ENABLE_UNINSTALLATION ) {
	die("Uninstallation disabled!");
}

// Include settings
require_once( "config/database.conf.php" );
require_once( "config/security.conf.php" );
require_once( "config/thread.conf.php" );
require_once( "config/vote.conf.php" );

// Function mysql_multi_query:
function mysql_multi_query( $sql_array, $connection ) {	
	foreach( $sql_array as $query ) {
		if( ECHO_SQL_COMMANDS ) {
			echo "Query: ".$query."<br/>\n";
		}
		
		$success = mysql_query($query, $connection);
		
		if( ECHO_DEBUG && !$success ) {
			die( "Error: ".mysql_error() );
		}
	}
}

// Open connection
require_once( "lib/connect.lib.php" );
$CONA = mysql_admin_connect();


// Sql queries
$sql_tables = array();


// Drop user table
array_push( $sql_tables, "
DROP TABLE IF EXISTS `user`;
");

// Drop index from post table
array_push( $sql_tables, "
DROP INDEX threadIndex ON `".DB_TABLE_POST."`;
");

// Drop post table
array_push( $sql_tables, "
DROP TABLE IF EXISTS `".DB_TABLE_POST."`;
");


// Drop rating table
array_push( $sql_tables, "
DROP TABLE IF EXISTS `".DB_TABLE_VOTE."`;
");
	
	
// Run queries
mysql_multi_query( $sql_tables, $CONA );


// Drop database users 
if( DROP_DATABASE_USERS ) {
   // Database user queries
   $sql_users = array();

	array_push( $sql_users, "
     DROP USER ".DB_WRITER_USERNAME."@`".DB_HOST."`;
   ");
   array_push( $sql_users, "
     DROP USER ".DB_ERASER_USERNAME."@`".DB_HOST."`;
   ");
   array_push( $sql_users, "
     DROP USER ".DB_READER_USERNAME."@`".DB_HOST."`;
   ");
	
	// Queries
	mysql_multi_query( $sql_users, $CONA );	
}


// Close connection
mysql_close( $CONA );
		
// Error in query
if( FALSE ) {
	echo "Error: uninstallation failed.\n";
} else {
	echo "<div>Uninstallation ready.</div>";
	echo "<div><a href=\"homes.php\">Continue to front page</a>.</div>\n";
	echo "<div><a href=\"install.php\">Reinstall website</a>.</div>\n";
}

// ### INSTALLATION ENDS ###

?>
