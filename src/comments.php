<?php
// Minimikoti
// manager.php

// Header
$TITLE = "comments_title";
$SECURITY_LEVEL = 0;
$BREADCRUMB = array(
	"bread_title" => "homes.php",
	"bread_comments" => "comments.php"
);
$HEADER_INCLUDE = ""
. "<link rel=\"stylesheet\" "
. "href=\"css/thread.css\" "
. "type=\"text/css\" media=\"screen\" />\n";
require_once( "header.php" );

require_once( "lib/thread.lib.php" );
require_once( "config/homedata.conf.php" );
require_once( "lib/home.lib.php" );
?>

<?php
if( DEFAULT_COMMENT_VIEW_LEVEL <= $user->getSecurityLevel() ) {
	
	// Thread handling
	require_once( "lib/thread.lib.php" );
	
	// Get a thread
	$thread = getThread($CONR, -1, -1, true);
	
	// Length of thread
	$thread_length = 0;
	if( $thread != false ) {
	   $thread_length = count($thread);
	}
	
	echo "<h1>".sprintf($lang->get("thread_title3"),$thread_length)."</h1>\n";

	// Echo thread
	echo "<div id=\"comments\" class=\"thread\">\n";

   // Get thread
	if( $thread === false ) {
		echo "<span class='note common'>".$lang->getText("thread_empty")."</span>\n";
	} else {
		foreach( $thread as $row ) {
			// Parse time, same format is used in suomi24.fi
			$time = gmdate("j.n.Y H:i", strtotime($row['time'] . " GMT"));
			
			$threadhome = new Home( $row['thread'], false, $lang );

			echo "<div class=\"post\">\n";
			echo "<div class=\"header\">\n";
			echo "<span class=\"topic\">".$row['topic']."</span> "
			. $lang->get("thread_comments_home")
			. " <span class=\"topic\">"
			. "<a href=\"home.php?hid=".$row['thread']."\">"
			. $threadhome->getTitle()
			. "</a></span>\n";
			echo "<div class=\"right\">"
			. $time
			. "</div>\n";
			echo "</div>\n";
			
			// comment administration
			if( DEFAULT_COMMENT_ADMIN_LEVEL <= $user->getSecurityLevel() ) {
			   echo "<div class=\"admin\">\n";
			   $pagecode = "hid=".$_GET['hid']."&pid=".$_GET['pid']."&postid=".$row['id'];
			   //$link_to_enable = "threadadmin.exe.php?type=ena&".$pagecode;
			   //$link_to_disable = "threadadmin.exe.php?type=dis&".$pagecode;
			   $link_to_delete = "threadadmin.exe.php?type=del&".$pagecode;
			   echo "<a href=\"".$link_to_delete."\">poista viesti</a>\n";
			   echo "</div>\n";
			}
			
			echo "<div class=\"body\">\n";
			echo stripcslashes( nl2br( $row['data'] ) );
			echo "</div>\n";
			echo "</div> <!-- post -->\n";
		}
	}
	
	echo "</div> <!-- thread -->\n";
	
} // end of if userlevel check
?>

<?php
require_once( "footer.php" );
?>
