<?php
<<<<<<< HEAD
global $conf;
class Ldap {
=======
class Ldap {

>>>>>>> 95bfabcd664aadd7a805767c5d6a580841069ab9
	var $cnx;
	var $config;

	// for debug
	public function write_log($message){
		@file_put_contents('/var/log/ldap_login.log',$message."\n",FILE_APPEND);
	}

	/**
	 * check ldap configuration
	 *
	 * Dans le cas ou l'acces au ldap est anonyme il faut impérativement faire une recherche
	 * pour tester la connection.
	 *
	 * When OpenLDAP 2.x.x is used, ldap_connect() will always return a resource as it does not actually connect
	 * but just initializes the connecting parameters. The actual connect happens with the next calls
	 * to ldap_* funcs, usually with ldap_bind().
	 */
	public function check_ldap(){

		if (!$this->ldap_conn()) {
			return $this->getErrorString();
		}

		// test du compte root si renseigné
		if (!empty($this->config['ld_binddn']) && !empty($this->config['ld_bindpw'])){ // if empty ld_binddn, anonymous search
			// authentication with rootdn and rootpw for search
			if (!$this->ldap_bind_as($this->config['ld_binddn'],$this->config['ld_bindpw'])){
				return $this->getErrorString();
			}
		} else {
			// sinon recherche du basedn (cf comportement ldap_connect avec OpenLDAP)
			if (!$this->ldap_check_basedn()){ // search userdn
				return $this->getErrorString();
			}
		}
		return true;
	}
	
