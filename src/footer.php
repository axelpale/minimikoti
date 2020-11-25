</div> <!-- local -->

<div class="footer">

<div class="top">

<div class="left">
&copy; <a href="http://www.asuntomessut.fi/" target="_blank">Suomen Asuntomessut</a> 2010
</div> <!-- left -->

<div class="right">
<a href="terms.php"><?php echo $lang->get("bread_terms"); ?></a>
<a href="contact.php"><?php echo $lang->get("bread_contact"); ?></a>
</div> <!-- right -->

</div> <!-- top -->

<div class="sitemap">

<div class="column01">
<a href="index.php"><?php echo $lang->get("bread_intro"); ?></a>
<a href="homes.php"><?php echo $lang->get("bread_homes"); ?></a>
<a href="project.php"><?php echo $lang->get("bread_project"); ?></a>
<a href="designers.php"><?php echo $lang->get("bread_designers"); ?></a>
<a href="contact.php"><?php echo $lang->get("bread_contact"); ?></a>
<br />
<?php
if( ENABLE_LOCALIZATION ) {
	// Change language
	if( $lang->getLanguage() == "fi" ) {
		echo "<a href=\"".$CURRENTPAGE."?lang=en\">In English</a>\n";
	} else {
		echo "<a href=\"".$CURRENTPAGE."?lang=fi\">Suomeksi</a>\n";
	}
}
?>
</div> <!-- column01" -->

<div class="column02">
<?php
   for($i=0; $i<8; $i++) {
      echo "<a href=\"home.php?hid=".$i."\">".$lang->getText("home".$i."_name")."</a>\n";
   }
?>
</div> <!-- column02" -->

<div class="column03">
<?php
	if( $user->isLogged() ) {
		echo "<a href=\"logout.exe.php\">";
		echo $lang->getText("footer_logout");
		echo "</a>\n";
		
		echo "<a href=\"manager.php\">";
		echo $lang->getText("footer_manager");
		echo "</a>\n";
	} else {
		echo "<a href=\"login.php\">";
		echo $lang->getText("footer_login");
		echo "</a>\n";
	}
?>
<a href="terms.php"><?php echo $lang->get("bread_terms"); ?></a>
<a href="site.php"><?php echo $lang->get("bread_site"); ?></a>
<br />
<a href="http://www.asuntomessut.fi/" target="_blank">Suomen Asuntomessut</a>
<a href="http://www.tut.fi/public/" target="_blank"><?php echo $lang->get("footer_tut"); ?></a>
<a href="http://www.tut.fi/index.cfm?siteid=178" target="_blank"><?php echo $lang->get("footer_archi"); ?></a>
<?php echo "<a href=\"".FACEBOOK_LINK."\" target=\"_blank\">" . $lang->get("footer_facebook") . "</a>\n"; ?>
</div> <!-- column03" -->

</div> <!-- sitemap -->

<div class="bottom"></div>

</div> <!-- footer -->

<?php
	// account information will show when user is logged in
	if( $user->isLogged() ) {
		echo "<div class=\"account\">\n";
		echo "minimikoti-projekti - ";
		echo "<a href=\"manager.php\">". $user->getName() ."</a> - ";
		echo "<a href=\"manager.php\">". $lang->getText("footer_manager") ."</a> - ";
		echo "<a href=\"logout.exe.php\">". $lang->getText("footer_logout") ."</a>\n";
		echo "</div>\n";
	}
?>

</div> <!-- container -->

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try{
var pageTracker = _gat._getTracker("UA-16344244-1");
pageTracker._trackPageview();
} catch(err) {}
</script>

</body>
</html>


<?php

// Close database-connection
mysql_close( $CONR );
?>
