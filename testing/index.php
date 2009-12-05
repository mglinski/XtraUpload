<?
// load and run the automated testing suite for XU

$fp = opendir('./tests');
while($file = readdir($fp) !== false)
{
	if(substr(0, -4, $file) == '.php' && !is_dir($file) && $file != 'index.php')
		include('./tests/'.$file);
}