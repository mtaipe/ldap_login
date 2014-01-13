{literal}
<style>
label
{
    display: block;
    width: 250px;
    float: left;
}
</style>
{/literal}

<div class="titrePage">
	<h2>{'Ldap_Login PlugIn'|@translate}</h2>
</div>

<form method="post" action="{$TESTPLUGIN_F_ACTION}" class="general">

<fieldset>
	<legend>{'Ldap_Login Configuration'|@translate}</legend>
	
	{if (!extension_loaded('ldap'))}
		<p style="color:red;">{'Warning: LDAP Extension missing.'|@translate}</p>
		<br />
	{/if}
	
	
    <p>{'If empty, localhost will be used in configuration.'|@translate}</p>
    <label for="host">{'Ldap server host :'|@translate}</label><input type="text" id="host" name="HOST" value="{$HOST}" />
    <br /><br />

	<label for="ld_use_ssl">{'Secure connexion ?'|@translate}</label>
	{if $USE_SSL == 'true'}	
		<input type="checkbox" id="use_ssl" name="USE_SSL" value="{$USE_SSL}" checked />
	{else}
		<input type="checkbox" id="use_ssl" name="USE_SSL" value="{$USE_SSL}" />
	{/if}
	<br /><br />
    
    <p>{'If empty, standard protocol ports will be used by the software.'|@translate}</p>
    <label for="port">{'Ldap port :'|@translate}</label><input type="text" id="port" name="PORT" value="{$PORT}" />
    <br /><br />
    
    <label for="basedn">{'Base DN :'|@translate}</label><input type="text" id="basedn" name="BASEDN" value="{$BASEDN}" />
    <br /><br />
       
    <label for="ld_attr">{'Attribute corresponding to the user name :'|@translate}</label><input type="text" id="ld_attr" name="LD_ATTR" value="{$LD_ATTR}" />
    <br /><br />
    
    <p>{'Let the following fields blank if the ldap accept anonymous connections.'|@translate}</p>
	<label for="ld_binddn">{'Bind DN, field in full ldap style :'|@translate}</label><input type="text" id="ld_binddn" name="LD_BINDDN" value="{$LD_BINDDN}" />
    <br /><br />
    
    <label for="ld_bindpw">{'Bind password :'|@translate}</label><input type="password" id="ld_bindpw" name="LD_BINDPW" />
    <br /><br />
    
</fieldset>
 
<p>
<input type="submit" value="{'Save'|@translate}" name="save" />
</p>
</form>

<br />

<form method="post" action="{$TESTPLUGIN_CHECK}" class="general">
<fieldset>
<legend>{'Ldap_Login Test'|@translate}</legend>
<p>{'Test Credentials'|@translate}</p>

<label for="username">{'Username :'|@translate}</label><input type="text" id="username" name="USERNAME" value="{$USERNAME}" />
    <br /><br />
       
    <label for="ld_attr">{'Your password :'|@translate}</label><input type="password" id="password" name="PASSWORD" value="{$PASSWORD}" />
    <br /><br />

{if (!empty($LD_CHECK_LDAP))}
 		{$LD_CHECK_LDAP}
 		<br />
	{/if}

</fieldset>
<p><input type="submit" value="{'Test Settings'|@translate}" name="check_ldap" /></p>


</form>
