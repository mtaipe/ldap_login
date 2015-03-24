<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

/*
*
*	Here we have everything related to the basic ldap conf' of the plugin.
*
*/

global $template;
$template->set_filenames( array('plugin_admin_content' => dirname(__FILE__).'/configuration.tpl') );
$template->assign(
  array(
    'PLUGIN_ACTION' => get_root_url().'admin.php?page=plugin-ldap_login-configuration',
    'PLUGIN_CHECK' => get_root_url().'admin.php?page=plugin-ldap_login-configuration',
    ));

$me = new Ldap();
$me->load_config();
$me->ldap_conn();

// we start the template generation by feeding with the settings (defaults or read from config).
$template->assign('HOST', 	$me->config['host']);
$template->assign('BASEDN',	$me->config['basedn']); // racine !
$template->assign('USERSBRANCH',$me->config['usersbranch']);
$template->assign('GROUPBRANCH',$me->config['groupbranch']);
$template->assign('LD_SEARCH_USERS',$me->config['ld_search_users']);
$template->assign('LD_SEARCH_GROUPS',$me->config['ld_search_groups']);
$template->assign('PORT', 	$me->config['port']);
$template->assign('LD_ATTR',	$me->config['ld_attr']);
$template->assign('LD_GROUP',	$me->config['ld_group']);
$template->assign('LD_USE_SSL',	$me->config['ld_use_ssl']);
$template->assign('LD_BINDPW',	$me->config['ld_bindpw']);
$template->assign('LD_BINDDN',	$me->config['ld_binddn']);
$template->assign('WEBMASTERS_GROUP',	$me->config['webmasters_group']);
$template->assign('ADMINS_GROUP',	$me->config['admins_group']);

// if the user hit the save button...
if (isset($_POST['save'])){
	$me->config['host'] 	 = $_POST['HOST'];
	$me->config['basedn']    = $_POST['BASEDN'];
	$me->config['usersbranch']    = $_POST['USERSBRANCH'];
	$me->config['groupbranch']    = $_POST['GROUPBRANCH'];
	$me->config['port']      = $_POST['PORT'];
	$me->config['ld_attr']   = $_POST['LD_ATTR'];
	$me->config['ld_group']   = $_POST['LD_GROUP'];
	$me->config['ld_binddn'] = $_POST['LD_BINDDN'];
	$me->config['ld_bindpw'] = $_POST['LD_BINDPW'];
	
	$me->config['webmasters_group'] = $_POST['WEBMASTERS_GROUP'];
	$me->config['admins_group'] = $_POST['ADMINS_GROUP'];


	if (isset($_POST['LD_USE_SSL'])){
		$me->config['ld_use_ssl'] = True;
	} else {
		$me->config['ld_use_ssl'] = False;
	}
	
	if (isset($_POST['LD_SEARCH_GROUPS'])){
		$me->config['ld_search_groups'] = True;
	} else {
		$me->config['ld_search_groups'] = False;
	}
	
	if (isset($_POST['LD_SEARCH_USERS'])){
		$me->config['ld_search_users'] = True;
	} else {
		$me->config['ld_search_users'] = False;
	}
}

// Save LDAP configuration
if (isset($_POST['save'])){
	$me->save_config();
}

// Check LDAP configuration
// the user need to have saved his config to do that.
if (isset($_POST['check_ldap'])){

	if ($me->config['users_group']) {
		if ($me->user_membership($_POST['USERNAME'],$me->ldap_group($me->config['users_group']))) {
			if ($me->ldap_bind_as($_POST['USERNAME'],$_POST['PASSWORD'])){
				// search groups
				$group_query = 'SELECT name, id FROM '.GROUPS_TABLE.';';
				$groups = pwg_query($group_query);
				$sentence = '';
	
				foreach($groups as $group) {
					if($me->user_membership($_POST['USERNAME'], $me->ldap_group($group['name']))) {
						$sentence = $sentence . ', '.$group['name'];
					}
				}
				$template->assign('LD_CHECK_LDAP','<p style="color:green;">Configuration LDAP OK : '.$_POST['USERNAME'].' is in users'.$sentence.' group(s) and can auth. He is a '.$me->ldap_status($_POST['USERNAME']).' user according to the plugin.</p>');
			}
			else {
				$template->assign('LD_CHECK_LDAP','<p style="color:red;">Error : test '.$me->config['uri'].' '.$me->ldap_name($_POST['USERNAME']).'</p>');
			}
		}
	}
	else {
		if ($me->ldap_bind_as($_POST['USERNAME'],$_POST['PASSWORD'])){
			// search groups
			$group_query = 'SELECT name, id FROM '.GROUPS_TABLE.';';
			$groups = pwg_query($group_query);
			$sentence = '';
	
			foreach($groups as $group) {
				if($me->user_membership($_POST['USERNAME'], $me->ldap_group($group['name']))) {
					$sentence = $sentence . ', '.$group['name'];
				}
			}
			$template->assign('LD_CHECK_LDAP','<p style="color:green;">Configuration LDAP OK : '.$_POST['USERNAME'].' is in group(s) '.$sentence.' and can auth. He is a '.$me->ldap_status($_POST['USERNAME']).' user according to the plugin.</p>');
		}
		else {
			$template->assign('LD_CHECK_LDAP','<p style="color:red;">Error : test '.$me->config['uri'].' '.$me->ldap_name($_POST['USERNAME']).'</p>');
		}
	}
}

$template->assign_var_from_handle( 'ADMIN_CONTENT', 'plugin_admin_content');
?>