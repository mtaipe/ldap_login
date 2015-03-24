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
	<h2>{'Ldap_Login Plugin'|@translate}</h2>
</div>

<i>{"If the LDAP doesn't furnish the mail address, users can set it up in the profile page."|@translate}</i>
<form method="post" action="{$PLUGIN_NEWUSERS}" class="general">

<fieldset>
	<legend>{'Ldap_Login configuration'|@translate}</legend>
	
    <p>
	{if $ALLOW_NEWUSERS}
		<input type="checkbox" id="allow_newusers" name="ALLOW_NEWUSERS" value="{$ALLOW_NEWUSERS}" checked />
	{else}
		<input type="checkbox" id="allow_newusers" name="ALLOW_NEWUSERS" value="{$ALLOW_NEWUSERS}" />
	{/if}
	{'Do you allow new piwigo users to be created when users authenticate succesfully on the ldap ?'|@translate}
    </p>
    
    <p>
		<b><label for="users_group">{'Users group'|@translate}</label></b>
		<br>
		{'Users members of this ldap group (e.g.: piwigo,users ... , default is void ) can authenticate on piwigo and are created if the option above is selected. If left blank, everyone can authenticate.'|@translate}
		<input size="70" type="text" id="users_group" name="USERS_GROUP" value="{$USERS_GROUP}" />
	</p>
    
    <p>
	{if $ADVERTISE_ADMINS}
		<input type="checkbox" id="advertise_admin_new_ldapuser" name="ADVERTISE_ADMINS" value="{$ADVERTISE_ADMINS}" checked />
	{else}
		<input type="checkbox" id="advertise_admin_new_ldapuser" name="ADVERTISE_ADMINS" value="{$ADVERTISE_ADMINS}" />
	{/if}
	{'Do you want admins to be advertised by mail in case of new users creation upon ldap login ?'|@translate}
    </p>
    
    <p>
	{if $SEND_CASUAL_MAIL}
		<input type="checkbox" id="send_password_by_mail_ldap" name="SEND_CASUAL_MAIL" value="{$SEND_CASUAL_MAIL}" checked />
	{else}
		<input type="checkbox" id="send_password_by_mail_ldap" name="SEND_CASUAL_MAIL" value="{$SEND_CASUAL_MAIL}" />
	{/if}
	{'Do you want to send mail to the new users, like casual piwigo users receive ?'|@translate}
    </p>
    
</fieldset>

<p>
<input type="submit" value="{'Save'|@translate}" name="save" />
</p>
</form>