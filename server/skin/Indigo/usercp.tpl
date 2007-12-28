<style>
.titleText{ font-size:24px}
</style>

<div align="center"><h1><{$lang.usercp.1}></h1><br />
    <br />
	<form>
  <?php if($g->expire != '0'){?><input onclick="location='<?=makeXuLink('index.php', 'p=points')?>';" value="<?=$lang['points']['14}>" type="button" />
  <?php }?> 
  <input type="button" onclick="location = '<?=makeXuLink('index.php', 'p=files')?>'" value="<{$lang.usercp.16}>" />
  <input type="button" onclick="location = '<?=makeXuLink('index.php', array('p'=>'folders','act'=>'create'))?>'" value="<{$lang.usercp.17}>" />
  <br />
  </form>
  <br />
</div>

<table width="877" height="447" border="0" align="center" cellpadding="3" cellspacing="0">
        <tr>
          <td width="532" height="25"><div align="center"><strong><{$lang.usercp.2}></strong></div></td>
          <td width="333"><div align="center"><{$lang.usercp.3}></strong></div></td>
        </tr>
        <tr>
          <td height="218" style="border:1px solid #000000">
		  	<table width="527" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#3D7DDA">
              <tr>
                <th><font size="2">
                  <?=$lang['editimg']['5}>
                </font></th>
                <th><?=$lang['editimg']['9}></th>
              </tr>
              <?php 
			$sql = "SELECT * FROM files WHERE `status` = '1' AND `user` = '".$_SESSION['myuid']."' ORDER BY `id` DESC LIMIT 5";
			$qr1 = $db->query($sql);
			while( $a = $db->fetch($qr1,'obj') )
			{ 
				?>
		      <tr onmouseover="this.style.backgroundColor = '#C1DEF0'" onmouseout="this.style.backgroundColor = ''">
                <td width="352" height="27"><div align="left">
                    <?php  
				if( check_file($a->hash))
				{
					?>
                    <b><a id="file_<?=$a->id?>" title="<?=$a->o_filename?>" target="_blank" href='<?=makeXuLink('index.php', array('p'=>'download', 'hash'=>$a->hash))?>'><font size="2"><font color="#000000">
                    
					<?php if(strlen($a->o_filename) > 30)
					{  		$o_filename_1 = strsplit($a->o_filename, 3);
						$i=0; $new = '';
						$count = count($o_filename_1); $count--; $count--; $count--; $count--;
						
						while($i < 10)
						{
							$new .= $o_filename_1[$i];
							$i++;
						}
						
						echo $new.'...'.$o_filename_1[$count++].$o_filename_1[$count++].$o_filename_1[$count++].$o_filename_1[$count];
					}
					else
					{
						echo $a->o_filename;
					} 
					?>
	
                      </font></font></a>
                      </b><?php $scriptBlock .= "$('#file_<?=$a->id?>').Tooltip({track: true, delay: 200});"?>
					  
                    <?
				}
				else
				{
					?>
                    <b><font size="2">
                      <?=$lang['editimg']['8}>
                      </font></b>
                    <?
				}
					?>
                </div></td>
		        <td width="157"><div align="center">
		          <?=check_file($a->hash);?>
	            </div></td>
	          </tr>
		      <?
			}
			?>
          </table>
            <p align="right"><a href="<?=makeXuLink('index.php', array('p'=>'files'))?>"><strong><{$lang.usercp.4}></strong></a></p></td>
          <td style="border:1px solid #000000">		
		  <?
		$c = $db->query("select * from users where uid='{$_SESSION['myuid']}'");
		$d = $db->fetch($c,'obj');
			$cusername = $d->username;
			$cpassword = $d->password;
			$cemail = $d->email;

?>
        </p>
        <form method='post'>
		
<table width="336" align="center">
  
  <span class="style187">
  <input type='hidden' name='a' value='personal'>
  </span>
  <tr>
    <td width="137" align=right><strong>
      <?=$lang['editp']['3}>
    </strong></td>
	<td width="187"><div align="left"><b>
	  <?=$cusername?>
	  </b></div></td></tr>
  <tr>
    <td align=right><strong>
      <?=$lang['editp']['4}>
    </strong></td>
	<td><div align="left">
	  <input name=spassword type=text value='' size=25 maxlength=15 />
	  </div></td>
  </tr>
  <tr>
    <td align=right><strong>
      <?=$lang['editp']['5}>
    </strong></td>
	<td><div align="left">
	  <input name=semail type=text value='<?=$cemail?>' size=25 maxlength=75 /> 
	  </div></td>
  </tr>
  <tr>
    <td> </td>
	<td><div align="left">
	  <input name=submit type=submit value='<?=$lang['editp']['6}>'>
	  </div></td>
  </tr>
  </table>
        </form>
        </td>
        </tr>
        <tr>
          <td height="41"><div align="center"><strong><{$lang.usercp.5}></strong></div></td>
          <td><div align="center"><strong><{$lang.usercp.6}></strong></div></td>
        </tr>
        <tr>
          <td height="163" style="border:1px solid #000000">	
		  <form method="post" id="folders_list1">
		  <?php 
			if($can_create_folders)
	{
	$js_folder = '';
			$sql = "SELECT * FROM folder WHERE user='".intval($_SESSION['myuid'])."' ORDER BY `id` DESC LIMIT 5";
			$qr1 = mysql_query($sql);
	?></form>
	<form onsubmit='return false;'>
	<table width="530" border="1" bordercolor="#000000" align="center" cellpadding="5" cellspacing="0">
	<tr>
	<th width="106"><{$lang.usercp.7}></th>
	<th width="257"><{$lang.usercp.8}></th>
	<th width="139"><{$lang.usercp.9}></th>
	</tr>
<?
			while( $a = mysql_fetch_object($qr1) )
			{
				
			
			?>
	<tr onmouseover="this.style.backgroundColor = '#C1DEF0'" onmouseout="this.style.backgroundColor = ''">
		<td>
			<div align="center">
			  <?
			  if($a->name == "")
			  {
			      echo "<b><span id='folder_name_".$a->id."'>[".$lang['usercp']['10']."]</span></b>  ";
			  }
			  else
			  {
				  echo "<b><span id='folder_name_".$a->id."'>".$a->name."</span></b>  ";
			  }
				?>
	        </div></td><td>
				  <div align="center">
				    <?
				echo "<input size='40' type='text' readonly='readonly' value='".makeXuLink('index.php', array('p' => 'view','id' => $a->fid))."' onfocus='this.focus();this.select()' onclick='this.focus();this.select()' onmousedown='this.focus();this.select()' /><br />";
				$js_folder .= createEditableJS("folder_name_".$a->id,"folder","name",$a->id).createEditableJS("folder_pass_".$a->id,"folder","password",$a->id);
				?>
	          </div></td><td>
				  <div align="center">
				<?
				echo "<a id='img_f_".$a->fid."' title='".$lang['userFolders']['6']."' href='".makeXuLink('index.php', array('p' => 'view', 'id' => $a->fid))."'>".get_icon("Folder (Open)", "normal")."</a> &nbsp; ";
				echo "<a id='img_a_".$a->fid."' title='".$lang['userFolders']['7']."' href='".makeXuLink('index.php', array('p' => 'folders', 'login' => $a->fid))."'>".get_icon("Folder", "normal")."</a> &nbsp; ";
				echo "<a id='img_d_".$a->fid."' title='".$lang['userFolders']['8']."'  href='".makeXuLink('index.php', array('p' => 'folders', 'login' => $a->fid, 'del' => $a->fid))."'>".get_icon("Folder (Remove)", "normal")."</a>";
				?>	        
		        </div>
				<?php $scriptBlock .= "$('#img_f_<?=$a->fid?>').Tooltip({track: true, delay: 1500});$('#img_a_<?=$a->fid?>').Tooltip({track: true, delay: 1500});$('#img_d_<?=$a->fid?>').Tooltip({track: true, delay: 1500});";?></td></tr>
		  <?
		  			
			}
?></table>
</form>
<p align="right"><a href="<?=makeXuLink('index.php', array('p' => 'userFolders'))?>"><{$lang.usercp.11}></a></p>
		<script>function load_folder(){<?=$js_folder?>} setTimeout('load_folder()',2000);</script><?
	}
	else
	{
	?><h3><center><?=$lang['folder']['9}></center></h3>
	<?php 
	}
	?></td>
          <td style="border:1px solid #000000">
           <table width="100%" border="0" cellpadding="2" cellspacing="2">
            <tr>
              <td width="484" height="31"><div align="right"><span class="style187"><{$lang.usercp.12}></span></div></td>
              <td width="392"><div align="left"><span class="style187"><span class="a1">
                <?php list($files) = $db->fetch( $db->query("SELECT COUNT(*) FROM `files` WHERE `status` = '1' AND `user` = '".$_SESSION['myuid']."' "), 'num' ); echo $files?>
              </span></span></div></td>
            </tr>
            <tr>
              <td height="38"><div align="right"><span class="style187"><{$lang.usercp.13}></span></div></td>
              <td><div align="left"><span class="style187"><span class="a1">
                <?php list($folders) = $db->fetch( $db->query("SELECT COUNT(*) FROM `folder` WHERE `user` = '".$_SESSION['myuid']."' "), 'num' ); echo $folders;?>
              </span></span></div></td>
            </tr>
            <tr>
              <td height="38"><div align="right"><{$lang.usercp.14}></div></td>
              <td><div align="left">
                <?php $ds = "SELECT * FROM users WHERE username='".$_SESSION['username']."' ";
                    $re = $db->query($ds);
                    $s = $db->fetch($re,"obj"); echo $s->points?>
              </div></td>
            </tr>
            <tr>
              <td height="38"><div align="right"><{$lang.usercp.15}></div></td>
              <td><div align="left">
                <?php 
			  $ser = $db->query("SELECT * FROM `files` WHERE `status` = '1' AND `user` = '".$_SESSION['myuid']."'");
			  $bw=0;
			  while($serv = $db->fetch($ser))
			  {
			  	$bw += $serv->size;
			  }
			  echo get_filesize_prefix($bw);
			  ?>
              </div></td>
            </tr>
          </table></td>
        </tr>
</table>
<script>
$(document).ready(function(){
	<?=$scriptBlock?>
});
</script>