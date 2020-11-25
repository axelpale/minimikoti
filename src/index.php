<?php
  // Minimikoti website
  // Copyright (C) 2010 Akseli Palén
  //
  // This program is free software: you can redistribute it and/or modify
  // it under the terms of the GNU General Public License as published by
  // the Free Software Foundation, either version 3 of the License, or
  // (at your option) any later version.
  //
  // This program is distributed in the hope that it will be useful,
  // but WITHOUT ANY WARRANTY; without even the implied warranty of
  // MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  // GNU General Public License for more details.
  //
  // You should have received a copy of the GNU General Public License
  // along with this program.  If not, see <https://www.gnu.org/licenses/>.

	// There's a possibility that this page needs logging in,
	// for example in test phase.
	require_once( "header-init.php" );

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fi" xml:lang="fi">
<head>
	<title>Minimikoti</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="Minimikoti-projektin kotisivut, homepages of project Minimikoti" />
	<meta name="keywords" content="minimikoti, minimum, home, architecture, TUT, TTY, Asuntomessut, arkkitehtuuri" />

	<link rel="stylesheet" href="css/index.css" type="text/css" media="screen" />

	<link rel="apple-touch-icon" href="apple-touch-icon.png" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

	<script type="text/javascript">
	<!--
	function mouseOver() {
		document.getElementById("logo").src = "graphics/minimilogo_hover.png";
	}
	function mouseOut() {
		document.getElementById("logo").src = "graphics/minimilogo.png";
	}
	//-->
	</script>

</head>
<body>

<div class="container">

<div class="banner">

<a href="homes.php">
<img id="logo" src="graphics/minimilogo.png" title="Minimikoti" alt="Minimikoti" onmouseover="mouseOver()" onmouseout="mouseOut()" />
</a>

</div> <!-- banner -->


</div> <!-- container -->

<div class="footer">
<a href="homes.php">jatka koteihin&nbsp;&gt;&gt;</a>
<?php
	// offer single link to english language
	if( ENABLE_LOCALIZATION ) {
		echo "<a href=\"homes.php?lang=en\" xml:lang=\"en\">in english&nbsp;&gt;&gt;</a>\n";
	}
?>
</div> <!-- footer -->

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
