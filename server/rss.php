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

// Include XtraUpload System
include("./include/init.php");

//----------------------
// Item Processing Limits - 10 By Default
//----------------------
$limit = 10;
if(isset($_GET['limit']))
{
	if(intval($_GET['limit']) > 0 && intval($_GET['limit']) < 101)
	{
		$limit = intval($_GET['limit']);
	}
}

//---------------------
// Is the Site in Offline Mode
//---------------------
if(!$site_offline)
{

	//-----------------------
	// 'switch()' For Functionality
	//-----------------------
	if($_GET['act'] == 'new')
	{
		// Newest Files
		$items = $db->query("SELECT * FROM files WHERE featured = '1' AND `status` = '1' LIMIT 0 ,".$limit);
	}
	else if($_GET['act'] == 'leastDownloaded')
	{
		// Least Downloaded
		$items = $db->query("SELECT * FROM files WHERE featured = '1' AND `status` = '1' ORDER BY `downloads` ASC LIMIT 0 ,".$limit);
	} 
	else
	{
		// Most Downloaded
		$items = $db->query("SELECT * FROM files WHERE featured = '1' AND `status` = '1' ORDER BY `downloads` DESC LIMIT 0 ,".$limit);
	}
	
	//---------------------
	// Load RSS System
	//---------------------
	$kernel->loadUserExt('rss');
	
		// Set RSS Feed Title
		$kernel->ext->rss->setChannelProperty('title',$sitename.' - RSS');
		
		// Set RSS Home Page Link
		$kernel->ext->rss->setChannelProperty('link',$siteurl.'index.php?p=home');
		
		// Set RSS Feed Description
		$kernel->ext->rss->setChannelProperty('description', 'Uploaded File Feed');
		
		// Set The Date Of Generation
		$kernel->ext->rss->setChannelProperty('pubDate', date('F j, Y, g:i a', time()));
		
		// Set The Creator of the Feed(XtraUpload)
		$kernel->ext->rss->setChannelProperty('generator', 'XtraUpload File Hoster(http://xtrafile.com/XtraUpload) - RSS Powered By XtraFeed(http://xtrafile.com/XtraFeed) Technology');
		
		// Set Channel Copyright Notice
		$kernel->ext->rss->setChannelProperty('copyright', 'Information Is Copyright '.$sitename.' 2007 -|- Files are copyright of their respective owners.');
		
		// Set Feed Encoding
		$kernel->ext->rss->setRssEncoding("UTF-8"); 
		$i=0;
	
	//---------------------
	// Start Item RSS System
	//---------------------
	while ($RSS_items = $db->fetch($items))
	{
		$type = str_replace('.','',strtoupper (strrchr ($RSS_items->o_filename, '.')));
		$icon = $type.' File';
		$imgFile = 'thumbs/'.substr($RSS_items->md5,0,2).'/thumb_'.$RSS_items->filename;
		if(file_exists($imgFile))
		{
			$showImage = true;
		}
		
		if(file_exists('./images/icons/'.$type.'.png'))
		{
			$icon = "<img id='".$type."' src='".$siteurl."images/icons/".$type.".png' alt='".$type."' />";
		}
		
		$user = $db->fetch($db->query("SELECT * FROM users WHERE uid = '".$RSS_items->user."' LIMIT 1"));
		$user = $user->username;
		
		$link = makeXuLink('index.php','p=download&hash='.$RSS_items->hash);
		if($user == '')
		{
			$user = 'Anonymous';
		}
		$description = $RSS_items->description;
		
		if($description == '')
		{
			$description = '&lt;&lt; No File Description &gt;&gt;';
		}
		
		$descriptionFin = $description;
		
		$kernel->ext->rss->addItem();
		$kernel->ext->rss->setItemProperty('title', $RSS_items->o_filename);
		$kernel->ext->rss->setItemProperty('description', $descriptionFin);
		$kernel->ext->rss->setItemProperty('link', $link);
		$kernel->ext->rss->setItemProperty('author', 'Uploader: '.$user);
		$kernel->ext->rss->setItemProperty('pubDate', date('F j, Y, g:i a', $RSS_channel->time));
		$kernel->ext->rss->setItemProperty('category', $type." File" );
		$i++;
		if($i == $limit)
		{
			break;
		}
	} 
	
	$kernel->ext->rss->writeRssXML($siteurl);
	// End Item RSS
}
?>