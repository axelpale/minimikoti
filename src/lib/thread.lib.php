<?php
// ### Xitrux Thread ###
// thread.lib.php
// Thread module for comments, news, etc.


// ### Functions ###
//  addPost( &$conn, $thread_id, $user_id, $topic, $maxtopiclen, $data, $maxdatalen )
//  updatePost( &$conn, $id, $topic, $maxtopiclen, $data, $maxdatalen )
//  discardPost( &$conn, $id )
//  restorePost( &$conn, $id )
//  destroyPost( &$conn, $id )
//  getPost( &$conn, $id, $enabled_only = true )
//  getThread( &$conn, $thread_id = -1, $number = -1,
//             $desc = false, $enabled_only = true )
//  getDiscarded( &$conn, $thread_id = -1, $number = -1,
//                $desc = false, $disabled_only = true )
//  countThread( &$conn, $thread_id = -1, $enabled_only = true )
//  countDiscarded( &$conn, $thread_id = -1, $disabled_only = true )

// ### Update log ###
// 100420 if thread_id is negative, select all threads
// 100420 new functions getDiscarded, countThread, countDiscarded
// 100420 configuration file changed
// 100420 getThread returns an array, no mysql-resource
// 090830 function updatePost added
// 090830 function deletePost added
// 090824 getThread updated, new arguments added
// 090824 post topic handling added
// 090818 major bug fixed in data length check
// 090802 file created

// ### SQL Database structure ###
// CREATE TABLE IF NOT EXISTS post (
// id		BIGINT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
// thr_id	BIGINT NULL,
// user_id	BIGINT NOT NULL DEFAULT 1,
// topic	VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL,
// data		TEXT CHARACTER SET utf8 DEFAULT NULL,
// time		TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
// enable	CHAR(1) NOT NULL DEFAULT 'Y',  -- 'Y' OR 'N', yes/no
// PRIMARY KEY (id)
// ) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci AUTO_INCREMENT=1;
//
// CREATE INDEX threadIndex ON post (thr_id);


// Settings:
require_once( "config/thread.conf.php" );


// Function addPost:
//  adds a post under given thread id
// Parameters:
//  $conn, MySQL-connection with INSERT privilege
//  $thread_id, thread id
//  $user_id, writer's user id. If there's no user-id use any number.
//  $topic, topic or title of the post, can be used as writer's nickname
//  $maxtopiclen, int, maximal length of the topic. Negative means unlimited
//  $data, post body, text
//  $maxdatalen, int, maximal length of the data. Negative means unlimited
//  $mintopiclen: int, minimum length of the topic. Default to zero.
//  $mindatalen: int, minimum length of the data. Default to zero.
// Returns:
//  boolean, FALSE on failure, TRUE otherwise
function addPost( &$conn, $thread_id, $user_id, $topic, $maxtopiclen, $data, $maxdatalen, $mintopiclen = 0, $mindatalen = 0 ) {

	// validate id
	if( !is_numeric( $thread_id ) || !is_numeric( $user_id ) ) {
		return false;
	}
	
	// check topic length
	$topiclen = mb_strlen( $topic,'UTF-8');
	if( ($maxtopiclen >= 0 && $topiclen > $maxtopiclen) || $topiclen < $mintopiclen )
	{
		return false;
	}
	
	// check data length
	$datalen = mb_strlen( $data,'UTF-8');
	if( ($maxdatalen >= 0 && $datalen > $maxdatalen) || $datalen < $mindatalen )
	{
		return false;
	}

	// sanitize topic
	$topic = mysql_real_escape_string( htmlspecialchars(trim( $topic )), $conn );
	
	// sanitize data
	$data = mysql_real_escape_string( htmlspecialchars(trim( $data )), $conn );
	
	$sql = "INSERT INTO ".DB_TABLE_POST." (thr_id, user_id, topic, data) "
		. "VALUES (".$thread_id.", ".$user_id.", '".$topic."', '".$data."' )";
		
	return mysql_query( $sql, $conn );
}


// Function updatePost:
//   Updates topic and body text to existing post
// Parameters:
//   $conn: MySQL-connection with UPDATE privilege
//   $id: id of the post about to be updated
//   $topic: topic or title of the post
//   $maxtopiclen: int, maximal length of the topic. Negative means unlimited
//   $data: post body, text
//   $maxdatalen: int, maximal length of the data. Negative means unlimited
//   $mintopiclen: int, minimum length of the topic. Default to zero.
//   $mindatalen: int, minimum length of the data. Default to zero.
// Returns: boolean as mysql_query result. TRUE on success, FALSE on failure
function updatePost( &$conn, $id, $topic, $maxtopiclen, $data, $maxdatalen, $mintopiclen = 0, $mindatalen = 0 ) {
	// validate id
	if( !is_numeric( $id ) ) {
		return false;
	}
	
	// check topic length
	$topiclen = mb_strlen( $topic,'UTF-8');
	if( ($maxtopiclen >= 0 && $topiclen > $maxtopiclen) ||
	    ($mintopiclen >= 0 && $topiclen < $mintopiclen) ) {
		return false;
	}
	
	// check data length
	$datalen = mb_strlen( $data,'UTF-8');
	if( ($maxdatalen >= 0 && $datalen > $maxdatalen) ||
	    ($mindatalen >= 0 && $datalen < $mindatalen) ) {
		return false;
	}
	
	// sanitize topic
	$topic = mysql_real_escape_string( htmlspecialchars(trim( $topic )), $conn );
	
	// sanitize data
	$data = mysql_real_escape_string( htmlspecialchars(trim( $data )), $conn );
	
	$sql = "UPDATE ".DB_TABLE_POST." "
		. "SET topic='".$topic."', data='".$data."' "
		. "WHERE id=".$id;
		
	return mysql_query( $sql, $conn );
}

