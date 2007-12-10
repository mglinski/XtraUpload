		</div>
	
		<div class="clearer"><span></span></div>

	</div>

</div>

<div class="footer">
	
	<div class="footerText">
		
        <{* Admin Footer Link *}>
        <{if isset($templatelite.session.isadmin) && $templatelite.session.isadmin eq '1'}>
			<a href="<{$siteurl}>admin/"><b>Administration Panel</b></a>
			<br />
	  <{else}>
	      <br />
        <{/if}>
        
		&copy; 2007 <a href="<{$siteurl}>"><{$sitename}></a>. Template design by <a href="http://arcsin.se">Arcsin</a>
		</div>
	</div>
</body>

</html>