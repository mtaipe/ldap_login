<?php
/*
Plugin Name: Ldap_Login
Version: 1.0.1
Description: Permet de se logger via une authentification ldap
Plugin URI: http://www.22decembre.eu
Author: 22decembre
Author URI:http://www.22decembre.eu
___________________________________

Language Name: English [UK]
*/

$lang['New users when ldap auth is successfull'] = 'New users when ldap auth is successfull';
$lang['Ldap_Login Plugin'] = 'Ldap_Login Plugin';
$lang['Ldap_Login configuration'] = 'Ldap_Login configuration';
$lang['Warning: LDAP Extension missing.'] = 'Warning: LDAP Extension missing.';

// ldap server connection

$lang['If empty, standard protocol ports will be used by the software.'] = 'If empty, standard protocol ports will be used by the software.';
$lang['If empty, localhost will be used in configuration.'] = 'If empty, localhost will be used in configuration.';
$lang['Ldap server host'] = 'Ldap server host';
$lang['Secure connexion'] = 'Secure connexion (ldaps)';
$lang['Ldap port'] = 'Ldap port';

// ldap attributes

$lang['Base DN'] = 'Base DN where ldap users should be found (ex : ou=users,dc=example,dc=com) :';
$lang['Ldap filter :'] = 'Ldap filter :';
$lang['Attribute corresponding to the user name'] = 'Attribute corresponding to the user name';

// ldap connection credentials

$lang['Let the following fields blank if the ldap accept anonymous connections.'] = 'Let the following fields blank if the ldap accept anonymous connections.';
$lang['Bind DN, field in full ldap style'] = 'Bind DN in ldap style (for ex : cn=admin,dc=example,dc=com).';
$lang['Bind password'] = 'Bind password';

// test and save

$lang['Username'] = 'Votre ldap username';
$lang['Your password'] = 'Your LDAP password.';
$lang['Ldap_Login Test'] = 'Ldap_Login Test';
$lang['You must save the settings with the Save button just up there before testing here.'] = 'You need to save settings with the Save button just up there before testing them.';
$lang['Save'] = 'Save';
$lang['Test Settings'] = 'Test settings';

// new piwigo users

$lang['Do you want to send mail to the new users, like casual piwigo users receive ?'] = 'Do you want to send mail to the new users, like casual piwigo users receive ?';
?>