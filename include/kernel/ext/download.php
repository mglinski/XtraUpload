<?
/**
 @author Nguyen Quoc Bao <quocbao.coder@gmail.com>
 @version 1.3	
 @copyright It's free as long as you keep this header .
**/

class download {

	var $data = null;
	var $data_len = 0;
	var $data_mod = 0;
	var $data_type = 0;
	var $data_section = 0; //section download
	/**
	 * @var ObjectHandler
	 **/
	var $handler = array('auth' => null);
	var $use_resume = true;
	var $use_autoexit = false;
	var $use_auth = false;
	var $filename = null;
	var $mime = null;
	var $bufsize = 8192;
	var $seek_start = 0;
	var $seek_end = -1;
	
	/**
	 * Total bandwidth has been used for this download
	 * @var int
	 */
	var $bandwidth = 0;
	/**
	 * Speed limit
	 * @var float
	 */
	var $speed = 0;
	
	/*-------------------
	| Download Function |
	-------------------*/
	/**
	 * Check authentication and get seek position
	 * @return bool
	 **/
	function initialize() {
		global $HTTP_SERVER_VARS;
		if ($this->mime == null) $this->mime = "application/octet-stream"; //default mime
		if (isset($_SERVER['HTTP_RANGE']) || isset($HTTP_SERVER_VARS['HTTP_RANGE']))
		{
			
			if (isset($HTTP_SERVER_VARS['HTTP_RANGE'])) $seek_range = substr($HTTP_SERVER_VARS['HTTP_RANGE'] , strlen('bytes='));
			else $seek_range = substr($_SERVER['HTTP_RANGE'] , strlen('bytes='));
			
			$range = explode('-',$seek_range);
			
			if ($range[0] > 0)
			{
				$this->seek_start = intval($range[0]);
			}
			
			if ($range[1] > 0) $this->seek_end = intval($range[1]);
			else $this->seek_end = -1;
			
			if (!$this->use_resume)
			{
				$this->seek_start = 0;
			}
			else
			{
				$this->data_section = 1;
			}
			
		}
		else
		{
			$this->seek_start = 0;
			$this->seek_end = -1;
		}
	}
	/**
	 * Send download information header
	 **/
	function header($size,$seek_start=null,$seek_end=null) {
		header('Content-type: ' . $this->mime);
		header('Content-Disposition: attachment; filename="' . $this->filename . '"');
		header('Last-Modified: ' . date('D, d M Y H:i:s \G\M\T' , $this->data_mod));
		
		if ($this->data_section && $this->use_resume)
		{
			header("HTTP/1.0 206 Partial Content");
			header("Status: 206 Partial Content");
			header('Accept-Ranges: bytes');
			header("Content-Range: bytes $seek_start-$seek_end/$size");
			header("Content-Length: " . ($seek_end - $seek_start + 1));
		}
		else
		{
			header("Content-Length: $size");
		}
	}
	
	/**
	 * Start download
	 * @return bool
	 **/
	function sendDownload()
    {
        $this->initialize();
        
        $seek = $this->seek_start;
        $speed = $this->speed;
        $bufsize = $this->bufsize;
        $packet = 1;
        
        //do some clean up
        @set_time_limit(0);
        $this->bandwidth = 0;
        
        $size = filesize($this->data);
        if ($seek > ($size - 1)) $seek = 0;
        if ($this->filename == null) $this->filename = basename($this->data);
        
        $res = fopen($this->data,'rb');
        if ($seek) fseek($res , $seek);
        if ($this->seek_end < $seek) $this->seek_end = $size - 1;
        
        $this->header($size,$seek,$this->seek_end); //always use the last seek
        $size = $this->seek_end - $seek + 1;    

        while (!($user_aborted = connection_aborted() || connection_status() == 1) && $size > 0)
        //while (!($user_aborted = connection_aborted() || connection_status() != 0))
        {
            $startpacket = microtime(1);
            
            if ($size < $bufsize)
            {
                echo $this->fullread($res , $size);
                $this->bandwidth += $size;
            }
            else
            {
                echo $this->fullread($res , $bufsize);
                $this->bandwidth += $bufsize;
            }
            
            $size -= $bufsize;
            flush();
            
            $timeend = microtime(1);

            $packettime = $timeend - $startpacket;
            $microsleep = ($bufsize / ($speed * 1024))*1000*1000 - $packettime;
            usleep($microsleep);
            
        }
        fclose($res);
                    
        if ($this->use_autoexit) exit();

        //restore old status
        @ignore_user_abort($old_status);
        @set_time_limit(ini_get("max_execution_time"));

        return $this->bandwidth;
    }
    
    function fullread($fh,$size)
    {
          $buffer ='';
          $done = 0;
          while($done < $size)
          {
              if ($size - $done > 8192)
              {
                  $thisbuff = fread($fh, 8192);
                $buffer .= $thisbuff;
                $did = strlen($thisbuff);
            }
            else
            {
                $thisbuff = fread($fh, $size - $done);
                $buffer .= $thisbuff;
                $did = strlen($thisbuff);
            }
            $done = $done + $did;
        }
        return $buffer;    
    }
	
	function set_byfile($dir) 
	{
		if (is_readable($dir) && is_file($dir)) 
		{
			$this->data_len = 0;
			$this->data = $dir;
			$this->data_type = 0;
			$this->data_mod = filemtime($dir);
			return true;
		} 
		else 
		{
			return false;
		}
	}
}

?>