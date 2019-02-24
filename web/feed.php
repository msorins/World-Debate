<?php
ini_set("session.cookie_httponly", 1);
session_start();
require_once("config/db.php");
require_once("config.php"); 
require_once("classes/Login.php");
require_once("libraries/password_compatibility_library.php");
require_once (ROOT."/classes/SecureInput.php");
?>
<!doctype html>
<html class="no-js" lang="en">
<link rel="shortcut icon" href="/img/upload/favicon.ico" />
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feed | World-Debate.net</title>
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
   <div style="margin-top:-4px;" class="section-header"><h3 class="text-center"><span> /   </span> Feed <span> /</span></h3>
   <div style="float:right; margin-top:-45px; height:66px; width:66px; padding-bottom:10px;"><span data-tooltip class="has-tip" title="This is the place where you can see all the activity of the friends you follow."><img style="float:right; margin-top:-7px;" height="66px" width="66px" src="/img/upload/question.jpg"></span>
   </div>
   </div>

	<?php 
	$user_name=$_SESSION["user_name"];
	$query=mysql_query("SELECT * FROM `users` WHERE `user_name`='$user_name'");
	$rez=mysql_fetch_array($query);
	$string=$rez["user_follows"];// pe cine are la follow userul logat
	$n=strlen($string);
	$p=secure($_GET["p"]);
	echo $p;
    $contor=0;
    if($p==0) { $p=1; }
	
	$query2=mysql_query("SELECT * FROM `public_posts` WHERE `post_activate`=1 ORDER BY post_count DESC");
	$total_number=mysql_num_rows($query2);
	while($i=mysql_fetch_array($query2))
   {
		$ok=false;
		//vad daca utilizatorul care a facut postu este in lista de feed a userului logat
		$user_feed=$i["post_owner"]; 
		$query=mysql_query("SELECT * FROM `users` WHERE `user_name`='$user_feed'");
		$rez=mysql_fetch_array($query);
		
		if($i["post_owner"]!=$i["post_target"])
		{
			$user_feed2=$i["post_target"];
			$query3=mysql_query("SELECT * FROM `users` WHERE `user_name`='$user_feed2'");
			$rez2=mysql_fetch_array($query3);
		}
		for($c=3; $c<$n; $c++)
			{
				$nr=0;
				while($string[$c]!='#')
				{
					$nr=$nr*10+ord($string[$c])-48;
					$c++;
				}
				if($nr==$rez["user_id"] || $nr==$rez2["user_id"])
				{
					$contor++;
				}
			    if((($p==1 && $contor<=8) || ($p!=1 && $contor>($p-1)*8 && $contor<=$p*8)) && ($nr==$rez["user_id"] || $nr==$rez2["user_id"]))
				{
					
					?><div style="width:80%; margin-left:10%;" class="large-15 small-12 columns"><?php
					require(ROOT."/views/post.php"); // aici se afla intregul post
					?></div><?php
   }
			}
   }?>
   <ul style="margin-left:4%;" class="pagination large-15 columns">
  <li class="arrow"><a href="/feed/page/<?php if($p>1) echo $p-1; else echo $p;?>">&laquo; Previous</a></li>
  <li class="arrow"><a href="/feed/page/<?php if($contor/8>$p) echo $p+1; else echo $p;?><?php echo $t;?>">Next &raquo;</a></li>
  </ul>
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