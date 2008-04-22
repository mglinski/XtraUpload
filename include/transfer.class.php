<?php
/*
 * http.php
 *
 * @(#) $Header: /home/mlemos/cvsroot/http/http.php,v 1.40 2005/05/14 03:51:01 mlemos Exp $
 *
 */

class http_class
{
	var $host_name="";
	var $host_port=0;
	var $proxy_host_name="";
	var $proxy_host_port=80;

	var $protocol="http";
	var $request_method="GET";
	//var $user_agent='httpclient (http://www.phpclasses.org/httpclient $Revision: 1.40 $)';
    var $user_agent='Mozilla/4.0 (compatible; MSIE 5.00; Windows 98)';
	var $authentication_mechanism="";
	var $user;
	var $password;
	var $realm;
	var $workstation;
	var $proxy_authentication_mechanism="";
	var $proxy_user;
	var $proxy_password;
	var $proxy_realm;
	var $proxy_workstation;
	var $request_uri="";
	var $request="";
	var $request_headers=array();
	var $request_user;
	var $request_password;
	var $request_realm;
	var $request_workstation;
	var $proxy_request_user;
	var $proxy_request_password;
	var $proxy_request_realm;
	var $proxy_request_workstation;
	var $request_body="";
	var $protocol_version="1.1";
	var $timeout=0;
	var $data_timeout=0;
	var $debug=0;
	var $html_debug=0;
	var $support_cookies=1;
    var $support_script=1;
	var $cookies=array();
	var $error="";
	var $exclude_address="";
	var $follow_redirect=1;
	var $redirection_limit=5;
	var $response_status="";
	var $response_message="";
	var $file_buffer_length=8000;
	var $force_multipart_form_post=0;

	/* private variables - DO NOT ACCESS */

	var $state="Disconnected";
	var $use_curl=0;
	var $connection=0;
	var $content_length=0;
	var $response="";
	var $read_response=0;
	var $read_length=0;
	var $request_host="";
	var $next_token="";
	var $redirection_level=0;
	var $chunked=0;
	var $remaining_chunk=0;
	var $last_chunk_read=0;
	var $months=array(
		"Jan"=>"01",
		"Feb"=>"02",
		"Mar"=>"03",
		"Apr"=>"04",
		"May"=>"05",
		"Jun"=>"06",
		"Jul"=>"07",
		"Aug"=>"08",
		"Sep"=>"09",
		"Oct"=>"10",
		"Nov"=>"11",
		"Dec"=>"12");

	/* Private methods - DO NOT CALL */

	function Tokenize($string,$separator="")
	{
		if(!strcmp($separator,""))
		{
			$separator=$string;
			$string=$this->next_token;
		}
		for($character=0;$character<strlen($separator);$character++)
		{
			if(GetType($position=strpos($string,$separator[$character]))=="integer")
				$found=(IsSet($found) ? min($found,$position) : $position);
		}
		if(IsSet($found))
		{
			$this->next_token=substr($string,$found+1);
			return(substr($string,0,$found));
		}
		else
		{
			$this->next_token="";
			return($string);
		}
	}

	function SetError($error)
	{
		return($this->error=$error);
	}

	function SetPHPError($error, &$php_error_message)
	{
		if(IsSet($php_error_message)
		&& strlen($php_error_message))
			$error.=": ".$php_error_message;
		return($this->SetError($error));
	}

	function SetDataAccessError($error)
	{
		$this->error=$error;
		if(!$this->use_curl
		&& function_exists("socket_get_status"))
		{
			$status=socket_get_status($this->connection);
			if($status["timed_out"])
				$this->error.=": data access time out";
			elseif($status["eof"])
				$this->error.=": the server disconnected";
		}
	}

	function OutputDebug($message)
	{
		$message.="\n";
		if($this->html_debug)
			$message=str_replace("\n","<br />\n",HtmlEntities($message));
		echo $message;
		flush();
	}

	function GetLine()
	{
		for($line="";;)
		{
			if($this->use_curl)
			{
				$eol=strpos($this->response,"\n",$this->read_response);
				$data=($eol ? substr($this->response,$this->read_response,$eol+1-$this->read_response) : "");
				$this->read_response+=strlen($data);
			}
			else
			{
				if(feof($this->connection))
					return($this->SetError("reached the end of data while reading from the HTTP server connection"));
				$data=fgets($this->connection,100);
			}
			if(GetType($data)!="string"
			|| strlen($data)==0)
			{
				$this->SetDataAccessError("it was not possible to read line from the HTTP server");
				return(0);
			}
			$line.=$data;
			$length=strlen($line);
			if($length
			&& !strcmp(substr($line,$length-1,1),"\n"))
			{
				$length-=(($length>=2 && !strcmp(substr($line,$length-2,1),"\r")) ? 2 : 1);
				$line=substr($line,0,$length);
				if($this->debug)
					$this->OutputDebug("S $line");
				return($line);
			}
		}
	}

	function PutLine($line)
	{
		if($this->debug)
			$this->OutputDebug("C $line");
		if(!fputs($this->connection,$line."\r\n"))
		{
			$this->SetDataAccessError("it was not possible to send a line to the HTTP server");
			return(0);
		}
		return(1);
	}

	function PutData(&$data)
	{
		if(strlen($data))
		{
			if($this->debug)
				$this->OutputDebug("C $data");
			if(!fputs($this->connection,$data))
			{
				$this->SetDataAccessError("it was not possible to send data to the HTTP server");
				return(0);
			}
		}
		return(1);
	}

	function FlushData()
	{
		if(!fflush($this->connection))
		{
			$this->SetDataAccessError("it was not possible to send data to the HTTP server");
			return(0);
		}
		return(1);
	}

	function ReadChunkSize()
	{
		if($this->remaining_chunk==0)
		{
			$line=$this->GetLine();
			if(GetType($line)!="string")
				return($this->SetError("4 could not read chunk start: ".$this->error));
			$this->remaining_chunk=hexdec($line);
		}
		return("");
	}

	function ReadBytes($length)
	{
		if($this->use_curl)
		{
			$bytes=substr($this->response,$this->read_response,min($length,strlen($this->response)-$this->read_response));
			$this->read_response+=strlen($bytes);
		}
		else
		{
			if($this->chunked)
			{
				for($bytes="",$remaining=$length;$remaining;)
				{
					if(strlen($this->ReadChunkSize()))
						return("");
					if($this->remaining_chunk==0)
					{
						$this->last_chunk_read=1;
						break;
					}
					$ask=min($this->remaining_chunk,$remaining);
					$chunk=@fread($this->connection,$ask);
					$read=strlen($chunk);
					if($read==0)
					{
						$this->SetDataAccessError("it was not possible to read data chunk from the HTTP server");
						return("");
					}
					if($this->debug)
						$this->OutputDebug("S ".$chunk);
					$bytes.=$chunk;
					$this->remaining_chunk-=$read;
					$remaining-=$read;
					if($this->remaining_chunk==0)
					{
						if(feof($this->connection))
							return($this->SetError("reached the end of data while reading the end of data chunk mark from the HTTP server"));
						$data=@fread($this->connection,2);
						if(strcmp($data,"\r\n"))
						{
							$this->SetDataAccessError("it was not possible to read end of data chunk from the HTTP server");
							return("");
						}
					}
				}
			}
			else
			{
				$bytes=@fread($this->connection,$length);
				if(strlen($bytes))
				{
					if($this->debug)
						$this->OutputDebug("S ".$bytes);
				}
				else
					$this->SetDataAccessError("it was not possible to read data from the HTTP server");
			}
		}
		return($bytes);
	}

	function EndOfInput()
	{
		if($this->use_curl)
			return($this->read_response>=strlen($this->response));
		if($this->chunked)
			return($this->last_chunk_read);
		return(feof($this->connection));
	}

