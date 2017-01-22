<?php 
/*
 *	                  ....
 *	                .:   '':.
 *	                ::::     ':..
 *	                ::.         ''..
 *	     .:'.. ..':.:::'    . :.   '':.
 *	    :.   ''     ''     '. ::::.. ..:
 *	    ::::.        ..':.. .''':::::  .
 *	    :::::::..    '..::::  :. ::::  :
 *	    ::'':::::::.    ':::.'':.::::  :
 *	    :..   ''::::::....':     ''::  :
 *	    :::::.    ':::::   :     .. '' .
 *	 .''::::::::... ':::.''   ..''  :.''''.
 *	 :..:::'':::::  :::::...:''        :..:
 *	 ::::::. '::::  ::::::::  ..::        .
 *	 ::::::::.::::  ::::::::  :'':.::   .''
 *	 ::: '::::::::.' '':::::  :.' '':  :
 *	 :::   :::::::::..' ::::  ::...'   .
 *	 :::  .::::::::::   ::::  ::::  .:'
 *	  '::'  '':::::::   ::::  : ::  :
 *	            '::::   ::::  :''  .:
 *	             ::::   ::::    ..''
 *	             :::: ..:::: .:''
 *	               ''''  '''''
 *	
 *
 *	AUTOMAD
 *
 *	Copyright (c) 2016-2017 by Marc Anton Dahmen
 *	http://marcdahmen.de
 *
 *	Licensed under the MIT license.
 *	http://automad.org/license
 */


namespace Automad\GUI;


defined('AUTOMAD') or die('Direct access not permitted!');


/**
 *	The User class provides all methods related to a user account. 
 *
 *	@author Marc Anton Dahmen
 *	@copyright Copyright (c) 2016-2017 Marc Anton Dahmen - http://marcdahmen.de
 *	@license MIT license - http://automad.org/license
 */

class User {
	
	
	/**
	 *	Change the password of the currently logged in user based on $_POST.
	 *
	 *	@return $output (error/success)
	 */
	
	public static function changePassword() {
		
		$output = array();

		if (!empty($_POST['current-password']) && !empty($_POST['new-password1']) && !empty($_POST['new-password2'])) {
	
			if ($_POST['new-password1'] == $_POST['new-password2']) {
		
				if ($_POST['current-password'] != $_POST['new-password1']) {
			
					// Get all accounts from file.
					$accounts = Accounts::get();
			
					if (Accounts::passwordVerified($_POST['current-password'], $accounts[User::get()])) {
				
						// Change entry for current user with accounts array.
						$accounts[User::get()] = Accounts::passwordHash($_POST['new-password1']);
					
						// Write array with all accounts back to file.
						if (Accounts::write($accounts)) {
					
							$output['success'] = Text::get('success_password_changed'); 
					
						} else {
					
							$output['error'] = Text::get('error_permission') . '<p>' . AM_FILE_ACCOUNTS . '</p>';
				
						}
				
					} else {
				
						$output['error'] = Text::get('error_password_current');
				
					}
						
				} else {
			
					$output['error'] = Text::get('error_password_reuse');
			
				}
		
			} else {
		
				$output['error'] = Text::get('error_password_repeat');
		
			}
	
		} else {
	
			$output['error'] = Text::get('error_form');
	
		}
		
		return $output;
		
	}
	
	
	/**
	 *	Return the currently logged in user.
	 * 
	 *	@return username
	 */

	public static function get() {
		
		if (isset($_SESSION['username'])) {
			return $_SESSION['username'];
		}
		
	}
	
	
	/**
	 *	Verify login information based on $_POST.
	 *
	 *	@return Error message in case of an error.
	 */
	
	public static function login() {
		
		if (!empty($_POST)) {
			
			if (!empty($_POST['username']) && !empty($_POST['password'])) {
	
				$username = $_POST['username'];
				$password = $_POST['password'];
				$accounts = Accounts::get();
	
				if (isset($accounts[$username]) && Accounts::passwordVerified($password, $accounts[$username])) {
		
					session_regenerate_id(true);
					$_SESSION['username'] = $username;
					header('Location: ' . $_SERVER['REQUEST_URI']);
					die;
		
				} else {
		
					return Text::get('error_login');
		
				}
		
			} else {
		
				return Text::get('error_login');
		
			}
			
		}
		
	}
	
	
	/**
	 *	Log out user.
	 *
	 *	@return true on success.
	 */
	
	public static function logout() {
		
		unset($_SESSION);
		$success = session_destroy();
		
		if (!isset($_SESSION) && $success) {
			return true;
		} else {
			return false;
		}
		
	}
	
	
}


?>