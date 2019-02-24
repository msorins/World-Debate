<? ob_start(); ?>
<?php
session_start();
require "../config/db.php";
require ROOT."/config.php";
require ROOT."/classes/SecureInput.php";

//variable
$file_sent=true;
$user_publicname=$_POST["user_publicname"]; $user_publicname=secure($user_publicname);
$user_facebook=$_POST["user_facebook"]; $user_facebook=secure($user_facebook);
$user_description=$_POST["user_description"]; $user_description=secure($user_description);
$user_name=$_SESSION['user_name'];
$result=mysql_query("SELECT * FROM `users` WHERE user_name LIKE '$user_name'");
$i=mysql_fetch_array($result);
$user_id=$i["user_id"];

//image upload
$file_name=$user_id.$_FILES["file"]["type"];
$file_name=str_replace("image/", ".", $file_name);


$allowedExts = array("gif", "jpeg", "jpg", "png", "bmp");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/bmp")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"]/1024 < 1000 )
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      ROOT."/img/users/" . $file_name);
      echo ROOT."/img/users" . $file_name;
      }
    }
	$file = ROOT.'/img/users/'.$file_name;
	$finfo = new finfo();
	$fileinfo = $finfo->file($file, FILEINFO_MIME);
	echo "tip :".$fileinfo." lala";
  }
else
  {
  echo "Invalid file";
  $file_sent=false;
  }
  
  
//background upload
$profile_img=$user_id.$_FILES["profile-image"]["type"];
$profile_img=str_replace("image/", ".", $profile_img);
$profile_sent=true;

$allowedExts = array("gif", "jpeg", "jpg", "png", "bmp");
$temp = explode(".", $_FILES["profile-image"]["name"]);
$extension = end($temp);

if ((($_FILES["profile-image"]["type"] == "image/gif")
|| ($_FILES["profile-image"]["type"] == "image/jpeg")
|| ($_FILES["profile-image"]["type"] == "image/jpg")
|| ($_FILES["profile-image"]["type"] == "image/pjpeg")
|| ($_FILES["profile-image"]["type"] == "image/x-png")
|| ($_FILES["profile-image"]["type"] == "image/bmp")
|| ($_FILES["profile-image"]["type"] == "image/png"))
&& ($_FILES["profile-image"]["size"]/1024 < 1000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["profile-image"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["profile-image"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["profile-image"]["name"] . "<br>";
    echo "Type: " . $_FILES["profile-image"]["type"] . "<br>";
    echo "Size: " . ($_FILES["profile-image"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["profile-image"]["tmp_name"] . "<br>";
     move_uploaded_file($_FILES["profile-image"]["tmp_name"],
     ROOT."/img/users-backgrounds/" . $profile_img);
    }
  }
else
  {
  echo "Invalid file";
  $profile_sent=false;
  }
// other info
if($user_publicname!=NULL)
	$result=mysql_query("UPDATE  `users` SET  `user_publicname` =  '$user_publicname' WHERE  user_id LIKE '$user_id'");
if($user_facebook!=NULL)
	$result=mysql_query("UPDATE  `users` SET  `user_facebook` =  '$user_facebook' WHERE  user_id LIKE '$user_id'");
if($user_description!=NULL)
	$result=mysql_query("UPDATE  `users` SET   `user_description` =  '$user_description' WHERE  user_id LIKE '$user_id'");
if($file_sent==true)
	$result=mysql_query("UPDATE  `users` SET   `user_avatar` =  '$file_name' WHERE  user_id LIKE '$user_id'");
if($profile_sent==true)
	$result=mysql_query("UPDATE  `users` SET   `user_background` =  '$profile_img' WHERE  user_id LIKE '$user_id'");
session_start();
$_SESSION["profile-upload"]=1;
header( 'Location: /profile.php?type=edit' );
?>
<? ob_flush(); ?>