	function Connect($host_name,$host_port,$ssl)
	{
		$domain=$host_name;
		if(ereg('^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$',$domain))
			$ip=$domain;
		else
		{
			if($this->debug)
				$this->OutputDebug("Resolving HTTP server domain \"$domain\"...");
			if(!strcmp($ip=@gethostbyname($domain),$domain))
				$ip="";
		}
		if(strlen($ip)==0
		|| (strlen($this->exclude_address)
		&& !strcmp(@gethostbyname($this->exclude_address),$ip)))
			return($this->SetError("could not resolve the host domain \"".$domain."\""));
		if($this->debug)
			$this->OutputDebug("Connecting to HTTP server IP ".$ip."...");
		if($ssl)
			$ip="ssl://".$ip;
		if(($this->connection=($this->timeout ? @fsockopen($ip,$host_port,$errno,$error,$this->timeout) : @fsockopen($ip,$host_port,$errno)))==0)
		{
			switch($errno)
			{
				case -3:
					return($this->SetError("-3 socket could not be created"));
				case -4:
					return($this->SetError("-4 dns lookup on hostname \"".$host_name."\" failed"));
				case -5:
					return($this->SetError("-5 connection refused or timed out"));
				case -6:
					return($this->SetError("-6 fdopen() call failed"));
				case -7:
					return($this->SetError("-7 setvbuf() call failed"));
				default:
					return($this->SetPHPError($errno." could not connect to the host \"".$host_name."\"",$php_errormsg));
			}
		}
		else
		{
			if($this->data_timeout
			&& function_exists("socket_set_timeout"))
				socket_set_timeout($this->connection,$this->data_timeout,0);
			if($this->debug)
				$this->OutputDebug("Connected to $host_name");
			$this->state="Connected";
			return("");
		}
	}

	function Disconnect()
	{
		if($this->debug)
			$this->OutputDebug("Disconnected from ".$this->host_name);
		if($this->use_curl)
		{
			curl_close($this->connection);
			$this->response="";
		}
		else
			fclose($this->connection);
		$this->state="Disconnected";
		return("");
	}

	/* Public methods */

	function GetRequestArguments($url,&$arguments)
	{
		if(strlen($this->error))
			return($this->error);
		$arguments=array();
		$parameters=parse_url($url);
		if(!IsSet($parameters["scheme"]))
			return($this->SetError("it was not specified the protocol type argument"));
		switch(strtolower($parameters["scheme"]))
		{
			case "http":
			case "https":
				$arguments["Protocol"]=$parameters["scheme"];
				break;
			default:
				return($parameters["scheme"]." connection scheme is not yet supported");
		}
		if(!IsSet($parameters["host"]))
			return($this->SetError("it was not specified the connection host argument"));
		$arguments["HostName"]=$parameters["host"];
		$arguments["Headers"]=array("Host"=>$parameters["host"].(IsSet($parameters["port"]) ? ":".$parameters["port"] : ""));
		if(IsSet($parameters["user"]))
			$arguments["AuthUser"]=UrlDecode($parameters["user"]);
		if(IsSet($parameters["pass"]))
			$arguments["AuthPassword"]=UrlDecode($parameters["pass"]);
		if(IsSet($parameters["port"]))
		{
			if(strcmp($parameters["port"],strval(intval($parameters["port"]))))
				return($this->SetError("it was not specified a valid connection host argument"));
			$arguments["HostPort"]=intval($parameters["port"]);
		}
		else
			$arguments["HostPort"]=0;
		$arguments["RequestURI"]=(IsSet($parameters["path"]) ? $parameters["path"] : "/").(IsSet($parameters["query"]) ? "?".$parameters["query"] : "");
		if(strlen($this->user_agent))
			$arguments["Headers"]["User-Agent"]=$this->user_agent;
		return("");
	}

	function Open($arguments)
	{
		if(strlen($this->error))
			return($this->error);
		if($this->state!="Disconnected")
			return("1 already connected");
		if(IsSet($arguments["HostName"]))
			$this->host_name=$arguments["HostName"];
		if(IsSet($arguments["HostPort"]))
			$this->host_port=$arguments["HostPort"];
		if(IsSet($arguments["ProxyHostName"]))
			$this->proxy_host_name=$arguments["ProxyHostName"];
		if(IsSet($arguments["ProxyHostPort"]))
			$this->proxy_host_port=$arguments["ProxyHostPort"];
		if(IsSet($arguments["Protocol"]))
			$this->protocol=$arguments["Protocol"];
		switch(strtolower($this->protocol))
		{
			case "http":
				$default_port=80;
				break;
			case "https":
				$default_port=443;
				break;
			default:
				return($this->SetError("2 it was not specified a valid connection protocol"));
		}
		if(strlen($this->proxy_host_name)==0)
		{
			if(strlen($this->host_name)==0)
				return($this->SetError("2 it was not specified a valid hostname"));
			$host_name=$this->host_name;
			$host_port=($this->host_port ? $this->host_port : $default_port);
		}
		else
		{
			$host_name=$this->proxy_host_name;
			$host_port=$this->proxy_host_port;
		}
		$ssl=(strtolower($this->protocol)=="https" && strlen($this->proxy_host_name)==0);
		$this->use_curl=($ssl && function_exists("curl_init"));
		if($this->use_curl)
		{
			$error=(($this->connection=curl_init($this->protocol."://".$this->host_name.($host_port==$default_port ? "" : ":".strval($host_port))."/")) ? "" : "Could not initialize a CURL session");
			if(strlen($error)==0)
			{
				if(IsSet($arguments["SSLCertificateFile"]))
					curl_setopt($this->connection,CURLOPT_SSLCERT,$arguments["SSLCertificateFile"]);
				if(IsSet($arguments["SSLCertificatePassword"]))
					curl_setopt($this->connection,CURLOPT_SSLCERTPASSWD,$arguments["SSLCertificatePassword"]);
			}
		}
		else
		{
			$error="";
			if(strlen($this->proxy_host_name)
			&& IsSet($arguments["SSLCertificateFile"]))
				$error="establishing SSL connections using certificates via non-SSL proxies is not supported";
			else
			{
				if($ssl)
				{
					if(IsSet($arguments["SSLCertificateFile"]))
						$error="establishing SSL connections using certificates is only supported when the cURL extension is enabled";
					else
					{
						$version=explode(".",function_exists("phpversion") ? phpversion() : "3.0.7");
						$php_version=intval($version[0])*1000000+intval($version[1])*1000+intval($version[2]);
						if($php_version<4003000)
							$error="establishing SSL connections requires at least PHP version 4.3.0 or having the cURL extension enabled";
						elseif(!function_exists("extension_loaded")
						|| !extension_loaded("openssl"))
							$error="establishing SSL connections requires the OpenSSL extension enabled";
					}
				}
				if(strlen($error)==0)
					$error=$this->Connect($host_name,$host_port,$ssl);
			}
		}
		if(strlen($error))
			return($this->SetError($error));
		$this->state="Connected";
		return("");
	}

	function Close()
	{
		if($this->state=="Disconnected")
			return("1 already disconnected");
		$error=$this->Disconnect();
		if(strlen($error)==0)
			$this->state="Disconnected";
		return($error);
	}

	function PickCookies(&$cookies,$secure)
	{
		if(IsSet($this->cookies[$secure]))
		{
			$now=gmdate("Y-m-d H-i-s");
			for($domain=0,Reset($this->cookies[$secure]);$domain<count($this->cookies[$secure]);Next($this->cookies[$secure]),$domain++)
			{
				$domain_pattern=Key($this->cookies[$secure]);
				$match=strlen($this->request_host)-strlen($domain_pattern);
				if($match>=0
				&& !strcmp($domain_pattern,substr($this->request_host,$match))
				&& ($match==0
				|| $domain_pattern[0]=="."
				|| $this->request_host[$match-1]=="."))
				{
					for(Reset($this->cookies[$secure][$domain_pattern]),$path_part=0;$path_part<count($this->cookies[$secure][$domain_pattern]);Next($this->cookies[$secure][$domain_pattern]),$path_part++)
					{
						$path=Key($this->cookies[$secure][$domain_pattern]);
						if(strlen($this->request_uri)>=strlen($path)
						&& substr($this->request_uri,0,strlen($path))==$path)
						{
							for(Reset($this->cookies[$secure][$domain_pattern][$path]),$cookie=0;$cookie<count($this->cookies[$secure][$domain_pattern][$path]);Next($this->cookies[$secure][$domain_pattern][$path]),$cookie++)
							{
								$cookie_name=Key($this->cookies[$secure][$domain_pattern][$path]);
								$expires=$this->cookies[$secure][$domain_pattern][$path][$cookie_name]["expires"];
								if($expires==""
								|| strcmp($now,$expires)<0)
									$cookies[$cookie_name]=$this->cookies[$secure][$domain_pattern][$path][$cookie_name];
							}
						}
					}
				}
			}
		}
	}

