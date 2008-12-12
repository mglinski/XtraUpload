<?php

/*
|--------------------------------------------------------------
| CI CRON JOB BOOTSTRAPPER
|--------------------------------------------------------------
|
| This section is used to get a cron job going, using standard
| CodeIgniter controllers and functions.
|
| 1) Set the CRON_CI_INDEX constant to the location of your
|    CodeIgniter index.php file
| 2) Make this file executable (chmod a+x cron.php)
| 3) You can then use this file to call any controller function:
|    ./cron.php --run=/controller/method [--show-output] [--log-file=logfile] [--time-limit=N] 
|
|----------------------------------------------------
| Edited by Matthew for use in XU2, 8/16/08
|
*/

    define('CRON_CI_INDEX', './index.php');   // Your CodeIgniter main index.php file
    define('IN_CRON', TRUE);   // Test for this in your controllers if you only want them accessible via cron
	define('RON_FLUSH_BUFFERS', TRUE);

# Parse the command line
	$value = '/cron';
	
    $_SERVER['PATH_INFO'] = $value;
    $_SERVER['REQUEST_URI'] = $value;
    $required['--run'] = TRUE;

    //if(!defined('CRON_LOG')) define('CRON_LOG', 'cron.log');
    //if(!defined('CRON_TIME_LIMIT')) define('CRON_TIME_LIMIT', 0);

    foreach($required as $arg => $present)
    {
        if(!$present) die($usage);
    }



# Set run time limit
    //set_time_limit(CRON_TIME_LIMIT);


# Run CI and capture the output

chdir(dirname(CRON_CI_INDEX));
require(CRON_CI_INDEX);           // Main CI index.php file
echo "\n\n";

?>
