<?
echo "<pre><code>// XtraUpload Javascript Packer\n// Pack all individual JS file into one to save bandwith and server load\n// For: XtraUpload\n// By: Matthew Glinski\n################################################
################################################
";

// Load files
$script = '';
$loaded = array();
loadFiles('jquery,misc'/*,ext-base,ext'*/);
//loadFiles('jquery,misc');

$temp = @opendir('.');
$arr = array('index.php', 'run.php', /*'ext.js', 'ext-base.js',*/ 'xu.js', 'jquery.js', 'misc.js');
//$arr = array('index.php', 'run.php', 'ext.js', 'ext-base.js', 'xu.js', 'jquery.js', 'misc.js');

while ($file = @readdir($temp))
{
	if (!in_array($file,$arr) && !is_dir('./' . $file))
	{
		loadFiles(str_replace('.js','',$file));
	}
}
@closedir ($temp);

function loadFiles($file)
{
	global $script,$loaded;
	$arr = explode(',',$file);
	foreach($arr as $fileN)
	{
		if(!in_array($fileN,$loaded))
		{
			$loaded[] = $fileN;
			$script .= file_get_contents('./'.$fileN.'.js')."\n\n\n";
			echo "-> Loaded File: ".$fileN.".js\n";
		}
	}
}

file_put_contents('../xu.js', $script);
file_put_contents('../xu.gz.js', gzencode($script, 9, FORCE_GZIP));


echo "-> Javascript Files combined into xu.js!
################################################
################################################";
echo "</code></pre>";
?>