	function GetFileDefinition(&$file,&$definition)
	{
		$name="";
		if(IsSet($file["FileName"]))
			$name=basename($file["FileName"]);
		if(IsSet($file["Name"]))
			$name=$file["Name"];
		if(strlen($name)==0)
			return("it was not specified the file part name");
		if(IsSet($file["Content-Type"]))
		{
			$content_type=$file["Content-Type"];
			$type=$this->Tokenize(strtolower($content_type),"/");
			$sub_type=$this->Tokenize("");
			switch($type)
			{
				case "text":
				case "image":
				case "audio":
				case "video":
				case "application":
				case "message":
					break;
				case "automatic":
					switch($sub_type)
					{
						case "name":
							switch(GetType($dot=strrpos($name,"."))=="integer" ? strtolower(substr($name,$dot)) : "")
							{
								case ".xls":
									$content_type="application/excel";
									break;
								case ".hqx":
									$content_type="application/macbinhex40";
									break;
								case ".doc":
								case ".dot":
								case ".wrd":
									$content_type="application/msword";
									break;
								case ".pdf":
									$content_type="application/pdf";
									break;
								case ".pgp":
									$content_type="application/pgp";
									break;
								case ".ps":
								case ".eps":
								case ".ai":
									$content_type="application/postscript";
									break;
								case ".ppt":
									$content_type="application/powerpoint";
									break;
								case ".rtf":
									$content_type="application/rtf";
									break;
								case ".tgz":
								case ".gtar":
									$content_type="application/x-gtar";
									break;
								case ".gz":
									$content_type="application/x-gzip";
									break;
								case ".php":
								case ".php3":
									$content_type="application/x-httpd-php";
									break;
								case ".js":
									$content_type="application/x-javascript";
									break;
								case ".ppd":
								case ".psd":
									$content_type="application/x-photoshop";
									break;
								case ".swf":
								case ".swc":
								case ".rf":
									$content_type="application/x-shockwave-flash";
									break;
								case ".tar":
									$content_type="application/x-tar";
									break;
								case ".zip":
									$content_type="application/zip";
									break;
								case ".mid":
								case ".midi":
								case ".kar":
									$content_type="audio/midi";
									break;
								case ".mp2":
								case ".mp3":
								case ".mpga":
									$content_type="audio/mpeg";
									break;
								case ".ra":
									$content_type="audio/x-realaudio";
									break;
								case ".wav":
									$content_type="audio/wav";
									break;
								case ".bmp":
									$content_type="image/bitmap";
									break;
								case ".gif":
									$content_type="image/gif";
									break;
								case ".iff":
									$content_type="image/iff";
									break;
								case ".jb2":
									$content_type="image/jb2";
									break;
								case ".jpg":
								case ".jpe":
								case ".jpeg":
									$content_type="image/jpeg";
									break;
								case ".jpx":
									$content_type="image/jpx";
									break;
								case ".png":
									$content_type="image/png";
									break;
								case ".tif":
								case ".tiff":
									$content_type="image/tiff";
									break;
								case ".wbmp":
									$content_type="image/vnd.wap.wbmp";
									break;
								case ".xbm":
									$content_type="image/xbm";
									break;
								case ".css":
									$content_type="text/css";
									break;
								case ".txt":
									$content_type="text/plain";
									break;
								case ".htm":
								case ".html":
									$content_type="text/html";
									break;
								case ".xml":
									$content_type="text/xml";
									break;
								case ".mpg":
								case ".mpe":
								case ".mpeg":
									$content_type="video/mpeg";
									break;
								case ".qt":
								case ".mov":
									$content_type="video/quicktime";
									break;
								case ".avi":
									$content_type="video/x-ms-video";
									break;
								case ".eml":
									$content_type="message/rfc822";
									break;
								default:
									$content_type="application/octet-stream";
									break;
							}
							break;
						default:
							return($content_type." is not a supported automatic content type detection method");
					}
					break;
				default:
                    break;
					return($content_type." is not a supported file content type");
			}
		}
		else
			$content_type="application/octet-stream";
		$definition=array(
			"Content-Type"=>$content_type,
			"NAME"=>$name
		);
		if(IsSet($file["FileName"]))
		{
			if(GetType($length=@filesize($file["FileName"]))!="integer")
			{
				$error="it was not possible to determine the length of the file ".$file["FileName"];
				if(IsSet($php_errormsg)
				&& strlen($php_errormsg))
					$error.=": ".$php_errormsg;
				if(!file_exists($file["FileName"]))
					$error="it was not possible to access the file ".$file["FileName"];
				return($error);
			}
			$definition["FILENAME"]=$file["FileName"];
			$definition["Content-Length"]=$length;
		}
		elseif(IsSet($file["Data"]))
			$definition["Content-Length"]=strlen($definition["DATA"]=$file["Data"]);
		else
			return("it was not specified a valid file name");
		return("");
	}

