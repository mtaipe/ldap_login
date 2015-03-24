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
$lang['New users when ldap auth is successfull'] = 'Nuevos usuarios cuando la autentificación LDAP es exitosa';
$lang['Save'] = 'Guardar';
$lang['Secure connexion'] = 'Conexión segura (ldap)';
$lang['Test Settings'] = 'Test de la configuración';
$lang['Username'] = 'Su nombre de usuario Ldap';
$lang['Warning: LDAP Extension missing.'] = 'Atención: falta la extensión LDAP';
$lang['You must save the settings with the Save button just up there before testing here.'] = 'Tiene que guardar la configuración usando en botón de arriba antes de iniciar un test';
$lang['Your password'] = 'Su contraseña LDAP';
$lang['All LDAP users can use their ldap password everywhere on piwigo if needed.'] = 'Todos los usuarios de LDAP pueden utilizar su contraseña en todas las partes de piwigo si es necesario.';
$lang['Attribute corresponding to the user name'] = 'Atributo que corresponde al nombre de usuario';
$lang['Base DN'] = 'La base DN es donde deben encontrarse los usuarios de LDAP (por ejemplo: ou = usuarios, dc = ejemplo, dc = com):';
$lang['Bind DN, field in full ldap style'] = 'Enlace DN en el estilo de LDAP (por ejemplo: cn = admin, dc = ejemplo, dc = com).';
$lang['Bind password'] = 'Contraseña Bind';
$lang['Do you allow new piwigo users to be created when users authenticate succesfully on the ldap ?'] = '¿Permite que los nuevos usuarios de Piwigo que se crean cuando los usuarios se autentican con éxito en el ldap?';
$lang['Do you want admins to be advertised by mail in case of new users creation upon ldap login ?'] = 'Desea ser advertido por mail en caso de creacion de una nueva cuenta ldap ?';
$lang['Do you want to send mail to the new users, like casual piwigo users receive ?'] = 'Desea mandar mail a los nuevos usuarios, como la mayoria de los usuarios de Piwigo ?';
$lang['If empty, localhost and standard protocol ports will be used in configuration.'] = 'En caso de estar libre. el localhost y los protocolos de los puertos se utilizaran para la configuracion. ';
$lang['If empty, standard protocol ports will be used by the software.'] = 'En caso de estar libre, los protocolos de los puertos se utilizaran para los programas.';
$lang['Ldap connection credentials'] = 'Credenciales de conexión ldap';
$lang['Ldap port'] = 'Puerto ldap';
$lang['Ldap server host'] = 'Servidor host de ldap';
$lang['Ldap server host connection'] = 'Conexión del servidor ldap';
$lang['Ldap_Login Plugin'] = 'Plugin de autentificacion de ldap';
$lang['Ldap_Login Test'] = 'Test de autentificacion de ldap';
$lang['Ldap_Login configuration'] = 'Configuracion de autentificacion de ldap
';
$lang['Let the fields blank if the ldap accept anonymous connections.'] = 'Deje los campos en blanco si el ldap acepte a conexiones anónimas.';
$lang['Users branch'] = 'Subdivisión donde se deben encontrar usuarios LDAP (e.g.: ou=groups):';
$lang['To get them out of these roles, they must be sorted of the ldap group and then role updated in the <a href="admin.php?page=user_list">piwigo admin</a>. If a group is mandatory as described in the <a href="admin.php?page=plugin-Ldap_Login-newusers">new piwigo users tab</a>, then they must also belong to the users group.'] = 'Para sacarlos de esas funciones, deben ser ordenados en el grupo ldap y luego actualizar las funciones en el <a href="admin.php?page=user_list">panel administrador</a>.Si un grupo es obligatorio, como se describe en la <a href="admin.php?page=plugin-Ldap_Login-newusers">nueva etiqueta de usuarios Piwigo</a>, entonces también deben pertenecer al grupo de usuarios.';
$lang['Search Ldap users ?'] = 'Buscar usuarios LDAP? Si usted tiene sus usuarios Esparcidos en varios sitios o carpetas, lo necesitará. Si no lo hace, salvas una solicitud LDAP. Es posible que no lo necesita si su árbol LDAP es simple (e.g.: cn=groupname,ou=groups,dc=example,dc=com).';
$lang['Search Ldap groups ?'] = 'Buscar usuarios LDAP? Si usted tiene sus grupos Esparcidos en varios sitios o carpetas, lo necesitará. Si no lo hace, salvas una solicitud LDAP. Es posible que no lo necesita si su árbol LDAP es simple (e.g.: cn=groupname,ou=groups,dc=example,dc=com).';
$lang['Ldap users'] = 'Usuarios LDPA';
$lang['Ldap groups'] = 'Grupos LDPA';
$lang['If you create a <a href="admin.php?page=group_list">piwigo group</a> with the same name as an ldap one, all members of the ldap group will automatically join the piwigo group at their next authentication. This allows you to create <a href="admin.php?page=help&section=groups">specific right access management</a> (restrict access to a particaular album...).'] = 'Si crea un <a href="admin.php?page=group_list">grupo Piwigo</a> con el mismo nombre que un grupo ldpa, todos los miembros de ese grupo se unirán automáticamente al de piwigo en su próxima conexión. Esto le permite crear<a href="admin.php?page=help&section=groups"> derechos específicos de acceso de gestión</a> (acceso restringido a un álbum particular...) Sin embargo, con el fin de sacar a este usuario, primero debe sacarlos de los grupos LDAP, entonces los grupos Piwigo se pueden actualizar.';
$lang['Groups branch'] = 'Subdivisión donde se deben encontrar grupos LDAP (e.g.: ou=groups):';