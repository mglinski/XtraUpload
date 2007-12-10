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

class xu_mail
{
	var $num_sent=0;
	var $db;
	var $content = array();
	
	function xu_mail()
	{
		global $db;
		$this->db = $db;
	}
	
	function send_email($sender, $subject, $text, $send_to)
	{
		mail($send_to,$subject,$text,'From: '.$sender.'\n\r');
		log_action('Mail sent to ('.$send_to.')', 'mail:send', '('.$sender.') sent ('.$send_to.') an email with the subject ('.$subject.') and message <[[('.$text.')]]>', 'ok', 'functions.inc.php');
	}
}
?>