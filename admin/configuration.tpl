<h2>{'Ldap_Login Plugin'|@translate}</h2>

<div id="configContent">

<p>{'All LDAP users can use their ldap password everywhere on piwigo if needed.'|@translate}</p>

<form method="post" action="{$PLUGIN_ACTION}" class="general">

	{if (!extension_loaded('ldap'))}
		<p style="color:red;">{'Warning: LDAP Extension missing.'|@translate}</p>
		<br />
	{/if}
	
	<fieldset class="mainConf">
	<legend>{'Ldap server host connection'|@translate}</legend>
	
	<ul>
		<li>
			<label for="host">{'Ldap server host'|@translate}</label>
			<br>
			<input size="70" type="text" id="host" name="HOST" value="{$HOST}" />
		</li>
	
		<li>
			<label for="ld_use_ssl">
			{if $LD_USE_SSL }
				<input type="checkbox" id="ld_use_ssl" name="LD_USE_SSL" value="{$LD_USE_SSL}" checked />
			{else}
				<input type="checkbox" id="ld_use_ssl" name="LD_USE_SSL" value="{$LD_USE_SSL}" />
			{/if}
			{'Secure connexion'|@translate}</label>
		</li>
	
		<li>
			<label for="port">{'Ldap port'|@translate}</label>
			<br>
			<input type="text" id="port" name="PORT" value="{$PORT}" />
		</li>
		
	<i>{'If empty, localhost and standard protocol ports will be used in configuration.'|@translate}</i>
		
		<li>
			<label for="basedn">{'Base DN'|@translate}</label>
			<br>
			<input size="70" type="text" id="basedn" name="BASEDN" value="{$BASEDN}" />
		</li>
	</ul>
	
    </fieldset>
    
    <fieldset class="mainConf">
	<legend>{'Ldap users'|@translate}</legend>
	<ul>
		<li>
			<label for="usersbranch">{'Users Branch'|@translate}</label>
			<br>
			<input size="70" type="text" id="usersbranch" name="USERSBRANCH" value="{$USERSBRANCH}" />
		</li>
		
		<li>
			<label for="ld_search_users">
			{if $LD_SEARCH_USERS }
				<input type="checkbox" id="ld_search_users" name="LD_SEARCH_USERS" value="{$LD_SEARCH_USERS}" checked />
			{else}
				<input type="checkbox" id="ld_search_users" name="LD_SEARCH_USERS" value="{$LD_SEARCH_USERS}" />
			{/if}
			{'Search Ldap users ?'|@translate}</label>
		</li>
		
		<li>
			<label for="ld_attr">{'Attribute corresponding to the user name'|@translate}</label>
			<br>
			<input type="text" id="ld_attr" name="LD_ATTR" value="{$LD_ATTR}" />
		</li>
	</ul>
    </fieldset>
    
    <fieldset class="mainConf">
	<legend>{'Ldap groups'|@translate}</legend>
	
	<p><i>{'If you create a <a href="admin.php?page=group_list">piwigo group</a> with the same name as an ldap one, all members of the ldap group will automatically join the piwigo group at their next authentication. This allows you to create <a href="admin.php?page=help&section=groups">specific right access management</a> (restrict access to a particaular album...).'|@translate}</i></p>
	<ul>
		
		<li>
			<label for="groupbranch">{'Groups Branch'|@translate}</label>
			<br>
			<input size="70" type="text" id="groupbranch" name="GROUPBRANCH" value="{$GROUPBRANCH}" />
		</li>
		
		<li>
			<label for="ld_search_groups">
			{if $LD_SEARCH_GROUPS }
				<input type="checkbox" id="ld_search_groups" name="LD_SEARCH_GROUPS" value="{$LD_SEARCH_GROUPS}" checked />
			{else}
				<input type="checkbox" id="ld_search_groups" name="LD_SEARCH_GROUPS" value="{$LD_SEARCH_GROUPS}" />
			{/if}
			{'Search Ldap groups ?'|@translate}</label>
		</li>
	
		<li>
			<label for="ld_attr">{'Attribute corresponding to the group name'|@translate}</label>
			<br>
			<input type="text" id="ld_group" name="LD_GROUP" value="{$LD_GROUP}" />
		</li>
		<br>
		
		<li>
			<label for="webmasters_group">{'Webmasters group'|@translate}</label>
			<br>
			{'Users members of this ldap group are granted piwigo webmasters.'|@translate}<br>
			<input size="70" type="text" id="webmasters_group" name="WEBMASTERS_GROUP" value="{$WEBMASTERS_GROUP}" />
		</li>
		
		<li>
			<label for="admins_group">{'Admins group'|@translate}</label>
			<br>
			{'Users members of this ldap group are granted piwigo admins.'|@translate}<br>
			<input size="70" type="text" id="admins_group" name="ADMINS_GROUP" value="{$ADMINS_GROUP}" />
			
			<br><br>
			
			{'To get them out of these roles, they must be sorted of the ldap group and then role updated in the <a href="admin.php?page=user_list">piwigo admin</a>. If a group is mandatory as described in the <a href="admin.php?page=plugin-Ldap_Login-newusers">new piwigo users tab</a>, then they must also belong to the users group.'|@translate}
		</li>
	</ul>
    </fieldset>
    
    <fieldset class="mainConf">
	<legend>{'Ldap connection credentials'|@translate}</legend>
	<ul>
		<li>
			<label for="ld_binddn">{'Bind DN, field in full ldap style'|@translate}</label>
			<br>
			<input size="70" type="text" id="ld_binddn" name="LD_BINDDN" value="{$LD_BINDDN}" />
		</li>
		
		<li>
			<label for="ld_bindpw">{'Bind password'|@translate}</label>
			<br>
			<input type="password" id="ld_bindpw" name="LD_BINDPW" />
		</li>
	</ul>
	<i>{'Let the fields blank if the ldap accept anonymous connections.'|@translate}</i>
</fieldset>
 
<p>
<input type="submit" value="{'Save'|@translate}" name="save" />
</p>
</form>

<form method="post" action="{$PLUGIN_CHECK}" class="general">
<fieldset class="mainConf">
<legend>{'Ldap_Login Test'|@translate}</legend>
<i>{'You must save the settings with the Save button just up there before testing here.'|@translate}</i>
	<ul>
		<li>
			<label for="username">{'Username'|@translate}</label>
			<br>
			<input type="text" id="username" name="USERNAME" value="{$USERNAME}" />
		</li>
		
		<li>
			<label for="ld_attr">{'Your password'|@translate}</label>
			<br>
			<input type="password" id="password" name="PASSWORD" value="{$PASSWORD}" />
		</li>
	</ul>
	
	{if (!empty($LD_CHECK_LDAP))}
 		{$LD_CHECK_LDAP}
	{/if}

</fieldset>
<p><input type="submit" value="{'Test Settings'|@translate}" name="check_ldap" /></p>

</form>
</div>
