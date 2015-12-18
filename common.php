<?php
session_start();

define('COOKIE_EXPIRATION_TIME', 1209600); // constant for cookie expiration time

// require config.php which contains information about the connection to database
require_once("config.php");
if(!defined('DB_HOST')) {
	die("ERROR: config.php not configured.  Please run <a href='install.php'>install</a>.");
}

//connect to database
$con=mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("FATAL ERROR: Unable to connect to MySQL database.");

//select database
mysql_select_db(DB_NAME, $con) or die("FATAL ERROR: Unable to select database " . DB_NAME);

// set the charset to utf8
mysql_set_charset("utf8");
//mb_language('uni');
//mb_internal_encoding('UTF-8');
//mysql_query("SET character_set_results=utf8", $con);
//mysql_query("SET character_set_client=utf8", $con);
//mysql_query("SET character_set_connection=utf8", $con);


//this function sends email with verification code: all variables are assumed to be mysqli_real_escape_string()
function send_verify_email($name, $email, $date){
	$subject="Meal Purchase with ECC";
	$content="Hi ".$name.": \n Thank you for purchasing lunch with ECC! \nPlease make sure to pick it up in GB lobby at noon of ".$date."\n\n\n\nECC Executive Team";
	$header = "From: ECC";
	if (mb_send_mail($email, $subject, $content, $header)){
		return true;
	}else{
		return false;
	}
}



// this function prints the functions for debugging propose
function print_session(){
	global $_SESSION;
	
	foreach ($_SESSION as $key => $value){
		echo $key. " : ".$value;
	}
}


?>