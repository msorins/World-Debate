<? ob_start(); ?>
<?php
session_start();
require "../config/db.php";
require ROOT."/config.php";
require ROOT."/classes/SecureInput.php";

$choice=secure($_POST["vote"]);
$post_id=secure($_GET["postid"]);
$post_name=secure($_GET["post_name"]);
$user_name=$_SESSION['user_name'];
if($user_name!=NULL)
{
$result=mysql_query("SELECT * FROM `users` WHERE user_name LIKE '$user_name'");
if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}
$i=mysql_fetch_array($result);
$string = $i["user_voted"];
$user_id=$i["user_id"].'#';
$findme   ="#".$post_id."#";
echo strpos($string, $findme);
echo "find :".$findme."==string : ".$string;
if(strpos($string, $findme)==0)
{
	if($choice==1)
	{
	
	 echo "votat1";
	 mysql_query("UPDATE  `admin_world-debate`.`public_posts` SET post_likes1=post_likes1+1, post_who_voted1 = CONCAT(post_who_voted1,'$user_id') WHERE  `public_posts`.`post_count` ='$post_id'") or die(mysql_error());
	}
	else
	{
	echo "votat2";
	mysql_query("UPDATE  `admin_world-debate`.`public_posts` SET post_likes2=post_likes2+1, post_who_voted2 = CONCAT(post_who_voted2,'$user_id') WHERE  `public_posts`.`post_count` ='$post_id'") or die(mysql_error());
	}
	$string=$string.$post_id."#";
	mysql_query("UPDATE  `admin_world-debate`.`users` SET  user_voted='$string' WHERE  `users`.`user_name` ='$user_name'") or die(mysql_error());
	
	$_SESSION["vote"]="1";
}
else
{
 $_SESSION["vote"]="2";
}
}
header( 'Location: /view.php?type=public&name='.$post_name);
?>
<? ob_flush(); ?>