<? ob_start(); ?>
<?php
session_start();
require "../config/db.php";
require ROOT."/config.php";
require ROOT."/classes/SecureInput.php";

// atribui informatiile din post
$post_type=secure($_GET["type"]);
$post_count=secure($_GET['count']);
$post_with=secure($_GET['with']);
$post_title=$_POST["post_title"]; $post_title=secure($post_title);
$post_category=$_POST["post_category"]; $post_category=secure($post_category);
$post_description1=$_POST["post_description1"]; $post_description1=secure($post_description1);
$post_description2=$_POST["post_description2"]; $post_description2=secure($post_description2);
$post_video1=secure($_POST["video1"]);
$post_video2=secure($_POST["video2"]);
$post_expire=$_POST["post_expire"]; $post_expire=secure($post_expire);
$post_anonymus=$_POST["post_anonymus"]; $post_anonymus=secure($post_anonymus);
$user_name=$_SESSION['user_name'];
$post_target=secure($_POST['post_target']);
$post_delete=secure($_GET['delete']);
$ok_img1=true; $ok_img2=true; // presupun ca ambele poze se uploadeaza
//daca postul e received iau anumite informatii din db
if($post_with=="videos")
{
preg_match(
        '/[\\?\\&]v=([^\\?\\&]+)/',
        $post_video1,
        $matches1
    );
$post_video1="http://www.youtube.com/embed/".$matches1[1];

preg_match(
        '/[\\?\\&]v=([^\\?\\&]+)/',
        $post_video2,
        $matches2
    );
$post_video2="http://www.youtube.com/embed/".$matches2[1];
}
if($post_type=="received")
{
$result=mysql_query("SELECT * FROM `public_posts` WHERE `post_count`='$post_count'");
$i=mysql_fetch_array($result);
$post_title=$i["post_title"];
$post_expire=$i["post_expire"];
$post_target=$i["post_target"];
}
$post_title=trim($post_title);
// setez data de expirare in functie de optiune
if($post_type=="solo" || $post_type=="received")
{
if($post_expire==1)
	$date = date('Y-m-d', strtotime('+1 days'));
if($post_expire==3)
	$date = date('Y-m-d', strtotime('+3 days'));
if($post_expire==7)
	$date = date('Y-m-d', strtotime('+7 days'));
if($post_expire==31)
	$date = date('Y-m-d', strtotime('+31 days'));
}
else
{
$date=$post_expire;
}


$image1=$post_title.$_FILES["image1"]["type"];
$image1=str_replace("image/", "1.", $image1);

$image2=$post_title.$_FILES["image2"]["type"];
$image2=str_replace("image/", "2.", $image2);

if($post_type=="competitive" || $post_type=="practice") // trimit userului cu pricina o notificare
{
	$post_activate=2;
	$image2=NULL;
}
else
{
	$post_activate=1;
}
if($post_type=="competitive" || $post_type=="solo")
	$post_competitive=1;
else
	$post_competitive=2;

