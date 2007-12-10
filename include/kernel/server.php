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
class server
{
	function server()
	{
	
	}
	
	function get_server()
	{
		global $db;
		$sql1 = "SELECT * FROM `servers`  WHERE `active` = '1'";
	
		$qr3 = $db->query($sql1, "server_1");	
		$serv_array = array();
		$i = 0;
	
		while($c = $db->fetch($qr3,"obj"))
		{
			$serv_array[$i] = $c->id;	
			$i++;	
		}
	
		$i--;
		$serv_count = $i;
		$serv_id = rand(0,$i);
		
		$sql2 = "SELECT * FROM `servers` WHERE `id` = '$serv_array[$serv_id]' ";
		if($serv_count != '0')
		{
			$sql2 .=  "AND used_bandwith < total_bandwith AND space_limit > space_used";
		}
		$qr2 = $db->query($sql2, "server_2");	
		$d = $db->fetch($qr2,"obj");
		$server = $d->link;
		return $server;
	}
	
	function update_bandwith($file)
	{
		global $db;
		// Grab the file info
		$que1 = $db->query("SELECT * FROM files WHERE filename='".$file."' LIMIT 1");
		$res1 = $db->fetch($que1,'obj');
		
		// Put Server name into Variable
		$file_server = $res1->server;
		$size = $res1->size;
		
		// Grab The Server Row From the database
		$que2 = $db->query("SELECT * FROM servers WHERE link='".$file_server."' ");
		$server = $db->fetch($que2,'obj');
		
		//Get total used bandwith
		$server_bw = ($server->used_bandwith + $size );
		$server_id = $server->id;
		
		// Update the server with the new total
		$que3 = $db->query("UPDATE servers SET used_bandwith = '".$server_bw."' WHERE id='".$server_id."' ");
		if($que3)
		{
			$return = array('complete' => true,'error' => 'none');
		}
		else
		{
			$return = array('complete' => false,'error' => mysql_error());
		}
		
		$return = serialize($return);
		return $return;
	}
	
	function update_total_size($file)
	{
		global $db;
		// Grab the file info
		$que1 = $db->query("SELECT * FROM files WHERE filename='".$file."' LIMIT 1");
		$res1 = $db->fetch($que1,'obj');
		
		// Put Server name into Variable
		$file_server = $res1->server;
		$size = $res1->size;
		
		// Grab The Server Row From the database
		$que2 = $db->query("SELECT * FROM servers WHERE link='".$file_server."' ");
		$server = $db->fetch($que2,'obj');
		
		//Get total used bandwith
		$server_space = ($server->space_used + $size);
		$server_id = $server->id;
		
		// Update the server with the new total
		$que3 = $db->query("UPDATE servers SET space_used = '".$server_space."'  WHERE id='".$server_id."' ");
		if($que3)
		{
			$return = array('complete' => true,'error' => 'none');
		}
		else
		{
			$return = array('complete' => false,'error' => mysql_error());
		}
		
		$return = serialize($return);
		return $return;
	}

}
?>