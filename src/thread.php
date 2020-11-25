<?php
// thread.php - Xitrux Thread
// originally created for Xitrux Locator
// 
// Comment thread. Prints thread and form.

// 100419 plenty of updates. Updated for Minimikoti
// 090824 getThread updated
// 090804 character limit for textarea

// Parameter: $THREAD_TITLE, string
if( is_null( $THREAD_TITLE ) ) {
	$THREAD_TITLE = "Thread:";
}

// Parameter: $THREAD_ID, integer or numeric string
if( is_null( $THREAD_ID ) ) {
	$THREAD_ID = 0;
}

// Parameter: $ENABLE_COMMENTING, boolean
if( is_null( $ENABLE_COMMENTING ) ) {
	$ENABLE_COMMENTING = false;
}

// PARAMETER: $THREAD_CONNECTION, MySQL-connection with read-privilege
if( is_null( $THREAD_CONNECTION ) ) {
	$THREAD_CONNECTION = false;
}

// Thread handling
require_once( "lib/thread.lib.php" );

// Echo thread
echo "<div class=\"thread\">\n";
echo "<div class=\"title\">". $THREAD_TITLE ."</div>\n";

// Print a thread
$thread = getThread($THREAD_CONNECTION, $THREAD_ID);
if( $thread === false ) {
	echo "<span class='note common'>none</span><br/>\n";
} else {
	foreach( $thread as $row ) {
		echo "<div class=\"post\">\n";
		echo "<div class=\"header\">\n";
		echo "<span class=\"topic\">".$row['topic']."</span> posted on ".$row['time']."\n";
		echo "</div>\n";
		echo "<div class=\"body\">\n";
		echo stripcslashes( nl2br( $row['data'] ) );
		echo "</div>\n";
		echo "</div> <!-- post -->\n";
	}
}

echo "</div> <!-- thread -->\n";

// Form for new comment
if( $ENABLE_COMMENTING ) {

	echo "<div class=\"new\">\n";
	echo "<div class=\"header\">\n";
	echo "<b>Add a comment:</b>\n";
	echo "</div>\n";
	echo "<form action=\"thread.exe.php?"
		."hid=".$HOME->getId()."\" method=\"post\">\n";
	echo "<div>Topic:<input type='text' name='topic' /></div>\n";
	echo "<textarea name=\"body\" rows='3' cols='60'>\n";
	echo "</textarea><br/>\n";
	echo "<span class=\"note\" id=\"limit\">Limit to 2-255 characters</span><br/><br/>\n";
	echo "<input type='submit' value='Comment' />\n";
	echo "<input type='reset' value='Clear' />\n";
	echo "</form>\n";
	echo "</div> <!-- new -->\n";	
}
?>