	function SendRequest($arguments)
	{
		if(strlen($this->error))
			return($this->error);
		switch($this->state)
		{
			case "Disconnected":
				return($this->SetError("1 connection was not yet established"));
			case "Connected":
				break;
			default:
				return($this->SetError("2 can not send request in the current connection state"));
		}
		if(IsSet($arguments["RequestMethod"]))
			$this->request_method=$arguments["RequestMethod"];
		if(IsSet($arguments["User-Agent"]))
			$this->user_agent=$arguments["User-Agent"];
		if(strlen($this->request_method)==0)
			return($this->SetError("3 it was not specified a valid request method"));
		if(IsSet($arguments["RequestURI"]))
			$this->request_uri=$arguments["RequestURI"];
		if(strlen($this->request_uri)==0
		|| substr($this->request_uri,0,1)!="/")
			return($this->SetError("4 it was not specified a valid request URI"));
		$this->request_body="";
		$this->request_headers=(IsSet($arguments["Headers"]) ? $arguments["Headers"] : array());
		$body_length=0;
		$this->request_body="";
		if($this->request_method=="POST")
		{
			if(IsSet($arguments["PostFiles"])
			|| ($this->force_multipart_form_post
			&& IsSet($arguments["PostValues"])))
			{
				$boundary="--".md5(uniqid(time()));
				$this->request_headers["Content-Type"]="multipart/form-data; boundary=".$boundary;
				$post_parts=array();
				$files=(IsSet($arguments["PostFiles"]) ? $arguments["PostFiles"] : array());
				Reset($files);
				$end=(GetType($input=Key($files))!="string");
				for(;!$end;)
				{
					if(strlen($error=$this->GetFileDefinition($files[$input],$definition)))
						return("3 ".$error);
					$headers="--".$boundary."\r\nContent-Disposition: form-data; name=\"".$input."\"; filename=\"".$definition["NAME"]."\"\r\nContent-Type: ".$definition["Content-Type"]."\r\n\r\n";
					$part=count($post_parts);
					$post_parts[$part]=array("HEADERS"=>$headers);
					if(IsSet($definition["FILENAME"]))
					{
						$post_parts[$part]["FILENAME"]=$definition["FILENAME"];
						$data="";
					}
					else
						$data=$definition["DATA"];
					$post_parts[$part]["DATA"]=$data;
					$body_length+=strlen($headers)+$definition["Content-Length"]+strlen("\r\n");
					Next($files);
					$end=(GetType($input=Key($files))!="string");
				}
				if(IsSet($arguments["PostValues"]))
				{
					$values=$arguments["PostValues"];
					if(GetType($values)!="array")
						return($this->SetError("5 it was not specified a valid POST method values array"));
					for(Reset($values),$value=0;$value<count($values);Next($values),$value++)
					{
						$input=Key($values);
						$headers="--".$boundary."\r\nContent-Disposition: form-data; name=\"".$input."\"\r\n\r\n";
						$data=$values[$input];
						$post_parts[]=array("HEADERS"=>$headers,"DATA"=>$data);
						$body_length+=strlen($headers)+strlen($data)+strlen("\r\n");
					}
				}
				$body_length+=strlen("--".$boundary."--\r\n");
			}
			elseif(IsSet($arguments["PostValues"]))
			{
				$values=$arguments["PostValues"];
				if(GetType($values)!="array")
					return($this->SetError("5 it was not specified a valid POST method values array"));
				for($this->request_body="",Reset($values),$value=0;$value<count($values);Next($values),$value++)
				{
                    /*
                    Fixed the array-like value in $arguments["PostValues"]
                    This is because PHP parse txt[key1]=val1&txt[key2]=$val2 into array,
                    so when we post data to host,we need to reverse this process
                    */
                    if(is_array($values[Key($values)]))
                    {
                        foreach($values[Key($values)] as $k => $v)
                        $this->request_body.=Key($values).UrlEncode("[$k]")."=".UrlEncode($v).'&';
                    }
                    else
					$this->request_body.=Key($values)."=".UrlEncode($values[Key($values)]).'&';
				}
                $this->request_body=substr($this->request_body,0,-1);
				$this->request_headers["Content-Type"]="application/x-www-form-urlencoded";
			}
			else
			{
				if(IsSet($arguments["Body"]))
					$this->request_body=$arguments["Body"];
			}
		}
		else
		{
			if(IsSet($arguments["Body"]))
				$this->request_body=$arguments["Body"];
		}
		if(IsSet($arguments["ProxyUser"]))
			$this->proxy_request_user=$arguments["ProxyUser"];
		elseif(IsSet($this->proxy_user))
			$this->proxy_request_user=$this->proxy_user;
		if(IsSet($arguments["ProxyPassword"]))
			$this->proxy_request_password=$arguments["ProxyPassword"];
		elseif(IsSet($this->proxy_password))
			$this->proxy_request_password=$this->proxy_password;
		if(IsSet($arguments["ProxyRealm"]))
			$this->proxy_request_realm=$arguments["ProxyRealm"];
		elseif(IsSet($this->proxy_realm))
			$this->proxy_request_realm=$this->proxy_realm;
		if(IsSet($arguments["ProxyWorkstation"]))
			$this->proxy_request_workstation=$arguments["ProxyWorkstation"];
		elseif(IsSet($this->proxy_workstation))
			$this->proxy_request_workstation=$this->proxy_workstation;
		
		if(isset($this->user))
		{
			$this->request_user=$this->user;
		}
		elseif(isset($arguments["AuthUser"]))
		{
			$this->request_user=$arguments["AuthUser"];
		}
		
		if(IsSet($this->password))
		{
			$this->request_password=$this->password;
		}
		elseif(IsSet($arguments["AuthPassword"]))
		{
			$this->request_password=$arguments["AuthPassword"];
		}
		
		if(IsSet($arguments["AuthRealm"]))
			$this->request_realm=$arguments["AuthRealm"];
		elseif(IsSet($this->realm))
			$this->request_realm=$this->realm;
		if(IsSet($arguments["AuthWorkstation"]))
			$this->request_workstation=$arguments["AuthWorkstation"];
		elseif(IsSet($this->workstation))
			$this->request_workstation=$this->workstation;
        if(IsSet($this->request_user))
		{
			$this->request_headers["Authorization"]="Basic ".base64_encode($this->request_user.":".$this->request_password);
		}
		if(strlen($this->proxy_host_name)==0)
			$request_uri=$this->request_uri;
		else
		{
			switch(strtolower($this->protocol))
			{
				case "http":
					$default_port=80;
					break;
				case "https":
					$default_port=443;
					break;
			}
			$request_uri=strtolower($this->protocol)."://".$this->host_name.(($this->host_port==0 || $this->host_port==$default_port) ? "" : ":".$this->host_port).$this->request_uri;
		}
		if($this->use_curl)
		{
			$version=(GetType($v=curl_version())=="array" ? (IsSet($v["version"]) ? $v["version"] : "0.0.0") : (ereg("^libcurl/([0-9]+\\.[0-9]+\\.[0-9]+)",$v,$m) ? $m[1] : "0.0.0"));
			$curl_version=100000*intval($this->Tokenize($version,"."))+1000*intval($this->Tokenize("."))+intval($this->Tokenize(""));
			$protocol_version=($curl_version<713002 ? "1.0" : $this->protocol_version);
		}
		else
			$protocol_version=$this->protocol_version;
		$this->request=$this->request_method." ".$request_uri." HTTP/".$protocol_version;
		if($body_length
		|| ($body_length=strlen($this->request_body)))
			$this->request_headers["Content-Length"]=$body_length;
		for($headers=array(),$host_set=0,Reset($this->request_headers),$header=0;$header<count($this->request_headers);Next($this->request_headers),$header++)
		{
			$header_name=Key($this->request_headers);
			$header_value=$this->request_headers[$header_name];
			if(GetType($header_value)=="array")
			{
				for(Reset($header_value),$value=0;$value<count($header_value);Next($header_value),$value++)
					$headers[]=$header_name.": ".$header_value[Key($header_value)];
			}
			else
				$headers[]=$header_name.": ".$header_value;
			if(strtolower(Key($this->request_headers))=="host")
			{
				$this->request_host=strtolower($header_value);
				$host_set=1;
			}
		}
		if(!$host_set)
		{
			$headers[]="Host: ".$this->host_name;
			$this->request_host=strtolower($this->host_name);
		}
        //get cookie from session,and send the website cookie
        if(count($_SESSION['cookies'])&&$this->support_cookies)//if(count($this->cookies))
		{
            $this->cookies= $_SESSION['cookies'];
			$cookies=array();
			$this->PickCookies($cookies,0);
			if(strtolower($this->protocol)=="https")
				$this->PickCookies($cookies,1);
			if(count($cookies))
			{
				$h=count($headers);
				$headers[$h]="Cookie:";
				for(Reset($cookies),$cookie=0;$cookie<count($cookies);Next($cookies),$cookie++)
				{
					$cookie_name=Key($cookies);
					$headers[$h].=" ".UrlEncode($cookie_name)."=".$cookies[$cookie_name]["value"].";";
				}
			}
		}
		if($this->use_curl)
		{
			if($body_length
			&& strlen($this->request_body)==0)
			{
				for($request_body="",$success=1,$part=0;$part<count($post_parts);$part++)
				{
					$request_body.=$post_parts[$part]["HEADERS"].$post_parts[$part]["DATA"];
					if(IsSet($post_parts[$part]["FILENAME"]))
					{
						if(!($file=@fopen($post_parts[$part]["FILENAME"],"rb")))
						{
							$this->SetPHPError("could not open upload file ".$post_parts[$part]["FILENAME"], $php_errormsg);
							$success=0;
							break;
						}
						while(!feof($file))
						{
							if(GetType($block=@fread($file,$this->file_buffer_length))!="string")
							{
								$this->SetPHPError("could not read upload file", $php_errormsg);
								$success=0;
								break;
							}
							$request_body.=$block;
						}
						fclose($file);
						if(!$success)
							break;
					}
					$request_body.="\r\n";
				}
				$request_body.="--".$boundary."--\r\n";
			}
			else
				$request_body=$this->request_body;
			curl_setopt($this->connection,CURLOPT_HEADER,1);
			curl_setopt($this->connection,CURLOPT_RETURNTRANSFER,1);
			if($this->timeout)
				curl_setopt($this->connection,CURLOPT_TIMEOUT,$this->timeout);
			curl_setopt($this->connection,CURLOPT_SSL_VERIFYPEER,0);
			curl_setopt($this->connection,CURLOPT_SSL_VERIFYHOST,0);
			$request=$this->request."\r\n".implode("\r\n",$headers)."\r\n\r\n".$request_body;
			curl_setopt($this->connection,CURLOPT_CUSTOMREQUEST,$request);
			if($this->debug)
				$this->OutputDebug("C ".$request);
			if(!($success=(strlen($this->response=curl_exec($this->connection))!=0)))
			{
				$error=curl_error($this->connection);
				$this->SetError("Could not execute the request".(strlen($error) ? ": ".$error : ""));
			}
		}
		else
		{
			if(($success=$this->PutLine($this->request)))
			{
				for($header=0;$header<count($headers);$header++)
				{
					if(!$success=$this->PutLine($headers[$header]))
						break;
				}
				if($success
				&& ($success=$this->PutLine(""))
				&& $body_length)
				{
					if(strlen($this->request_body))
						$success=$this->PutData($this->request_body);
					else
					{
						for($part=0;$part<count($post_parts);$part++)
						{
							if(!($success=$this->PutData($post_parts[$part]["HEADERS"]))
							|| !($success=$this->PutData($post_parts[$part]["DATA"])))
								break;
							if(IsSet($post_parts[$part]["FILENAME"]))
							{
								if(!($file=@fopen($post_parts[$part]["FILENAME"],"rb")))
								{
									$this->SetPHPError("could not open upload file ".$post_parts[$part]["FILENAME"], $php_errormsg);
									$success=0;
									break;
								}
								while(!feof($file))
								{
									if(GetType($block=@fread($file,$this->file_buffer_length))!="string")
									{
										$this->SetPHPError("could not read upload file", $php_errormsg);
										$success=0;
										break;
									}
									if(!($success=$this->PutData($block)))
										break;
								}
								fclose($file);
								if(!$success)
									break;
							}
							if(!($success=$this->PutLine("")))
								break;
						}
						if(!($success=$this->PutLine("--".$boundary."--")))
							break;
					}
					if($success)
						$sucess=$this->FlushData();
				}
			}
		}
		if(!$success)
			return($this->SetError("5 could not send the HTTP request: ".$this->error));
		$this->state="RequestSent";
		return("");
	}

