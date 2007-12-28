<script type="text/javascript">
var links_html = '';
function get_links_result(block)
{
	$('#form1').hide('slow');
	//show_loading();
	$.post("<?=makeXuLink('api.php','page=linkcheckerscript')?>", {links: ""+block+""},
	function(data)
	{
		eval(data);
		$('#links_return').show('slow');
		this.blur();
	});
	
	return false;
}
</script>
<style type="text/css">
<!--
.style2 {
	font-size: 18px;
	font-weight: bold;
}
-->
</style>

<div align="center">
  <h1><?=$lang['linkchecker']['1']?></h1>
  <p><?=$lang['linkchecker']['2']?></p>  
  <table width="600" border="2" bordercolor="#000000" cellspacing="0" id="links_return" style="display:none;">
    <tr>
      <td>
	    <div align="center"><font size="5"><?=$lang['linkchecker']['3']?></font></div>	  <br /></td>
    </tr>
    <tr>
      <td width='600'><div align="center" style="border:1px solid #666666"><span id='links_code'></span></div></td>
    </tr>
    <tr>
      <td><div align="center"> <span id="links_val_num">0</span><?=$lang['linkchecker']['4']?><span id="links_num">0</span> <?=$lang['linkchecker']['5']?></div>
	  <br />
	    <hr />
	  <br />
<center><input type="button" onclick="$('#form1').show('slow');$('#links_return').hide('slow');$('#links_block').attr('value','')" value="<?=$lang['linkchecker']['6']?>" style="font-size: 18px; font-weight: bold; text-align:center" /></center>
</td>
    </tr>
  </table></div>
  <table width="400" align="center" cellspacing="0">
    <tr>
      <td>
  <form method="post" id="form1" onsubmit="return get_links_result(this.links_block.value);">
    <textarea name="links" id='links_block' cols="80" rows="12"></textarea><br />
    <center><input name="validate" type="submit" id="validate" value="<?=$lang['linkchecker']['7']?>" /></center>
  </form>
  </td>
    </tr>
  </table>
<br />
<br />
