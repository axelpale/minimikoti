<?php
// Minimikoti
// terms.php

// Header
$TITLE = "site_title";
$BREADCRUMB = array(
	"bread_title" => "homes.php",
	"bread_site" => "site.php"
);
require_once( "header.php" );
?>

<h1><?php echo $lang->get("site_h1"); ?></h1>

<?php
echo $lang->getText("site_text");
?>

<p>
   <a href="http://validator.w3.org/check?uri=referer">
   <img style="border:0;width:88px;height:31px" src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" />
   </a>
</p>

<p>
   <a href="http://jigsaw.w3.org/css-validator/check/referer">
   <img style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!" />
   </a>
</p>



<?php
require_once( "footer.php" );
?>
