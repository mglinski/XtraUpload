<?
$sql = "SELECT * FROM files WHERE hash='".txt_clean($_REQUEST['file'])."' AND status='1'";
$qu = $db->query($sql);
$file = $db->fetch($qu,"obj");
if($db->num($qu) == '1')
{
	echo "<script> location = '".makeXuLink('index.php','p=download&hash='.$file->hash)."';</script>";
}
else
{
	echo "<script> location = '".makeXuLink('index.php','p=fileError&hash='.txt_clean($_REQUEST['file']))."';</script>";
}
?>