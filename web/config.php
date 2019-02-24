<?
$host = "#"; 
$user = "#"; 
$pass = "#"; 
$db = "#";
// open connection 
$connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!". mysql_error());

// select database 
mysql_select_db($db) or die ("Unable to select database!". mysql_error());
?>
