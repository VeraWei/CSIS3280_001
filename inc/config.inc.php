<?php
define("DB_HOST", "127.0.0.1");
define("DB_NAME", "FP_yanyi");
define("DB_USER","root");
define("DB_PASS","");
define("DB_PORT",3306);

// Set the error log things!
define('LOGFILE','../log/error_log.txt');
ini_set("log_errors", 1);  
ini_set('error_log', LOGFILE); 

?>