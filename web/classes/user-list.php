<?php
require "../config/db.php";
require ROOT."/config.php";
require ROOT."/classes/SecureInput.php";

$req=mysql_query("SELECT * FROM `users` WHERE `user_name` LIKE  '%" . secure($_GET['term']) . "%'  ");
$c=0;
while($row = mysql_fetch_array($req))
{
	$c++;
	$results[] = array('label' => $row['user_name']);
	if($c>15)
		{
			$results[] = array('label' => "..");
			break;
		}
}

echo json_encode($results);
?>