// Function discardPost:
//   Piscards post. Post is not shown in normal threads until post is restored.
//   If post is already discarded, post stays discarded.
// Parameters:
//   $conn: MySQL connection with UPDATE privilege
//   $id: id number of post about to be discarded
// Returns:
//   boolean from mysql_query result. TRUE on succes, FALSE on failure.
//   If post is already discarded, returns TRUE.
function discardPost( &$conn, $id ) {
	// validate id
	if( !is_numeric( $id ) ) {
		return false;
	}
	
	$sql = "UPDATE ".DB_TABLE_POST." "
		. "SET enable='N' "
		. "WHERE id=".$id;
	
	return mysql_query( $sql, $conn );
}

// Function restorePost:
//   Restores a discarded post.
// Parameters:
//   $conn: MySQL connection with UPDATE privilege
//   $id: id number of a post about to be restored
// Returns:
//   boolean from mysql_query result. TRUE on succes, FALSE on failure.
//   If post is not discarded, returns TRUE.
function restorePost( &$conn, $id ) {
	// validate id
	if( !is_numeric( $id ) ) {
		return false;
	}
	
	$sql = "UPDATE ".DB_TABLE_POST." "
		. "SET enable='Y' "
		. "WHERE id=".$id;
	
	return mysql_query( $sql, $conn );
}

// Function destroyPost:
//   Deletes a post permanently from the database
// Parameters:
//   $conn: MySQL connection with DELETE privilege
//   $id: id number of post about to be deleted
// Returns:
//   boolean from mysql_query result. TRUE on succes, FALSE on failure.
function destroyPost( &$conn, $id ) {
	// validate id
	if( !is_numeric( $id ) ) {
		return false;
	}
	
	$sql = "DELETE FROM ".DB_TABLE_POST." "
		. "WHERE id=".$id;
		
	return mysql_query( $sql, $conn );
}


// Function getPost:
//   searchs and returns a single post with given id
// Parameters:
//   $conn: MySQL-connection with SELECT privilege
//   $id: id number of wanted post
//   $enabled_only: boolean.
//     When false, can return a discarded post. Default true.
// Returns:
//  false(boolean) on bad ID or zero rows
//    OR
//  associative array, first (and the only) row fetched
//    from the mysql query result. Fields are "id", "thread", "user",
//    "topic, "data", "time" and "enabled".
function getPost( &$conn, $id, $enabled_only = true ) {
	// validate id
	if( !is_numeric( $id ) ) {
		return false;
	}
	
	// Select posts
	$sql = "SELECT po.id AS id, po.thr_id AS thread, po.user_id AS user, "
		. "po.topic AS topic, po.data AS data, po.time AS time, "
		. "po.enable AS enabled "
		. "FROM ".DB_TABLE_POST." po "
		. "WHERE po.id=".$id;
	
	// by default, search only for enabled posts
	if( $enabled_only ) {
		$sql .= " AND po.enable='Y'";
	}
	
	$result = mysql_query( $sql, $conn );
	
	if( mysql_num_rows( $result ) < 1 ) {
		return false;
	}
	
	// return array
	return mysql_fetch_assoc($result);
}


// Function getThread:
//  search a thread with given id from database and return posts oldest first
// Parameters:
//  $conn, MySQL-connection with SELECT privilege
//  $thread_id: id of thread to search. Negative selects all threads.
//    Default is -1.
//  $number: integer, number of posts to select.
//    Negative selects all. Default is -1.
//  $desc, boolean, TRUE selects posts newest first. Default FALSE;
//  $enabled_only: boolean. TRUE search only for non-discarded posts.
//    Default TRUE;
// Returns:
//  false(boolean) on bad ID or on zero rows
//    OR
//  array, a full thread as multidimension associative array.
//   Fields are "id", "thread", "user", "topic, "data" and "time".
//   For example $threadid = $returnedarray[1]['thread'];
function getThread( &$conn, $thread_id = -1, $number = -1,
                    $desc = false, $enabled_only = true) {
	
	// Select posts
	$sql = "SELECT po.id AS id, po.thr_id AS thread, po.user_id AS user, "
		. "po.topic AS topic, po.data AS data, po.time AS time, "
		. "po.enable AS enabled "
		. "FROM ".DB_TABLE_POST." po "
		. "WHERE TRUE ";
		
	// Is there specific thread 
	if( is_numeric($thread_id) && $thread_id >= 0 ) {
		$sql .= " AND po.thr_id=".$thread_id;
	}
	
	// by default, search only for enabled posts
	if( $enabled_only ) {
		$sql .= " AND po.enable='Y'";
	}
	
	// Order
	if( $desc ) {
		$sql .= " ORDER BY po.id DESC";
	}
	
	// How many will be selected 
	if( is_numeric($number) && $number >= 0 ) {
		$sql .= " LIMIT ".$number;
	}
		
	$result = mysql_query( $sql, $conn );
	
	echo mysql_error($conn);
	
	if( mysql_num_rows( $result ) < 1 ) {
		return false;
	}
	
	// Convert to array
	$tablearray = array();
	while( $row = mysql_fetch_assoc($result) ) {
		array_push($tablearray, $row);
	}

	return $tablearray;
}


