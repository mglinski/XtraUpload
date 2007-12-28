		</div>
	
		<div class="clearer"><span></span></div>

	</div>

</div>

<div class="footer">
	
	<div class="footerText">
		
        <{* Admin Footer Link *}>
        <{if isset($templatelite.session.isadmin) && $templatelite.session.isadmin eq '1'}>
			<a href="<{$siteurl}>admin/"><b>Administration Panel</b></a> | 	
        <{/if}>
        <{* 
        	Althought you have full right to remove this link please keep it in place. 
        	Even if you remove it as visible please keep the link in place without text.
            If the link is removed completly you might not recive support of our site. 
        *}>
	    <a href="http://xtrafile.com/">Powered By: XtraUpload</a><br />
		&copy; 2007 <a href="<{$siteurl}>"><{$sitename}></a>. Template design by <a href="http://arcsin.se">Arcsin</a>
		</div>
	</div>
</body>

</html>