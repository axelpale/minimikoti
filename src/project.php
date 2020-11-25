<?php
// Minimikoti
// project.php

// Header
$TITLE = "project_title";
$MENU_HIGHLIGHT = 2;
$BREADCRUMB = array(
	"bread_title" => "homes.php",
	"bread_project" => "project.php"
);
$HEADER_INCLUDE = ""
. "<link rel=\"stylesheet\" "
. "href=\"css/project.css\" "
. "type=\"text/css\" media=\"screen\" />\n";
require_once( "header.php" );
?>

<h1>minimikoti?</h1>

<?php echo $lang->getText("project_description"); ?>

<?php
require_once( "footer.php" );
?>
