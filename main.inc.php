<?php
/*
Plugin Name: Ldap_Login
Version: 0.3
Description: Permet de se logger via une authentification ldap
Plugin URI: http://www.22decembre.eu
Author: 22decembre
Author URI:http://www.22decembre.eu
*/
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

define('LDAP_LOGIN_PATH' , PHPWG_PLUGINS_PATH.basename(dirname(__FILE__)).'/');
include_once(LDAP_LOGIN_PATH.'/class.ldap.php');

add_event_handler('init', 'ldap_login_load_language');
function ldap_login_load_language(){
	load_language('plugin.lang', LDAP_LOGIN_PATH);
}

add_event_handler('try_log_user','ldap_login', 0, 4);

function ldap_login($success, $username, $password, $remember_me){

	global $conf;

	$obj = new Ldap();
	$obj->load_config();
	$obj->ldap_conn() or die("Impossible de se connecter au serveur LDAP: ".$obj->getErrorString());

	if (!empty($obj->config['ld_binddn']) && !empty($obj->config['ld_bindpw'])){ // if empty ld_binddn, anonymous search
		// authentication with rootdn and rootpw for dn search
		if (!$obj->ldap_bind_as($obj->config['ld_binddn'],$obj->config['ld_bindpw'])){
			return false;
		}
	}

	if (!$obj->ldap_bind_as($username,$password)){ // bind with userdn
		trigger_action('login_failure', stripslashes($username));
		return false; // wrong password
	}

	// search user in piwigo database
    $query = '
SELECT '.$conf['user_fields']['id'].' AS id FROM '.USERS_TABLE.' WHERE '.$conf['user_fields']['username'].' = \''.pwg_db_real_escape_string($username).'\'
;';

  $row = pwg_db_fetch_assoc(pwg_query($query));

  	if (!empty($row['id'])) {
  		log_user($row['id'], $remember_me);
  		trigger_action('login_success', stripslashes($username));
  		return true;
  	} else {
  		trigger_action('login_failure', stripslashes($username));
  		return false;
  	}
}

$ldap = new Ldap();
$ldap->load_config();
add_event_handler('get_admin_plugin_menu_links', array(&$ldap, 'ldap_admin_menu'));
set_plugin_data($plugin['id'], $ldap);

?>
