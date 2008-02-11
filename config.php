<?PHP
// XtraUpload  |  1.5.0
// http://XtraFile.com/forums
// This file is (C) XtraFile.com
// All Rights Reserved Unless Explictly Noted.
/////////////////////////////
################
@session_start();
################
$dbServer = "localhost"; // mysql host
$dbUser = "root"; // mysql username
$dbPass = ""; //mysql password
$dbName = "xu"; //mysql database
$serverurl = "http://localhost/xu"; // URL to compare to for Progress bar
$use_mysqli = false; // Use MySQLi - Only recomended for large sites(over 4 servers or over unique 5000 hits a day)
?>