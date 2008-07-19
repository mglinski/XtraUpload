<?php 
header("Content-type: text/javascript; charset: UTF-8");
$isGZip = false;
if(ini_get('zlib.output_compression') == 'On' or ini_get('output_buffering') == 'On')
{
	$isGZip = true;
	header("Content-Encoding: deflate");
}
header("Cache-Control: must-revalidate");
header("Expires: " .gmdate("D, d M Y H:i:s",time() + (60 * 60)) . " GMT");
if($isGZip)
{
	readfile("xu.gz");
}
else
{
	readfile("xu.js");
}