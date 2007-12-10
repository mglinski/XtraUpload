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
function get_accounts()
{
	global $kernel, $db, $lang;
	
	$accArr = array();
	$retArr = array();
	$endArr = array();
	
	$c=0;
	$i=0;
	$query = $db->query("SELECT * FROM groups WHERE visible = '1' ", '', true);
	$num = $db->num($query);
	$kernel->tpl->assign('colNum', $num);
	while($a = $db->fetch($query,'obj'))
	{
		//###############################################
		$accArr[$c]['lang'] = $lang['open']['1'];
		$retArr[$c++][$i]['val'] = $a->name;
		//###############################################
		$accArr[$c]['lang'] = $lang['open']['2'];
		if(floatval($a->price) > 0.000)
		{ 
			$retArr[$c++][$i]['val'] = '$'.$a->price;
		}
		else
		{
			$retArr[$c++][$i]['val'] = $lang['open']['3'];	
		}
		//###############################################
		$accArr[$c]['lang'] = $lang['open']['4'];
		if($a->limit != '0')
		{ 
			$retArr[$c][$i]['val'] = $a->limit;
		}
		else
		{
			$retArr[$c][$i]['val'] = $lang['open']['5'];
		}
		$retArr[$c++][$i]['val'] .= ' '.$lang['open']['6'];
		//###############################################
		$accArr[$c]['lang'] = $lang['open']['7'];
		if($a->limit_size != '0')
		{ 
			$retArr[$c][$i]['val'] = $a->limit_size;
		}
		else
		{
			$retArr[$c][$i]['val'] = $lang['open']['8'];
		}
		$retArr[$c++][$i]['val'] .= ' '.$lang['open']['9'];
		//###############################################
		$accArr[$c]['lang'] = $lang['open']['10'];
		if($a->resume)
		{
			$retArr[$c++][$i]['val'] = get_icon('Checkmark','small');
		}
		else
		{
			$retArr[$c++][$i]['val'] = get_icon('Close','small');
		}
		//###############################################
		$accArr[$c]['lang'] = $lang['open']['11'];
		if($a->can_cgi)
		{
			$retArr[$c++][$i]['val'] = get_icon('Checkmark','small');
		}
		else
		{
			$retArr[$c++][$i]['val'] = get_icon('Close','small');
		}
		//###############################################
		$accArr[$c]['lang'] = $lang['open']['12'];
		if($a->can_url)
		{
			$retArr[$c++][$i]['val'] = get_icon('Checkmark','small');
		}
		else
		{
			$retArr[$c++][$i]['val'] = get_icon('Close','small');
		}
		//###############################################
		$accArr[$c]['lang'] = $lang['open']['13'];
		if($a->can_flash)
		{
			$retArr[$c++][$i]['val'] = get_icon('Checkmark','small');
		}
		else
		{
			$retArr[$c++][$i]['val'] = get_icon('Close','small');
		}
		//###############################################
		$accArr[$c]['lang'] = $lang['open']['14'];
		if($a->can_view_folders)
		{
			$retArr[$c++][$i]['val'] = get_icon('Checkmark','small');
		}
		else
		{
			$retArr[$c++][$i]['val'] = get_icon('Close','small');
		}
		//###############################################
		$accArr[$c]['lang'] = $lang['open']['15'];
		if($a->can_create_folders)
		{
			$retArr[$c++][$i]['val'] = get_icon('Checkmark','small');
		}
		else
		{
			$retArr[$c++][$i]['val'] = get_icon('Close','small');
		}
		//###############################################
		$accArr[$c]['lang'] = $lang['open']['16'];
		if($a->can_manage)
		{
			$retArr[$c++][$i]['val'] = get_icon('Checkmark','small');
		}
		else
		{
			$retArr[$c++][$i]['val'] = get_icon('Close','small');
		}
		//###############################################
		$accArr[$c]['lang'] = $lang['open']['17'];
		if($a->captcha)
		{
			$retArr[$c++][$i]['val'] = get_icon('Checkmark','small');
		}
		else
		{
			$retArr[$c++][$i]['val'] = get_icon('Close','small');
		}
		//###############################################
		$accArr[$c]['lang'] = $lang['open']['18'];
		if($a->home_captcha)
		{
			$retArr[$c++][$i]['val'] = get_icon('Checkmark','small');
		}
		else
		{
			$retArr[$c++][$i]['val'] = get_icon('Close','small');
		}
		//###############################################
		$accArr[$c]['lang'] = $lang['open']['19'];
		if($a->id == '1')
		{
			$a->expire = '0';
		}
	
		if($a->expire !== '0')
		{
			$retArr[$c++][$i]['val'] = $a->expire.$lang['open']['20'];
		}
		else
		{ 
			$retArr[$c++][$i]['val'] = $lang['open']['21'];
		}
		//###############################################
		$accArr[$c]['lang'] = $lang['open']['22'];
		if($a->can_email)
		{
			$retArr[$c++][$i]['val'] = get_icon('Checkmark','small');
		}
		else
		{
			$retArr[$c++][$i]['val'] = get_icon('Close','small');
		}
		//###############################################
		$accArr[$c]['lang'] = $lang['open']['23'];
		if($a->limit_speed != '0')
		{ 
			$retArr[$c++][$i]['val'] = $a->limit_speed.$lang['open']['24']; 
		}
		else
		{ 
			$retArr[$c++][$i]['val'] = $lang['open']['25'];
		}
		//###############################################
		$accArr[$c]['lang'] = $lang['open']['26'];
		if($a->userlimit != '0')
		{ 
			$retArr[$c++][$i]['val'] = ($a->userlimit)-($a->users);
		}
		else
		{ 
			$retArr[$c++][$i]['val'] = $lang['open']['27'];
		}
		//###############################################
		if($a->id == '1')
		{
			$endArr[$i]['av']=false;
		}
		else
		{	
			$endArr[$i]['id']=$a->id;
			$endArr[$i]['av']=true;
		}
		$c=0;
		$i++;
	}
	$kernel->tpl->assign('accArr', $accArr);
	$kernel->tpl->assign('retArr', $retArr);
	$kernel->tpl->assign('endArr', $endArr);
	ob_start();
	$kernel->tpl->display('premium.tpl');
	return ob_get_clean();
}