if($post_with!="videos")
{
if($post_type!="received")
{
// image1 upload
$allowedExts = array("gif", "jpeg", "jpg", "png", "bmp");
$temp = explode(".", $_FILES["image1"]["name"]);
$extension = end($temp);
if ((($_FILES["image1"]["type"] == "image/gif")
|| ($_FILES["image1"]["type"] == "image/jpeg")
|| ($_FILES["image1"]["type"] == "image/jpg")
|| ($_FILES["image1"]["type"] == "image/pjpeg")
|| ($_FILES["image1"]["type"] == "image/x-png")
|| ($_FILES["image1"]["type"] == "image/bmp")
|| ($_FILES["image1"]["type"] == "image/png")
|| ($_FILES["image1"]["type"] == "image/png"))
&& ($_FILES["image1"]["size"]/1024 < 1000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["image1"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["image1"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["image1"]["name"] . "<br>";
    echo "Type: " . $_FILES["image1"]["type"] . "<br>";
    echo "Size: " . ($_FILES["image1"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["image1"]["tmp_name"] . "<br>";

    if (file_exists("upload/" . $_FILES["image1"]["name"]))
      {
      echo $_FILES["image1"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["image1"]["tmp_name"],
      ROOT."/img/public_posts/" . $image1);
      echo ROOT."/img/public_posts" . $image1;
      }
    }
  }
else
{
  $ok_img1=false;
}
}
if($post_type!="competitive")
{
//image 2 upload
$allowedExts = array("gif", "jpeg", "jpg", "png", "bmp");
$temp = explode(".", $_FILES["image2"]["name"]);
$extension = end($temp);
if ((($_FILES["image2"]["type"] == "image/gif")
|| ($_FILES["image2"]["type"] == "image/jpeg")
|| ($_FILES["image2"]["type"] == "image/jpg")
|| ($_FILES["image2"]["type"] == "image/pjpeg")
|| ($_FILES["image2"]["type"] == "image/x-png")
|| ($_FILES["image2"]["type"] == "image/bmp")
|| ($_FILES["image2"]["type"] == "image/png"))
&& ($_FILES["image2"]["size"]/1024 < 1000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["image2"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["image2"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["image2"]["name"] . "<br>";
    echo "Type: " . $_FILES["image2"]["type"] . "<br>";
    echo "Size: " . ($_FILES["image2"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["image2"]["tmp_name"] . "<br>";

    if (file_exists("upload/" . $_FILES["image2"]["name"]))
      {
      echo $_FILES["image2"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["image2"]["tmp_name"],
      ROOT."/img/public_posts/" . $image2);
      echo ROOT."/img/public_posts" . $image2;
      }
    }
  }
else
{
  $ok_img2=false;
}
}
}
if($post_type!="received") //daca acum face postu
{
if(($ok_img1==true && $ok_img2==true && $post_type=="solo") || ($ok_img1==true  && $post_type=="practice") || ($ok_img1==true  && $post_type=="competitive"))
{
if($post_type!="solo")
{
mysql_query("UPDATE  `admin_world-debate`.`users` SET  user_notifications=user_notifications+1 WHERE  `user_name` ='$post_target'") or die(mysql_error());
}
mysql_query("INSERT INTO `admin_world-debate`.`public_posts` (`post_count`, `post_owner`, `post_title`, `post_category`, `post_description1`, `post_description2`, `post_image1`, `post_image2`, `post_video1`, `post_video2`, `post_competitive`, `post_expire`, `post_anonymus`, `post_type`, `post_target`, `post_activate`, `post_with`) VALUES (NULL, '$user_name', '$post_title', '$post_category', '$post_description1', '$post_description2', '$image1', '$image2', '$post_video1', '$post_video2','$post_competitive', '$date', '$post_anonymus', '$post_type', '$post_target', '$post_activate', '$post_with')") or die(mysql_error());
if($post_type!="received")
	$_SESSION["post_done"]=1;
}
else
{
$_SESSION["post_image_upload"]=1;
}

if($post_type=="competitive")
	header( 'Location: /make.php?type=competitive' );
if($post_type=="solo")
	header( 'Location: /make.php?type=solo' );
if($post_type=="practice")
	header( 'Location: /make.php?type=practice' );

}
else // daca raspunde la un post deja facut
{
mysql_query("UPDATE  `admin_world-debate`.`users` SET  user_notifications=user_notifications-1 WHERE  `user_name` ='$post_target'");
	if($post_delete==1)
	{
		mysql_query( "DELETE FROM `admin_world-debate`.`public_posts` WHERE `public_posts`.`post_count` = '$post_count'");
	}
	else
	{
		if($ok_img2==true)
		{
		mysql_query("UPDATE  `admin_world-debate`.`public_posts` SET  `post_description2` =  '$post_description2',
		`post_image2` =  '$image2',
		`post_video2` = '$post_video2',
		`post_expire` =  '$date',
		`post_activate` =  '1' WHERE  `public_posts`.`post_count` ='$post_count'") or die(mysql_error());
		//$_SESSION["post_done"]=0;
		}
		else
		{
		$_SESSION["post_image_upload"]=1;
		}
	}
	header( 'Location: /profile.php?type=received' );
}
?>
<? ob_flush(); ?>