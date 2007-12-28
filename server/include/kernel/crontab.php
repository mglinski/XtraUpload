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
define("PC_MINUTE",	1);
define("PC_HOUR",	2);
define("PC_DOM",	3);
define("PC_MONTH",	4);
define("PC_DOW",	5);
define("PC_CMD",	7);
define("PC_COMMENT",	8);
define("PC_CRONLINE", 20);

class crontab
{
	var $cronTab = "1   1    *    *    *    ./prune.php";
	var $jobs;

	function crontab()
	{
		$this->run();
	}

	function lTrimZeros($number) 
	{
		while ($number[0]=='0') 
		{
			$number = substr($number,1);
		}
		return $number;
	}
	
	function multisort(&$array, $sortby, $order='asc') 
	{
	   foreach($array as $val) 
	   {
		   $sortarray[] = $val[$sortby];
	   }
	   $c = $array;
	   $const = $order == 'asc' ? SORT_ASC : SORT_DESC;
	   $s = array_multisort($sortarray, $const, $c, $const);
	   $array = $c;
	   return $s;
	}
	
	function parseElement($element, &$targetArray, $numberOfElements) 
	{
		$subelements = explode(",",$element);
		for ($i=0;$i<$numberOfElements;$i++) 
		{
			$targetArray[$i] = $subelements[0]=="*";
		}
		
		for ($i=0;$i<count($subelements);$i++) 
		{
			if (preg_match("~^(\\*|([0-9]{1,2})(-([0-9]{1,2}))?)(/([0-9]{1,2}))?$~",$subelements[$i],$matches)) 
			{
				if ($matches[1]=="*") 
				{
					$matches[2] = 0;		// from
					$matches[4] = $numberOfElements;		//to
				} 
				elseif ($matches[4]=="") 
				{
					$matches[4] = $matches[2];
				}
				if ($matches[5][0]!="/") 
				{
					$matches[6] = 1;		// step
				}
				for ($j=$this->lTrimZeros($matches[2]);$j<=$this->lTrimZeros($matches[4]);$j+=$this->lTrimZeros($matches[6])) 
				{
					$targetArray[$j] = TRUE;
				}
			}
		}
	}
	
	function incDate(&$dateArr, $amount, $unit) 
	{
		
		if ($unit=="mday") 
		{
			$dateArr["hours"] = 0;
			$dateArr["minutes"] = 0;
			$dateArr["seconds"] = 0;
			$dateArr["mday"] += $amount;
			$dateArr["wday"] += $amount % 7;
			if ($dateArr["wday"]>6) 
			{
				$dateArr["wday"]-=7;
			}
	
			$months28 = Array(2);
			$months30 = Array(4,6,9,11);
			$months31 = Array(1,3,5,7,8,10,12);
			
			if ((in_array($dateArr["mon"], $months28) && $dateArr["mday"]==28) || (in_array($dateArr["mon"], $months30) && $dateArr["mday"]==30) || (in_array($dateArr["mon"], $months31) && $dateArr["mday"]==31)) 
			{
				$dateArr["mon"]++;
				$dateArr["mday"] = 1;
			}
			
		} 
		elseif ($unit=="hour") 
		{
			if ($dateArr["hours"]==23) 
			{
				$this->incDate($dateArr, 1, "mday");
			} 
			else 
			{
				$dateArr["minutes"] = 0;
				$dateArr["seconds"] = 0;
				$dateArr["hours"]++;
			}
		} 
		elseif ($unit=="minute") 
		{
			if ($dateArr["minutes"]==59) 
			{
				$this->incDate($dateArr, 1, "hour");
			} 
			else 
			{
				$dateArr["seconds"] = 0;
				$dateArr["minutes"]++;
			}
		}
	}
	
	function getLastActualRunTime($jobname) 
	{
		$jobfile = $jobname;
		if (file_exists($jobfile)) 
		{
			return filemtime($jobfile);
		}
		return 0;
	}
	
