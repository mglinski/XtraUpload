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
//----------------------------
// Used in the admin panel
//----------------------------
function writecombo($array_name, $name, $selected = "", $start = 0, $add_text = "", $add_text2 = "") 
{
	$length = count ($array_name);
	if (($array_name == "") || ($length == 0)){
		echo "<select name=\"$name\"></select>\n";
	}else{
		echo "<select name=\"$name\" $add_text $add_text2>\n";
		while (list($key, $val) = @each($array_name)) {
			if( !is_array($val) ){
				$select_name = $val;
				$i = $key;
				echo "  <option value=\"$i\"";
				if ($i == $selected)
				{
					echo " selected";
				}
				echo ">$select_name</option>\n";
			}
		}
		echo "</select>\n";
	}
}

function myround($amt,$dec="3")
{
	ob_start();
	if($dec == 2){
		printf("%6.2f",$amt);
	}else{
		printf("%6.3f",$amt);
	}
	$amount = ob_get_contents();
	ob_end_clean(); 
	$amount = str_replace(" ","",$amount);
	return $amount;
}

class fptime
{
	function fptime()
	{
		return 1;
	}

	function mytime($stamp="",$format="m/d/Y")
	{
		return date( $format,($stamp ? $stamp : time()) );
	}

	function stamp($mm,$dd,$yy,$hh=0,$min=0,$sec=0)
	{
		return mktime($hh,$min,$sec,$mm,$dd,$yy);
	}

	function subhours($interval,$mm,$dd,$yy,$hh,$m,$s)
	{
		return $this->stamp( $mm,$dd,$yy,($hh-$interval),$m,$s );
	}

	function addhours($interval,$mm,$dd,$yy,$hh,$m,$s)
	{
		return $this->stamp( $mm,$dd,$yy,($hh+$interval),$m,$s );
	}

	function subdays($interval,$mm,$dd,$yy)
	{
		return $this->stamp($mm,($dd-$interval),$yy);
	}

	function adddays($interval,$mm,$dd,$yy,$hh=0,$min=0,$sec=0)
	{
		return $this->stamp($mm,($dd+$interval),$yy,$hh,$min,$sec);
	}

	function submonths($interval,$mm,$dd,$yy)
	{
		return $this->stamp( ($mm-$interval),$dd,$yy );
	}

	function addmonths($interval,$mm,$dd,$yy)
	{
		return $this->stamp( ($mm+$interval),$dd,$yy );
	}

	function subyears($interval,$mm,$dd,$yy)
	{
		return $this->stamp( $mm,$dd,($yy-$interval) );
	}

	function addyears($interval,$mm,$dd,$yy)
	{
		return $this->stamp( $mm,$dd,($yy+$interval) );
	}

	function DateDiff ($interval, $date1,$date2) 
	{
		$timedifference =  $date2 - $date1;
		switch ($interval) 
		{
			case "w":
				$retval = $timedifference/604800;
				$retval = floor($retval);
				break;
			case "d":
				$retval = $timedifference/86400;
				$retval = floor($retval);
				break;
			case "h":
				$retval = $timedifference/3600;
				$retval = floor($retval);
				break;
			case "n":
				$retval = $timedifference/60;
				$retval = floor($retval);
				break;
			case "s":
				$retval  = floor($timedifference);
				break;
		}
		return $retval;
	}

	function dateNow($format="%Y%m%d"){
		return(strftime($format,time()));
	}

	function dateToday(){
		$ndate = time();
		return( $ndate );
	}

	function daysInMonth($month="",$year=""){
		if(empty($year)) {
			$year = $this->dateNow("%Y");
		}
		if(empty($month)) {
			$month = $this->dateNow("%m");
		}
		if($month == 2) {
			if($this->isLeapYear($year)) {
				return 29;
			} else {
				return 28;
			}
		} elseif($month == 4 or $month == 6 or $month == 9 or $month == 11) {
			return 30;
		} else {
			return 31;
		}
	}

	function isLeapYear($year=""){
		if(empty($year)) {
			$year = $this->dateNow("%Y");
		}
		if(strlen($year) != 4) {
			return false;
		}
		if(preg_match("/\D/",$year)) {
			return false;
		}
		return (($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0);
	}
}
$month_values= array(
	"0"=>"--",
	"1"=>"Jan",
	"2"=>"Feb",
	"3"=>"Mar",
	"4"=>"Apr",
	"5"=>"May",
	"6"=>"Jun",
	"7"=>"Jul",
	"8"=>"Aug",
	"9"=>"Sep",
	"10"=>"Oct",
	"11"=>"Nov",
	"12"=>"Dec",
);
$day_values= array(
	"0"=>"--",
	"1"=>"1",
	"2"=>"2",
	"3"=>"3",
	"4"=>"4",
	"5"=>"5",
	"6"=>"6",
	"7"=>"7",
	"8"=>"8",
	"9"=>"9",
	"10"=>"10",
	"11"=>"11",
	"12"=>"12",
	"13"=>"13",
	"14"=>"14",
	"15"=>"15",
	"16"=>"16",
	"17"=>"17",
	"18"=>"18",
	"19"=>"19",
	"20"=>"20",
	"21"=>"21",
	"22"=>"22",
	"23"=>"23",
	"24"=>"24",
	"25"=>"25",
	"26"=>"26",
	"27"=>"27",
	"28"=>"28",
	"29"=>"29",
	"30"=>"30",
	"31"=>"31",
);


//----------------------------
// Reads log file
//----------------------------
function readlog($sector='',$limit=0)
{
	global $db;
	$i=0;
	$html = '<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<th width="10%"><span class="style1">Result</th>
	<th width="70%"><span class="style1">Action</th>
	<th width="30%"><span class="style1">Date</th>
  </tr>';
	if($sector != '')
	{
		$log = $db->query("SELECT * FROM `syslog` WHERE sector = '".$sector."' ORDER BY `id` DESC");
	}
	else
	{
		$log = $db->query("SELECT * FROM `syslog`  ORDER BY `id` DESC");
	}
	
	while($syslog = $db->fetch($log))
	{
		
			$html .= '
	  <tr  onmouseover="this.style.backgroundColor = \'#C1DEF0\'" onmouseout="this.style.backgroundColor = \'\'">
		<td width="40"><span align="center" class="style1"><center>';
		if($syslog->status == 'ok')
		{
			$html .= get_icon('OK','normal');
		}
		else if($syslog->status == 'warn')
		{
			$html .= get_icon('Warning','normal');
		}
		else
		{
			$html .= get_icon('Cancel','normal');
		}
		$html .= '</center></span></td>
		<td width="260"><span align="center" class="style1"><center>'.$syslog->desc.'</center></span></td>
		<td width="200 "><span align="center" class="style1"><center>'.$syslog->date.'</center></span></td>
	  </tr>';
	  
		if($limit > 0 and $i < ($limit-1))
		{ 
			$i++;
		}
		else if($i = $limit)
		{
			break;
		}
	}
	$html .= '</table>';
	return $html;
}
?>