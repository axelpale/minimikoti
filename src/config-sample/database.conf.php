<?php

##### Settings #####
// MySQL-database settings. These have to match with
// settings on MySQL-server.

// MySQL-server location
define( DB_HOST, "localhost" );

// Primary database
define( DB_NAME, "minimikoti" );

// Table: user
define( DB_TABLE_USER, "user" );

// Name and password for admin-user
define( DB_ADMIN_USERNAME, "minimi_admin" );
define( DB_ADMIN_PASSWORD, "admin" );

// User with read and write privileges
define( DB_WRITER_USERNAME, "minimi_writer" );
define( DB_WRITER_PASSWORD, "writer" );

// User with privileges for deleting only
define( DB_ERASER_USERNAME, "minimi_eraser" );
define( DB_ERASER_PASSWORD, "eraser" );

// User with read privileges only
define( DB_READER_USERNAME, "minimi_reader" );
define( DB_READER_PASSWORD, "reader" );

?>
