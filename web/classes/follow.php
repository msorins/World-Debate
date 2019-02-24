<? ob_start(); ?>
<?php
session_start();
require "../config/db.php";
require ROOT."/config.php";
require ROOT."/classes/SecureInput.php";

$user_name=$_SESSION['user_name']; // numele userului logat
$to_follow=secure($_GET["tofollow"]); // id-ul celui care vrea sa il adauge la follow
$from_user=secure($_GET["from"]); // numele userului de unde vine cererea
if($user_name!=NULL && $user_name!=$from_user)
{
$result=mysql_query("SELECT * FROM `users` WHERE user_name LIKE '$user_name'");
$i=mysql_fetch_array($result);
$string = $i["user_follows"];
$user_id=$i["user_id"]; //id-ul userului logat pt query
$findme   ="#".$to_follow."#";
if(strpos($string, $findme)==0) // nu il are la follow
{
	$concat_string =$to_follow."#";
	mysql_query("UPDATE  `admin_world-debate`.`users` SET user_follows= CONCAT(user_follows,'$concat_string') WHERE  `user_id` ='$user_id'");
	mysql_query("UPDATE  `admin_world-debate`.`users` SET user_number_followers= user_number_followers+1 WHERE  `user_id` ='$to_follow'") or die(mysql_error());
}
else // il are la follow
{
	$string=str_replace($findme,"#",$string);
	mysql_query("UPDATE  `admin_world-debate`.`users` SET user_follows='$string' WHERE  `user_id` ='$user_id'");
	mysql_query("UPDATE  `admin_world-debate`.`users` SET user_number_followers= user_number_followers-1 WHERE  `user_id` ='$to_follow'") or die(mysql_error());
}
}
if($from_user!="followers")
header( 'Location: /'.$from_user);
else
header( 'Location: /friends.php');

?>
<? ob_flush(); ?>