	function SetCookie($name, $value, $expires="" , $path="/" , $domain="" , $secure=0)
	{
		if(strlen($this->error))
			return($this->error);
		if(strlen($name)==0)
			return($this->SetError("it was not specified a valid cookie name"));
		if(strlen($path)==0
		|| strcmp($path[0],"/"))
			return($this->SetError($path." is not a valid path for setting cookie ".$name));
		if($domain==""
		|| !strpos($domain,".",$domain[0]=="." ? 1 : 0))
			return($this->SetError($domain." is not a valid domain for setting cookie ".$name));
		$domain=strtolower($domain);
		$this->cookies[$secure][$domain][$path][$name]=array(
			"name"=>$name,
			"value"=>$value,
			"domain"=>$domain,
			"path"=>$path,
			"expires"=>$expires,
			"secure"=>$secure
		);
		return("");
	}

	function ReadReplyHeadersResponse(&$headers)
	{
		$headers=array();
		if(strlen($this->error))
			return($this->error);
		switch($this->state)
		{
			case "Disconnected":
				return($this->SetError("1 connection was not yet established"));
			case "Connected":
				return($this->SetError("2 request was not sent"));
			case "RequestSent":
				break;
			default:
				return($this->SetError("3 can not get request headers in the current connection state"));
		}
		$this->content_length=$this->read_length=$this->read_response=$this->remaining_chunk=0;
		$this->content_length_set=$this->chunked=$this->last_chunk_read=$chunked=0;
		for($this->response_status="";;)
		{
			$line=$this->GetLine();
			if(GetType($line)!="string")
				return($this->SetError("4 could not read request reply: ".$this->error));
			if(strlen($this->response_status)==0)
			{
				if(!eregi($match="^http/[0-9]+\\.[0-9]+[ \t]+([0-9]+)[ \t]*(.*)\$",$line,$matches))
					return($this->SetError("3 it was received an unexpected HTTP response status"));
				$this->response_status=$matches[1];
				$this->response_message=$matches[2];
			}
			if($line=="")
			{
				if(strlen($this->response_status)==0)
					return($this->SetError("3 it was not received HTTP response status"));
				$this->state="GotReplyHeaders";
				break;
			}
			$header_name=strtolower($this->Tokenize($line,":"));
			$header_value=Trim(Chop($this->Tokenize("\r\n")));
			if(IsSet($headers[$header_name]))
			{
				if(GetType($headers[$header_name])=="string")
					$headers[$header_name]=array($headers[$header_name]);
				$headers[$header_name][]=$header_value;
			}
			else
				$headers[$header_name]=$header_value;
			switch($header_name)
			{
				case "content-length":
					$this->content_length=intval($headers[$header_name]);
					$this->content_length_set=1;
					break;
				case "transfer-encoding":
					$encoding=$this->Tokenize($header_value,"; \t");
					if(!$this->use_curl
					&& !strcmp($encoding,"chunked"))
						$chunked=1;
					break;
				case "set-cookie":
					if($this->support_cookies)
					{
						if(GetType($headers[$header_name])=="array")
							$cookie_headers=$headers[$header_name];
						else
							$cookie_headers=array($headers[$header_name]);
						for($cookie=0;$cookie<count($cookie_headers);$cookie++)
						{
							$cookie_name=trim(UrlDecode($this->Tokenize($cookie_headers[$cookie],"=")));
							$cookie_value=UrlDecode($this->Tokenize(";"));
							$domain=$this->request_host;
							$path="/";
							$expires="";
							$secure=(strtolower($this->protocol)=="https");
							while(($name=trim(UrlDecode($this->Tokenize("="))))!="")
							{
								$value=UrlDecode($this->Tokenize(";"));
								switch($name)
								{
									case "domain":
										$domain=$value;
										break;
									case "path":
										$path=$value;
										break;
									case "expires":
										if(ereg("^((Mon|Monday|Tue|Tuesday|Wed|Wednesday|Thu|Thursday|Fri|Friday|Sat|Saturday|Sun|Sunday), )?([0-9]{2})\\-(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\\-([0-9]{2,4}) ([0-9]{2})\\:([0-9]{2})\\:([0-9]{2}) GMT$",$value,$matches))
										{
											$year=intval($matches[5]);
											if($year<1900)
												$year+=($year<70 ? 2000 : 1900);
											$expires="$year-".$this->months[$matches[4]]."-".$matches[3]." ".$matches[6].":".$matches[7].":".$matches[8];
										}
										break;
									case "secure":
										$secure=1;
										break;
								}
							}
							if(strlen($this->SetCookie($cookie_name, $cookie_value, $expires, $path , $domain, $secure)))
								$this->error="";
						}
					}
			}
		}
        //store cookie in session
        $_SESSION['cookies']=$this->cookies;
		$this->chunked=$chunked;
		return("");
	}

	function Authenticate(&$headers, $proxy, &$proxy_authorization, &$user, &$password, &$realm, &$workstation)
	{
        //require 'sasl.php';
		if($proxy)
		{
			$authenticate_header="proxy-authenticate";
			$authorization_header="Proxy-Authorization";
			$authenticate_status="407";
			$authentication_mechanism=$this->proxy_authentication_mechanism;
		}
		else
		{
			$authenticate_header="www-authenticate";
			$authorization_header="Authorization";
			$authenticate_status="401";
			$authentication_mechanism=$this->authentication_mechanism;
		}
		if(IsSet($headers[$authenticate_header]))
		{
			if(function_exists("class_exists")
			&& !class_exists("sasl_client_class"))
				return($this->SetError("the SASL client class needs to be loaded to be able to authenticate".($proxy ? " with the proxy server" : "")." and access this site"));
			if(GetType($headers[$authenticate_header])=="array")
				$authenticate=$headers[$authenticate_header];
			else
				$authenticate=array($headers[$authenticate_header]);
			for($mechanisms=array(),$m=0;$m<count($authenticate);$m++)
			{
				$mechanism=$this->Tokenize($authenticate[$m]," ");
				if(strlen($authentication_mechanism))
				{
					if(!strcmp($authentication_mechanism,$mechanism))
					{
						$mechanisms[]=$mechanism;
						break;
					}
				}
				else
					$mechanisms[]=$mechanism;
			}
			$sasl=new sasl_client_class;
			if(IsSet($user))
				$sasl->SetCredential("user",$user);
			if(IsSet($password))
				$sasl->SetCredential("password",$password);
			if(IsSet($realm))
				$sasl->SetCredential("realm",$realm);
			if(IsSet($workstation))
				$sasl->SetCredential("workstation",$workstation);
			do
			{
				$status=$sasl->Start($mechanisms,$message,$interactions);
			}
			while($status==SASL_INTERACT);
			switch($status)
			{
				case SASL_CONTINUE:
					break;
				case SASL_NOMECH:
					return($this->SetError(($proxy ? "proxy " : "")."authentication error: ".(strlen($authentication_mechanism) ? "authentication mechanism ".$authentication_mechanism." may not be used: " : "").$sasl->error));
				default:
					return($this->SetError("Could not start the SASL ".($proxy ? "proxy " : "")."authentication client: ".$sasl->error));
			}
			for(;;)
			{
				if(strlen($error=$this->ReadReplyBody($body,$this->file_buffer_length)))
					return($error);
				if(strlen($body)==0)
					break;
			}
			$authorization_value=$sasl->mechanism.(IsSet($message) ? " ".base64_encode($message) : "");
            $arguments=array(
				"Headers"=>array(
                    'Host' => $this->host_name,
                    'User-Agent' => $this->request_headers['User-Agent'],
					$authorization_header=>$authorization_value,
					"Keep-Alive"=>"300"
				)
			);
            $arguments["RequestMethod"]='GET';
			if(!$proxy
			&& strlen($proxy_authorization))
				$arguments["Headers"]["Proxy-Authorization"]=$proxy_authorization;
			if(strlen($error=$this->Close())
			|| strlen($error=$this->Open($arguments)))
				return($this->SetError($error));
			$authenticated=0;
			$response="";
			if(IsSet($message))
			{
				if(strlen($error=$this->SendRequest($arguments))
				|| strlen($error=$this->ReadReplyHeadersResponse($headers)))
					return($this->SetError($error));
				if(!IsSet($headers[$authenticate_header]))
					$authenticate=array();
				elseif(GetType($headers[$authenticate_header])=="array")
					$authenticate=$headers[$authenticate_header];
				else
					$authenticate=array($headers[$authenticate_header]);
				for($mechanism=0;$mechanism<count($authenticate);$mechanism++)
				{
					if(!strcmp($this->Tokenize($authenticate[$mechanism]," "),$sasl->mechanism))
					{
						$response=$this->Tokenize("");
						break;
					}
				}
				switch($this->response_status)
				{
					case "200":
						if($proxy)
							$proxy_authorization=$authorization_value;
						$authenticated=1;
						break;
                    case "401":
                        return '401';
						break;
					case $authenticate_status:
						break;
					default:
                        //if 30x,redirect or 40x,auth again
                        if(is_numeric($this->response_status))
                        {
                            $this->ReadReplyHeaders($headers);
                            return "";
                        }
						if($proxy
						&& !strcmp($this->response_status,"401"))
						{
							$proxy_authorization=$authorization_value;
							$authenticated=1;
							break;
						}
						return($this->SetError(($proxy ? "proxy " : "")."authentication error: ".$this->response_status." ".$this->response_message));
				}
			}
			for(;!$authenticated;)
			{
				do
				{
					$status=$sasl->Step($response,$message,$interactions);
				}
				while($status==SASL_INTERACT);
				switch($status)
				{
					case SASL_CONTINUE:
						$authorization_value=$sasl->mechanism.(IsSet($message) ? " ".base64_encode($message) : "");
						$arguments=array(
							"Headers"=>array(
								$authorization_header=>$authorization_value,
								"Keep-Alive"=>"300"
							)
						);
						if(!$proxy
						&& strlen($proxy_authorization))
							$arguments["Headers"]["Proxy-Authorization"]=$proxy_authorization;
						if(strlen($error=$this->SendRequest($arguments))
						|| strlen($error=$this->ReadReplyHeadersResponse($headers)))
							return($this->SetError($error));
						switch($this->response_status)
						{
							case "200":
								if($proxy)
									$proxy_authorization=$authorization_value;
								$authenticated=1;
								break;
							case $authenticate_status:
								if(GetType($headers[$authenticate_header])=="array")
									$authenticate=$headers[$authenticate_header];
								else
									$authenticate=array($headers[$authenticate_header]);
								for($response="",$mechanism=0;$mechanism<count($authenticate);$mechanism++)
								{
									if(!strcmp($this->Tokenize($authenticate[$mechanism]," "),$sasl->mechanism))
									{
										$response=$this->Tokenize("");
										break;
									}
								}
								for(;;)
								{
									if(strlen($error=$this->ReadReplyBody($body,$this->file_buffer_length)))
										return($error);
									if(strlen($body)==0)
										break;
								}
								$this->state="Connected";
								break;
							default:
								if($proxy
								&& !strcmp($this->response_status,"401"))
								{
									$proxy_authorization=$authorization_value;
									$authenticated=1;
									break;
								}
								return($this->SetError(($proxy ? "proxy " : "")."authentication error: ".$this->response_status." ".$this->response_message));
						}
						break;
					default:
						return($this->SetError("Could not process the SASL ".($proxy ? "proxy " : "")."authentication step: ".$sasl->error));
				}
			}
		}
		return("");
	}
	
