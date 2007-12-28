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

###################################
echo '<h2 align="center">'.$sitename.' - F.A.Q</h2>';
$f1 = $db->query("SELECT * FROM `faq` ORDER BY `pos`");
$faqs = array();
$i = 0;
while($faq = $db->fetch($f1,'obj'))
{
	$faqs[$i] = array('id' => $faq->id,'name' => $faq->name);
	$i++;
}


$f2 = $db->query("SELECT * FROM `faq_items` ORDER BY `pos`");
$faq_items = array();
$i=0;
while($faq_item = $db->fetch($f2,'obj'))
{
	$faq_items[$i] = array('id' => $faq_item->faq, 'a' => $faq_item->id, 'name' => $faq_item->name,'answer' => $faq_item->answer);
	$i++;
}
$i--;
foreach($faqs as $id => $name)
{
?>
<table width="700" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><b><a href="#c<?=$name['id']?>"><?=$name['name']?></a></b><br />
	<? echo '<blockquote>';
	foreach($faq_items as $id => $arr)
	{
	
		if($arr['id'] == $name['id'])
		{
			?><li><a href="#i<?=$arr['a']?>"><?=$arr['name']?></a></li><?
	  	}
		
	}echo '</blockquote>';
?>
</td>
  </tr>
</table>
<?
}

foreach($faqs as $id => $name)
{

?>

<table width="700" border="0" cellspacing="3" cellpadding="0" style="border:1px solid #000000">
<tr><td><b><center><a id="c<?=$name['id']?>"></a><a href="#"><?=$name['name']?></a></center></b><br /></td></tr>
<tr><td>&nbsp;</td></tr>
	<? 
	foreach($faq_items as $id => $arr)
	{
	
		if($arr['id'] == $name['id'])
		{
			?>
			<tr><td><a id="i<?=$arr['a']?>"></a><b><?=$arr['name']?></a></b><br /></td></tr>
			<tr><td><?=str_replace(array('-!-{$SITEURL}-!-', '-!--!-', '-SITEURL-'), $siteurl, $arr['answer'])?><br /></td></tr>
			<tr><td>&nbsp;</td></tr>
			<?
	  	}
		
	}
?>
<tr><td>&nbsp;</td></tr>
</td>
  </tr>
</table><hr />
<?

}
###################################

?>