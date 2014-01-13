<?php

global $template;
$template->set_filenames( array('plugin_admin_content' => dirname(__FILE__).'/newusers.tpl') );
$template->assign_var_from_handle( 'ADMIN_CONTENT', 'plugin_admin_content');

// do we allow to create new piwigo users in case of auth along the ldap ?

// does he have to belong an ldap group ?

// does ldap groups give some power ?

// what do we do when there's no mail in the ldap ?

// do we send mail to admins ?
?>