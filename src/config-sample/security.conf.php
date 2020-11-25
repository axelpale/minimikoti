<?php

// AES-128 encryption key used in user passwords.
define( PASSWORD_KEY, "12345678" );

// AES-128 encryption key used in other user information.
define( ENCRYPTION_KEY, "12345678" );

// Password pre- and postsalt
define( PASSWORD_PRESALT, "1234" );
define( PASSWORD_POSTSALT, "1234" );

// Defines how many times an user can try to log in before login-feature locks
// up. Counter is set back to zero when user logs in successfully. Makes brute
// force attacks more difficult.
define( ENABLE_LOGIN_LOCK, false );
define( MAX_FAILED_LOGINS, "100" );

// DEFAULT_USER_LEVEL defines default security level for non-registered user
// DEFAULT_PAGE_LEVEL defines default security level for a page
define( DEFAULT_USER_LEVEL, 0 );
define( DEFAULT_PAGE_LEVEL, 0 );
define( DEFAULT_COMMENT_VIEW_LEVEL, 0 );
define( DEFAULT_COMMENT_ADMIN_LEVEL, 2 );

// Page where to forward after successful login
define( LOGIN_SUCCESS_FORWARD, "manager.php" );

// Page where to forward on failed login or unauthorized user
define( LOGIN_FAILURE_FORWARD, "login.php" );

// Page where to forward on unauthorized user
define( UNAUTHORIZED_FORWARD, "login.php" );

// Page where to forward on unauthorized user when normal login page can not
// be used
define( UNAUTHORIZED_FORWARD_2, "public_login.php" );

?>
