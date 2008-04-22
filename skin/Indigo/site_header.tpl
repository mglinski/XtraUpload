<{* // Insert Vars *}><{insert name="rand" assign="randNum"}><{insert name="languageFlags" assign="langFlags"}><{* // END *}>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
	<head>
    <{* //Title -- Header.tpl *}>
    	<title><{$sitename}></title> 
    
    <{* //Meta Section of Header Code *}>
    	<meta http-equiv="Content-Type" content="text/html; charset=<{$lang_charset}>" />
    	<meta name="description" content="<{$metadesc}>" />
    	<meta name="keywords" content="<{$metakey}>" />
    
    <{* // FavIcon.ico [shortcut icon] -- Header.tpl *}>
    	<link rel="shortcut icon" href="<{$shortcut_icon}>" />
    
    <{* // CSS -- Header.tpl *}>
    	<link rel="stylesheet" href="<{$siteurl}>css/global.css" type="text/css" />
    	<link rel="stylesheet" type="text/css" href="<{$siteurl}>skin/Indigo/skin.css" media="screen"/>
    	<{**
    	*	// EXTjs v1.1.1 -> CSS Files
    	*   // For use in XU v2+
    	*   <link rel="stylesheet" type="text/css" href="<{$siteurl}>resources/css/ext-all.css">
    	*	<link rel="stylesheet" type="text/css" href="<{$siteurl}>resources/css/xtheme-aero.css">
    	*}>
    
    <{* // RSS -- Header.tpl *}>
    	<link rel="alternate" type="application/rss+xml" title="<{$sitename}> Uploaded Files RSS Feed" href="<?=makeXuLink('rss.php','act=new')?>" />
    
    <{* // Javascript -- Header.tpl *}>
    	<script type="text/javascript" language="javascript"> var siteUrl = '<{$siteurl}>';</script>
    	<script type="text/javascript" language="javascript" src="<{$siteurl}>js/xu.php"></script>
    	<{**
    	*	// EXTjs v1.1.1 -> JS Files
    	*   // For use in XU v2+
    	*   <script type="text/javascript" language="javascript" src="<{$siteurl}>js/ext.js"></script>
    	*}>
    	<script type="text/javascript" language="javascript">
		<{* Javascript Var Definitions *}>
			var loggedin = <{if isset($templatelite.session.loggedin)}>true<{else}>false<{/if}>;
			var is_admin = <{if isset($templatelite.session.isadmin)}>true<{else}>false<{/if}>;
			var x<{$randNum}> = 0;
			var hash_count='';
			
		<{* [JavaScript] checkTime() -> Validates Download Time Requirement *}>
			function checkTime()
			{
				if(x<{$randNum}> == 0)
				{
					if(!disable_button())
					{
						return false;
					} 
					else
					{
						return true;
					}
				}
				alert("You need to wait "+x<{$randNum}>+" more seconds before you can download this file!");
				return false;
			}
			
		<{* [JavaScript] set_time() -> used to start the downnload countdown *}>
			function set_time(time,hash)
			{
				x<{$randNum}> = time;
				hash_count = hash;
				countdown();
			}
			
		<{* [JavaScript] countdown() -> controls the download countdown *}>
			function countdown() 
			{
				var hash1 = hash_count;
				x<{$randNum}>--;
				
				if(x<{$randNum}> == 0)
				{
					$("#dl4").hide();
					$("#dl").show();
					$("#process").html('<span style="font-size:24px; color:#009900">Your File is ready, Click the button to download.<br /></span>');
					$('#dl2').fadeOut('normal');
					$('#dl3').fadeIn('normal');
				}
				
				if(x<{$randNum}> > 0)
				{
					$("#process").html("<span style='font-size:24px; color:#FF0000'>Please wait while we prepare your file.<br /></span><br />");
					$("#dl4").html("<span style='font-size:18px; color:#FF0000'>Your download will begin in "+x<{$randNum}>+" seconds.</span>");
					setTimeout('countdown()',1000);
				}
			}
			
		<{* [JavaScript] langDown() -> used to move the language selector into view *}>
			function langDown(div)
			{
				$(div).css("top","0px");
			}
			
		<{* [JavaScript] langUp() -> used to hide the language selector *}>
			function langUp(div)
			{
				$(div).css("top","-30px");
			}
			
		<{* [JavaScript] xuMenu[array] -> an array that the site menu is generated from. (JSCookMenu system) *}>
			var xuMenu =
			[
				// Home Page Link
				['<img src="<{$siteurl}>images/actions/Home_16x16.png" />','Home','<?=makeXuLink('index.php','p=home')?>',null,'Site Home'],
				// Site Tools
				['<img src="<{$siteurl}>images/actions/Toolbox_16x16.png" />', 'Tools', null, null, 'Site Tools',
				
					// Validate File Llinks
					['<img src="<{$siteurl}>images/actions/URL_16x16.png" />','Validate File Links','<?=makeXuLink('index.php', 'p=linkchecker')?>',null,'Validate File Links'],
					
					<{if $can_view_folders eq "1"}>
					// View Folders
					['<img src="<{$siteurl}>images/actions/Folder (Open)_16x16.png" />','View Folders','<?=makeXuLink('index.php', 'p=view')?>',null,'View Folders'],
					<{/if}>
					
					<{if !$templatelite.session.loggedin and $can_create_folders eq "1"}>
					//Manage Folders
					['<img src="<{$siteurl}>images/actions/Folder_16x16.png" />','Manage Folders','<?=makeXuLink('index.php', 'p=folders')?>',null,'Manage Folders'],
					<{/if}>
					
				],
				// Login System
				<{if $templatelite.session.loggedin}>
					
					// Logout
					 ['<img src="<{$siteurl}>images/actions/Log Out_16x16.png" />','Logout','<?=makeXuLink('index.php','p=logout')?>',null,'User Logout'],
					// User CP
					['<img src="<{$siteurl}>images/actions/User_16x16.png" />','User CP',null,null,'User Control Panel',
					
						// Main User CP
						['<img src="<{$siteurl}>images/actions/Options_16x16.png" />','User CP','<?=makeXuLink('index.php', 'p=usercp')?>',null,'User CP'],
						
						<{if $can_manage eq "1"}>
						// Manage Files
						['<img src="<{$siteurl}>images/actions/Documents_16x16.png" />','Manage Files','<?=makeXuLink('index.php', 'p=files')?>',null,'Manage Files'],
						<{/if}>
						
						<{if $can_create_folders eq "1"}>
						// Manage Folders
						['<img src="<{$siteurl}>images/actions/Folder_16x16.png" />','Manage Folders','<?=makeXuLink('index.php', 'p=userFolders')?>',null,'Manage Folders'],
						<{/if}>
						
						// Cancel Account Link
						['<img src="<{$siteurl}>images/actions/User (Alt 2)_16x16.png" />','Cancel Account','<?=makeXuLink('index.php', 'p=delacc')?>',null,'Cancel Account'],
					],
				<{else}>
					// Login
					['<img src="<{$siteurl}>images/actions/Log In_16x16.png" />', 'Login', '<?=makeXuLink('index.php','p=login')?>', null, 'User Login'],
					
					//Premium
					['<img src="<{$siteurl}>images/actions/Key_16x16.png" />','Premium','<?=makeXuLink('index.php','p=fastpass')?>',null,'Get Premium Account'],
				<{/if}>
				
				// RSS
				['<img src="<{$siteurl}>images/actions/RSS_16x16.png" />','RSS','<?=makeXuLink('index.php','p=rss')?>',null,'RSS Feeds'],
				
				// News
				['<img src="<{$siteurl}>images/actions/News_16x16.png" />','News','<?=makeXuLink('index.php','p=news')?>',null,'Site News'],
				
				// FAQ
				['<img src="<{$siteurl}>images/actions/Help (Alt 3)_16x16.png" />','FAQ','<?=makeXuLink('index.php','p=faq')?>',null,'Site F.A.Q.']
			];
			
		<{* [JavaScript] $(document).ready() -> actions that are executed when the DOM tree is ready *}>
			$(document).ready(
				function()
				{
					// EXT 1.1.1 Stuff
					// For XU2 Only
					//Ext.BLANK_IMAGE_URL = '<{$siteurl}>images/ext/default/s.gif';
					
					// Lang Positioning
					$('#langSel').css('top', '-30px');
					
					//Menu JS
					cmThemeOffice.effect = new CMSlidingEffect(8)
					cmDraw ('staticMenuBar', xuMenu, 'hbr', cmThemeOffice, 'ThemeOffice');
				}
			);
		</script>
    </head>
    
    <body >
    <div 
    <{* // Menu Bar -- Header.tpl *}>
        <div style="position:absolute; top:68; left:200px;">
            <div id="staticMenuBar" style="padding-top:68px" align="left"></div>
        </div>
    
    <{* // Language Selector -- Header.tpl *}>
        <div id='langSel' onmouseover='langDown(this)' onmouseout='langUp(this)'>
            <center>
                <div class="langTable" style="text-align:center;">
                    <{section name=lang loop=$langFlags}>
                        <a class='langBtn' title="<{$langFlags[lang].name}>" href='<{$langFlags[lang].link}>'> 
                            <img border='0' src='<{$siteurl}>images/flags/<{$langFlags[lang].cc}>.png' alt='<{$langFlags[lang].name}>' /> 
                        </a> 
                    <{/section}>
                </div><br />
                Language
            </center>
        </div>
    
    <{* // Main Container -- Header.tpl *}>
        <div class="container">
            <div class="header">
                <div class="title">
                    <h1><{$sitename}></h1>
                </div>
                <div class="clearer"><span></span></div>
            </div>
        
            <div class="main">
                <div class="content" align="center">
                    <{insert name="ads"}>
                    <!-- Ads here -->