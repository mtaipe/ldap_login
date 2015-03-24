<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

/*
*
*	Here we have everything if valid ldap users are allowed or not to connect to piwigo
*	Valid ldap users with no piwigo login can create their login this way.
*
*/

global $template;
$template->set_filenames( array('plugin_admin_content' => dirname(__FILE__).'/newusers.tpl') );
$template->assign(
  array(
    'PLUGIN_NEWUSERS' => get_root_url().'admin.php?page=plugin-Ldap_Login-newusers',
    ));

$me = new Ldap();
$me->load_config();

// do we allow new users to have a piwigo login created if they have a valid ldap login ?
$template->assign('ALLOW_NEWUSERS',	$me->config['allow_newusers']);

// do we send a mail to admins in case of new users ?
$template->assign('ADVERTISE_ADMINS',	$me->config['advertise_admin_new_ldapuser']);

// do we send the piwigo (!) password to the mail address provided by ldap ?
$template->assign('SEND_CASUAL_MAIL',	$me->config['send_password_by_mail_ldap']);

// Is there a restriction in the ldap users group ?
// Only members of this ldap group can log in !
$template->assign('USERS_GROUP',	$me->config['users_group']);

if (isset($_POST['save'])){

	$me->config['users_group'] = $_POST['USERS_GROUP'];

	if (isset($_POST['ALLOW_NEWUSERS'])){
		$me->config['allow_newusers'] = True;
	} else {
		$me->config['allow_newusers'] = False;
	}
	
	if (isset($_POST['ADVERTISE_ADMINS'])){
		$me->config['advertise_admin_new_ldapuser'] = True;
	} else {
		$me->config['advertise_admin_new_ldapuser'] = False;
	}
	
	if (isset($_POST['SEND_CASUAL_MAIL'])){
		$me->config['send_password_by_mail_ldap'] = True;
	} else {
		$me->config['send_password_by_mail_ldap'] = False;
	}
}

// Save LDAP configuration
if (isset($_POST['save'])){
	$me->save_config();
}

$template->assign_var_from_handle( 'ADMIN_CONTENT', 'plugin_admin_content');
?>