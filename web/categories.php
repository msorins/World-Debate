<?php
require_once("classes/Login.php");
require_once("libraries/password_compatibility_library.php");
require_once("config/db.php");
require ROOT."/classes/SecureInput.php";
?>
<!doctype html>
<html class="no-js" lang="en">
<link rel="shortcut icon" href="/img/upload/favicon.ico" />
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo secure($_GET["cat"]);?> Category | World-Debate</title>
	<meta name="Description" content="World Debate is the best debate platform where you can challenge your friends, choose what you like the most and win points , achievements and a lot more .">
    <link rel="stylesheet" href="/css/foundation.css" />
	<script src="/js/modernizr.js"></script> 
    <script src="/js/vendor/jquery.js"></script>
    <script src="/js/foundation/foundation.js"></script>
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
   <?php include ROOT.'/views/header.php';
	require ROOT."/config.php";
   ?>
   <div style="background-color:white; margin-top:15px;" class="row">
   <div style="margin-top:-4px;" class="section-header">
   <h3 id="orientation-detection">Selected category: <i><?php echo secure($_GET["cat"]);?></i>
 
		
	  <div style="float:right;">
	  <input <?php if(secure($_GET["t"])==1) echo "checked"; ?> onChange="location.href='/category/<?php echo secure($_GET["cat"]);?>/'+this.value+''" type="radio" name="post_anonymus" value="1" id="pokemonRed1"><label for="pokemonRed1"><h3 style="font-size:17px;">Yes</h3></label>
      <input <?php if(secure($_GET["t"])!=1) echo "checked"; ?> onChange="location.href='/category/<?php echo secure($_GET["cat"]);?>/'+this.value+''" type="radio" name="post_anonymus" value="2" id="pokemonRed1"><label for="pokemonRed1"><h3 style="font-size:17px;">No</h3></label>
      </div>
	  <div style="float:right;">
	  <h3 style="font-size:17px; margin-right:10px;"> Just active debates?  </h3>
	  </div>
   </h3>
   </div>
   <?php
   $cat=secure($_GET["cat"]);
   $p=secure($_GET["p"]);
   $t=secure($_GET["t"]);
   $contor=0;
   if($p==0)
	$p=1;
   if($t!=1)
   {
	  if($cat!="all")
	  {
		$query=mysql_query("SELECT * FROM `public_posts` WHERE post_category LIKE '$cat'  AND `post_activate`=1 ORDER BY post_count DESC");
	  }
	  if($cat=="all")
	  {
		$query=mysql_query("SELECT * FROM `public_posts` WHERE `post_activate`=1 ORDER BY post_count DESC");
	  }
   }
   else
   {
    if($cat!="all")
	{
    $query=mysql_query("SELECT * FROM `public_posts` WHERE post_category LIKE '$cat'  AND `post_activate`=1 AND `post_competitive`=1 ORDER BY post_count DESC");
	}
	if($cat=="all")
	  {
		$query=mysql_query("SELECT * FROM `public_posts` WHERE `post_activate`=1 AND `post_competitive`=1 ORDER BY post_count DESC");
	  }
   }
   $total_number=mysql_num_rows($query);
   while($i=mysql_fetch_array($query))
   {
   $contor++;
   if(($p==1 && $contor<=12) || ($p!=1 && $contor>($p-1)*12 && $contor<=$p*12))
   {
    ?><div style="width:80%; margin-left:10%;" class="large-15 small-12 columns"><?php
	require(ROOT."/views/post.php"); // aici se afla intregul post
	?></div><?php
   }
   }?>
   <ul style="margin-left:4%;" class="pagination large-15 columns">
  <li class="arrow"><a href="/category/<?php echo $cat;?>/<?php if($p>1) echo $p-1; else echo $p;?>/<?php echo $t;?>">&laquo; Previous</a></li>
  <li class="arrow "><a href="/category/<?php echo $cat;?>/<?php if($contor/12>$p) echo $p+1; else echo $p;?>/<?php echo $t;?>">Next &raquo;</a></li>
  </ul>

   </div>
   <!-- Footer -->
	<?php include ROOT.'/views/footer.php'; ?>
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