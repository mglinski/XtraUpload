<<<<<<< .mine
<html>
	<head>
		<title>MP3 Embed</title>
		<script type="text/javascript">
		function ___imageClose(){return 'http://192.168.0.153/xu2/images/lightbox-btn-close.gif';}
		function ___imageLoading(){return 'http://192.168.0.153/xu2/images/loading.gif';}
		function ___baseUrl(){return 'http://192.168.0.153/xu2/';}
		</script>
		<script src="http://192.168.0.153/xu2/js/main.php" type="text/javascript"></script>
	</head>
	<body>
		<div id="player"></div>
		<script type="text/javascript">
		var so = new SWFObject('<?=$base_url?>flash/player.swf','mpl','470','20','9');
		so.addParam('allowscriptaccess','always');
		so.addParam('allowfullscreen','false');
		so.addParam('flashvars','file=<?=site_url('files/stream/'.$file->file_id.'/'.$file->link_name)?>');
		so.write('player');
		</script>
	</body>
=======
<html>
	<head>
		<title>MP3 Embed</title>
		<script type="text/javascript">
		function ___imageClose(){return '<?=$base_url?>images/lightbox-btn-close.gif';}
		function ___imageLoading(){return '<?=$base_url?>images/loading.gif';}
		function ___baseUrl(){return '<?=$base_url?>';}
		</script>
		<script src="<?=$base_url?>js/src/swfobject.js" type="text/javascript"></script>
	</head>
	<body>
	<div id="player"></div>
	<script type="text/javascript">
	var so = new SWFObject('<?=$base_url?>flash/player.swf','mpl','470','20','9');
	so.addParam('allowscriptaccess','always');
	so.addParam('allowfullscreen','false');
	so.addParam('flashvars','file=<?=site_url('files/stream/'.$file->file_id.'/'.md5($this->config->config['encryption_key'].$file->file_id.$this->input->ip_address()).'/'.$file->link_name)?>');
	so.write('player');
	</script>
	</body>
>>>>>>> .r96
</html>