	function ReadReplyHeaders(&$headers)
	{
        if($this->state!='GotReplyHeaders')
		if(strlen($error=$this->ReadReplyHeadersResponse($headers)))
			return($error);
		$proxy_authorization="";
		switch($this->response_status)
		{
			case "100":
				$this->state="RequestSent";
				return($this->ReadReplyHeaders($headers));
			case "301":
			case "302":
			case "303":
			case "307":
				if($this->follow_redirect)
				{
					if(!IsSet($headers["location"])
					|| strlen($headers["location"])==0)
						return($this->SetError("3 it was received a redirect without location URL"));
					$location=$headers["location"];
					if(strcmp($location[0],"/"))
					{
						$location_arguments=parse_url($location);
						if(!IsSet($location_arguments["scheme"]))
							$location=dirname($this->request_uri)."/".$location;
					}
					if(!strcmp($location[0],"/"))
						$location=$this->protocol."://".$this->host_name.($this->host_port ? ":".$this->host_port : "").$location;
					$error=$this->GetRequestArguments($location,$arguments);
					if(strlen($error))
						return($this->SetError("could not process redirect url: ".$error));
					$arguments["RequestMethod"]="GET";
					if(strlen($error=$this->Close())==0
					&& strlen($error=$this->Open($arguments))==0
					&& strlen($error=$this->SendRequest($arguments))==0)
					{
						$this->redirection_level++;
						if($this->redirection_level>$this->redirection_limit)
							$error="it was exceeded the limit of request redirections";
						else
							$error=$this->ReadReplyHeaders($headers);
						$this->redirection_level--;
					}
                    $_SESSION['cookies']=$this->cookies;
					if(strlen($error))
						return($this->SetError($error));
				}
				break;
			case "407":
				if(strlen($error=$this->Authenticate($headers, 1, $proxy_authorization, $this->proxy_request_user, $this->proxy_request_password, $this->proxy_request_realm, $this->proxy_request_workstation)))
					return($error);
				if(strcmp($this->response_status,"401"))
					return("");
			case "401":
                preg_match_all("'([a-z0-9]+)\s*realm=([\"\'])?(?(1) (.*?)\\2 | ([^\s]+) )'isx",$headers["www-authenticate"],$result);
                $auth=$result[1][0];
                if(isset($_SESSION[$this->host_name.':'.$auth]))
                {
                    list($this->request_user,$this->request_password)=split(':',$_SESSION[$this->host_name.':'.$auth]);
                }
                else
                {
                    show_auth_form($headers["www-authenticate"]);
                    return "";
                }
                $error=$this->Authenticate($headers, 0, $proxy_authorization, $this->request_user, $this->request_password, $this->request_realm, $this->request_workstation);
                if(is_numeric($error))
                {
                   return "";
                }
                else
				return($error);
		}
		return("");
	}

	function ReadReplyBody(&$body,$length)
	{
		$body="";
		if(strlen($this->error))
			return($this->error);
		switch($this->state)
		{
			case "Disconnected":
				return($this->SetError("1 connection was not yet established"));
			case "Connected":
				return($this->SetError("2 request was not sent"));
			case "RequestSent":
				if(($error=$this->ReadReplyHeaders($headers))!="")
					return($error);
				break;
			case "GotReplyHeaders":
				break;
			default:
				return($this->SetError("3 can not get request headers in the current connection state"));
		}
		if($this->content_length_set)
			$length=min($this->content_length-$this->read_length,$length);
		if($length>0
		&& !$this->EndOfInput()
		&& ($body=$this->ReadBytes($length))=="")
		{
			$version=explode(".",function_exists("phpversion") ? phpversion() : "3.0.7");
			$php_version=intval($version[0])*1000000+intval($version[1])*1000+intval($version[2]);
			if($php_version<4003002
			|| ($php_version>4003004
			&& $php_version!=4003007)
			|| !$this->EndOfInput())
				return($this->SetError("4 could not get the request reply body: ".$this->error));
		}
		$this->read_length+=strlen($body);
		return("");
	}

	function GetPersistentCookies(&$cookies)
	{
		$now=gmdate("Y-m-d H-i-s");
		$cookies=array();
		for($secure_cookies=0,Reset($this->cookies);$secure_cookies<count($this->cookies);Next($this->cookies),$secure_cookies++)
		{
			$secure=Key($this->cookies);
			for($domain=0,Reset($this->cookies[$secure]);$domain<count($this->cookies[$secure]);Next($this->cookies[$secure]),$domain++)
			{
				$domain_pattern=Key($this->cookies[$secure]);
				for(Reset($this->cookies[$secure][$domain_pattern]),$path_part=0;$path_part<count($this->cookies[$secure][$domain_pattern]);Next($this->cookies[$secure][$domain_pattern]),$path_part++)
				{
					$path=Key($this->cookies[$secure][$domain_pattern]);
					for(Reset($this->cookies[$secure][$domain_pattern][$path]),$cookie=0;$cookie<count($this->cookies[$secure][$domain_pattern][$path]);Next($this->cookies[$secure][$domain_pattern][$path]),$cookie++)
					{
						$cookie_name=Key($this->cookies[$secure][$domain_pattern][$path]);
						$expires=$this->cookies[$secure][$domain_pattern][$path][$cookie_name]["expires"];
						if($expires!=""
						&& strcmp($now,$expires)<0)
							$cookies[$secure][$domain_pattern][$path][$cookie_name]=$this->cookies[$secure][$domain_pattern][$path][$cookie_name];
					}
				}
			}
		}
	}

}


