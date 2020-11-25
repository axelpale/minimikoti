<?php
// Minimikoti
// homes.php

// Header
$TITLE = "frontpage_title";
$MENU_HIGHLIGHT = 1;
$BREADCRUMB = array(
	"bread_title" => "homes.php",
	"bread_homes" => "homes.php"
);
$HEADER_INCLUDE = "<link rel=\"stylesheet\" "
. "href=\"css/homes.css\" "
. "type=\"text/css\" media=\"screen\" />\n"
. "<link rel=\"stylesheet\" "
. "href=\"css/thread.css\" "
. "type=\"text/css\" media=\"screen\" />\n"
. "<script type=\"text/javascript\" src=\"lib/slogan.js\"></script>\n";
require_once( "header.php" );

// Include home data
require_once( "lib/home.lib.php" );
require_once( "config/homedata.conf.php" );

// Get homes
$home = array();
array_push( $home,
	new Home(0, false, $lang),
	new Home(1, false, $lang),
	new Home(2, false, $lang),
	new Home(3, false, $lang),
	new Home(4, false, $lang),
	new Home(5, false, $lang),
	new Home(6, false, $lang),
	new Home(7, false, $lang)
);

// how-to: $home[0]->getSlogan();
// <?php echo $home[0]->getSlogan(); ?

// Echo home
function echoHome( $id ) {
	global $home;
	echo "<a href=\"home.php?hid=".$id."\" "
	."onmouseover=\"onSlogan('".$home[$id]->getTitle().": ','".$home[$id]->getSlogan()."')\" "
	."onmouseout=\"offSlogan()\">\n";
	echo "<img src=\"".$home[$id]->getIconSrc()."\" "
	."alt=\"".$home[$id]->getTitle()."\" "
	."title=\"".$home[$id]->getSlogan()."\" />\n";
	echo "<span>".$home[$id]->getTitle()."</span>\n";
	echo "</a>\n";
}
?>

<div class="homeicons">

<div class="row">

<div class="item left">
<?php echoHome(0); ?>
</div>

<div class="item leftcenter">
<?php echoHome(1); ?>
</div>

<div class="item rightcenter">
<?php echoHome(2); ?>
</div>

<div class="item right">
<?php echoHome(6); ?>
</div>

</div>

<div class="row">

<div class="item left">
<?php echoHome(3); ?>
</div>

<div class="item leftcenter">
<?php echoHome(5); ?>
</div>

<div class="item rightcenter">
<?php echoHome(4); ?>
</div>

<div class="item right">
<?php echoHome(7); ?>
</div>

</div>

<div id="slogan"><span id="hometitle"></span><span id="slogantext"></span></div>

</div> <!-- homeicons -->

<h1><?php echo $lang->get("homes_welcome_title"); ?></h1>

<?php echo $lang->getText("homes_welcome"); ?>


<?php
if( DEFAULT_COMMENT_VIEW_LEVEL <= $user->getSecurityLevel() ) {
	// COMMENTING
	$ENABLE_COMMENTING = false;
	
	// Thread handling
	require_once( "lib/thread.lib.php" );
	
	// Get a thread
	$thread = getThread($CONR, -1, 3, true);
	
	// Length of thread
	$thread_length = 0;
	if( $thread != false ) {
	   $thread_length = count($thread);
	}
	
	echo "<h1>".sprintf($lang->get("thread_title2"),$thread_length)."</h1>\n";

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
