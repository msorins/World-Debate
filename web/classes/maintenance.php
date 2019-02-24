<? ob_start(); ?>
<?php
session_start();
require "../config/db.php";
require ROOT."/config.php";
require ROOT."/classes/SecureInput.php";
$today_date = date("Y-m-d");
$result=mysql_query("SELECT * FROM public_posts WHERE `post_is_expired`=2 AND `post_activate`=1") or die(mysql_error());
while($i=mysql_fetch_array($result))
{
	$expire_date=$i["post_expire"];
	if($today_date>$expire_date)// ma leg de posturile expirate
		{
			echo $today_date." Expire date: ".$expire_date." Post count: ".$i["post_count"]."   -----------------------------------------    ";
			$post_count=$i["post_count"];
			$post_owner=$i["post_owner"];
			$post_target=$i["post_target"];
			$post_title=$i["post_title"];
			$message="Received 10 Debate Points ";
			if($i["post_likes1"]>$i["post_likes2"])
			{
				$string_winner=$i["post_who_voted1"];
				$string1_loser=$i["post_who_voted2"];
				$winner=1;
				$post_winner=$i["post_owner"];
				$post_looser=$i["post_target"];
			}
			if($i["post_likes2"]>$i["post_likes1"])
			{
				$string_winner=$i["post_who_voted2"];
				$string1_loser=$i["post_who_voted1"];
				$winner=2;
				$post_winner=$i["post_target"];
				$post_looser=$i["post_owner"];
			}
			if($i["post_type"]=="competitive")//Atribuie puncte la unul dintre cei 2 castigatori
			{ 
			// puncte si statistici pt castigatorul debate-ului la competitive 
			mysql_query("UPDATE  `admin_world-debate`.`users` SET  user_points=user_points+10,
			user_total_votes=user_total_votes+1,
			user_good_votes=user_good_votes+1
			WHERE  `user_name` ='$post_winner'") or die (mysql_error());
			
			mysql_query("INSERT INTO  `admin_world-debate`.`logs` (`logs_date`,`logs_user_name` , `logs_message` , `logs_post_name` , `logs_post_count`)
				VALUES (
				'$today_date','$post_winner',  '$message',  '$post_title',  '$post_count')") or die (mysql_error());
				
			//statistici pt pierzator
			mysql_query("UPDATE  `admin_world-debate`.`users` SET user_total_votes=user_total_votes+1
			WHERE  `user_name` ='$post_looser'") or die (mysql_error());
			}
			
			$message="Received 3 Debate Points ";
			
			//inchid postul
			mysql_query("UPDATE  `admin_world-debate`.`public_posts` SET  post_is_expired=1, post_competitive=2, post_winner='$winner' WHERE  `post_count` ='$post_count'");
				
			$n=strlen($string_winner);
			echo "winneri :".$string_winner;
			for($c=2; $c<$n; $c++)// for-ul pentru winneri
			{
				if($string_winner[$c]!='#')
				{
					$nr=0;
					while($string_winner[$c]!='#')
					{
						$nr=$nr*10+ord($string_winner[$c])-48;
						$c++;
					}
					echo "nr :".$nr;
					if($i["post_type"]!="practice")
					{
					mysql_query("UPDATE  `admin_world-debate`.`users` SET user_points=user_points+3 WHERE  `user_id` ='$nr'") or die (mysql_error());
					
					//iau numele userului
					$rez=mysql_query("SELECT * FROM `users` WHERE `user_id`='$nr'") or die(mysql_error());
					$hh=mysql_fetch_array($rez);
					$user_name=$hh["user_name"];
					echo "user  :".$user_name;
					//adaug in loguri
					mysql_query("INSERT INTO  `admin_world-debate`.`logs` (`logs_date`, `logs_user_name` , `logs_message` , `logs_post_name` , `logs_post_count`)
					VALUES (
					'$today_date','$user_name',  '$message',  '$post_title',  '$post_count')") or die (mysql_error());
					}
				}
			}
		}
}
//mentananta achivuri user
$result=mysql_query("SELECT * FROM users") or die(mysql_error());
while($i=mysql_fetch_array($result))
{
	$string=$i["user_achievements"];
	$user_id=$i["user_id"];
	$user_name=$i["user_name"];
	$contor=0;
	if($i["user_good_votes"]>0 && strpos($string, "#1#")==0)//Achiv Nr 1, un debate castigat
	{
		$string=$string."1#";
		mysql_query("UPDATE  `admin_world-debate`.`users` SET  user_achievements='$string' WHERE  `users`.`user_id` ='$user_id'") or die(mysql_error());
		echo "Achiv 1 primit userul cu id : ".$user_id."--------------------------------------------------";
		$contor++;
				
	}
	if($i["user_total_votes"]>$i["user_good_votes"] && strpos($string, "#2#")==0)//Achiv Nr 2, un debate pierdut
	{
		$string=$string."2#";
		mysql_query("UPDATE  `admin_world-debate`.`users` SET  user_achievements='$string' WHERE  `users`.`user_id` ='$user_id'") or die(mysql_error());
		echo "Achiv 2 primit userul cu id : ".$user_id."--------------------------------------------------";
		$contor++;
	}
	if($i["user_points"]>100 && strpos($string, "#3#")==0)//Achiv Nr 3, 100 debate points
	{
		$string=$string."3#";
		mysql_query("UPDATE  `admin_world-debate`.`users` SET  user_achievements='$string' WHERE  `users`.`user_id` ='$user_id'") or die(mysql_error());
		echo "Achiv 3 primit userul cu id : ".$user_id."--------------------------------------------------";
		$contor++;
	}
	if($i["user_good_votes"]>50 && strpos($string, "#4#")==0)//Achiv Nr 4, Min 70 debate-uri facute corect
	{
		$string=$string."4#";
		mysql_query("UPDATE  `admin_world-debate`.`users` SET  user_achievements='$string' WHERE  `users`.`user_id` ='$user_id'") or die(mysql_error());
		echo "Achiv 4 primit userul cu id : ".$user_id."--------------------------------------------------";
		$contor++;
	}
	if($i["user_number_followers"]>100 && strpos($string, "#5#")==0)//Achiv Nr 4, Min 70 debate-uri facute corect
	{
		$string=$string."5#";
		mysql_query("UPDATE  `admin_world-debate`.`users` SET  user_achievements='$string' WHERE  `users`.`user_id` ='$user_id'") or die(mysql_error());
		echo "Achiv 5 primit userul cu id : ".$user_id."--------------------------------------------------";
		$contor++;
	}
	if($contor!=0)
	{
		$message="You gained ".$contor." achievement";
		if($contor>1)
			$message=$message."s";
		mysql_query("INSERT INTO  `admin_world-debate`.`logs` (`logs_date`, `logs_user_name` , `logs_message` , `logs_post_name` , `logs_post_count`)
					VALUES (
					'$today_date','$user_name',  '$message',  '$post_title',  '$post_count')") or die (mysql_error());		
	}
}
echo "-------------------------MAINTENANCED FINISHED ------------------------------";
?>
<? ob_flush(); ?>