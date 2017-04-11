<?php 

class Auth {
	public static $password = '$2y$10$SLjwBwdOVvnMgWxvTI4Gb.YVcmDlPTpQystHMO2Kfyi/DS8rgA0Fm';

	// check() that returns a boolean if there is a logged in user (no matter if the user is guest or admin)
	public static function check() {
		return isset($_SESSION['logged_in_user']);
	}

	// user() method should return the string of the currently logged in user
	public static function user() {
		if(self::check()) {
			return $_SESSION['logged_in_user'];	
		} else {
			return false;
		}
	}

	// assign username to $_SESSION and return true if credentials are good
	// return false if there's any failure
	public static function attempt($username, $password) {
		// get the user object from the db or get null if they don't exist
		if($username == "admin" && password_verify($password, self::$password)) {
			$_SESSION['logged_in_user'] = $username;
			return true;
		} else {
			return false;
		}
	}

	public static function logout() {
		 // clear $_SESSION array
	    session_unset();

	    // ensure client is sent a new session cookie
	    session_regenerate_id();

	    // delete session data on the server
	    session_destroy();

	    // start a new session - session_destroy() ended our previous session so
	    // if we want to store any new data in $_SESSION we must start a new one
	    session_start();
	}
}





// attempt() should take in the attempted username and password
	// if good, set $_SESSION['logged_in_user'] to hold the username, then return true;
	// if not, return false;

// logout() method should destroy the session completely and make a new session
