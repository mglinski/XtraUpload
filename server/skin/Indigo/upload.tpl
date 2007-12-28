<?
$upload = $kernel->upload->set();
$ret = $kernel->upload->return;

if(!$upload)
{
	header("location: ".makeXuLink('index.php', array('p'=>'uploadError', 'error' => $kernel->upload->error)));
	die;
}
else
{
	$kernel->server->update_bandwith($kernel->upload->file_name);
	//echo 'File Uploaded. Please wait while we process your file.<br />file_upload&secid='.$kernel->upload->secid.'<div class="clearer"></div>';
	
	$img = $kernel->upload->file_name; 
	$img = str_replace('.','',strtolower (strrchr ($img, '.')));
	$type = $img;
	if(($img == 'png' or $img == 'jpg' or $img == 'jpeg') && $allow_imaging)
	{
		$img = true;
		$thumb = img_thumb('./files/'.substr($kernel->upload->md5,0,2).'/'.$kernel->upload->file_name);
	}
	
	echo "<script> location = '".makeXuLink('index.php', array('p'=>'fileUpload', 'secid' => $kernel->upload->secid) )."'; </script>";
	die;
}
?>