<?php
// Minimikoti
// Home presentation
// home.php

// Parameter: $_GET['hid']
// Home ID-number
if( is_null( $_GET['hid'] ) ) {
	$_GET['hid'] = 1;
}

// Parameter: $_GET['pid']
// Picture (slide) ID-number
if( is_null( $_GET['pid'] ) ) {
	$_GET['pid'] = 1;
}

// Database and user initialization
require_once( "header-init.php" );

// Home functions and classes
require_once( "lib/home.lib.php" );

// Load home data
$HOME = new Home($_GET['hid'], $CONR, $lang);

// Header
$TITLE = "home". $_GET['hid'] ."_title";
$MENU_HIGHLIGHT = 1;
$BREADCRUMB = array(
	"bread_title" => "homes.php",
	"bread_homes" => "homes.php",
	$HOME->getTitle() => "home.php?hid=".$HOME->getId()
);
$HEADER_INCLUDE = ""
. "<script type=\"text/javascript\" src=\"lib/ratingsys.js\"></script>\n"
. "<link rel=\"stylesheet\" "
. "href=\"css/home.css\" "
. "type=\"text/css\" media=\"screen\" />\n"
. "<link rel=\"stylesheet\" "
. "href=\"css/thread.css\" "
. "type=\"text/css\" media=\"screen\" />\n";
require_once( "header-structure.php" );


?>

<div class="slideshow">
<div class="navigation">
<?php
	echo "<div class=\"title\">".$HOME->getTitle()."</div>\n";
	
	echo "<div class=\"numbers\">";
	
		
	$first = 1;
	$last = $HOME->getPictureCount(); // number of pictures
	$current = $_GET['pid'];
	$prev = max($current-1, $first);
	$next = min($current+1, $last);
	
	$link = "home.php?hid=". $_GET['hid'] ."&amp;pid=";
	$full = $HOME->getPictureSrc( $_GET['pid'], true );
	
	// Print arrow
	echo "<a href=\"". $link . $prev . "\" class=\"arrow\" title=\"".$lang->get("previous")."\">&lt;</a>\n";
	
	// Print slide numbers
	for( $i = $first; $i <= $last; $i++ ) {
		echo "<a href=\"". $link . $i ."\"";
		if( $i == $current ) echo " class=\"current\"";
		echo ">" . $i . "</a>\n";
	}
	
	// Print arrow
	echo "<a href=\"". $link . $next . "\" class=\"arrow\" title=\"".$lang->get("next")."\">&gt;</a>\n";
	
	echo "</div>\n";
?>
</div>

<div class="data">
<?php
	
	// Picture
	echo "<div class=\"picture\">\n";
	echo "<a href=\"". $full . "\" target=\"_blank\">\n";
	echo "<img src=\"" . $HOME->getPictureSrc( $_GET['pid'] ) . "\" "
	. "alt=\"". $HOME->getPictureTitle( $_GET['pid'] ) ."\" "
	. "title=\"". $HOME->getPictureTitle( $_GET['pid'] ) ."\" />";
	echo "</a>\n";
	echo "<div class=\"showfull\">"
	. "<a href=\"". $full ."\" target=\"_blank\">[".$lang->getText("home_showfull")."]</a>"
	. "</div>\n";
	echo "</div>\n";
	
	// Text
	echo $HOME->getPictureCaption( $_GET['pid'] );
	echo "<br />\n";
	
	// Languages
	$prev_lang = $lang->get( "previous" );
	$next_lang = $lang->get( "next" );
	
	// Link to next or previous slide
	if( $current != $first ) {
		echo " <a href=\"". $link . $prev . "\" title=\"".$prev_lang."\">[".$prev_lang."]</a>\n";
	}
	if( $current != $last ) {
		echo " <a href=\"". $link . $next . "\" title=\"".$prev_lang."\">[".$next_lang."]</a>\n";
	}
?>
</div>
<div class="bottom"></div>
</div> <!-- slideshow -->


<div id="rating" title="<?php echo $lang->get("home_rating_title"); ?>">
<h1><?php echo $lang->getText("home_rating"); ?></h1>

<!-- http://reignwaterdesigns.com/ad/tidbits/rateme/ -->
<div id="rateMe" title="Rate Me...">

<?php
	function buildStar( $counter, $title ) {
		return $string = ""
		. "<a href=\""
		. "vote.exe.php?hid=".$_GET['hid']."&amp;pid=".$_GET['pid']."&amp;points=".$counter
		. "\" "
		. "id=\"_".$counter."\" title=\"".$title."\" "
		. "onmouseover=\"rating(this)\" onmouseout=\"off(this)\">&nbsp;</a>\n";
	}
	
	// Build stars
	for($i = 1; $i <= 5; $i++) {
	   echo buildStar( $i, $lang->get("rating_".$i) );
	}
?>

</div>

<?php
//<!-- div id="rateStatus">
//</div -->

//<!--div>
//Rate <?php //echo round($HOME->getRating(true),2); >
//</div-->
?>

<div id="votes">
<?php echo sprintf($lang->getText("home_rating_count"),$HOME->getVotes()); ?>
</div>

<script type="text/javascript">
	setPreset( <?php echo round($HOME->getRating()); ?> );
</script>


</div> <!-- rating -->

<div id="others">
<h1><?php echo $lang->getText("home_other"); ?></h1>

<div>
<?php
// Desinger's name
echo "<div class=\"designer\">".$lang->getText("home_designer").": "
. "<a href=\"designers.php#design".$HOME->getId()."\"><span>". $HOME->getDesigner()."</span></a></div>\n";

