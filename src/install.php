<?php
// Minimikoti installation


// ### INSTALLATION PARAMETERS ###

define( ENABLE_INSTALLATION, TRUE ); // default TRUE

define( ECHO_SQL_COMMANDS, FALSE ); // default FALSE
define( ECHO_DEBUG, TRUE ); // default TRUE

// Site admin username.
// Can be changed afterwards from site control panel.
define( ADMIN_USERNAME, "admin" );

// Site admin password.
// This is default password that MUST be changed from site control panel after
// site set up successfylly.
define( ADMIN_PASSWORD, "p7kkuk7t7!" );

// Site admin security level.
// Depends on page security level settings
define( ADMIN_SECURITY_LEVEL, 4 );


// Test user
define( CREATE_TEST_USER, true );
define( TEST_USERNAME, "testaaja" );
define( TEST_PASSWORD, "p7kkuk7t7!" );
define( TEST_SECURITY_LEVEL, 1 );

// Database users
define( CREATE_DATABASE_USERS, FALSE ); // default TRUE


// ### INSTALLATION BEGINS ###

// Installation begins
if( !ENABLE_INSTALLATION ) {
	die("Installation disabled!");
}

// Include settings
require_once( "config/database.conf.php" );
require_once( "config/security.conf.php" );
require_once( "config/thread.conf.php" );
require_once( "lib/vote.lib.php" );

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


// Create user table
array_push( $sql_tables, ""
."CREATE TABLE IF NOT EXISTS `user` ( "
."  `id` int(11) unsigned NOT NULL auto_increment, "
."  `name` varchar(32) character set utf8 NOT NULL UNIQUE, "
."  `pass` varbinary(128) NOT NULL, "
."  `level` int(11) unsigned NOT NULL DEFAULT '0', "
."  `enable` char(1) NOT NULL DEFAULT 'Y', " //-- 'Y' OR 'N', yes/no
."  `time` timestamp NOT NULL default CURRENT_TIMESTAMP, "
."  `session` varbinary(128) default NULL, "
."  `ip` varbinary(128) default NULL, "
."  PRIMARY KEY  (`id`) "
.") ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci AUTO_INCREMENT=1; "
);


// Create post table
array_push( $sql_tables, ""
."CREATE TABLE IF NOT EXISTS ".DB_TABLE_POST." ( "
."id		BIGINT(11) UNSIGNED NOT NULL AUTO_INCREMENT, "
."thr_id	BIGINT NULL, "
."user_id	BIGINT NOT NULL DEFAULT 1, "
."topic	VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL, "
."data		TEXT CHARACTER SET utf8 DEFAULT NULL, "
."time		TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, "
."enable	CHAR(1) NOT NULL DEFAULT 'Y', " // -- 'Y' OR 'N', yes/no
."PRIMARY KEY (`id`) "
.") ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci AUTO_INCREMENT=1; "
);

// Create index for post table
array_push( $sql_tables, "
CREATE INDEX threadIndex ON ".DB_TABLE_POST." (thr_id);
");


// Create rating table
array_push( $sql_tables, ""
."CREATE TABLE IF NOT EXISTS `".DB_TABLE_VOTE."` ("
."  `id` int(11) NOT NULL,"
."  `score` int(11) unsigned NOT NULL DEFAULT '0',"
."  `votes` int(11) unsigned NOT NULL DEFAULT '0',"
."  PRIMARY KEY (`id`)"
.") ENGINE=InnoDB DEFAULT CHARSET=utf8;"
);

// Create databanks for votes
// -- see below --

// Create admin user
array_push( $sql_tables, "
INSERT INTO `".DB_TABLE_USER."` "
	. "( `name`, `pass`, `level` ) "
	. "VALUES ( '".ADMIN_USERNAME."', AES_ENCRYPT('"
	. PASSWORD_PRESALT.ADMIN_PASSWORD.PASSWORD_POSTSALT
	. "', '".PASSWORD_KEY."'), "
	. ADMIN_SECURITY_LEVEL." )
");

// Create test user
if( CREATE_TEST_USER ) {
array_push( $sql_tables, "
INSERT INTO `".DB_TABLE_USER."` "
	. "( `name`, `pass`, `level` ) "
	. "VALUES ( '".TEST_USERNAME."', AES_ENCRYPT('"
	. PASSWORD_PRESALT.TEST_PASSWORD.PASSWORD_POSTSALT
	. "', '".PASSWORD_KEY."'), "
	. TEST_SECURITY_LEVEL." )
");
}

	
// Run queries
mysql_multi_query( $sql_tables, $CONA );

// Create databanks for votes
Vote::createBank( $CONA, 0 );
Vote::createBank( $CONA, 1 );
Vote::createBank( $CONA, 2 );
Vote::createBank( $CONA, 3 );
Vote::createBank( $CONA, 4 );
Vote::createBank( $CONA, 5 );
Vote::createBank( $CONA, 6 );
Vote::createBank( $CONA, 7 );


// Create Database users
if( CREATE_DATABASE_USERS ) {

   // Database user queries
   $sql_users = array();

	// Writer
	$sql_users[0] = "CREATE USER '".DB_WRITER_USERNAME."'@'".DB_HOST."' "
		. "IDENTIFIED BY '".DB_WRITER_PASSWORD."'";
	$sql_users[1] = "GRANT SELECT, INSERT, UPDATE ON ".DB_NAME.".* TO '"
		. DB_WRITER_USERNAME."'@'".DB_HOST."'";
	
	// Eraser
	$sql_users[2] = "CREATE USER '".DB_ERASER_USERNAME."'@'".DB_HOST."' "
		. "IDENTIFIED BY '".DB_ERASER_PASSWORD."'";
	$sql_users[3] = "GRANT SELECT, DELETE ON ".DB_NAME.".* TO '"
		. DB_ERASER_USERNAME."'@'".DB_HOST."'";
	
	// Reader
	$sql_users[4] = "CREATE USER '".DB_READER_USERNAME."'@'".DB_HOST."' "
		. "IDENTIFIED BY '".DB_READER_PASSWORD."'";
	$sql_users[5] = "GRANT SELECT ON ".DB_NAME.".* TO '"
		. DB_READER_USERNAME."'@'".DB_HOST."'";
	
	// Queries
	mysql_multi_query( $sql_users, $CONA );
		
}
	


// Close connection
mysql_close( $CONA );
		
// Error in query
if( FALSE ) {
	echo "Error: installation failed.\n";
} else {
	echo "<div>Installation ready.</div>";
	echo "<div><a href=\"homes.php\">Continue to front page</a>.</div>\n";
	echo "<div><a href=\"uninstall.php\">Uninstall website</a>.</div>\n";
}

// ### INSTALLATION ENDS ###

?>
