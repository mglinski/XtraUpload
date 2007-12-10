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
class sqlBackup
{
    var $dbServer='localhost';
    var $dbUser=null;
    var $dbPass=null;
	var $db;

    var $SelectedTables=array();
    var $BackupType=null;
    var $BackupDir='./db/';
    var $ListOfDatabasesToMaybeBackUp=array();
    var $GZ_enabled=null;
    
    var $debug=false;
	var $output = '';
    
    function sqlBackup($db='')
    {
		global $db;
        define('backupDBversion', '1.1.27a');
        define('BACKTICKCHAR',    '`');
        define('QUOTECHAR',       '\'');
        define('LINE_TERMINATOR', "\n");  // \n = UNIX; \r\n = Windows; \r = Mac
        define('BUFFER_SIZE',     32768); // in bytes

        $starttime = $this->getmicrotime();
        
        $this->dbServer=$host;
		$this->db = $db;
        $this->dbUser=$user;
        $this->dbPass=$pass;

        if($this->GZ_enabled == NULL)
		{
        	$this->GZ_enabled = (bool)function_exists('gzopen');
		}
        $this->tempbackupfilename = 'db_backup.temp.sql'.($this->GZ_enabled ? '.gz' : '');
    }
	
	function act($act)
	{
		if($act == 'restore')
		{
			$this->AddDatabase();
			$this->GetBackupTables();
		}
		else if($act == 'maintain')
		{
			$this->AddDatabase();
			$this->GetBackupTables();
			$this->CheckStatus();
		}
	}
	
