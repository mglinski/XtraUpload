<{if $valid}>
	<{if empty($username)}>
    	<{$lang.forgotpass.1}>
        <form method="post"><h1><{$lang.forgotpass.11}></h1><br />
            <p>
                <{$lang.forgotpass.13}> <input type="text" size="30" name="email" value="" /><br /><br />
                <{$lang.contactus.11}><{$captcha}><{$lang['contactus']['12}><br />
                <input type="submit" name="Submit" value="Change Password" />
            </p>
        </form>
    <{else}>
    	<{$lang.forgotpass.10}>
    <{/if}>
<{else}>
	<form method="post"><h1><{$lang.forgotpass.11}></h1><br />
		<p>
			<{$lang.forgotpass.13}> <input type="text" size="30" name="email" value="" /><br /><br />
			<{$lang.contactus.11}><{$captcha}><{$lang['contactus']['12}><br />
			<input type="submit" name="Submit" value="Change Password" />
		</p>
	</form>
<{/if}>