/*********************************************************************
 *
 *    PHP FTP Client Class By TOMO ( groove@spencernetwork.org )
 *
 *  - Version 0.12 (2002/01/11)
 *  - This script is free but without any warranty.
 *  - You can freely copy, use, modify or redistribute this script
 *    for any purpose.
 *  - But please do not erase this information!!.
 *
 ********************************************************************/



/*********************************************************************
Example

$ftp_host = "ftp.example.com";
$ftp_user = "username";
$ftp_pass = "password";

$ftp = new ftp();

$ftp->debug = TRUE;

if (!$ftp->ftp_connect($ftp_host)) {
	die("Cannot connect\n");
}

if (!$ftp->ftp_login($ftp_user, $ftp_pass)) {
	$ftp->ftp_quit();
	die("Login failed\n");
}

if ($pwd = $ftp->ftp_pwd()) {
	echo "Current directory is ".$pwd."\n";
} else {
	$ftp->ftp_quit();
	die("Error!!\n");
}

if ($sys = $ftp->ftp_systype()) {
	echo "Remote system is ".$sys."\n";
} else {
	$ftp->ftp_quit();
	die("Error!!\n");
}


$local_filename  = "local.file";
$remote_filename = "remote.file";

if ($ftp->ftp_file_exists($remote_filename) == 1) {
	$ftp->ftp_quit();
	die($remote_filename." already exists\n");
}

if ($ftp->ftp_put($remote_filename, $local_filename)) {
	echo $local_filename." has been uploaded as ".$remote_filename."\n";
} else {
	$ftp->ftp_quit();
	die("Error!!\n");
}


$ftp->ftp_quit();
*********************************************************************/



/*********************************************************************
List of available functions

ftp_connect($server, $port = 21)
ftp_login($user, $pass)
ftp_pwd()
ftp_size($pathname)
ftp_mdtm($pathname)
ftp_systype()
ftp_cdup()
ftp_chdir($pathname)
ftp_delete($pathname)
ftp_rmdir($pathname)
ftp_mkdir($pathname)
ftp_file_exists($pathname)
ftp_rename($from, $to)
ftp_nlist($arg = "", $pathname = "")
ftp_rawlist($pathname = "")
ftp_get($localfile, $remotefile, $mode = 1)
ftp_put($remotefile, $localfile, $mode = 1)
ftp_site($command)
ftp_quit()

*********************************************************************/

class ftp
{
	/* Public variables */
	var $debug;
	var $umask;
	var $timeout;

	/* Private variables */
	var $ftp_sock;
	var $ftp_resp;

	/* Constractor */
	function ftp()
	{
		$this->debug = FALSE;
		$this->umask = 0022;
		$this->timeout = 30;

		if (!defined("FTP_BINARY")) {
			define("FTP_BINARY", 1);
		}
		if (!defined("FTP_ASCII")) {
			define("FTP_ASCII", 0);
		}

		$this->ftp_resp = "";
	}

	/* Public functions */
	function ftp_connect($server, $port = 21)
	{
		$this->ftp_debug("Trying to ".$server.":".$port." ...\n");
		$this->ftp_sock = @fsockopen($server, $port, $errno, $errstr, $this->timeout);

		if (!$this->ftp_sock || !$this->ftp_ok()) {
			$this->ftp_debug("Error : Cannot connect to remote host \"".$server.":".$port."\"\n");
			$this->ftp_debug("Error : fsockopen() ".$errstr." (".$errno.")\n");
			return FALSE;
		}
		$this->ftp_debug("Connected to remote host \"".$server.":".$port."\"\n");

		return TRUE;
	}

	function ftp_login($user, $pass)
	{
		$this->ftp_putcmd("USER", $user);
		if (!$this->ftp_ok()) {
			$this->ftp_debug("Error : USER command failed\n");
			return FALSE;
		}

		$this->ftp_putcmd("PASS", $pass);
		if (!$this->ftp_ok()) {
			$this->ftp_debug("Error : PASS command failed\n");
			return FALSE;
		}
		$this->ftp_debug("Authentication succeeded\n");

		return TRUE;
	}

	function ftp_pwd()
	{
		$this->ftp_putcmd("PWD");
		if (!$this->ftp_ok()) {
			$this->ftp_debug("Error : PWD command failed\n");
			return FALSE;
		}

		return ereg_replace("^[0-9]{3} \"(.+)\" .+\r\n", "\\1", $this->ftp_resp);
	}

	function ftp_size($pathname)
	{
		$this->ftp_putcmd("SIZE", $pathname);
		if (!$this->ftp_ok()) {
			$this->ftp_debug("Error : SIZE command failed\n");
			return -1;
		}

		return ereg_replace("^[0-9]{3} ([0-9]+)\r\n", "\\1", $this->ftp_resp);

	}

	function ftp_mdtm($pathname)
	{
		$this->ftp_putcmd("MDTM", $pathname);
		if (!$this->ftp_ok()) {
			$this->ftp_debug("Error : MDTM command failed\n");
			return -1;
		}
		$mdtm = ereg_replace("^[0-9]{3} ([0-9]+)\r\n", "\\1", $this->ftp_resp);
		$date = sscanf($mdtm, "%4d%2d%2d%2d%2d%2d");
		$timestamp = mktime($date[3], $date[4], $date[5], $date[1], $date[2], $date[0]);

		return $timestamp;
	}

	function ftp_systype()
	{
		$this->ftp_putcmd("SYST");
		if (!$this->ftp_ok()) {
			$this->ftp_debug("Error : SYST command failed\n");
			return FALSE;
		}
		$DATA = explode(" ", $this->ftp_resp);

		return $DATA[1];
	}

	function ftp_cdup()
	{
		$this->ftp_putcmd("CDUP");
		$response = $this->ftp_ok();
		if (!$response) {
			$this->ftp_debug("Error : CDUP command failed\n");
		}
		return $response;
	}

	function ftp_chdir($pathname)
	{
		$this->ftp_putcmd("CWD", $pathname);
		$response = $this->ftp_ok();
		if (!$response) {
			$this->ftp_debug("Error : CWD command failed\n");
		}
		return $response;
	}

	function ftp_delete($pathname)
	{
		$this->ftp_putcmd("DELE", $pathname);
		$response = $this->ftp_ok();
		if (!$response) {
			$this->ftp_debug("Error : DELE command failed\n");
		}
		return $response;
	}

	function ftp_rmdir($pathname)
	{
		$this->ftp_putcmd("RMD", $pathname);
		$response = $this->ftp_ok();
		if (!$response) {
			$this->ftp_debug("Error : RMD command failed\n");
		}
		return $response;
	}

	function ftp_mkdir($pathname)
	{
		$this->ftp_putcmd("MKD", $pathname);
		$response = $this->ftp_ok();
		if (!$response) {
			$this->ftp_debug("Error : MKD command failed\n");
		}
		return $response;
	}

	function ftp_file_exists($pathname)
	{
		if (!($remote_list = $this->ftp_nlist("-la"))) {
			$this->ftp_debug("Error : Cannot get remote file list\n");
			return -1;
		}
		
		reset($remote_list);
		while (list(,$value) = each($remote_list)) {
			if ($value == $pathname) {
				$this->ftp_debug("Remote file ".$pathname." exists\n");
				return 1;
			}
		}
		$this->ftp_debug("Remote file ".$pathname." does not exist\n");

		return 0;
	}

	function ftp_rename($from, $to)
	{
		$this->ftp_putcmd("RNFR", $from);
		if (!$this->ftp_ok()) {
			$this->ftp_debug("Error : RNFR command failed\n");
			return FALSE;
		}
		$this->ftp_putcmd("RNTO", $to);

		$response = $this->ftp_ok();
		if (!$response) {
			$this->ftp_debug("Error : RNTO command failed\n");
		}
		return $response;
	}