// Function getDiscarded:
//  search a thread with given id from database and return all discarded posts
//  oldest post first.
// Parameters:
//  $conn, MySQL-connection with SELECT privilege
//  $thread_id: id of thread to search. Negative selects all threads.
//    Default is -1.
//  $number: integer, number of posts to select.
//    Negative selects all. Default is -1.
//  $desc, boolean, TRUE selects posts newest first. Default FALSE;
//  $disabled_only: boolean. TRUE search only for discarded posts.
//    Default TRUE;
// Returns:
//  false(boolean) on bad ID or on zero rows
//    OR
//  array, a full thread as multidimension associative array.
//   Fields are "id", "thread", "user", "topic, "data" and "time".
//   For example $threadid = $returnedarray[1]['thread'];
function getDiscarded( &$conn, $thread_id = -1, $number = -1,
                    $desc = false, $disabled_only = true) {
	
	// Select posts
	$sql = "SELECT po.id AS id, po.thr_id AS thread, po.user_id AS user, "
		. "po.topic AS topic, po.data AS data, po.time AS time, "
		. "po.enable AS enabled "
		. "FROM ".DB_TABLE_POST." po "
		. "WHERE TRUE ";
		
	// Is there specific thread 
	if( is_numeric($thread_id) && $thread_id >= 0 ) {
		$sql .= " AND po.thr_id=".$id;
	}
	
	// by default, search only for disabled posts
	if( $disabled_only ) {
		$sql .= " AND po.enable='N'";
	}
	
	// Order
	if( $desc ) {
		$sql .= " ORDER BY po.id DESC";
	}
	
	// How many will be selected 
	if( is_numeric($number) && $number >= 0 ) {
		$sql .= " LIMIT ".$number;
	}
		
	$result = mysql_query( $sql, $conn );
	
	if( mysql_num_rows( $result ) < 1 ) {
		return false;
	}
	
	// Convert to array
	$tablearray = array();
	while( $row = mysql_fetch_assoc($result) ) {
		array_push($tablearray, $row);
	}

	return $tablearray;
}


// Function countThread:
// Parameters:
//   $conn: MySQL-connection with SELECT privilege
//   $thread_id: id of thread to count. Negative selects all threads.
//     Default is -1.
//   $enabled_only: boolean. TRUE counts only non-discarded posts.
//     Default TRUE;
// Returns:
//  false(boolean) on bad ID or on error
//    OR
//  integer, number of rows.
function countThread( &$conn, $thread_id = -1, $enabled_only = true ) {
	
	//
	$sql = "SELECT COUNT(id) AS number "
		. "FROM ".DB_TABLE_POST." "
		. "WHERE TRUE ";
	
	// Is there specific thread 
	if( is_numeric($thread_id) && $thread_id >= 0 ) {
		$sql .= " AND thr_id=".$id;
	}
	
	// by default, search only for enabled posts
	if( $enabled_only ) {
		$sql .= " AND enable='Y'";
	}
	
	$result = mysql_query( $sql, $conn );
	
	// Return integer
	return mysql_result( $result, 0 );
}


// Function countDiscarded:
// Parameters:
//   $conn: MySQL-connection with SELECT privilege
//   $thread_id: id of thread to count. Negative selects all threads.
//     Default is -1.
//   $disabled_only: boolean. TRUE counts only discarded posts.
//     Default TRUE;
// Returns:
//  false(boolean) on bad ID or on error
//    OR
//  integer, number of rows.
function countDiscarded( &$conn, $thread_id = -1, $disabled_only = true ) {
	
	//
	$sql = "SELECT COUNT(id) AS number "
		. "FROM ".DB_TABLE_POST." "
		. "WHERE TRUE ";
	
	// Is there specific thread 
	if( is_numeric($thread_id) && $thread_id >= 0 ) {
		$sql .= " AND thr_id=".$id;
	}
	
	// by default, search only for disabled posts
	if( $disabled_only ) {
		$sql .= " AND enable='N'";
	}
	
	$result = mysql_query( $sql, $conn );
	
	// Return integer
	return mysql_result( $result, 0 );
}

?>
