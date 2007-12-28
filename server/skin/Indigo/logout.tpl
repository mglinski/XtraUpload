<?
	logout();
	echo "<br />
<br />
<h2>".$lang['logout']['1']."</h2><br />
<h4>".$lang['logout']['2']."</h4>
<br />
<script>
function red()
{
	window.location =  '".makeXuLink('index.php','p=home')."';
}
setTimeout('red()',2000);</script>
";
?>