<? ob_start(); ?>
<?php
session_start();
require "../config/db.php";
require ROOT."/config.php";
require ROOT."/classes/SecureInput.php";

$user_name=$_SESSION['user_name'];
if($user_name!=NULL)
{
$result=mysql_query("UPDATE `users`  SET `user_background`='' WHERE user_name LIKE '$user_name'");
}
header( 'Location: /profile/edit');
?>
<? ob_flush(); ?>