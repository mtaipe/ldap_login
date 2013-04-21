<?php
/*
Plugin Name: Ldap_Login
Version: 0.1
Description: Permet de se logger via une authentification ldap
Plugin URI: http://www.22decembre.eu
Author: 22decembre
Author URI:http://www.22decembre.eu
*/

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

add_event_handler('try_log_user','ldap_login', 0, 4);

function ldap_login($success, $username, $password, $remember_me)
{

  global $conf;
    $query = '
SELECT '.$conf['user_fields']['id'].' AS id FROM '.USERS_TABLE.' WHERE '.$conf['user_fields']['username'].' = \''.pwg_db_real_escape_string($username).'\'
;';

  $row = pwg_db_fetch_assoc(pwg_query($query));

    // Vérification de l'authentification
    if (ldap_log($username,$password)) {

	log_user($row['id'], $remember_me);
	trigger_action('login_success', stripslashes($username));
	return true;
	}
    else
    {
    trigger_action('login_failure', stripslashes($username));
    return false;
    }
}

function ldap_log($user,$pass)
{
$obj = new Ldap();
$obj->load_config();

// Eléments d'authentification LDAP
$ldaprdn  = $obj->config['pref'].$user.$obj->config['basedn'];     // DN ou RDN LDAP

// Connexion au serveur LDAP
$ldapconn = ldap_connect($obj->config['host'])
    or die("Impossible de se connecter au serveur LDAP.");
    
ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

if ($ldapconn) {

    // Connexion au serveur LDAP
    $ldapbind = @ldap_bind($ldapconn, $ldaprdn, $pass);
    
    // Vérification de l'authentification
    if ($ldapbind) {
       // Connexion LDAP réussie
	return true;
    } else {
       // Connexion LDAP échouée
      return false;
    }

}
}

class Ldap
{
    var $config;
    function load_config()
    {
        $x = @file_get_contents( dirname(__FILE__).'/data.dat' );
        if ($x!==false)
        {
            $c = unserialize($x);
            // do some more tests here
            $this->config = $c;
        }
 
        if ( !isset($this->config))
        {
            $this->config['host']	= 'localhost';
	    $this->config['basedn']	= ',ou=people,dc=example,dc=com';
            $this->config['pref']	= 'uid=';
            $this->save_config();
        }
    }
    function save_config()
    {
        $file = fopen( dirname(__FILE__).'/data.dat', 'w' );
        fwrite($file, serialize($this->config) );
        fclose( $file );
    }

    function ldap_admin_menu($menu)
    {
    array_push($menu,
	array(
	'NAME' => 'Ldap Login',
	'URL' => get_admin_plugin_menu_link(dirname(__FILE__).'/admin/ldap_login_plugin_admin.php') )
	);
      
    return $menu;
    }
}

$ldap = new Ldap();
$ldap->load_config();
add_event_handler('get_admin_plugin_menu_links', array(&$ldap, 'ldap_admin_menu'));
set_plugin_data($plugin['id'], $ldap);

?>