    function AddDatabase()
    {
		global $dbName;
		$this->ListOfDatabasesToMaybeBackUp = $dbName;
		
    }
    function AddTable($dbname='',$table)
    {
        if($dbname&&$table) $this->SelectedTables[$dbname][] = $table;
    }
    function Start($stucture,$data,$complete)
    {
        if($stucture=='1'){ $this->BackupType='_stucture';}
        if($data=='1'){ $this->BackupType.='_data';}
        if($data=='1' && $complete=='1'){ $this->BackupType.='_complete';}
        
        $this->DataType=$complete;
        
        $this->GetBackupTables();
        $this->CheckStatus();
        
        if($stucture=='1')
		{
        	$this->BackupStucture();
        }

        if($data=='1')
		{
        	$this->BackupData();
		}
    }
    function Store($tofile='')
    {
        $this->CloseFile();
        
        $backuptimestamp    = '.'.date('Y-m-d'); // timestamp
	    $backuptimestamp = '.'.'XtraUpload'.$backuptimestamp;

        if($tofile=='')
        {
            $this->backupfilename = 'db'.$this->BackupType.'_'.$backuptimestamp.'.sql'.($this->GZ_enabled ? '.gz' : '');
        }
        else
        $this->backupfilename=$tofile;
        
        if (file_exists($this->BackupDir.$this->backupfilename)) 
		{
			unlink($this->BackupDir.$this->backupfilename); // Windows won't allow overwriting via rename
		}
		rename($this->BackupDir.$this->tempbackupfilename, $this->BackupDir.$this->backupfilename);
    }
    function Email()
    {
        if ($fp = @fopen($this->BackupDir.$this->backupfilename, 'rb')) {
			$emailattachmentfiledata = fread($fp, filesize($this->BackupDir.$this->backupfilename));
			fclose($fp);
			if (!$this->EmailAttachment($this->admin_email, $this->admin_email, 'backupDB: '.basename($this->backupfilename), 'backupDB: '.basename($this->backupfilename), $emailattachmentfiledata, basename($this->backupfilename))) {
				mail($this->admin_email, 'backupDB: Failed to email attachment ['.basename($this->backupfilename).']', 'Failed to email attachment ['.basename($this->backupfilename).']');
			}
			unset($emailattachmentfiledata);
		}
    }
    function FTP()
    {

    }
    function GetBackupTables()
    {
        $NeverBackupDBtypes = array('HEAP');
        //get table from db
        $dbname = $this->ListOfDatabasesToMaybeBackUp;
			set_time_limit(60);
			$tables = mysql_list_tables($dbname);
			if (is_resource($tables)) 
			{
				$tablecounter = 0;
				while (list($tablename) = mysql_fetch_array($tables)) 
				{
					$TableStatusResult = mysql_query('SHOW TABLE STATUS LIKE "'.mysql_escape_string($tablename).'"');
					if ($TableStatusRow = mysql_fetch_array($TableStatusResult)) 
					{
						if (in_array($TableStatusRow['Type'], $NeverBackupDBtypes)) 
						{

							// no need to back up HEAP tables, and will generate errors if you try to optimize/repair

						} else {

							$this->SelectedTables[$dbname][] = $tablename;
						}
					}
				}
			}
    }
    /**
    Check table status,repair it,if nessesary,Repair table
    */
    function CheckStatus()
    {
        if(count($this->SelectedTables)==0) die("No table selected to backup");
		$this->OutputInformation('Checking tables...');
		$TableErrors = array();
		foreach ($this->SelectedTables as $dbname => $selectedtablesarray) {
		mysql_select_db($dbname);
		$repairresult = '';
		$CanContinue = true;
		foreach ($selectedtablesarray as $selectedtablename) {

			$this->OutputInformation('Checking table <b>'.$dbname.'.'.$selectedtablename.'</b>');
			$result = mysql_query('CHECK TABLE '.BACKTICKCHAR.$selectedtablename.BACKTICKCHAR);
			while ($row = mysql_fetch_array($result)) {
				set_time_limit(60);
				if ($row['Msg_text'] == 'OK') {
                    $this->OutputInformation('Optimize table <b>'.$dbname.'.'.$selectedtablename.'</b>');
					mysql_query('OPTIMIZE TABLE '.$selectedtablename);

				} else {

					$this->OutputInformation('Repairing table <b>'.$selectedtablename.'</b>');
					$repairresult .= 'REPAIR TABLE '.$selectedtablename.' EXTENDED'."\n\n";
					$fixresult = mysql_query('REPAIR TABLE '.BACKTICKCHAR.$selectedtablename.BACKTICKCHAR.' EXTENDED');
					$ThisCanContinue = false;
					while ($fixrow = mysql_fetch_array($fixresult)) {
						$repairresult .= $fixrow['Msg_type'].': '.$fixrow['Msg_text']."\n";
						if (($fixrow['Msg_type'] == 'status') && ($fixrow['Msg_text'] == 'OK')) {
							$ThisCanContinue = true;
						}
					}
					if (!$ThisCanContinue) {
						$CanContinue = false;
					}

					$repairresult .= "\n\n".str_repeat('-', 60)."\n\n";

				}
			}
		}
        }
    }
    /**
    Backup selected table stucture
    $this->SelectedTables get from $this->GetBackupTables
    */
    function BackupStucture()
    {
        if(count($this->SelectedTables)==0) die("No table selected to backup");
        $alltablesstructure = '';
        //$dbname = $this->SelectedTables;
		//mysql_select_db($dbname);
        $table_num= count($this->SelectedTables[$dbname]);
		for ($t = 0; $t < $table_num; $t++) {
			set_time_limit(60);
			$this->OutputInformation('Creating structure for <b>'.$dbname.'.'.$this->SelectedTables[$dbname][$t].'</b>');

			$fieldnames     = array();
			$structurelines = array();
			$result = mysql_query('SHOW FIELDS FROM '.BACKTICKCHAR.$this->SelectedTables[$dbname][$t].BACKTICKCHAR);
			while ($row = mysql_fetch_array($result)) {
				$structureline  = BACKTICKCHAR.$row['Field'].BACKTICKCHAR;
				$structureline .= ' '.$row['Type'];
				$structureline .= ' '.($row['Null'] ? '' : 'NOT ').'NULL';
				if (isset($row['Default'])) {
					switch ($row['Type']) {
						case 'tinytext':
						case 'tinyblob':
						case 'text':
						case 'blob':
						case 'mediumtext':
						case 'mediumblob':
						case 'longtext':
						case 'longblob':
							// no default values
							break;
						default:
							$structureline .= ' default \''.$row['Default'].'\'';
							break;
					}
				}
				$structureline .= ($row['Extra'] ? ' '.$row['Extra'] : '');
				$structurelines[] = $structureline;

				$fieldnames[] = $row['Field'];
			}
			mysql_free_result($result);

			$tablekeys    = array();
			$uniquekeys   = array();
			$fulltextkeys = array();
			$result = mysql_query('SHOW KEYS FROM '.BACKTICKCHAR.$this->SelectedTables[$dbname][$t].BACKTICKCHAR);
			while ($row = mysql_fetch_array($result)) {
				$uniquekeys[$row['Key_name']]   = (bool) ($row['Non_unique'] == 0);
				if (isset($row['Index_type'])) {
					$fulltextkeys[$row['Key_name']] = (bool) ($row['Index_type'] == 'FULLTEXT');
				} elseif (@$row['Comment'] == 'FULLTEXT') {
					$fulltextkeys[$row['Key_name']] = true;
				} else {
					$fulltextkeys[$row['Key_name']] = false;
				}
				$tablekeys[$row['Key_name']][$row['Seq_in_index']] = $row['Column_name'];
				ksort($tablekeys[$row['Key_name']]);
			}
			mysql_free_result($result);
			foreach ($tablekeys as $keyname => $keyfieldnames) {
				$structureline  = '';
				if ($keyname == 'PRIMARY') {
					$structureline .= 'PRIMARY KEY';
				} else {
					if ($fulltextkeys[$keyname]) {
						$structureline .= 'FULLTEXT ';
					} elseif ($uniquekeys[$keyname]) {
						$structureline .= 'UNIQUE ';
					}
					$structureline .= 'KEY '.BACKTICKCHAR.$keyname.BACKTICKCHAR;
				}
				$structureline .= ' ('.BACKTICKCHAR.implode(BACKTICKCHAR.','.BACKTICKCHAR, $keyfieldnames).BACKTICKCHAR.')';
				$structurelines[] = $structureline;
			}


			$TableStatusResult = mysql_query('SHOW TABLE STATUS LIKE "'.mysql_escape_string($this->SelectedTables[$dbname][$t]).'"');
			if (!($TableStatusRow = mysql_fetch_array($TableStatusResult))) {
				die('failed to execute "SHOW TABLE STATUS" on '.$dbname.'.'.$tablename);
			}

			$tablestructure  = 'CREATE TABLE '.BACKTICKCHAR.$dbname.BACKTICKCHAR.'.'.BACKTICKCHAR.$this->SelectedTables[$dbname][$t].BACKTICKCHAR.' ('.LINE_TERMINATOR;
            $tablestructure  = 'CREATE TABLE '.BACKTICKCHAR.$this->SelectedTables[$dbname][$t].BACKTICKCHAR.' ('.LINE_TERMINATOR;
			$tablestructure .= '  '.implode(','.LINE_TERMINATOR.'  ', $structurelines).LINE_TERMINATOR;
			$tablestructure .= isset($TableStatusRow['Type']) ? ') TYPE='.$TableStatusRow['Type']:(isset($TableStatusRow['Engine']) ? ') Engine='.$TableStatusRow['Engine']:')');

			if ($TableStatusRow['Auto_increment'] !== null) {
				$tablestructure .= ' AUTO_INCREMENT='.$TableStatusRow['Auto_increment'];
			}
			$tablestructure .= ';'.LINE_TERMINATOR.LINE_TERMINATOR;

			$alltablesstructure .= str_replace(' ,', ',', $tablestructure);

		} // end table structure backup
        $this->OpenFile();
        $this->Write2File($alltablesstructure);
        return $alltablesstructure;
    }
    /**
    Backup selected table data
    $this->SelectedTables get from $this->GetBackupTables
    */
    function  BackupData()
    {
        if(count($this->SelectedTables)==0) die("No table selected to backup");
        $this->OpenFile();
        $processedrows = 0;
        $alltablesdata = '';
		foreach ($this->SelectedTables as $dbname => $value) {
			set_time_limit(60);
			mysql_select_db($dbname);
			for ($t = 0; $t < count($this->SelectedTables[$dbname]); $t++) {
                $this->OutputInformation('Creating data for table <b>'.$dbname.'.'.$this->SelectedTables[$dbname][$t].'</b>');

				$result = mysql_query('SELECT * FROM '.BACKTICKCHAR.$this->SelectedTables[$dbname][$t].BACKTICKCHAR);
				$rows[$t] = mysql_num_rows($result);
				if ($rows[$t] > 0) {
					$tabledatadumpline = '';//$this->SelectedTables[$dbname][$t].LINE_TERMINATOR;
                    $this->Write2File($tabledatadumpline);
                    $alltablesdata.=$tabledatadumpline;
				}
				unset($fieldnames);
				for ($i = 0; $i < mysql_num_fields($result); $i++) {
					$fieldnames[] = mysql_field_name($result, $i);
				}
				if ($this->DataType==1) {
					$insertstatement = 'INSERT INTO '.BACKTICKCHAR.$this->SelectedTables[$dbname][$t].BACKTICKCHAR.' ('.BACKTICKCHAR.implode(BACKTICKCHAR.', '.BACKTICKCHAR, $fieldnames).BACKTICKCHAR.') VALUES (';
				} else {
					$insertstatement = 'INSERT INTO '.BACKTICKCHAR.$this->SelectedTables[$dbname][$t].BACKTICKCHAR.' VALUES (';
				}
				$thistableinserts = '';
				while ($row = mysql_fetch_array($result)) {
					unset($valuevalues);
					foreach ($fieldnames as $key => $val) {
						if ($row[$key] === null) {
							$valuevalues[] = 'NULL';
						} else {
							$valuevalues[] = QUOTECHAR.mysql_escape_string($row[$key]).QUOTECHAR;
						}
					}
					$thistableinserts .= $insertstatement.implode(', ', $valuevalues).');'.LINE_TERMINATOR;

					if (strlen($thistableinserts) >= BUFFER_SIZE) {
                        $alltablesdata.=$thistableinserts;
                        $this->Write2File($thistableinserts);
						$thistableinserts = '';
					}
				}
                $alltablesdata.=$thistableinserts.LINE_TERMINATOR.LINE_TERMINATOR;
                $this->Write2File($thistableinserts.LINE_TERMINATOR.LINE_TERMINATOR);
			}
		}
        return  $alltablesdata;
    }
    function OpenFile()
    {
        if(is_resource($this->fp)) return true;

        if(!is_writable($this->BackupDir)) die($this->backupabsolutepath." is not writable,exit");
        if($this->GZ_enabled)
        $this->fp=@gzopen($this->BackupDir.'/'.$this->tempbackupfilename, 'wb');
        else
        $this->fp=@fopen($this->BackupDir.'/'.$this->tempbackupfilename, 'wb');

    }
    function Write2File($content)
    {
         if($this->GZ_enabled)
         gzwrite($this->fp, $content, strlen($content));
         else
         fwrite($this->fp, $content, strlen($content));
    }
    function CloseFile()
    {
        if($this->GZ_enabled)
        gzclose($this->fp);
        else
        fclose($this->fp);
    }
    function FormattedTimeRemaining($seconds, $precision=1)
    {
	if ($seconds > 86400) {
		return $this->number_format($seconds / 86400, $precision).' days';
	} elseif ($seconds > 3600) {
		return $this->number_format($seconds / 3600, $precision).' hours';
	} elseif ($seconds > 60) {
		return $this->number_format($seconds / 60, $precision).' minutes';
	}
	return $this->number_format($seconds, $precision).' seconds';
    }

