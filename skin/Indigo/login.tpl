<{if isset($templatelite.POST.username) && isset($templatelite.POST.password)}>
    <{if !$failed}>
    	<div align="center">
            <h2> <{$lang.login.8}> </h2>
            <br />
            <h4> <{$lang.login.9}> </h4>
        </div>
        <script type="text/javascript"> 
            function r()
            {
                window.location = "<{$redirect}>";
            }
            setTimeout('r()',1500);
        </script>
    <{else}>
		 <p align="center"><font color="#FF0000"><{$msg}></font></p>
        <p align="center"><{$lang.login.1}><{$sitename}>
        <form method="POST" enctype="application/x-www-form-urlencoded">
          <input type="hidden" name="return" value="<{$templatelte.GET.return}>" />
          <div align="center"> 
            <span style="font-size:14px"><{$lang.login.2}></span> <input type='text' name='username' size=30 tabindex="1" /><br />
            <span style="font-size:14px"><{$lang.login.3}></span> <input type='password' name='password' size=30 tabindex="2" /><br />
            <input type="submit" name="Submit" value="Submit" />
            <br />
            <br />
            <div align="center"><a href="<{$forgot}>"><{$lang.login.4}></a></div>
            <div align="center"><a href="<{$fastpass}>"><{$lang.login.5}></a></div>
          </div>
        </form>
        </p>
    <{/if}>
<{else}>
    <p align="center"><font color="#FF0000"><{$msg}></font></p>
    <p align="center"><{$lang.login.1}><{$sitename}>
    <form method="POST" enctype="application/x-www-form-urlencoded">
      <input type="hidden" name="return" value="<{$templatelte.GET.return}>" />
      <div align="center"> 
        <span style="font-size:14px"><{$lang.login.2}></span> <input type='text' name='username' size=30 tabindex="1" /><br />
        <span style="font-size:14px"><{$lang.login.3}></span> <input type='password' name='password' size=30 tabindex="2" /><br />
        <input type="submit" name="Submit" value="Submit" />
		<br />
		<br />
        <div align="center"><a href="<{$forgot}>"><{$lang.login.4}></a></div>
        <div align="center"><a href="<{$fastpass}>"><{$lang.login.5}></a></div>
      </div>
    </form>
    </p>
<{/if}>