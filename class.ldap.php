<?php
class Ldap {

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

	function load_config()
	{
		$x = @file_get_contents( LDAP_LOGIN_PATH.'data.dat' );
		if ($x!==false)
		{
			$c = unserialize($x);
			// do some more tests here
			$this->config = $c;
		}

		if ( !isset($this->config))
		{
			if (empty($this->config['host'])){	$this->config['host'] = 'localhost'; }
			if (empty($this->config['port'])){ 	$this->config['port'] = 389; }
			if (empty($this->config['basedn'])){	$this->config['basedn'] = 'ou=people,dc=example,dc=com'; }
			if (empty($this->config['ld_attr'])){   $this->config['ld_attr']  = 'uid'; }
			//$this->save_config();
		}
		//$this->write_log('$this->config '.print_r($this->config,true));
	}

	function save_config()
	{
		$file = fopen( LDAP_LOGIN_PATH.'/data.dat', 'w' );
		fwrite($file, serialize($this->config) );
		fclose( $file );
	}

	function ldap_admin_menu($menu)
	{
		array_push($menu,
		array(
		'NAME' => 'Ldap Login',
		'URL' => get_admin_plugin_menu_link(LDAP_LOGIN_PATH.'/admin/ldap_login_plugin_admin.php') )
		);

		return $menu;
	}

	public function ldap_conn(){

		if ($this->config['use_ssl'] == 1){
			$this->config['uri'] = 'ldaps://'.$this->config['host'].':'.$this->config['port'];
			}
			else {
				$this->config['uri'] = 'ldap://'.$this->config['host'].':'.$this->config['port'];
			}

		if ($this->cnx = @ldap_connect($this->config['uri'])){
			@ldap_set_option($this->cnx, LDAP_OPT_PROTOCOL_VERSION, 3); // LDAPv3 if possible
			return true;
		}
		return false;
	}

	// return ldap error
	public function getErrorString(){
		return ldap_err2str(ldap_errno($this->cnx));
	}
	
	// return the name ldap understand
	public function ldap_name($name){
	return $this->config['ld_attr'].'='.$name.','.$this->config['basedn'];
	}

	// authentication
	public function ldap_bind_as($user,$user_passwd){
		if (@ldap_bind($this->cnx,$this->ldap_name($user),$user_passwd)){
			return true;
		}
		return false;
	}

	// return userdn (and username) for authentication
	public function ldap_search_dn($to_search){
		$filter = str_replace('%s',$to_search,$this->config['ld_filter']);
		//$this->write_log('$filter '.$filter);

		if ($search = @ldap_search($this->cnx,$this->config['basedn'],$filter,array('dn',$this->config['ld_attr']),0,1)){
			$entry = @ldap_get_entries($this->cnx, $search);
			if (!empty($entry[0][strtolower($this->config['ld_attr'])][0])) {
				return $entry;
			}
		}
		return false;
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