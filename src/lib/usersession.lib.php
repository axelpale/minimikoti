<?php
// User session class

require_once( "lib/user.lib.php" );
require_once( "config/database.conf.php" );
require_once( "config/security.conf.php" );

class UserSession extends User {
	

// public:
	
	// Creates user from session data
	// Parameters:
	//   &$connection: MySQL-connection with SELECT-privilege
	public function __construct( &$connection ) {
		
		// default behaviour
		$this->logged_ = false;
				
		// If user id is not a number (normal visitor or bug)
		// or user id is zero or below (normal visitor)
		if( !is_numeric($_SESSION['uid']) || $_SESSION['uid'] < 1 ) {			
			// Create default user
			parent::__construct(0,"",DEFAULT_USER_LEVEL,true);
			return;
		}
		
		// Search for the user from database. Search is done only with uid
		// to lower sql-injection risk.
		$sql = "SELECT `id`, `name`, `level`, `session`, `ip` "
			. "FROM `".DB_TABLE_USER."` "
			. "WHERE `id`=".$_SESSION['uid'];
		$result = mysql_query( $sql, $connection );
		
		// Error in query
		if( $result === false || mysql_num_rows($result) != 1 ) {
			// Create default user
			parent::__construct(0,"",DEFAULT_USER_LEVEL,true);
			return;
		}
		
		// Read userdata from database.
		$user = mysql_fetch_assoc($result);
		
		// Compare database to local.
		if( $_SESSION['logged']
		    && $user['session'] === md5(session_id())
		    && $user['ip'] === md5($_SERVER['REMOTE_ADDR']) )
		{
			// set member variables
			$this->logged_ = true;
			parent::__construct($user['id'], $user['name'], $user['level'],true);
			return;
		}
		
		// Create default user
		parent::__construct(0,"",DEFAULT_USER_LEVEL,true);
	}
	
	public function logout() {
		// Log user out
		$this->logged_ = false;
		
		// Reset session variables
		$_SESSION['uid'] = null;
		$_SESSION['logged'] = null;
	}
	
	public function isLogged() {
		return $this->logged_;
	}	
	
// static public:
	
	// precondition
	//   -session_start() is executed 
	//   -connection is valid MySQL-connection with update-privilege
	static public function login( $username, $password, &$connection ) {
		
		// Add salt
		$password = PASSWORD_PRESALT.$password.PASSWORD_POSTSALT;
	
		// Escape properly
		$username = mysql_real_escape_string( $username, $connection );
		$password = mysql_real_escape_string( $password, $connection );

		// Search for the user
		$sql = "SELECT `id` "
			. "FROM `".DB_TABLE_USER."` "
			. "WHERE `name`='".$username."' "
			. "AND `pass`=AES_ENCRYPT('".$password."', '".PASSWORD_KEY."')";
		$result = mysql_query($sql, $connection);

		// If no or two or more users found, return false
		if( $result === false || mysql_num_rows($result) != 1) {
			return false;
		}
		
		// Fetch user ID
		$uid = mysql_result( $result, 0 );
				
		// Update user's session ID and IP-address
		$sid = session_id();
		$uip = $_SERVER['REMOTE_ADDR'];
		$sql = "UPDATE `".DB_TABLE_USER."` "
			. "SET `session`=MD5('".$sid."'), "
			. "`ip`=MD5('".$uip."') "
			. "WHERE `id`=".$uid;
		$result = mysql_query($sql, $connection);
		
		// Error
		if( !$result ) {
			echo "Error: updating user's session info failed.\n";
			return false;
		}
		
		// User logged in, set session variables
		$_SESSION['uid'] = $uid;
		$_SESSION['logged'] = true;

		return true;
	}
	
	
// private:
	
	private $logged_; // boolean
	
	
}

?>
