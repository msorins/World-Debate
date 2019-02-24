<?php
header('content-type: application/json; charset=utf-8'); 
require "../config/db.php";
require ROOT."/config.php";
require ROOT."/classes/SecureInput.php";
$user = secure($_POST['post_target']);
$title = secure($_POST['post_title']);

if($user==NULL && $title==NULL)
{
  echo "false";
}
else
{
if($user!=NULL)
{
	$query=mysql_query("SELECT * FROM `users` WHERE `user_name`='$user'"); $count=0;
	while($k=mysql_fetch_array($query))
	{
		$count++;
	}
	if($count>0)
		echo "true";
	else
		echo "false";
}
if($title!=NULL)
{
	$query=mysql_query("SELECT * FROM `public_posts` WHERE `post_title`='$title'"); $count=0;
	while($k=mysql_fetch_array($query))
	{
		$count++;
	}
	if($count==0)
		echo "true";
	else
		echo "false";

}
}
?>