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
	new Home(0, $lang),
	new Home(1, $lang),
	new Home(2, $lang),
	new Home(3, $lang),
	new Home(4, $lang),
	new Home(5, $lang),
	new Home(6, $lang),
	new Home(7, $lang)
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
require_once( "footer.php" );
?>
