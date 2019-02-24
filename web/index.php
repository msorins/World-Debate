<?php
//require 'bootstrap/autoload.php';
//$app = require_once 'bootstrap/start.php';
require_once("classes/Login.php");
require_once("libraries/password_compatibility_library.php");
require_once("config/db.php");
require ROOT."/classes/SecureInput.php";
?>
<!doctype html>
<html class="no-js" lang="en">
<link rel="shortcut icon" href="/img/upload/favicon.ico" />
  <head>
    <title>World Debate | Best free online Debate platform </title>
	<meta name="Description" content="World Debate is the best debate platform where you can challenge your friends, choose what you like the most and win points , achievements and a lot more .">
    <meta name="Keywords" content="debate, world-debate, competition, opinions, socialization, challenge a friend">
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/foundation.css" />
	<script src="js/modernizr.js"></script> 
  <script src="/js/vendor/jquery.js"></script>
  <script src="js/foundation/foundation.js"></script>
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
<!--[if lt IE 9]>
  <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
  <script src="//s3.amazonaws.com/nwapi/nwmatcher/nwmatcher-1.2.5-min.js"></script>
  <script src="//html5base.googlecode.com/svn-history/r38/trunk/js/selectivizr-1.0.3b.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
<![endif]-->
<!--[if gt IE 8]><!-->
    <script src="/js/foundation4/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>
<!--<![endif]-->
            
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
   <body>
   <?php include 'views/header.php'; 
   //Session::put('user_logged_in', '1');
   //echo Session::get('user_name')." ".Session::get('user_logged_in');
   ?>
     <div style="width:100%; height:5px; background-color:#053446"></div>
   <div style="width:100%; height:250px; background-image:url('img/upload/stripes.png');">
   <br><br><br><br><br>
   <h1 style="margin-top:-5px; color:white;">Debate , Challenge your friends, Be a Winner !</h1> </div>
   <div style="width:100%; height:5px; background-color:#085a78"></div>
	<br>
  <!-- End Top Bar -->
  <div  style="width:100%" class="row">
    <div style="width:100%" class="large-12 columns">

 
 <div id="myModal" class="reveal-modal" data-reveal>
  <h2>Awesome. I have it.</h2>
  <p class="lead">Your couch.  It is mine.</p>
  <p>Im a cool paragraph that lives inside of an even cooler modal. Wins</p>
  <a class="close-reveal-modal">&#215;</a>
</div>
      <div class="row">
        <div class="large-12 columns">
          <div class="row">
            <!-- Shows -->
            <div class="large-9 small-12 columns">
			<div class="section-header">
			 <h3 class="text-center"><span> /   </span> Latest debates <span> /</span></h3>
			</div>
			
			<?php
			require_once("config.php");
			$result=mysql_query("SELECT * FROM public_posts WHERE `post_activate`=1 ORDER BY post_count DESC LIMIT 8");
			while($i=mysql_fetch_array($result))
			{
			 require(ROOT."/views/post.php"); // aici se afla intregul post
		    } ?>
			</div>

            <?php include 'views/index-right.php'; ?>
 
 
            <!-- End Feed -->
 
          </div>
        </div>
      </div>
    <!-- End Content -->
 
 
    <!-- Footer -->
	<?php include 'views/footer.php'; ?>
    <!-- End Footer -->
    </div>
  </div>
  <!-- Script Area -->
  <script>
  document.write('<script src=js/vendor/' +
  ('__proto__' in {} ? 'zepto' : 'jquery') +
  '.js><\/script>')
  </script>
  <script src="js/foundation.min.js"></script>
  <script>
    $(document).foundation();
  </script>
  
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ro_RO/all.js#xfbml=1&appId=263418157141115";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!--END Facebook login / register zone -->
</body>
</html>