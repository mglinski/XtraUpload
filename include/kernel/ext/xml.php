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
class xml
{
	function convert($data, $to)
	{
		if(strtolower($to) == 'xml')
		{
			return _arrayToXml($data);
		}
		else if(strtolower($to) == 'php')
		{
			return _xmlToArray($data);
		}
	}
	
	function _xmlToArray($data)
	{
		global 	$_phpArrayToXml;
		unset($_phpArrayToXml['a'],
			$_phpArrayToXml['n'],
			$_phpArrayToXml['t'],
			$_phpArrayToXml['gn'],
			$_phpArrayToXml['pos'],
			$_phpArrayToXml['status'],
			$_phpArrayToXml['val']
		);
	
	
		$xml_parser = xml_parser_create();
		xml_parser_set_option ($xml_parser, 2, 'ISO-8859-1');
		
		xml_set_element_handler($xml_parser,
			create_function(
				'$parser, $current_element, $current_attribs',
					'global 	$_phpArrayToXml;
			
					if ($current_element=="GROUP"){
						$_phpArrayToXml["gn"][$_phpArrayToXml["pos"]]=$current_attribs["NAME"];
						$_phpArrayToXml["pos"]++;
					}
					elseif ($current_element=="ENTRY"){
						$_phpArrayToXml["status"]=true;
						$_phpArrayToXml["n"]=$current_attribs["NAME"];
						if (!($_phpArrayToXml["t"]=$current_attribs["TYPE"])) $_phpArrayToXml["t"]="string";
						if ($_phpArrayToXml["t"]==="NULL") {
							if ($_phpArrayToXml["n"]) {
								$a[$_phpArrayToXml["pos"]][$_phpArrayToXml["n"]]=null;}else{$a[$_phpArrayToXml["pos"]][]=null;
							}
						}
					}'
			),
			create_function(
				'$parser, $current_element',
					'global 	$_phpArrayToXml;
					if ($current_element=="GROUP"){
						$_phpArrayToXml["pos"]--;
						if ($_phpArrayToXml["gn"][$_phpArrayToXml["pos"]]) {
							$_phpArrayToXml["a"][$_phpArrayToXml["pos"]][$_phpArrayToXml["gn"][$_phpArrayToXml["pos"]]]=$_phpArrayToXml["a"][$_phpArrayToXml["pos"]+1];
						}else{
							$_phpArrayToXml["a"][$_phpArrayToXml["pos"]][]=$_phpArrayToXml["a"][$_phpArrayToXml["pos"]+1];
						}
						unset($_phpArrayToXml["a"][$_phpArrayToXml["pos"]+1],$_phpArrayToXml["gn"][$_phpArrayToXml["pos"]]);
		
					}elseif ($current_element=="ENTRY"){
						if ($_phpArrayToXml["n"]) {
							$_phpArrayToXml["a"][$_phpArrayToXml["pos"]][$_phpArrayToXml["n"]]=$_phpArrayToXml["val"];
						}else{
							$_phpArrayToXml["a"][$_phpArrayToXml["pos"]][]=$_phpArrayToXml["val"];
						}
							end($_phpArrayToXml["a"][$_phpArrayToXml["pos"]]);
							settype($_phpArrayToXml["a"][$_phpArrayToXml["pos"]][key($_phpArrayToXml["a"][$_phpArrayToXml["pos"]])],$_phpArrayToXml["t"]);
						$_phpArrayToXml["val"]="";
						$_phpArrayToXml["status"]=false;
					}'
			)
		);
		
		xml_set_character_data_handler($xml_parser,
			create_function(
				'$parser, $data',
					'global 	$_phpArrayToXml;
					if ($_phpArrayToXml["status"]) {
						$_phpArrayToXml["val"].=$data;
					}'
			)
		);
		
		xml_parse($xml_parser, $data);
		xml_parser_free($xml_parser);
		return ($_phpArrayToXml['a'][0][0]);
	}
	
	function _arrayToXML($data)
	{
		global 	$_phpArrayToXml;
		$tr=array('<'=>'&#60;','>'=>'&#62;','"'=>'&#34;','&'=>'&#38;');
		$xml.='<?xml version="1.0" encoding="ISO-8859-1" standalone="yes" ?>'."\n".'<phpArray version="1.0">'."\n\t".'<group>';
		$x[1]=&$data;
		$lev=1;
	
		while($x)
		{
			foreach($x[$lev] as $k=>$v)
			{
				if($jump)
				{
					unset($x[$lev][$k],$jump);
				}
				elseif (is_array($v))
				{
					$xml.="\n";
					for ($i=0;$i<=$lev;$i++){$xml.="\t";}
					$xml.='<group name="'.$k.'">';
					$x[$lev+1]=&$x[$lev][$k];
					$lev++;
					break;
				}
				else
				{
					$t=gettype($v);
					if($t!='NULL'){$e='>'.strtr($v,$tr).'</entry>';}else{$e='/>';}
					$xml.="\n";for ($i=0;$i<=$lev;$i++){$xml.="\t";}
					$xml.='<entry name="'.$k.'" type="'.$t.'"'.$e;
					unset($x[$lev][$k]);
				}
				
				if(!$x[$lev]) 
				{
					$xml.="\n";
					for ($i=1;$i<=$lev;$i++){$xml.="\t";}
					$xml.='</group>';
					unset($x[$lev]);
					$lev--;
					$jump=TRUE;
					break;
				}
			}
		}
		$xml.="\n</phpArray>";
		return $xml;
	}
}
?>