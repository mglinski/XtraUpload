<?php
/*
XtraUpload - File Hosting Software
Copyright (C) 2006-2007  Matthew Glinski and XtraFile.com
Link: http://www.xtrafile.com
-----------------------------------------------------------------
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program(LICENSE.txt); if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

include("./init.php");

if($_REQUEST['process'])
{
	$post_valid = $_POST['valid'];
	if($post_valid == "yes")
	{
		if($_POST['all_filetypes'])
		{
			$_POST['att_filetypes'] = '*|'.$_POST['att_filetypes'];
		}
		
		$sql = "UPDATE `config` SET ";
		$posts = '';
		foreach($_POST as $key => $value)
		{
			if($key != 'valid' and $key != 'Submit')
			{
				$sql = "UPDATE `config` SET `value` = '$value' WHERE id = '".$key."'";
				$qr1 = $db->query($sql);
			}
		}
		$valid = true;
		$msg = '<img src="../images/actions/Certificate_32x32.png" /><br />Config Successfully Updated!';
		unset($s);
	}
	else
	{
		$valid = false;
	}
}
else if($_REQUEST['add'])
{
	$post_valid = $_POST['valid'];
	if($post_valid == "yes")
	{
		$sql = "INSERT INTO `config` VALUES (NULL, '{$_POST['1']}', '{$_POST['2']}', '{$_POST['3']}', '{$_POST['4']}', '{$_POST['5']}', '{$_POST['6']}', '0')";
		$db->query($sql);
		$valid = true;
		$msg = 'Config Item Successfully Added!';
	}
	else
	{
		$valid = false;
	}
}
else if($_REQUEST['delete'])
{
	$sql_pre = "SELECT * FROM `config` WHERE `id` = '".intval($_GET['delete'])."'";
	$pre = $db->query($sql_pre);
	$config = $db->fetch($pre);
	if($config->invincible != '1' and $config->name != '' and $config->name != 'version')
	{
		$sql = "DELETE FROM `config` WHERE `id` = '".intval($_GET['delete'])."'";
		$db->query($sql);
		$valid = true;
		$msg = 'Config Item Successfully Deleted!';
	}
	else
	{
		$valid = false;
	}
}
else
{
	$valid = false;
}


?>
<h1><span>Site Wide Configuration</span>XtraUpload :: Admin Panel</h1>
<div class="actionsMenu">
  <div class="spacer"></div>
      <a id="menu1" style="display:none" href="javascript:showManageForm();">
      <div class="item">
        <div class="img" style="background-image:url(../images/small/view.png);"></div>
        <div class="txt">Manage</div>
      </div>
      </a> 
      
      <a id="menu2" href="javascript:showAddForm();">
      <div class="item">
        <div class="img" style="background-image:url(../images/small/add.png);"></div>
        <div class="txt">Add</div>
      </div>
      </a> 
  </div>
<br />
<? if($msg != ''){?>
<div id="msgBox" class="msgBox"> <img class="okImg" src="../images/actions/OK_24x24.png" alt="Ok!"  /> <span>
  <?=$msg?>
  </span> <a href="javascript:;" onclick="hideMsgBox()"> <img class="closeImg" src="../images/small/Close.png" alt="Close"  /> </a> </div>
<? }?><br />
<div id="mainContent">
	<table id="manage" width="846" border="0" cellpadding="0" cellspacing="0" align="center">
	  <tr>
		<td width="846">
		  <form name="form1" method="post" action="config.php?process=true">
			<div align="center"> <br />
			<?
			$groups = array();
			$html = '';
			$sql = "SELECT * FROM `config` WHERE `name` != 'version'";
			$qr1 = $db->query($sql);	
			while($config = $db->fetch($qr1,"obj"))
			{
			    $html = '<table width="729" border="0" align="center" cellpadding="5" cellspacing="0" class="mainTable">
			     <tr>
				  <td width="261" class="mainRow"><div align="right" class="style3">'.$config->description1.'</div></td>
				  <td width="438"  class="mainRow">';
				  
				  if($config->type == 'text')
				  {
					  $html .= '<input type="text" name="'.$config->id.'" id="'.$config->name.'" value="'.$config->value.'" /> '.$config->description2;
				  }
				  else if($config->type == 'box')
				  {
					  $html .= '<textarea rows="8" cols="60" name="'.$config->id.'" id="'.$config->name.'" >'.$config->value.'</textarea> <br />'.$config->description2;
				  }// <script>$("#'.$config->name.'").tinymce();
				  else if($config->type == 'color')
				  {
					  $html .= '<div id="color_'.$config->id.'"></div><script>$("#color_'.$config->id.'").farbtastic(\''.$config->name.'\',\''.$config->value.'\');</script><br /><input style="background-color:'.$config->value.'" type="text" name="'.$config->id.'" value="'.$config->value.'" id="'.$config->name.'" \>'.$config->description2;
				  }
				  else
				  {
					  $description = $config->description2;
					  $description = explode('|-|',$description);
					  $html .= '<input type="radio" name="'.$config->id.'" id="'.$config->name.'" value="1"'; if($config->value == '1'){$html .= ' checked="checked"';} $html .= ' /> '.$description[0].'<br />';
					  $html .= '<input type="radio" name="'.$config->id.'" id="'.$config->name.'" value="0"'; if($config->value == '0'){$html .= ' checked="checked"';} $html .= ' /> '.$description[1].'<br />';
				  }
				  
				  $html .= '</td>';
				  $html .= '<td width="24" class="mainRow">';
				  
				  if(!$config->invincible)
				  {
				     $html .= '<a href="config.php?delete='.$config->id.'">'.get_icon('Cancel','normal').'</a>'; 
				  }
				  else
				  {
				  	 $html .= '&nbsp;';
				  }
				  
				  $html .= '</td>
				  </tr>
				</table>';
				
				$groups[$config->group] .= $html;
			   }
			   
			   foreach($groups as $key => $value)
			   {
			       if($key != '')
				   {
				    	if($value != '')
						{
				   echo '<fieldset>
							   <legend>'.$key.'</legend> 
							   <center><a id="'.str_replace(' ','_',$key).'_link" href="javascript:void(0);" onclick="$(\'#mainContent\').css(\'height\',\'auto\'); $(\'#'.str_replace(' ','_',$key).'\').slideDown(\'normal\');$(\'#'.str_replace(' ','_',$key).'_link\').slideUp(\'normal\');">Show Settings</a></center><div style="display:none" id="'.str_replace(' ','_',$key).'">'.$value.'<center><input type="submit" name="Submit" value="   Quick Update   " /></center></div>
						   </fieldset><br />';
						}
					}
			   }
			   ?>
			  <input type="hidden" name="valid" value="yes" />
			  <input type="submit" name="Submit" value="   Update   " />
		</div></form>    
		</td>
	  </tr>
  </table>
	<table style="display:none" id="add" width="849"cellpadding="0" cellspacing="4" align="center" class="slideUp">
	  <tr>
		<td width="841">
		  <form name="form1" method="post" action="config.php?add=1">
			 <div align="center">
				  <p><span class="subTitle">Add a Setting </span></p>
				  <table width="843" border="0" align="center" cellpadding="3" cellspacing="3">
					<tr>
					  <td width="253" class="mainRow"><div align="right">Setting Name: </div></td>
						<td width="576" class="mainRow"><input type="text" name="1" />
					  The Name of the setting inside theh script. Example: help = $help </td>
				    </tr>
					<tr>
					  <td class="mainRow"><div align="right">Default Value: </div></td>
						<td class="mainRow"><p>
						  <input type="text" name="2" />
						  Default Value for Setting?(if yes/no use 1 or 0) </p>
					  </td>
				    </tr>
					<tr>
					  <td class="mainRow"><div align="right">Setting Title : </div></td>
					  <td class="mainRow"><input type="text" name="3" /> 
					    The name of the setting as displayed to the user. </td>
				    </tr>
					<tr>
					  <td class="mainRow"><div align="right">Setting Description: </div></td>
					  <td class="mainRow"><input type="text" name="4" /></td>
				    </tr>
					<tr>
					  <td class="mainRow"><div align="right">Setting Group:</div></td>
						<td class="mainRow"><input type="text" name="5" />
						  Settings Group Name </td>
				    </tr>
					<tr>
					  <td class="mainRow"><div align="right">Setting Type: </div></td>
					  <td class="mainRow"><p>
						<select name="6">
							<option value="text" >Textbox (text value) </option>
							<option value="box" >TextArea (text value) </option>
							<option value="yesno" >Yes/No Radio Buttons (true/false value)</option>
							<option value="color" >HEX Color Code ('#FFFFFF' value)</option>
						</select>
					  </td>
				    </tr>
			   </table>
	  			<input type="hidden" name="valid" value="yes" />
			    <input type="submit" name="Submit" value="  Add  " />
		    </div>
	      </form>    
	    </td>
	  </tr>
  </table>
</div>
<script>
function showManageForm()
{
	if($('#add').css('display') != 'none')
	{
		$('#add').slideUp('normal');
		$('#menu1').css('display','none');
	}
	$('#manage').slideDown('normal'); 
	$('#menu2').css('display','block');
}

function showAddForm()
{
	if($('#manage').css('display') != 'none')
	{
		$('#manage').slideUp('normal');
		$('#menu2').css('display','none');
	}
	$('#add').slideDown('normal');
	$('#menu1').css('display','block');
}
<? if(strlen($msg)){?>
function hideMsgBox()
{
	$('#msgBox').slideUp('normal');
}
setTimeout('hideMsgBox()', 20000);
<? }?>
</script>
<?
	include("admin/footer.php");
?>