// Create short filename
$filealias = str_replace(" ", "_", $HOME->getTitle()) . ".pdf";
//$info = pathinfo($HOME->getPdfSrc());

// PDF-file
echo "<div class=\"pdf\">\n"
	."<div>".$lang->getText("home_pdftext")."</div>\n"
	."<!-- http://www.adobe.com/ -->\n"
	."<img id=\"pdflogo\" src=\"graphics/pdficon_small.gif\" alt=\"Adobe PDF\" title=\"Adobe PDF\" />\n"
	."<a href=\"".$HOME->getPdfSrc()."\" target=\"_blank\">"
	.$filealias." ("
	.$HOME->getPdfFilesizeMB(1)." MB)"
	."</a>\n";
echo "</div>\n";
?>

<!-- http://www.addthis.com/ -->
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style">
<a href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4be08b7076ed7202" class="addthis_button_compact"><?php echo $lang->getText("home_share"); ?></a>
<span class="addthis_separator">|</span>
<a class="addthis_button_facebook"></a>
<a class="addthis_button_twitter"></a>
<a class="addthis_button_myspace"></a>
<a class="addthis_button_google"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4be08b7076ed7202"></script>
<!-- AddThis Button END -->


</div>
</div> <!-- others -->

<div class="bottom"></div>

<?php
if( DEFAULT_COMMENT_VIEW_LEVEL <= $user->getSecurityLevel() ) {
	// COMMENTING
	$ENABLE_COMMENTING = true;
	
	// Thread handling
	require_once( "lib/thread.lib.php" );
	
	// Get a thread
	$thread = getThread($CONR, $HOME->getId(), -1, true);
	
	// Length of thread
	$thread_length = 0;
	if( $thread != false ) {
	   $thread_length = count($thread);
	}
	
	// Echo thread
	echo "<div id=\"comments\" class=\"thread\">\n";
	
	if( strpos( $_GET["msg"], "home_comment") === 0 ) {
	   echo "<div class=\"notice\">".$lang->get($_GET["msg"])."</div>\n";
	}
	
	echo "<div class=\"title\">". $lang->getText("thread_title1") ." (".$thread_length.")</div>\n";

	// Print the thread
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
			   $pagecode = "hid=".$_GET['hid']."&amp;pid=".$_GET['pid']."&amp;postid=".$row['id'];
			   //$link_to_enable = "threadadmin.exe.php?type=ena&amp;".$pagecode;
			   //$link_to_disable = "threadadmin.exe.php?type=dis&amp;".$pagecode;
			   $link_to_delete = "threadadmin.exe.php?type=del&amp;".$pagecode;
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

	// Form for new comment
	if( $ENABLE_COMMENTING ) {
	
		echo "<div class=\"newpost\">\n";
		echo "<div class=\"title\">". $lang->getText("thread_comment_title") ."</div>\n";
		echo "<form action=\"thread.exe.php?"
			."hid=".$HOME->getId()."&amp;pid=".$_GET['pid']."\" method=\"post\">\n";
			
		echo "<div class=\"single\">\n";
		echo "<div class=\"caption\">".sprintf( $lang->getText("thread_nickname"), MIN_TOPIC_LENGTH, MAX_TOPIC_LENGTH )."</div>\n"
			."<div><input class=\"textinput\" type='text' name='topic' maxlength='30' /></div>\n";
		echo "</div>\n";
		
		echo "<div class=\"single\">\n";
		echo "<div class=\"caption\">".sprintf( $lang->getText("thread_comment"), MIN_DATA_LENGTH, MAX_DATA_LENGTH )."</div>\n"
			."<div><textarea name=\"body\" rows='3' cols='79'>\n"
			."</textarea></div>\n";
		echo "</div>\n";
?>

<div class="single">

<!-- http://www.phpcaptcha.org/ -->
<div id="captchaframes">
<img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
<div id="tools">

<a class="reload" tabindex="-1" href="#" title="Refresh Image" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?sid=' + Math.random(); return false"><?php echo $lang->getText("thread_captcha_reload"); ?></a>

<a class="reload" tabindex="-1" href="#" title="Refresh Image" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?sid=' + Math.random(); return false"><img src="securimage/images/refresh.gif" alt="Reload Image" onclick="this.blur()" /></a>

<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" title="Listen Captcha">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="movie" value="securimage/securimage_play.swf?audio=securimage_play.php&amp;bgColor1=#777&amp;bgColor2=#fff&amp;iconColor=#000&amp;roundedCorner=5" />
	<param name="quality" value="high" />

	<param name="bgcolor" value="#ffffff" />
	<embed src="securimage/securimage_play.swf?audio=securimage/securimage_play.php&amp;bgColor1=#777&amp;bgColor2=#fff&amp;iconColor=#000&amp;roundedCorner=5" quality="high" bgcolor="#ffffff" width="19" height="19" name="SecurImage_as3" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />

</object>


</div>
</div> <!-- captchaframes -->

<div class="caption"><?php echo $lang->getText("thread_captcha_tip"); ?></div>
<div><input class="textinput" type="text" name="captcha_code" maxlength="6" /></div>

</div>

<?php
		//echo "<span class=\"note\" id=\"limit\">Limit to 2-255 characters</span><br/><br/>\n";
		//echo "<div class=\"caption\">Kerro mitä lukee viereisessä kuvassa</div>\n"
		//	."<div><input type='text' name='captcha' /></div>\n";
?>

<div class="single">
<input id="submit" type='submit' value='<?php echo $lang->getText("thread_submit"); ?>' />
</div>

<div class="bottom"></div>

</form>
</div> <!-- newpost -->

<?php
	}
} // end of if userlevel check
?>


<?php
// Footer
require_once( "footer.php" );
?>