	function ftp_nlist($arg = "", $pathname = "")
	{
		if (!($string = $this->ftp_pasv())) {
			return FALSE;
		}

		if ($arg == "") {
			$nlst = "NLST";
		} else {
			$nlst = "NLST ".$arg;
		}
		$this->ftp_putcmd($nlst, $pathname);

		$sock_data = $this->ftp_open_data_connection($string);
		if (!$sock_data || !$this->ftp_ok()) {
			$this->ftp_debug("Error : Cannot connect to remote host\n");
			$this->ftp_debug("Error : NLST command failed\n");
			return FALSE;
		}
		$this->ftp_debug("Connected to remote host\n");

		while (!feof($sock_data)) {
			$list[] = ereg_replace("[\r\n]", "", fgets($sock_data, 512));
		}
		$this->ftp_close_data_connection($sock_data);
		$this->ftp_debug(implode("\n", $list));

		if (!$this->ftp_ok()) {
			$this->ftp_debug("Error : NLST command failed\n");
			return FALSE;
		}

		return $list;
	}

	function ftp_rawlist($pathname = "")
	{
		if (!($string = $this->ftp_pasv())) {
			return FALSE;
		}

		$this->ftp_putcmd("LIST", $pathname);

		$sock_data = $this->ftp_open_data_connection($string);
		if (!$sock_data || !$this->ftp_ok()) {
			$this->ftp_debug("Error : Cannot connect to remote host\n");
			$this->ftp_debug("Error : LIST command failed\n");
			return FALSE;
		}

		$this->ftp_debug("Connected to remote host\n");

		while (!feof($sock_data)) {
			$list[] = ereg_replace("[\r\n]", "", fgets($sock_data, 512));
		}
		$this->ftp_debug(implode("\n", $list));
		$this->ftp_close_data_connection($sock_data);

		if (!$this->ftp_ok()) {
			$this->ftp_debug("Error : LIST command failed\n");
			return FALSE;
		}

		return $list;
	}

	function ftp_get($remotefile, $filesize, $secid, $mode = 1)
	{
        $dtstart = $dtnow = time();
        $iTotal = $filesize;
        $iRead=0;
                   
		umask($this->umask);

		if (!$this->ftp_type($mode)) {
			$this->ftp_debug("Error : GET command failed\n");
			return FALSE;
		}

		if (!($string = $this->ftp_pasv())) {
			$this->ftp_debug("Error : GET command failed\n");
			return FALSE;
		}

		$this->ftp_putcmd("RETR", $remotefile);

		$sock_data = $this->ftp_open_data_connection($string);
		if (!$sock_data || !$this->ftp_ok()) {
			$this->ftp_debug("Error : Cannot connect to remote host\n");
			$this->ftp_debug("Error : GET command failed\n");
			return FALSE;
		}
		$this->ftp_debug("Connected to remote host\n");
		$this->ftp_debug("Retrieving remote file \"".$remotefile."\" \n");
		$body='';
		$tmp_file = './temp/'.$secid.'/upload_postdata';
		$fp = fopen($tmp_file, 'w');
		while (!feof($sock_data)) 
		{
            $i++;
            $body=fread($sock_data, 4096);
			fwrite($fp,$body);
            $iRead += strlen($body);
			$body='';
            if($i % 50==0) 
				uploadstatus($iTotal,$iRead,$dtstart);
		}
		fclose($fp);
        uploadstatus($iTotal,$iRead,$dtstart);
        
		$this->ftp_close_data_connection($sock_data);

		$response = $this->ftp_ok();
		if (!$response) 
		{
			$this->ftp_debug("Error : GET command failed\n");
			return false;
		}
		return $tmp_file;
	}

	function ftp_put($remotefile, $localfile, $mode = 1)
	{
		
		if (!@file_exists($localfile)) {
			$this->ftp_debug("Error : No such file or directory \"".$localfile."\"\n");
			$this->ftp_debug("Error : PUT command failed\n");
			return FALSE;
		}

		$fp = @fopen($localfile, "r");
		if (!$fp) {
			$this->ftp_debug("Error : Cannot read file \"".$localfile."\"\n");
			$this->ftp_debug("Error : PUT command failed\n");
			return FALSE;
		}

		if (!$this->ftp_type($mode)) {
			$this->ftp_debug("Error : PUT command failed\n");
			return FALSE;
		}

		if (!($string = $this->ftp_pasv())) {
			$this->ftp_debug("Error : PUT command failed\n");
			return FALSE;
		}

		$this->ftp_putcmd("STOR", $remotefile);

		$sock_data = $this->ftp_open_data_connection($string);
		if (!$sock_data || !$this->ftp_ok()) {
			$this->ftp_debug("Error : Cannot connect to remote host\n");
			$this->ftp_debug("Error : PUT command failed\n");
			return FALSE;
		}
		$this->ftp_debug("Connected to remote host\n");
		$this->ftp_debug("Storing local file \"".$localfile."\" to remote file \"".$remotefile."\"\n");
		while (!feof($fp)) {
			fputs($sock_data, fread($fp, 4096));
		}
		fclose($fp);

		$this->ftp_close_data_connection($sock_data);

		$response = $this->ftp_ok();
		if (!$response) {
			$this->ftp_debug("Error : PUT command failed\n");
		}
		return $response;
	}

	function ftp_site($command)
	{
		$this->ftp_putcmd("SITE", $command);
		$response = $this->ftp_ok();
		if (!$response) {
			$this->ftp_debug("Error : SITE command failed\n");
		}
		return $response;
	}

	function ftp_quit()
	{
		$this->ftp_putcmd("QUIT");
		if (!$this->ftp_ok() || !fclose($this->ftp_sock)) {
			$this->ftp_debug("Error : QUIT command failed\n");
			return FALSE;
		}
		$this->ftp_debug("Disconnected from remote host\n");
		return TRUE;
	}

	/* Private Functions */

	function ftp_type($mode)
	{
		if ($mode) {
			$type = "I"; //Binary mode
		} else {
			$type = "A"; //ASCII mode
		}
		$this->ftp_putcmd("TYPE", $type);
		$response = $this->ftp_ok();
		if (!$response) {
			$this->ftp_debug("Error : TYPE command failed\n");
		}
		return $response;
	}

	function ftp_port($ip_port)
	{
		$this->ftp_putcmd("PORT", $ip_port);
		$response = $this->ftp_ok();
		if (!$response) {
			$this->ftp_debug("Error : PORT command failed\n");
		}
		return $response;
	}

	function ftp_pasv()
	{
		$this->ftp_putcmd("PASV");
		if (!$this->ftp_ok()) {
			$this->ftp_debug("Error : PASV command failed\n");
			return FALSE;
		}

		$ip_port = ereg_replace("^.+ \\(?([0-9]{1,3},[0-9]{1,3},[0-9]{1,3},[0-9]{1,3},[0-9]+,[0-9]+)\\)?.*\r\n$", "\\1", $this->ftp_resp);
		return $ip_port;
	}

	function ftp_putcmd($cmd, $arg = "")
	{
		if ($arg != "") {
			$cmd = $cmd." ".$arg;
		}

		fputs($this->ftp_sock, $cmd."\r\n");
		$this->ftp_debug("> ".$cmd."\n");

		return TRUE;
	}

	function ftp_ok()
	{
		$this->ftp_resp = "";
		do {
			$res = fgets($this->ftp_sock, 512);
			$this->ftp_resp .= $res;
		} while (substr($res, 3, 1) != " ");

		$this->ftp_debug(str_replace("\r\n", "\n", $this->ftp_resp));

		if (!ereg("^[123]", $this->ftp_resp)) {
			return FALSE;
		}

		return TRUE;
	}

	function ftp_close_data_connection($sock)
	{
		$this->ftp_debug("Disconnected from remote host\n");
		return fclose($sock);
	}

	function ftp_open_data_connection($ip_port)
	{
		if (!ereg("[0-9]{1,3},[0-9]{1,3},[0-9]{1,3},[0-9]{1,3},[0-9]+,[0-9]+", $ip_port)) {
			$this->ftp_debug("Error : Illegal ip-port format(".$ip_port.")\n");
			return FALSE;
		}

		$DATA = explode(",", $ip_port);
		$ipaddr = $DATA[0].".".$DATA[1].".".$DATA[2].".".$DATA[3];
		$port   = $DATA[4]*256 + $DATA[5];
		$this->ftp_debug("Trying to ".$ipaddr.":".$port." ...\n");
		$data_connection = @fsockopen($ipaddr, $port, $errno, $errstr);
		if (!$data_connection) {
			$this->ftp_debug("Error : Cannot open data connection to ".$ipaddr.":".$port."\n");
			$this->ftp_debug("Error : ".$errstr." (".$errno.")\n");
			return FALSE;
		}

		return $data_connection;
	}

	function ftp_debug($message = "")
	{
		if ($this->debug) {
			echo $message;
		}

		return TRUE;
	}
}

?>
