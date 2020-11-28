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
<a href="terms.php"><?php echo $lang->get("bread_terms"); ?></a>
<a href="site.php"><?php echo $lang->get("bread_site"); ?></a>
<br />
<a href="https://www.asuntomessut.fi/" target="_blank">Suomen Asuntomessut</a>
<a href="https://tutcris.tut.fi/portal/en/front.html" target="_blank"><?php echo $lang->get("footer_tut"); ?></a>
<a href="https://tutcris.tut.fi/portal/fi/organisations/school-of-architecture(d56a50f8-bb6a-49b6-908b-b6c58ae0ab7d).html" target="_blank"><?php echo $lang->get("footer_archi"); ?></a>
</div> <!-- column03" -->

</div> <!-- sitemap -->

<div class="bottom"></div>

</div> <!-- footer -->

</div> <!-- container -->

</body>
</html>
