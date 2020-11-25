<?php

// HTML structure header


// Parameter: $TITLE
if( is_null( $TITLE ) ) {
	$TITLE = "default_title";
}

// Parameter: $MENU_HIGHLIGHT
// Number of menu element to highlight (class = current)
if( is_null( $MENU_HIGHLIGHT ) ) {
	$MENU_HIGHLIGHT = 0;
}

// Parameter: $BREADCRUMB
if( is_null( $BREADCRUMB ) ) {
	$BREADCRUMB = array(
		"bread_title" => "homes.php"
	);
}

// Parameter: $HEADER_INCLUDE
// If the page needs something extra in <head>-part
if( is_null( $HEADER_INCLUDE ) ) {
	$HEADER_INCLUDE = "";
}



// Localize breadcrumb keys
foreach ($BREADCRUMB as $key => $value) {
	unset ($BREADCRUMB[$key]);
	$new_key = $lang->getText($key);
	$BREADCRUMB[$new_key] = $value;
}

// Breadcrumb
require_once( "lib/breadcrumb.lib.php" );
$bread = new Breadcrumb( " > ", $BREADCRUMB );

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fi" xml:lang="fi">
<head>
	<title><?php echo $lang->getText($TITLE); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="Minimikoti-projektin kotisivut, homepages of project Minimikoti" />
	<meta name="keywords" content="minimikoti, minimum, home, architecture, TUT, TTY, Asuntomessut, arkkitehtuuri" />

	<link rel="apple-touch-icon" href="apple-touch-icon.png" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

	<link rel="stylesheet" href="css/structure.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/basic.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/header.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/footer.css" type="text/css" media="screen" />

	<?php echo "\n".$HEADER_INCLUDE."\n"; ?>

</head>
<body>

<div class="container">

<div id="message">
<?php echo $lang->get($_GET['msg']); ?>
</div>

<img id="bgimage" src="graphics/minimilogo_bg.png" alt="minimikoti" />

<div class="banner">
<a href="homes.php">
<img src="graphics/banner.png" title="<?php echo $lang->get("banner_title"); ?>" alt="M I N I M I K O T I" />
</a>
</div> <!-- banner -->


<div class="mainmenu">

<a <?php if($MENU_HIGHLIGHT == 1) echo "class=\"current\""; ?> href="homes.php"><?php echo $lang->getText("menu_homes"); ?></a>
<a <?php if($MENU_HIGHLIGHT == 2) echo "class=\"current\""; ?> href="project.php"><?php echo $lang->getText("menu_project"); ?></a>
<a <?php if($MENU_HIGHLIGHT == 3) echo "class=\"current\""; ?> href="designers.php"><?php echo $lang->getText("menu_designers"); ?></a>
<a <?php if($MENU_HIGHLIGHT == 4) echo "class=\"current\""; ?> href="contact.php"><?php echo $lang->getText("menu_contact"); ?></a>

</div> <!-- menu -->


<div class="navigation">

<div class="path">
<?php echo $bread->getBreadcrumb( true ); ?>
</div> <!-- path -->

<div class="language">
<?php
if( ENABLE_LOCALIZATION ) {
	// Build gets
	$link = $CURRENTPAGE."?";
	foreach( $_GET as $key => &$param ) {
		$link .= $key."=".$param."&amp;";
	}
	$link .= "lang=";

	// Change language
	if( $lang->getLanguage() == "fi" ) {
		echo "<a href=\"".$link."en\" xml:lang=\"en\">in english</a>\n";
	} else {
		echo "<a href=\"".$link."fi\" xml:lang=\"fi\">suomeksi</a>\n";
	}
}
?>
</div> <!-- language -->

</div> <!-- navigation -->

<div class="local">
