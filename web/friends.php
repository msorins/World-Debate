<?php
ini_set("session.cookie_httponly", 1);
session_start();
require_once("classes/Login.php");
require_once("libraries/password_compatibility_library.php");
require_once("config/db.php");
require_once("config.php"); 
require_once (ROOT."/classes/SecureInput.php");

?>
<!doctype html>
<html class="no-js" lang="en">
<link rel="shortcut icon" href="/img/upload/favicon.ico" />
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Friends | World-Debate.net</title>
	<meta name="Description" content="World Debate is the best debate platform where you can challenge your friends, choose what you like the most and win points , achievements and a lot more .">
    <link rel="stylesheet" href="/css/foundation.css" />
	<script src="/js/modernizr.js"></script> 
    <script src="/js/vendor/jquery.js"></script>
	<script src="/js/foundation/foundation.js"></script>
	<script src="/js/foundation/foundation.clearing.js"></script>
	<script src="/js/validate.js"></script>
	  <script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-46577566-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	</head>
	<!--/Start async trafic.ro/-->
<script type="text/javascript" id="trfc_trafic_script">
//<![CDATA[
t_rid = 'world-debate-net';
(function(){ t_js_dw_time=new Date().getTime();
t_js_load_src=((document.location.protocol == 'http:')?'http://storage.':'https://secure.')+'trafic.ro/js/trafic.js?tk='+(Math.pow(10,16)*Math.random())+'&t_rid='+t_rid;
if (document.createElement && document.getElementsByTagName && document.insertBefore) {
t_as_js_en=true;var sn = document.createElement('script');sn.type = 'text/javascript';sn.async = true; sn.src = t_js_load_src;
var psn = document.getElementsByTagName('script')[0];psn.parentNode.insertBefore(sn, psn); } else {
document.write(unescape('%3Cscri' + 'pt type="text/javascript" '+'src="'+t_js_load_src+';"%3E%3C/sc' + 'ript%3E')); }})();
//]]>
</script>
<noscript><p><a href="http://www.trafic.ro/statistici/world-debate.net"><img alt="world-debate.net" src="http://log.trafic.ro/cgi-bin/pl.dll?rid=world-debate-net" /></a> <a href="http://www.trafic.ro/">Web analytics</a></p></noscript>
<!--/End async trafic.ro/-->
   <body style="background-color: #085a78;">
   <?php include 'views/header.php'; ?>
   <div style="background-color:white; margin-top:15px;" class="row">
   <div style="margin-top:-4px;" class="section-header"><h3 class="text-center"><span> /   </span> Friends<span> /</span></h3>
   <div style="float:right; margin-top:-45px; height:66px; width:66px; padding-bottom:10px;"><span data-tooltip class="has-tip" title="This is the place where you can see all the list of the friends you follow."><img style="float:right; margin-top:-7px;" height="66px" width="66px" src="/img/upload/question.jpg"></span>
   </div>
   </div>

	<?php 
	$user_name=$_SESSION["user_name"];
	$query=mysql_query("SELECT * FROM `users` WHERE `user_name`='$user_name'");
	$rez=mysql_fetch_array($query);
	$string=$rez["user_follows"];// pe cine are la follow userul logat
	$n=strlen($string);
	$p=secure($_GET["p"]);
    $contor=0;
    if($p==0) { $p=1; }
	$total_number=mysql_num_rows($query);
	for($c=3; $c<$n; $c++)
			{
				$nr=0;
				if($string[$c]!='#')
				{
				$contor++;
				while($string[$c]!='#')
					{
						$nr=$nr*10+ord($string[$c])-48;
						$c++;
					}
				$query2=mysql_query("SELECT * FROM `users` WHERE `user_id`='$nr'");
				$i=mysql_fetch_array($query2);
				if(($p==1 && $contor<=8) || ($p!=1 && $contor>($p-1)*8 && $contor<=$p*8))
				{
				?>
				
				<div style="margin-top:10px; width:92%; margin-left:4%; height:auto; min-height:220px;  word-wrap: break-word;" class="panel">
	 <div class="row">
	<div class="large-3 columns">
	<a class="th" href="/<?php echo $i["user_name"];?>">
	<img style="height:189px; width:189px;"src="/img/users/<?if ($i["user_avatar"]!=NULL ) echo $i["user_avatar"]; else echo "no-image.jpg";?>">
	</a>
    </div>
    <div class="large-6 columns">
      <h3 style="word-wrap: break-word; width:100%;" class="left large-2 medium-2 small-2 columns"><a href="<?php echo $i["user_name"];?> 
	  "><?php if($i["user_publicname"]!=NULL) echo $i["user_publicname"]; else echo $i["user_name"];?></a><br><p style="margin-top:5px; color:#A4A4A4; font-size:15px;" ><i><?php echo $i["user_description"]; ?></i></p><font size="3.7px"><a href="<?php echo $i["user_facebook"]; ?>"><?php echo $i["user_facebook"]; ?></a></font><br><a href="/classes/follow.php?tofollow=<?php echo $i["user_id"];?>&from=followers" style="margin-top:20px;" class="medium alert button round small">
	  <!-- Follow sau UnFollow -->
	  <?php
			$user_current_name=$_SESSION['user_name'];
			if($user_current_name==NULL || $user_current_name==secure($_GET['user']))
				echo "Follow";
			else
			{
			$result_follow=mysql_query("SELECT * FROM `users` WHERE user_name LIKE '$user_current_name'");
			$result_i=mysql_fetch_array($result_follow);
			$result_string=$result_i["user_follows"];
			if(strpos($result_string, "#".$i["user_id"]."#")==0)
			   echo "Follow";
			else
			   echo "UnFollow";
			
			}
		?>
	   </a></h3>
    </div>
    <div class="large-3  columns">
    <p class="text-center"><img style="margin-top:-17px;" height="60px;" width="60px;" src="/img/upload/stats.png"></p>
	  <h6 style="margin-top:-15px;"> Succes rate: <br><?php echo $i["user_good_votes"]." out of ".$i["user_total_votes"]." debates"?>  </h6>
	<div class="progress">
    <span style="width: <?php echo ($i["user_good_votes"]/$i["user_total_votes"])*100; ?>%" class="meter"></span>
    </div> 
	  <h6> Debate points : <?php echo $i["user_points"]; ?></h6>
	  <h6> Followers : <?php  echo $i["user_number_followers"];?></h6>
	  <a href="#" class="button tiny" data-dropdown="drop2"><span style="font-size:17px">Achivements »</span></a>
	  <div  id="drop2" data-dropdown-content class="f-dropdown content">
	 <div class="row">
	 <?php $ok=false; ?>
	 <?php if(strpos($i["user_achievements"], "#1#")!=0) {  $ok=true;?>
    <div class="small-6 large-6 columns"><a class="th" href="/<?php echo $i["user_name"]; ?>">
				<img id="theImage1" src="/img/upload/1.png"></a>
	</div>
	<?php } ?>
	<?php if(strpos($i["user_achievements"], "#2#")!=0) { $ok=true; ?>
  <div class="small-6 large-6 columns"><a class="th" href="#">
				<img id="theImage2" src="/img/upload/2.png"></a>
	</div>
	<?php } ?>
	<?php if(strpos($i["user_achievements"], "#3#")!=0) { $ok=true; ?>
	 <div style="margin-top:20px;" class="small-6 large-6 columns"><a class="th" href="#">
				<img id="theImage3" src="/img/upload/3.png"></a>
	</div>
	<?php } ?>
	<?php if(strpos($i["user_achievements"], "#4#")!=0) { $ok=true;  ?>
  <div style="margin-top:20px;" class="small-6 large-6 columns"><a class="th" href="#">
				<img id="theImage4" src="/img/upload/4.png"></a>
	</div>
	<?php } ?>
	<?php if(strpos($i["user_achievements"], "#5#")!=0) { $ok=true;  ?>
  <div style="margin-top:20px;" class="small-6 large-6 columns"><a class="th" href="#">
				<img id="theImage5" src="/img/upload/5.png"></a>
	</div>
	<?php }
	if($ok==false)
	{ ?> <h5>You don't have any achievements </h5> <?php } ?>
	<script>
	document.getElementById('theImage1').title='Win one competitive debate';
	document.getElementById('theImage2').title='Lose one competitive debate';
	document.getElementById('theImage3').title='Get 100 debate points';
	document.getElementById('theImage4').title='Win 70 competitive debates';
	document.getElementById('theImage5').title='Get 100 followers';
	</script>
	<div style="height:3px; clear:both;"></div>
	<hr>
	<a href="/achievements.php"><span style="font-size:12px; float:right;">All available achievements »</span></a> 
</div>
	</div>
	  </div></div></div>
				
				<?php
				}
				}
				
			}
		if($user_name==NULL)
		{
		?> <h4 style="margin-left:5%"> You have to be logged in in order to acces this page </h4> <?php 
		}
		else
		{
			if($contor==0)
			 {
			 ?> <h4 style="margin-left:5%" > You have to follow someone first </h4> <?php
			 }
			 else
			 {
			  ?>	 <ul style="margin-left:4%;" class="pagination large-15 columns">
  <li class="arrow"><a href="/followers.php?p=<?php if($p>1) echo $p-1; else echo $p;?>">&laquo; Previous</a></li>
  <li class="arrow "><a href="/followers.php?p=<?php if($contor/8>$p) echo $p+1; else echo $p;?><?php echo $t;?>">Next &raquo;</a></li>
  </ul>		<?php 
			 }
		}
			
   ?>

  </div>
	
  <?php 
  // Footer
  include 'views/footer.php'; ?>
  <!-- End Footer -->
  <script>
  document.write('<script src=js/vendor/' +
  ('__proto__' in {} ? 'zepto' : 'jquery') +
  '.js><\/script>')
  </script>
  <script src="/js/foundation.min.js"></script>
  <script>
    $(document).foundation();
  </script>
   </body>
</html>