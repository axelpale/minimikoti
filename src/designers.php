<?php
// Minimikoti
// designers.php

// Header
$TITLE = "designers_title";
$MENU_HIGHLIGHT = 3;
$BREADCRUMB = array(
	"bread_title" => "homes.php",
	"bread_designers" => "designers.php"
);
$HEADER_INCLUDE = ""
. "<link rel=\"stylesheet\" "
. "href=\"css/designers.css\" "
. "type=\"text/css\" media=\"screen\" />\n";
require_once( "header.php" );

// Include home data
require_once( "lib/home.lib.php" );
require_once( "config/homedata.conf.php" );

// Get designers from homes, order by family name
$home = array();
array_push( $home,
	new Home(4, false, $lang),
	new Home(6, false, $lang),
	new Home(1, false, $lang),
	new Home(2, false, $lang),
	new Home(5, false, $lang),
	new Home(3, false, $lang),
	new Home(7, false, $lang),
	new Home(0, false, $lang)
);

echo "<h1>".$lang->get("designers_h1")."</h1>\n";

// Echoes one designer. Uses homedata
function echoDesigner( $item ) {
	$d = $item->getDesigner();
	echo "<div id=\"design".$item->getId()."\" class=\"designer\">\n";
	echo "<img src=\"".$item->getDesignerFaceSrc()."\" alt=\"".$d."\" title=\"".$d."\" />\n";
	echo "<div class=\"name\">".$d."</div>\n";
	echo "<div class=\"home\">"
	. "<a href=\"home.php?hid=".$item->getId()."\">".$item->getTitle()."</a>"
	. "</div>\n";
	if( $item->isEmailEnabled() ) {
		global $lang;
		echo "<div class=\"emailtitle\">".$lang->getText("designers_email")."</div>\n";
		echo "<div class=\"email\">".$item->getEmail()."</div>\n";
	}
	echo "</div>\n";
}

echo "<div>\n";

echo "<div class=\"column\">\n";
echoDesigner( $home[0] );
echoDesigner( $home[1] );
echoDesigner( $home[2] );
echoDesigner( $home[3] );
echo "</div> <!-- column -->\n";

echo "<div class=\"column\">\n";
echoDesigner( $home[4] );
echoDesigner( $home[5] );
echoDesigner( $home[6] );
echoDesigner( $home[7] );
echo "</div> <!-- column -->\n";

echo "<div class=\"bottom\"></div>\n";

echo "</div>\n";

// Email help
echo "<div class=\"emailtip\">\n";
echo $lang->getText("designers_emailtip");
echo "</div>\n";

?>
<?php
require_once( "footer.php" );
?>
