<?php
/*
Plugin Name: Ldap_Login
Version: 1.0.1
Description: Allow piwigo authentication along an ldap
Plugin URI: 
Author: 22decembre
Author URI: http://www.22decembre.eu
*/
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

// +-----------------------------------------------------------------------+
// | Define plugin constants                                               |
// +-----------------------------------------------------------------------+
define('LDAP_LOGIN_ID',      basename(dirname(__FILE__)));
define('LDAP_LOGIN_PATH' ,   PHPWG_PLUGINS_PATH . LDAP_LOGIN_ID . '/');
define('LDAP_LOGIN_ADMIN',   get_root_url() . 'admin.php?page=plugin-' . LDAP_LOGIN_ID);
define('LDAP_LOGIN_VERSION', '1.0.1');

include_once(LDAP_LOGIN_PATH.'/class.ldap.php');

// +-----------------------------------------------------------------------+
// | Event handlers                                                        |
// +-----------------------------------------------------------------------+

add_event_handler('init', 'ldap_login_load_language');

add_event_handler('try_log_user','login', 0, 4);

add_event_handler('get_admin_plugin_menu_links', array(&$ldap, 'ldap_admin_menu'));

// +-----------------------------------------------------------------------+
// | Admin menu loading                                                    |
// +-----------------------------------------------------------------------+

$ldap = new Ldap();
$ldap->load_config();
set_plugin_data($plugin['id'], $ldap);
unset($ldap);

// +-----------------------------------------------------------------------+
// | functions                                                             |
// +-----------------------------------------------------------------------+

function ldap_login_load_language(){
	load_language('plugin.lang', LDAP_LOGIN_PATH);
}

function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}

function login($success, $username, $password, $remember_me){

$advertise_admin_new_ldapuser = False;
$send_password_by_mail_ldap = False;

	global $conf;
	
	$obj = new Ldap();
	$obj->load_config();
	$obj->ldap_conn() or die("Unable to connect LDAP server : ".$ldap->getErrorString());

	/* if (!empty($obj->config['ld_binddn']) && !empty($obj->config['ld_bindpw'])){ // if empty ld_binddn, anonymous search
		// authentication with rootdn and rootpw for dn search
		if (!$obj->ldap_bind_as($obj->config['ld_binddn'],$obj->config['ld_bindpw'])){
			return false;
		}
	} */

	if (!$obj->ldap_bind_as($username,$password)){ // bind with userdn
		trigger_action('login_failure', stripslashes($username));
		return false; // wrong password
	}

	// search user in piwigo database
$query = 'SELECT '.$conf['user_fields']['id'].' AS id FROM '.USERS_TABLE.' WHERE '.$conf['user_fields']['username'].' = \''.pwg_db_real_escape_string($username).'\' ;';

  $row = pwg_db_fetch_assoc(pwg_query($query));

  // if query is not empty, it means everything is ok and we can continue, auth is done !
  	if (!empty($row['id'])) {
  		log_user($row['id'], $remember_me);
  		trigger_action('login_success', stripslashes($username));
  		return true;
  	}
  	
  	// if query is empty but ldap auth is done, we can create a piwigo user if it's said so !
  	else {
  		//trigger_action('login_failure', stripslashes($username));
  		//return false;
  		//register_user($_POST['login'],$_POST['password'],$_POST['mail_address'],true,$page['errors'],isset($_POST['send_password_by_mail']));
  		if ($obj->ldap_mail($username)) {
			$mail = $ldap->ldap_mail($username);
  		}
  		else {
			$mail = $username.'@localhost';
  		}
  		register_user($username,random_password(8),$mail,$advertise_admin_new_ldapuser,$page['errors'],$send_password_by_mail_ldap);
  	}
}

?>