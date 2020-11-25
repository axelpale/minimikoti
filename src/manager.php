<?php
// Minimikoti
// manager.php

// Header
$TITLE = "manager_title";
$SECURITY_LEVEL = 1;
$BREADCRUMB = array(
	"bread_title" => "homes.php",
	"bread_manager" => "manager.php"
);
require_once( "header.php" );

require_once( "lib/thread.lib.php" );
?>

<h1>Tila</h1>
<div>Kommentteja näkyvillä: <?php echo countThread($CONR); ?>
&nbsp;<a href="comments.php">näytä kommentit</a>
</div>
<div>Poistettuja kommentteja: <?php echo countDiscarded($CONR); ?></div>

<h1>Kommenttien hallinta</h1>

<p>
Kommentteja poistetaan samoista paikoista, joissa niitä voi lukea. Helpoin tapa on siirtyä kodin esittelysivulle ja tarkastella sivun alaosassa näkyviä kommentteja. Sisäänkirjautuneelle käyttäjälle näytetään kommenttien otsikon alla punertava palkki, jossa on poista-linkki. Painamalla tätä linkkiä kommentti poistuu.
</p>

<p>
Kommenttien poistaminen on tarkoitettu häiritsevien tai herjaavien kommenttien poistamiseen. Ominaisuutta ei ole sopivaa käyttää kritisoivan palautteen karsimiseen, eteenkin jos palaute on esitetty asiallisesti.
</p>

<h2>Sivuja, joilla on kommentteja:</h2>

<p>
<div><a href="homes.php"><?php echo $lang->getText("bread_homes"); ?> (etusivu)</a></div>
<div><a href="comments.php"><?php echo $lang->getText("bread_comments"); ?></a></div>
</p>

<p>
<?php
   for($i=0; $i<8; $i++) {
      echo "<div><a href=\"home.php?hid=".$i."\">".$lang->getText("home".$i."_name")."</a></div>\n";
   }
?>
</p>

<?php
require_once( "footer.php" );
?>
