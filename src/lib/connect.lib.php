<?php

// UTF-8 MySQL-connections
// based on Xitrux Locator connection.lib.php
// connect.lib.php

require_once( "config/database.conf.php" );

// Function mysql_admin_connect: Opens new MySQL-connection as database admin
// Returns: new MySQL-connection
function mysql_admin_connect() {
	$con = @mysql_connect( DB_HOST, DB_ADMIN_USERNAME, DB_ADMIN_PASSWORD );
	if (!$con) { die('Could not connect: '.mysql_error()); }
	mysql_select_db( DB_NAME, $con );
	mysql_query("SET NAMES 'utf8'"); // Connection UTF8
	return $con;
}

// Function mysql_writer_connect: Opens new MySQL-connection as writer
// Returns: new MySQL-connection
function mysql_writer_connect() {
	// MySQL-connection
	$con = @mysql_connect( DB_HOST, DB_WRITER_USERNAME, DB_WRITER_PASSWORD );
	if (!$con) { die('Could not connect: '.mysql_error()); }
	mysql_select_db( DB_NAME, $con );
	mysql_query("SET NAMES 'utf8'"); // Connection UTF8
	return $con;
}

// Function mysql_eraser_connect: Opens new MySQL-connection as eraser
// Returns: new MySQL-connection
function mysql_eraser_connect() {
	// MySQL-connection
	$con = @mysql_connect( DB_HOST, DB_ERASER_USERNAME, DB_ERASER_PASSWORD );
	if (!$con) { die('Could not connect: '.mysql_error()); }
	mysql_select_db( DB_NAME, $con );
	mysql_query("SET NAMES 'utf8'"); // Connection UTF8
	return $con;
}

// Function mysql_reader_connect: Opens new MySQL-connection as reader
// Returns: new MySQL-connection
function mysql_reader_connect() {
	// MySQL-connection
	$con = @mysql_connect( DB_HOST, DB_READER_USERNAME, DB_READER_PASSWORD );
	if (!$con) { die('Could not connect: '.mysql_error()); }
	mysql_select_db( DB_NAME, $con );
	mysql_query("SET NAMES 'utf8'"); // Connection UTF8
	return $con;
}

?>