	public function load_default_config(){
		$this->config['host'] = 'localhost';
		$this->config['basedn'] = 'dc=example,dc=com'; // racine !
		$this->config['usersbranch'] = 'ou=people';
		$this->config['groupbranch'] = 'ou=group';
		$this->config['ld_search_users'] = False;
		$this->config['ld_search_groups'] = False;
		$this->config['port'] = ''; // if port is empty, I count on the software to care of it !
		$this->config['ld_attr'] = 'uid';
		$this->config['ld_group'] = 'cn';
		//$this->config['ld_class'] = 'posixAccount';
		$this->config['ld_use_ssl'] = False;
		$this->config['ld_bindpw'] ='';
		$this->config['ld_binddn'] ='';

	function load_config(){
		// first, load the hard coded defaults, then apply the one from the file.
		// that way, when we begin setting the conf', there is already sane defaults. And there is no holes in it !
		$this->load_default_config();
		
		$conf_file = @file_get_contents( LDAP_LOGIN_PATH.'data.dat' );
		if ($conf_file!==false)
		{
			$this->config = unserialize($conf_file);
			
			// user and groupbranches + basedn make full_groupbranch. 
			// that way, we can save one ldap request when logging (see ldap_name).
			
			$this->full_usersbranch = $this->config['usersbranch'].','.$this->config['basedn'];
 			$this->full_groupbranch = $this->config['groupbranch'].','.$this->config['basedn'];
		}
	}

	function save_config(){
		$file = fopen( LDAP_LOGIN_PATH.'/data.dat', 'w' );
		fwrite($file, serialize($this->config) );
		fclose( $file );
	}

	// basically loads the menu in piwigo admin.
	function ldap_admin_menu($menu){
		array_push($menu,
		array(
		'NAME' => 'Ldap Login',
		'URL' => get_admin_plugin_menu_link(LDAP_LOGIN_PATH.'/admin.php') )
		);
		return $menu;
	}

	// initializes all the ldap connection
	// the function returns basically "yes/true" -> we can connect to ldap or "no/wrong" -> connction is not possible
	// this function is used both in admin and logging process.
	public function ldap_conn(){
		if ($this->config['ld_use_ssl'] == 1){
			if (empty($this->config['port'])){
				$this->config['uri'] = 'ldaps://'.$this->config['host'];
			}
			else {
			$this->config['uri'] = 'ldaps://'.$this->config['host'].':'.$this->config['port'];
			}
		}
		
		// now, it's without ssl
		else {
			if (empty($this->config['port'])){
				$this->config['uri'] = 'ldap://'.$this->config['host'];
			}
			else {
				$this->config['uri'] = 'ldap://'.$this->config['host'].':'.$this->config['port'];
			}
		}

		// first, we initializes connection to ldap
		if ($this->cnx = @ldap_connect($this->config['uri'])){
				@ldap_set_option($this->cnx, LDAP_OPT_PROTOCOL_VERSION, 3); // LDAPv3 if possible
		
			// then we authenticate if anonymous search is forbidden
			if (!empty($obj->config['ld_binddn']) && !empty($obj->config['ld_bindpw'])){
				$password = strtr($obj->config['ld_bindpw'], array("\'"=>"'"));
			
				if (@ldap_bind($this->cnx,$this->config['ld_binddn'],$password)){
					return true;
				}
				else { return false; }
			}
			// if anonymous search is allowed, we still need a fake auth using ldap_bind
			else {
				if (@ldap_bind($this->cnx)){
					return true;
				}
				else { return false; }
			}
		}
		else { return false; }
	}

	// return ldap error
	public function getErrorString(){
		return ldap_err2str(ldap_errno($this->cnx));
	}
	
	// return the name ldap understand
	// this function is used every time you log in piwigo.
	public function ldap_name($name){
		if ($this->config['ld_search_users']) {
			return $this->ldap_search_dn($name);
		}
		else { return $this->config['ld_attr'].'='.$name.','.$this->full_usersbranch; }
	}
	
	public function ldap_group($groupname){
		// this should return an array, because it is used to search the users in (see function ldap_search_dn)
		// even if it's only one group !
		if ($this->config['ld_search_groups']) {
			return $this->ldap_search_group($groupname);
		}
		else {
		$result[] = $this->config['ld_group'].'='.$groupname.','.$this->full_groupbranch;
		return $result;
		}
	}

	// authentication in the ldap server.
	// the function needs bare login name and password.
	// the ldap_name function will be used to provide the ldap syntax
	public function ldap_bind_as($user,$user_passwd){
		$user_passwd = strtr($user_passwd, array("\'"=>"'"));
		

	// authentication
	public function ldap_bind_as($user,$user_passwd){
		if (@ldap_bind($this->cnx,$this->ldap_name($user),$user_passwd)){
			return true;
		}
		return false;
	}

	// provide the mail to piwigo when creating the user
	public function ldap_mail($name){
	
		$sr=@ldap_read($this->cnx, $this->ldap_name($name), "(objectclass=*)", array('mail'));
		$entry = @ldap_get_entries($this->cnx, $sr);
		
		if (!empty($entry[0]['mail'])) {
			return $entry[0]['mail'][0];
			}
		return False;
	}

	// this function must return an array.
	public function ldap_search_group($to_search){
		$ld_group = $this->config['ld_group'];
		
		$sr=@ldap_search($this->cnx, $this->full_groupbranch, "($ld_group=$to_search)", array('dn'),0,0);
		$groups = @ldap_get_entries($this->cnx, $sr);
		$result = array();
		foreach ($groups as $group) {
			$result[] = $group['dn'];
		}
		return $result;
	}
	
	public function ldap_search_dn($to_search){
		$ld_attr = $this->config['ld_attr'];
		
		if(($results=@ldap_search($this->cnx,$this->config['basedn'],"($ld_attr=$to_search)",array('dn','mail',$ld_attr)))!==false)
		$entry = @ldap_first_entry($this->cnx, $results);
		
		if($entry==null)
		{
		return false;
		}
		
		else
		{	if(($userDn=ldap_get_dn($this->cnx,$entry))!==false)
			{
				return $userDN;
			}
			else
			{
				return null;
			}
		}
	}
	
	// This function takes the user and check if it is a member of some ldap groups.
	// This allows to set that it is allowed to log in, or that it is an admin or a webmaster (see function ldap_status)
	public function user_membership($user, $groups){
		// $groups is an array of groupdn ! (there is a possibility of several groups, we search the user in each of them).
		foreach ($groups as $groupdn) {
			$filter = '(objectClass=*)';
			$result = @ldap_read($this->cnx,$groupdn,$filter,array('memberUid'));
			$result2 = @ldap_get_entries($this->cnx, $result);
			if(isset($result2[0]['memberuid'])){
				foreach($result2[0]['memberuid'] as $item){
					if ($item == $user){
						return True;
					}
				}
			}
		}
		return False;
	}
	
	public function ldap_status($username){
		if ($this->config['webmasters_group']) {
			if ($this->user_membership($username,$this->ldap_group($this->config['webmasters_group']))) {
				// set status to webmaster and quit (more powerfull, no need to get further)
				return 'webmaster';
			}
		}
		if ($this->config['admins_group']) {
			if ($this->user_membership($username,$this->ldap_group($this->config['admins_group']))) {
				// set status to admin
				return 'admin';
			}
		}
		else 
		{
		return 'normal';
		}
	}
	
	public function getAttr(){
	$search = @ldap_read($this->cnx, "cn=subschema", "(objectClass=*)", array('*', 'subschemasubentry'));
	$entries = @ldap_get_entries($this->cnx, $search);
	}
	
	public function getRootDse(){

        $search = @ldap_read($this->cnx, NULL, 'objectClass=*', array("*", "+"));
        $entries = @ldap_get_entries($this->cnx, $search);
        return $entries[0];
	}

	public function ldap_check_basedn(){
		if ($read = @ldap_read($this->cnx,$this->config['basedn'],'(objectClass=*)',array('dn'))){
			$entry = @ldap_get_entries($this->cnx, $read);
			if (!empty($entry[0]['dn'])) {
				return true;
			}
		}
		return false;
	}

}
?>