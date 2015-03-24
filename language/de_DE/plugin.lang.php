<?php
// +-----------------------------------------------------------------------+
// | Piwigo - a PHP based photo gallery                                    |
// +-----------------------------------------------------------------------+
// | Copyright(C) 2008-2014 Piwigo Team                  http://piwigo.org |
// | Copyright(C) 2003-2008 PhpWebGallery Team    http://phpwebgallery.net |
// | Copyright(C) 2002-2003 Pierrick LE GALL   http://le-gall.net/pierrick |
// +-----------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify  |
// | it under the terms of the GNU General Public License as published by  |
// | the Free Software Foundation                                          |
// |                                                                       |
// | This program is distributed in the hope that it will be useful, but   |
// | WITHOUT ANY WARRANTY; without even the implied warranty of            |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU      |
// | General Public License for more details.                              |
// |                                                                       |
// | You should have received a copy of the GNU General Public License     |
// | along with this program; if not, write to the Free Software           |
// | Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, |
// | USA.                                                                  |
// +-----------------------------------------------------------------------+
$lang['Attribute corresponding to the user name'] = 'Attribute entsprechend des Benutzernamens';
$lang['All LDAP users can use their ldap password everywhere on piwigo if needed.'] = 'Alle LDAP-Benutzer können ihr LDAP-Passwort falls es notwendig ist auch für Piwigo benutzen.';
$lang['Base DN'] = 'Base DN wo LDAP-Benutzer gefunden werden sollen (zB.: ou=users,dc=example,dc=com):';
$lang['Bind DN, field in full ldap style'] = 'Bind DN im LDAP-Style (z.B.: cn=admin,dc=example,dc=com).';
$lang['Do you want admins to be advertised by mail in case of new users creation upon ldap login ?'] = 'Möchtest du das die Admins per Mail benachrichtigt werden, wenn neue Nutzer über das LDAP Login angelegt werden.';
$lang['Do you want to send mail to the new users, like casual piwigo users receive ?'] = 'Möchtest du die Mails so an die neuen Nutzern senden, wie sie normale Piwigo Benutzer bekommen?';
$lang['Ldap connection credentials'] = 'LDAP-Verbindungsreferenzen';
$lang['Username'] = 'Bitte LDAP Benutzername';
$lang['New users when ldap auth is successfull'] = 'Neuer Benutzer, wenn LDAP Auth erfolgreich war';
$lang['Warning: LDAP Extension missing.'] = 'Warnung: LDAP Erweiterung fehlt.';
$lang['Secure connexion'] = 'Sichere Verbindung (ldaps)';
$lang['Ldap port'] = 'LDAP-Port';
$lang['Ldap server host'] = 'LDAP-Server';
$lang['Bind password'] = 'Bind passwort';
$lang['Ldap server host connection'] = 'LDAP Serververbindung';
$lang['Ldap_Login Plugin'] = 'LDAP-Login Plugin';
$lang['Ldap_Login Test'] = 'LDAP-Login Test';
$lang['Ldap_Login configuration'] = 'LDAP-Login Konfiguration';
$lang['Save'] = 'Speichern';
$lang['Test Settings'] = 'Test-Einstellungen';
$lang['You must save the settings with the Save button just up there before testing here.'] = 'Du musst die Einstellungen erst speichern, bevor du sie testen kannst.';
$lang['Your password'] = 'Dein LDAP Passwort.';
$lang['Do you allow new piwigo users to be created when users authenticate succesfully on the ldap ?'] = 'Erlauben Sie, dass neue Piwigo-Benutzer angelegt werden, wenn sie erfolgreich bei LDAP authentifiziert wurden?';
$lang['If empty, standard protocol ports will be used by the software.'] = 'Wenn leer werden die Standard-Protokoll-Ports von der Software benutzt.';
$lang['If empty, localhost and standard protocol ports will be used in configuration.'] = 'Wenn leer werden localhost und die Standard-Protokoll-Ports in der Konfiguration benutzt.';
$lang['Let the fields blank if the ldap accept anonymous connections.'] = 'Das Feld leer lassen, wenn LDAP auch anonyme Verbindungen erlauben soll.';
$lang['Groups branch'] = 'Zweig der LDAP User (z.B.: ou=groups)';
$lang['If you create a <a href="admin.php?page=group_list">piwigo group</a> with the same name as an ldap one, all members of the ldap group will automatically join the piwigo group at their next authentication. This allows you to create <a href="admin.php?page=help&section=groups">specific right access management</a> (restrict access to a particaular album...).'] = 'Wenn sie eine <a href="admin.php?page=group_list">Piwigo Gruppe</a> mit dem gleichen Name wie die LDAP Gruppe erstellen, werden alle Mitgleider dieser Gruppe zu Mitgliedern der Piwigo Gruppe (bei der nächsten Anmeldung). Das erlaubt eine <a href="admin.php?page=help&section=groups">spezifische Zugriffsverwaltung</a> (Zugriff auf einzelne Alben). Zunächst müssen diese aus den LDAP Gruppen entfernt werden dann können die Piwigo Gruppen aktualisiert werden';
$lang['Ldap groups'] = 'LDAP Gruppen';
$lang['Ldap users'] = 'LDAP Benutzer';
$lang['Search Ldap groups ?'] = 'LDAP Benutzer suchen? Wenn die Benutzer auf unterschiederlichen Zweigen oder OU verteilt sind wird diese Einstellung benötigt. Wird es nicht verwendet wird ein LDAP request eingespart. Es wird nicht bei einfachen LDAP Baumstrukturen benöotigt (z.B.: cn=groupname,ou=groups,dc=example,dc=com).';
$lang['Search Ldap users ?'] = 'LDAP Benutzer suchen? Wenn die Benutzer auf unterschiederlichen Zweigen oder OU verteilt sind wird diese Einstellung benötigt. Wird es nicht verwendet wird ein LDAP request eingespart. Es wird nicht bei einfachen LDAP Baumstrukturen benöotigt (z.B.: cn=groupname,ou=groups,dc=example,dc=com).';
$lang['To get them out of these roles, they must be sorted of the ldap group and then role updated in the <a href="admin.php?page=user_list">piwigo admin</a>. If a group is mandatory as described in the <a href="admin.php?page=plugin-Ldap_Login-newusers">new piwigo users tab</a>, then they must also belong to the users group.'] = 'Um sie aus de Rolle zu entfernen müssen sie der LDAP Gruppe zugeordnet werden und die Rolle in <a href="admin.php?page=user_list">piwigo admin</a> aktualisiert werden. Wenn eine Gruppe pflicht ist, wie in <a href="admin.php?page=plugin-Ldap_Login-newusers">"new piwigo users"</a>-Tab beschrieben, dann müssen diese auch zur Gruppe des Benutzer zugeordnet werden.

To get them out of these roles, they must be sorted of the ldap group and then role updated in the <a href="admin.php?page=user_list">piwigo admin</a>. If a group is mandatory as described in the <a href="admin.php?page=plugin-Ldap_Login-newusers">new piwigo users tab</a>, then they must also belong to the users group.';
$lang['Users branch'] = 'Zweig mit LDAP Benutzern (z.B.: ou=users):';