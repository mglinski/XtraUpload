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

class ads
{
	var $ad_id;
	var $src;
	var $type;
	var $no_ads;

	function ads()
	{
		global $no_ads;
		if($no_ads)
		{
			$this->choose_ad();
		}
		$this->no_ads = $no_ads;
	}
	
	function make_link()
	{
		if($this->no_ads)
		{
			if($this->type == 'image')
			{
				$a='<center><a href="'.makeXuLink('index.php','p=click&id='.$this->ad_id).'" target="_blank">
				<img src="'.$this->src.'" alt="Advertisement" border="0" />
				</a></center>';
				return $a;
			}
			else
			{
				return $this->src;
			}
		}
	}

	function choose_ad()
	{
		if($this->no_ads)
		{
			global $db;	
			$qr3 = $db->query("SELECT * FROM `ads` WHERE `status` = '1' ");	
			$ads_array = array();
			$i = 0;
			while($c = $db->fetch($qr3))
			{
				if($c->impressions >= $c->allow_imp && $c->nolimit == '0')
				{
					$qr = $db->query("UPDATE `ads` SET `status` = '0'  WHERE `id` = '".$c->id."'");
				}
				else
				{
					$ads_array[] = $c->id;
				}
			}
	
			array_rand($ads_array);
			$aid = $ads_array[0];
			$qr2 = $db->query("SELECT * FROM `ads` WHERE `id` = '".intval($aid)."' LIMIT 1");	
			$d = $db->fetch($qr2);
			
			$db->query("UPDATE `ads` SET `impressions` = '".($d->impressions + 1)."' WHERE `id` = '".intval($aid)."' LIMIT 1");
			
			$this->type = $d->type;
			$this->src = $d->src;
			$this->ad_id = $d->id;
		}
	}
}
?>