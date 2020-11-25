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
?>


<h1>Lisää käyttäjä</h1>

<h1><?php echo "Lisää käyttäjä"; ?></h1>

<form action='account.exe.php?type=add' onsubmit='return validateForm(this)' method='post'>

<?php echo TEXT_ACCOUNT_USER_NAME; ?>:<br/>
<input type='text' id='namefield' name='name' maxlength=32 onfocus='this.select()' onkeyup='checkUsername(this)' /><br/>
<span class="note" id="note1">Characters: a-z A-Z 0-9 åäö ÅÄÖ</span><br/>
<span class="note" id="note6">Length: 2-32 characters</span><br/>
<br/>

<?php echo TEXT_ACCOUNT_USER_PASSWORD; ?> <span class="note" id="note2">(twice)</span>:<br/>
<input type='password' id='codefield1' name='pword1' maxlength=16 onfocus='this.select()' onkeyup='checkPasswords()' /><br/>
<input type='password' id='codefield2' name='pword2' maxlength=16 onfocus='this.select()' onkeyup='checkPasswords()' /><br/>
<span class="note" id="note3">Characters: a-z A-Z 0-9 åäö ÅÄÖ</span><br/>
<span class="note" id="note5">Length: 8-16 characters</span><br/>
<span class="note" id="note4">Cannot be same as your nickname</span><br/>
<br/>

<input type='submit' value='Create Account' />

</form>

<script type='text/javascript'>
//<!--
	document.getElementById('namefield').focus();
//-->
</script>


<?php
require_once( "footer.php" );
?>
