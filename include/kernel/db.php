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
class db_conn
{
    // Sets the necessary variables for the class
    var $connection;
    var $database_name;
    var $querycount = 0;
    var $select;
    var $query;
    var $msg;
    var $queries;
    var $debug_html;
    var $memcacheStore;
    var $use_memcache;
    var $hooks;
    var $mysqli = false;

    function connect($server, $conn_username, $conn_password, $database_name)
    {
        global $pdBconn, $use_mysqli;

        //$this->hooks = new stdClass;


        if($use_mysqli)
        {
            $this->mysqli = true;
        }

        if(!$this->mysqli)
        {
            if(!$pdBconn)
            {
                $this->connection = mysql_connect($server,$conn_username,$conn_password,true) or $this->error_out('Could not connect to the database: '.mysql_error().'<br />');
            }
            else
            {
                $this->preStr = 'mysql_';
                $this->connection = mysql_pconnect($server,$conn_username,$conn_password) or $this->error_out('Could not connect to the database: '.mysql_error().'<br />');
            }

            mysql_select_db($database_name) or $this->error_out('Could not select the database: '.mysql_error().'<br />');
        }
        else
        {
            if(!$pdBconn)
            {
                $this->connection = mysqli_connect($server,$conn_username,$conn_password,$database_name);
                /* check connection */
                if (!$this->connection)
                {
                    $this->error_out('Could not connect to the database: '.mysqli_connect_error().'<br />');
                }
            }
            else
            {
                $this->mysqli = false;
                $this->connection = mysql_pconnect($server,$conn_username,$conn_password) or $this->error_out('Could not connect to the database: '.mysql_error().'<br />');
                mysql_select_db($database_name) or $this->error_out('Could not select the database: '.mysql_error().'<br />');
            }
        }
    }

    function error_out($msg)
    {
        $msg = '<html>
<head>
<title>ERROR :: XtraUpload Database System</title>
<style type="text/css">
<!--
.style1 {
    color: #FF0000;
    font-size: 24px;
    font-weight: bold;
}
-->
</style>
</head>
<body>
<table width="106" height="34" border="5" align="center" cellpadding="7" cellspacing="0" bordercolor="#FF0000">
  <tr>
    <td width="86" bordercolor="#FF0000"><div align="center" class="style1">ERROR</div></td>
  </tr>
</table>
<p align="center"><b>'.$msg.'</b></p>
<script>alert("'.$msg.'")</script>
</body>
</html>';
        echo $msg;
        die;
    }

    function query($query,$place ='',$useMemcache=false)
    {
        global $kernel;

        $this->debug_html .= '<tr><td style="font-family: Arial, Helvetica, sans-serif">Query: ['.$this->querycount.'] => $db->query("'.$query.'");</td></tr>'."\n";
        $this->queries[$this->querycount] = "'".$query."'";
        $this->querycount++;

        $this->query = $query;

        /*
        $hookLoc = 'query';
          foreach($this->hooks->$hookLoc as $hook)
        {
            $result = $this->runHook($hookLoc, $hook, $result, $type);
            if(!$result['ret'])
            {
                $this->error_out('Could not run hook "'.$hook.'": ' . $result['errorMsg'].'<br />');
            }
            else
            {
                if($result['force'])
                {
                    return $result['new'];
                }
            }
        }
        */

        if($this->use_memcache)
        {
            $this->memcacheStore = '';
            $obj = $kernel->memcache->get(md5($query));

            if($obj)
            {
                $this->memcacheStore = unserialize($obj);
                return 'memcache';
            }
            else
            {
                $ser = array();
                if(!$this->mysqli)
                {
                    $result = mysql_query($query, $this->connection);
                }
                else
                {
                    $result = mysqli_query($this->connection, $query);
                }

                $ser['query'] = $query;
                $ser['fetch'] = serialize($this->fetch($result));
                $ser['num'] = $this->num($result);
                $ser['ins_id'] = $this->insert_id($result);

                $kernel->memcache->set(md5($query), serialize($ser));
            }
        }
        else
        {
            $this->memcacheStore = '';
            if(!$this->mysqli)
            {
                $result = mysql_query($query, $this->connection);
            }
            else
            {
                $result = mysqli_query($this->connection, $query);
            }
        }


        if(!$this->mysqli)
        {
             if (!$result)
            {
                $error = 'Could not run query: ' . mysql_error($this->connection).'<br />'.$place;
                $this->error_out($error.$query);
            }
        }
        else
        {
             if (!$result)
            {
                $error = 'Could not run query: ' . mysqli_error($this->connection).'<br />'.$place;
                $this->error_out($error.$query);
            }
        }
        return $result;
    }

    function insert_id($query, $place ='')
    {
        $this->debug_html .= '<tr><td style="font-family: Arial, Helvetica, sans-serif"><font size=2>Query: ['.$this->querycount.'] => $db->insert_id("'.$query.'");</font></td></tr>
';
        $this->queries[$this->querycount] = '\''.$query.'\'';
        $this->querycount++;

        if($query == 'memcache')
        {
            return $this->memcacheStore['insert_id'];
        }

        if(!$this->mysqli)
        {
            $result = mysql_insert_id($this->connection);
            if (!$result and $this->memcacheStore == '')
            {
                $error = 'Could not get insert id: ' . mysql_error($this->connection).'<br />'.$place;
                $this->error_out($error.$query);
            }
        }
        else
        {
            $result = mysqli_insert_id($this->connection);
            if (!$result and $this->memcacheStore == '')
            {
                $error = 'Could not get insert id: ' . mysqli_error($this->connection).'<br />'.$place;
                $this->error_out($error.$query);
            }
        }
        return $result;
    }

    function fetch($result,$type='obj',$place='')
    {
        $fetch = NULL;

        if($result=='memcache')
        {
            return unserialize($this->memcacheStore['fetch']);
        }

        /*
        $hookLoc = 'fetch';
          foreach($this->hooks->$hookLoc as $hook)
        {
            $result = $this->runHook($hookLoc, $hook, $result, $type);
            if(!$result['ret'])
            {
                $this->error_out('Could not run hook "'.$hook.'": ' . $result['errorMsg'].'<br />');
            }
            else
            {
                if($result['force'])
                {
                    return $result['new'];
                }
            }
        }
        */

        if(!$this->mysqli)
        {
            if (strtolower($type) == "num")
            {
                $fetch = mysql_fetch_row($result);
            }
            else if(strtolower($type) == "alpha")
            {
                $fetch = mysql_fetch_assoc($result);
            }
            else if(strtolower($type) == "obj")
            {
                $fetch = mysql_fetch_object($result);
            }
        }
        else
        {
            if (strtolower($type) == "num")
            {
                $fetch = mysqli_fetch_row($result);
            }
            else if(strtolower($type) == "alpha")
            {
                $fetch = mysqli_fetch_assoc($result);
            }
            else if(strtolower($type) == "obj")
            {
                $fetch = mysqli_fetch_object($result);
            }
        }

        return $fetch;
    }

    function num($result)
    {
        $fetch = NULL;
        if($result=='memcache')
        {
            return $this->memcacheStore['num'];
        }

        if(!$this->mysqli)
        {
            $fetch = mysql_num_rows($result);
        }
        else
        {
            $fetch = mysqli_num_rows($result);
        }
        return $fetch;
    }

    function terminate()
    {
        if(!$this->mysqli)
        {
			mysql_free_result($this->connection);
            mysql_close($this->connection);
        }
        else
        {
			mysqli_free_result($this->connection);
            mysqli_close($this->connection);
        }
    }
}
?>