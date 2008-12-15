
<html>
	<head>
		<title>XtraUpload Upgrader</title>
		<style type='text/css'>
		
		BODY		          	
		{
			font-size: 11px;
			font-family: Verdana, Arial;
			color: #000;
			margin: 0px;
			padding: 0px;
			background-image: url(images/background.png);
			background-repeat: no-repeat;
			background-position: right bottom;
		}
		
		TABLE, TR, TD     { font-family:Verdana, Arial;font-size: 11px; color:#000 }
		
		a:link, a:visited, a:active  { color:#000055 }
		a:hover                      { color:#333377;text-decoration:underline }
		
		.centerbox { margin-right:10%;margin-left:10%;text-align:left }
		
		.warnbox {
				   border:1px solid #F00;
				   background: #FFE0E0;
				   padding:6px;
				   margin-right:10%;margin-left:10%;text-align:left;
				 }
		
		.tablepad    { background-color:#F5F9FD;padding:6px }
		.description { color:gray;font-size:10px }
		.pformstrip { background-color: #D1DCEB; color:#3A4F6C;font-weight:bold;padding:7px;margin-top:1px;text-align:left }
		.pformleftw { background-color: #F5F9FD; padding:6px; margin-top:1px;width:50%; border-top:1px solid #C2CFDF; border-right:1px solid #C2CFDF; }
		.pformright { background-color: #F5F9FD; padding:6px; margin-top:1px;border-top:1px solid #C2CFDF; }
		
		.tableborder { border:1px solid #345487;background-color:#FFF; padding:0px; margin:0px; width:100% }
		
		.maintitle { text-align:left;vertical-align:middle;font-weight:bold; color:#FFF; letter-spacing:1px; padding:8px 0px 8px 5px; background-image: url("images/back1.png") }
		.maintitle a:link, .maintitle  a:visited, .maintitle  a:active { text-decoration: none; color: #FFF }
		.maintitle a:hover { text-decoration: underline }
		
		#copy { font-size:10px }
							
		#button   { background-color: #4C77B6; color: #FFFFFF; font-family:Verdana, Arial; font-size:11px }
		
		#textinput { background-color: #EEEEEE; color:Ê#000000; font-family:Verdana, Arial; font-size:11px; width:100% }
		
		#dropdown { background-color: #EEEEEE; color:Ê#000000; font-family:Verdana, Arial; font-size:10px }
		
		#multitext { background-color: #EEEEEE; color:Ê#000000; font-family:Courier, Verdana, Arial; font-size:10px }
		
		#logostrip {
		padding: 0px;
		margin: 0px;
		background-color: #8f9d71;
				   }
				   
		.fade					
		{
			background-image: url(images/fade.jpg);
			background-repeat: repeat-x;
		}
		
		label.error
		{
			display:inline;
			background: left center url(../img/fam/exclamation.png) no-repeat;
			padding-left:18px;
			margin-left:4px;
			margin-bottom:12px;
			color: #FF3300;
		}
		
		.progressMenu
		{
			display:block;
			text-align:center;
			width:780px;
			margin:auto;
			margin-bottom:15px;
			border: 1px #000 solid;
		}
		.progressMenu ul
		{
			list-style:none; 
			display:inline;
			text-align:center;
			padding:0;
			margin:0;
		}
		
		.progressMenu ul li
		{
			margin-left:10px; 
			margin-right:10px; 
			font-size:18px; 
			display:inline; 
			color:#666666;
		}
		
		.progressMenu ul li.complete
		{
			padding:10px; 
			font-size:18px; 
			display:inline; 
			color:#009900;
		}
		.progressMenu ul li.complete a
		{
			color:#009900;
		}
		
		.progressMenu ul li.current
		{
			padding:10px; 
			font-size:18px; 
			display:inline; 
			color:#336699
		}
				
		/* BUTTONS */
		span.cssbutton { clear:left; }
		
		span.cssButton a, span.cssButton button
		{
			display:block;
			float:left;
			margin:0 7px 0 0;
			background-color:#f5f5f5;
			border:1px solid #dedede;
			border-top:1px solid #eee;
			border-left:1px solid #eee;
			font-family:"Lucida Grande", Tahoma, Arial, Verdana, sans-serif;
			font-size:100%;
			line-height:130%;
			text-decoration:none;
			font-weight:bold;
			color:#565656;
			cursor:pointer;
			padding:5px 10px 6px 7px; /* Links */
		}
		
		span.cssButton button
		{
			width:auto;
			overflow:visible;
			padding:4px 10px 3px 7px; /* IE6 */
		}
		
		span.cssButton button[type]
		{
			padding:5px 10px 5px 7px; /* Firefox */
			line-height:17px; /* Safari */
		}
		
		*:first-child+html button[type] { padding:4px 10px 3px 7px; /* IE7 */ }
		
		span.cssButton button img, span.cssButton a img
		{
			margin:0 3px -3px 0 !important;
			padding:0;
			border:none;
			width:16px;
			height:16px;
			background:none;
		}
		
		/* STANDARD */
		
		span.cssButton button:hover, span.cssButton a:hover
		{
			background-color:#dff4ff;
			border:1px solid #c2e1ef;
			color:#336699;
		}
		
		span.cssButton a:active
		{
			background-color:#6299c5;
			border:1px solid #6299c5;
			color:#fff;
		}
		
		/* buttonGreen */
		
		span.cssButton button.buttonGreen, span.cssButton a.buttonGreen { color:#529214; }
		
		span.cssButton a.buttonGreen:hover, span.cssButton button.buttonGreen:hover
		{
			background-color:#E6EFC2;
			border:1px solid #C6D880;
			color:#529214;
		}
		
		span.cssButton a.buttonGreen:active
		{
			background-color:#529214;
			border:1px solid #529214;
			color:#fff;
		}
		
		/* buttonRed */
		
		span.cssButton a.buttonRed, button.buttonRed { color:#d12f19; }
		
		span.cssButton a.buttonRed:hover, span.cssButton button.buttonRed:hover
		{
			background:#fbe3e4;
			border:1px solid #fbc2c4;
			color:#d12f19;
		}
		
		span.cssButton a.buttonRed:active
		{
			background-color:#d12f19;
			border:1px solid #d12f19;
			color:#fff;
		}

		
		</style>
		<script type="text/javascript">function ___baseUrl(){return '';}</script>
		<script type="text/javascript" src="../js/main.php"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body marginheight='0' marginwidth='0' leftmargin='0' topmargin='0' bgcolor='#FFFFFF'>

	<div id='logostrip'>
		<img src='images/logo.png' alt='XtraUpload v2 Installer' width="450" height="70" border='0' />
	</div>
	<div class='fade'>&nbsp;</div>
	<br />