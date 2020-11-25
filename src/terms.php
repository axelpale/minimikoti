<?php
// Minimikoti
// terms.php

// Header
$TITLE = "terms_title";
$BREADCRUMB = array(
	"bread_title" => "homes.php",
	"bread_terms" => "terms.php"
);
require_once( "header.php" );
?>

<h1><?php echo $lang->get("terms_h1"); ?></h1>

<?php
echo $lang->getText("terms_text");
?>


<?php
require_once( "footer.php" );
?>
