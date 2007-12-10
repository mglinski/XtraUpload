<?
if($_SESSION['loggedin'])
{
?>
<table width="646" border="0" align="center">
  <tr>
    <td width="470" class="style1"><p>
		<?=$lang['history']['1'].$_SESSION['username']?><br><br>
        <?=$lang['history']['2']?><br><br>
        <?=$lang['history']['3'].total_points($_SESSION['myuid'])?><br>
        <?=$lang['history']['4'].$_SESSION['file_name']; ?><br>
        <?=$lang['history']['5'].$_SESSION['file_size']; ?> </p>
    </td>
  </tr>
</table
<?
}
else
{
	redirect_foot("<h4><center>".$lang['history']['6']."</center></h4>",'home');
}
?>