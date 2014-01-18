<?php
/*
Plugin Name: Ldap_Login
Version: 1.0.1
Description: Permet de se logger via une authentification ldap
Plugin URI: http://www.22decembre.eu
Author: 22decembre
Author URI:http://www.22decembre.eu
___________________________________

Language Name: Dansk [DK]
*/
$lang['All LDAP users can use their ldap password everywhere on piwigo if needed.'] = 'Ldab bruger kan bruge ldap adgangskode overalt, de har brug.';
$lang['New users when ldap auth is successfull'] = 'Nye bruger i tilfælde af en vellykket ldap';
$lang['Ldap_Login Plugin'] = 'Ldap_Login Plugin';
$lang['Ldap_Login configuration'] = 'Ldap_Login konfiguration';
$lang['Warning: LDAP Extension missing.'] = 'Php-ldap udvidelse mangler.';

// ldap server connection

$lang['Ldap server host connection'] = 'Ldap server forbindelse';
$lang['If empty, standard protocol ports will be used by the software.'] = 'Hvis dette felt er tomt, standart protokol ip-port vil blev brugt.';
$lang['If empty, localhost and standard protocol ports will be used in configuration.'] = 'Hvis dette felterne er tomt, localhost og standart ip-port vil blev brugt.';
$lang['Ldap server host'] = 'LDAP server adresse';
$lang['Secure connexion'] = 'ssl forbindelse (ldaps)';
$lang['Ldap port'] = 'Ip-port hvor LDAP lytter';

// ldap attributes

$lang['Ldap attributes'] = 'Attributer ldap';
$lang['Base DN'] = 'Base DN hvor er brugerne (f.eks : ou=people,dc=example,dc=com)';
$lang['Ldap filter'] = '';
$lang['Attribute corresponding to the user name'] = 'Attribut der svarer til brugernavnet.';

// ldap connection credentials
$lang['Ldap connection credentials'] = 'Ldap forbindelse DN og adgangskode';
$lang['Let the fields blank if the ldap accept anonymous connections.'] = 'Lade felterne tomt hvid LDAP acceptere anonym forbindelser.';
$lang['Bind DN, field in full ldap style'] = 'Bind DN med den ldap stil (f.eks : cn=admin,dc=example,dc=com).';
$lang['Bind password'] = 'Adgangskode';

// test and save

$lang['Username'] = 'Din LDAP brugernavn.';
$lang['Your password'] = 'Din LDAP adgangskode.';
$lang['Ldap_Login Test'] = 'Ldap_Login Test';
$lang['You must save the settings with the Save button just up there before testing here.'] = 'Du skal gemme indstillingerne med knappen Gem lige deroppe før testning her';
$lang['Save'] = 'Gem';
$lang['Test Settings'] = 'Test instillingerne.';

// new piwigo users

$lang['If the LDAP doesn\'t furnish the mail address, users can set it up in the profile page.'] = 'Hvis LDAP ikke give mail addresse, brugerne kan give i profile side.';
$lang['Do you want to send mail to the new users, like casual piwigo users receive ?'] = 'Vil du send beskeder til nye bruger, ligesom tilfældige brugere modtager?';
$lang['Do you allow new piwigo users to be created when users authenticate succesfully on the ldap ?'] = 'Ønsker du at oprette nye brugere, når Ldap forbindelse er en succes?';
$lang['Do you want admins to be advertised by mail in case of new users creation upon ldap login ?'] = 'Vil du send beskeder til administratorer da vi oprette nye bruger ?';

?>