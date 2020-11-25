<?php
// Minimikoti
// Account Handling

$TITLE = "Module Content - Editing";
$BREADCRUMB = array(
	"bread_title" => "homes.php",
	"bread_homes" => "homes.php"
);
require_once( "header.php" );

	// AUTHENTICATION SCRIPT HERE //
	
	// Libaries
	require_once( "lib/user.lib.php" );
	
	// Parameters
	$type = $_GET['type'];
	$uid = $_GET['uid'];
	$return = $_GET['return'];
	$cancel = $_GET['cancel'];
	
	if( is_null($cancel) ) {
		$cancel = $return;
	} 
	
	// Form action
	$action = "account.exe.php?type=".$type."&uid=".$uid."&return=".$return;
	
	// Cancel button
	//$html_cancel = "<input type=\"button\" value=\"Cancel\" onclick=\"history.back()\" /></div>\n";
?>
	
		<form action="<?php echo $action; ?>" method="post">
	
<?php
	// Different forms: login, logout, add, chname, chpw, ena, dis, remove
	switch( $type ) {
		case "login":
?>
			<div>
			<div>Username:</div>
			<div><input type='text' name='name' /></div>
			</div>

			<div>
			<div>Password:</div>
			<div><input type='password' name='pass' /></div>
			</div>

			<div><input type='submit' value='Log in' /></div>
<?php
			break;
		case "logout":
?>
			<div><input type="submit" value="Log out" /></div>
<?php
			break;
		case "add":
?>
			<div>
			<div>Username:</div>
			<div><input type='text' name='name' /></div>
			</div>

			<div>
			<div>Password:</div>
			<div><input type='password' name='pass' /></div>
			</div>

			<div><input type='submit' value='Create Account' /></div>
<?php
			break;
		case "chname":
			$user = User::getUser( $uid );
?>
			<div><input type="text" name="name" value="<?php echo $user['name']; ?>" /></div>
			<div><input type="submit" value="Save" /></div>
<?php
			break;
		case "chpw":
?>
			<div><input type="password" name="pass" /></div>
			<div><input type="submit" value="Save" /></div>
<?php
			break;
		case "ena":
?>
			<div><input type="submit" value="Enable" /></div>
<?php
			break;
		case "dis":
?>
			<div><input type="submit" value="Disable" /></div>
<?php
			break;
		case "remove":
?>
			<div><input type="submit" value="Remove Permanently" /></div>
<?php
			break;
		default:
?>
			<div>Error: unknown form type.</div>
<?php
	} // end switch
?>
		</form>
		<form action="<?php echo $cancel; ?>" method="get">
			<div><input type="submit" value="Cancel" /></div>
		</form>
	</body>
</html>