    function FileSizeNiceDisplay($filesize, $precision=2)
    {
	if ($filesize < 1000) {
		$sizeunit  = 'bytes';
		$precision = 0;
	} else {
		$filesize /= 1024;
		$sizeunit = 'kB';
	}
	if ($filesize >= 1000) {
		$filesize /= 1024;
		$sizeunit = 'MB';
	}
	if ($filesize >= 1000) {
		$filesize /= 1024;
		$sizeunit = 'GB';
	}
	return number_format($filesize, $precision).' '.$sizeunit;
    }

    function OutputInformation($text='')
    {
		if ($this->debug&&$text) 
		{
			$this->output .= $text.'<br>';
			flush();
		}
    }
    function EmailAttachment($from, $to, $subject, $textbody, &$attachmentdata, $attachmentfilename) {
	$boundary = '_NextPart_'.time().'_'.md5($attachmentdata).'_';

	$textheaders  = '--'.$boundary."\n";
	$textheaders .= 'Content-Type: text/plain; format=flowed; charset="iso-8859-1"'."\n";
	$textheaders .= 'Content-Transfer-Encoding: 7bit'."\n\n";

	$attachmentheaders  = '--'.$boundary."\n";
	$attachmentheaders .= 'Content-Type: application/octet-stream; name="'.$attachmentfilename.'"'."\n";
	$attachmentheaders .= 'Content-Transfer-Encoding: base64'."\n";
	$attachmentheaders .= 'Content-Disposition: attachment; filename="'.$attachmentfilename.'"'."\n\n";

	$headers[] = 'From: '.$from;
	$headers[] = 'Content-Type: multipart/mixed; boundary="'.$boundary.'"';

	return mail($to, $subject, $textheaders.ereg_replace("[\x80-\xFF]", '?', $textbody)."\n\n".$attachmentheaders.wordwrap(base64_encode($attachmentdata), 76, "\n", true)."\n\n".'--'.$boundary."--\n\n", implode("\r\n", $headers));
    }
    function getmicrotime() {
		list($usec, $sec) = explode(' ', microtime());
		return ((float) $usec + (float) $sec);
	}
}