function getFiles()
{
	global $filetypes, $lang, $files_restrict_allowed;
	$txt = $lang['open']['32'];
	if($files_restrict_allowed)
	{
		$txt .= $lang['open']['33'];
		$not = true;
	}
	$txt .= $lang['open']['37'];
	$files = explode('|', $filetypes);
	$c = count($files);
	$i = 0;
	foreach($files as $ext)
	{
		if($ext == '')
		{
		}
		else
		{
			
			if($i == 1)
			{
				$txt .= ' .'.$ext;
			}
			else if($i == $c)
			{
				$txt .= ', and .'.$ext;
			}
			else
			{
				$txt .= ', .'.$ext;
			}
		}
	}
	$txt .= '<br />';
	if(!$not and $files[0] == '*')
	{
		$txt = '';
	}
	return $txt;
}

function strsplit($str,$split=3)
{
	$len = strlen($str);
	$dev = round($len/$split);
	$a = 0;
	$s = 0;
	$string = array();
	while($dev >= $a)
	{
		$strn = substr($str,$s,$split);
		$string[$a] = $strn;
		$s = $s + $split;
		$a++;
	}
	
	return $string;
}

function starRateGen($hash,$rating)
{
global $siteurl, $lang;
return '
<form method="post" class="rating" id="fileRating" title="File Rating: '.round($rating,2).'" enctype="multipart/form-data" action="'.$siteurl.'jhp/starRate.php">
          <select name="r1" id="r1">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option> 
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
          </select>
          <input type="submit" name="Submit" value="'.$lang['rate']['15'].'" />
</form>
<script>var hashRate = "'.$hash.'"; $("#fileRating").rating();</script>
';
}
?>