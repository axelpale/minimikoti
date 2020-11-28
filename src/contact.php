<?php
// Minimikoti
// contact.php

// Header
$TITLE = "contact_title";
$MENU_HIGHLIGHT = 4;
$BREADCRUMB = array(
	"bread_title" => "homes.php",
	"bread_contact" => "contact.php"
);
require_once( "header.php" );

echo "<h1>".$lang->get("contact_h1")."</h1>\n";

echo $lang->get("contact_text");

require_once( "footer.php" );
?>
