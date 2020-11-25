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
$HOME = new Home($_GET['hid'], $lang);

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

<div id="votes">
<?php echo sprintf($lang->getText("home_rating_count"),10); ?>
</div>

<script type="text/javascript">
	setPreset(5);
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

</div>
</div> <!-- others -->

<div class="bottom"></div>

<?php
// Footer
require_once( "footer.php" );
?>
