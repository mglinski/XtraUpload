<?
	$block = $_REQUEST['links'];
	$block = explode("\n",$block);
	$i = 0;
	$a = 0;
	$line_arr = '';
	$hash_arr = array();
	
	foreach($block as $line)
	{
		$line = trim($line);
		if($line != '')
		{
			$hash = explode('index.php?p=download&hash=',$line);
			if(count($hash) == 2)
			{
				$hash = txt_clean($hash[1]);
			}
			else
			{
				$hash = explode('/',$hash[0]);
				$count = count($hash);
				$count--;
				$hash = $hash[$count];
			}
			
			if(!in_array($hash,$hash_arr))
			{
				$i++;
				if(check_file_bool($hash))
				{
					$line_arr .= "<working>#".$i.":  <a href='".$line."'><font color='#009900'>".$line."</font></a>  is Working! </working><br />";
					$a++;
				}
				else
				{
					$line_arr .= "<failed>#".$i.":  <font color='#FF0000'>".$line."</font>  is Not Working! </failed><br />";
				}
				$hash_arr[] = $hash;
			}
		}
	}

	$line_arr .= '<br />';

	header("Content-type: text/javascript");
	
?>
$("#links_code").html("<?=$line_arr;?>");
$("#links_num").html("<?=$i?>");
$("#links_val_num").html("<?=$a?>");
<?
unset($hash,$line_arr,$i,$a,$hash_arr);
?>