function readSqlFile($sqlfile)
{
    $sql_query='';
    $ext=strtolower(strrchr(basename($sqlfile),'.'));
    if($ext=='.sql')
    {
        $sql_query = file_get_contents($sqlfile);
    }
    else
    {
        $zp = gzopen($sqlfile, "r");
        if ($zp)
		{
        	while (!gzeof($zp))
        	{
        	   $sql_query .= gzgets ($zp, 4096) ;
        	}
		}
    }

	//$sql_query = remove_remarks($sql_query);
	$sql_query = trim($sql_query);
	$sql_query = split_sql_file($sql_query, $delimiter_basic=';');

    return  $sql_query;
}

//
// split_sql_file will split an uploaded sql file into single sql statements.
// Note: expects trim() to have already been run on $sql.
//
function split_sql_file($sql, $delimiter)
{
	$sql = str_replace('\\\n','\n',$sql);
	// Split up our string into "possible" SQL statements.
	$tokens = explode($delimiter, $sql);

	// try to save mem.
	$sql = "";
	$output = array();

	// we don't actually care about the matches preg gives us.
	$matches = array();

	// this is faster than calling count($oktens) every time thru the loop.
	$token_count = count($tokens);
	for ($i = 0; $i < $token_count; $i++)
	{
		// Don't wanna add an empty string as the last thing in the array.
		if (($i != ($token_count - 1)) || (strlen($tokens[$i] > 0)))
		{
			// This is the total number of single quotes in the token.
			$total_quotes = preg_match_all("/'/", $tokens[$i], $matches);
			// Counts single quotes that are preceded by an odd number of backslashes,
			// which means they're escaped quotes.
			$escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$i], $matches);

			$unescaped_quotes = $total_quotes - $escaped_quotes;

			// If the number of unescaped quotes is even, then the delimiter did NOT occur inside a string literal.
			if (($unescaped_quotes % 2) == 0)
			{
				// It's a complete sql statement.
				$output[] = $tokens[$i];
				// save memory.
				$tokens[$i] = "";
			}
			else
			{
				// incomplete sql statement. keep adding tokens until we have a complete one.
				// $temp will hold what we have so far.
				$temp = $tokens[$i] . $delimiter;
				// save memory..
				$tokens[$i] = "";

				// Do we have a complete statement yet?
				$complete_stmt = false;

				for ($j = $i + 1; (!$complete_stmt && ($j < $token_count)); $j++)
				{
					// This is the total number of single quotes in the token.
					$total_quotes = preg_match_all("/'/", $tokens[$j], $matches);
					// Counts single quotes that are preceded by an odd number of backslashes,
					// which means they're escaped quotes.
					$escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$j], $matches);

					$unescaped_quotes = $total_quotes - $escaped_quotes;

					if (($unescaped_quotes % 2) == 1)
					{
						// odd number of unescaped quotes. In combination with the previous incomplete
						// statement(s), we now have a complete statement. (2 odds always make an even)
						$output[] = $temp . $tokens[$j];

						// save memory.
						$tokens[$j] = "";
						$temp = "";

						// exit the loop.
						$complete_stmt = true;
						// make sure the outer loop continues at the right point.
						$i = $j;
					}
					else
					{
						// even number of unescaped quotes. We still don't have a complete statement.
						// (1 odd and 1 even always make an odd)
						$temp .= $tokens[$j] . $delimiter;
						// save memory.
						$tokens[$j] = "";
					}

				} // for..
			} // else
		}
	}
	return $output;
}
?>