	function getLastScheduledRunTime($job) 
	{
	
		$extjob = Array();
		$this->parseElement($job[PC_MINUTE], $extjob[PC_MINUTE], 60);
		$this->parseElement($job[PC_HOUR], $extjob[PC_HOUR], 24);
		$this->parseElement($job[PC_DOM], $extjob[PC_DOM], 31);
		$this->parseElement($job[PC_MONTH], $extjob[PC_MONTH], 12);
		$this->parseElement($job[PC_DOW], $extjob[PC_DOW], 7);
		
		$dateArr = getdate($this->getLastActualRunTime($job[PC_CMD]));
		$minutesAhead = 0;
		while ($minutesAhead<525600 and (!$extjob[PC_MINUTE][$dateArr["minutes"]] or !$extjob[PC_HOUR][$dateArr["hours"]] or (!$extjob[PC_DOM][$dateArr["mday"]] OR !$extjob[PC_DOW][$dateArr["wday"]]) or !$extjob[PC_MONTH][$dateArr["mon"]])) 
		{
			if (!$extjob[PC_DOM][$dateArr["mday"]] OR !$extjob[PC_DOW][$dateArr["wday"]]) 
			{
				$this->incDate($dateArr,1,"mday");
				$minutesAhead+=1440;
				continue;
			}
			if (!$extjob[PC_HOUR][$dateArr["hours"]]) 
			{
				$this->incDate($dateArr,1,"hour");
				$minutesAhead+=60;
				continue;
			}
			if (!$extjob[PC_MINUTE][$dateArr["minutes"]]) 
			{
				$this->incDate($dateArr,1,"minute");
				$minutesAhead++;
				continue;
			}
		}
		
		return mktime($dateArr["hours"],$dateArr["minutes"],0,$dateArr["mon"],$dateArr["mday"],$dateArr["year"]);
	}
	
	function markLastRun($jobname) 
	{
		touch($jobname);
	}
	
	function runJob($job) 
	{
		global $db, $kernel;
		$lastScheduled = $job["lastScheduled"];
		if ($lastScheduled<time()) 
		{
	
			$e = @error_reporting(0);
			include($job[PC_CMD]);
			@error_reporting($e);
			$this->markLastRun($job[PC_CMD]);
			return true;
		} 
		else 
		{
			return false;
		}
	}
	
	function parseCronFile($cronTabFile) 
	{
		$file = explode("\n",$cronTabFile);
		$job = Array();
		$this->jobs = Array();
		for ($i=0;$i<count($file);$i++) 
		{
			if ($file[$i][0]!='#') 
			{
				if (preg_match("~^([-0-9,/*]+)\\s+([-0-9,/*]+)\\s+([-0-9,/*]+)\\s+([-0-9,/*]+)\\s+([-0-7,/*]+|(-|/|Sun|Mon|Tue|Wed|Thu|Fri|Sat)+)\\s+([^#]*)\\s*(#.*)?$~i",$file[$i],$job)) 
				{
					$jobNumber = count($this->jobs);
					$this->jobs[$jobNumber] = $job;
					if ($this->jobs[$jobNumber][PC_DOW][0]!='*' AND !is_numeric($this->jobs[$jobNumber][PC_DOW])) 
					{
						$this->jobs[$jobNumber][PC_DOW] = str_replace(
							Array("Sun","Mon","Tue","Wed","Thu","Fri","Sat"),
							Array(0,1,2,3,4,5,6),
							$this->jobs[$jobNumber][PC_DOW]);
					}
					$this->jobs[$jobNumber][PC_CMD] = trim($job[PC_CMD]);
					$this->jobs[$jobNumber][PC_COMMENT] = trim(substr($job[PC_COMMENT],1));
					$this->jobs[$jobNumber][PC_CRONLINE] = $file[$i];
				}				
				$this->jobs[$jobNumber]["lastScheduled"] = $this->getLastScheduledRunTime($this->jobs[$jobNumber]);
			}
		}
		
		$this->multisort($this->jobs, "lastScheduled");
		
		return $this->jobs;
	}

	function run()
	{
		$this->jobs = $this->parseCronFile($this->cronTab);
		for ($i=0;$i<count($this->jobs);$i++) 
		{
			$this->runJob($this->jobs[$i]);
		}
	}
	
	function custom_job($job)
	{
		$this->jobs = $this->parseCronFile($job);
		for ($i=0;$i<count($this->jobs);$i++) 
		{
			$this->runJob($this->jobs[$i]);
		}
	}
}
?>