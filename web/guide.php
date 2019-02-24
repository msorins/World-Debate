<?php
require_once("classes/Login.php");
require_once("libraries/password_compatibility_library.php");
require_once("config/db.php");
ini_set("session.cookie_httponly", 1);
session_start();
?>
<!doctype html>
<html class="no-js" lang="en">
<link rel="shortcut icon" href="/img/upload/favicon.ico" />
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Guide | World Debate</title>
	<meta name="Description" content="World Debate is the best debate platform where you can challenge your friends, choose what you like the most and win points , achievements and a lot more .">
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
   <?php include 'views/header.php'; ?>
     <div style="width:100%; height:5px; background-color:#053446"></div>
   <div style="width:100%; height:250px; background-image:url('img/upload/stripes.png');">
   <br><br><br><br><br>
   <h1 style="margin-top:-5px; color:white;">Debate , Express your opinions , Be a Winner !</h1> </div>
   <div style="width:100%; height:5px; background-color:#085a78"></div>
	<br>
  <div  style="width:100%" class="row">
    <div style="width:100%" class="large-12 columns">
      <div class="row">
        <div class="large-12 columns">
          <div class="row">
            <div class="large-9 small-12 columns">
			<div class="section-header">
			 <h3 class="text-center"><span> /   </span> Guide <span> /</span></h3>
			</div>
			<div class="panel">
                <h6 class="subheader">The available Mods:</h6>
                <ul>
					<li>Competitive debate</li>
					<li>Solo competitive debate</li>
					<li>Practice debate</li>
				</ul>
				<h6 class="subheader">Competitive debate:</h6>
				<p>This mode allows you to challenge a friend , the challenge can be between two pictures or two videos. After the debate expires ( usually over 1 day / 3 days / 1 week /1 month ) the person who uploaded the winning picture / video gets 10 Debate Points. The winner is choosen by the amount of votes he or she accumulated, so the Picture / Video who got the most amount of points win the debate. Also the persons who voted the winners will get 3 points for the good prediction.</p>
				<hr>
				<h6 class="subheader">Solo competitive debate:</h6>
				<p>Very similiar with the competitive debate, in this mode you upload the both files, but you're not getting any points for that, just the people who vote the winning file will get 3 points.</p>
				<hr>
				<h6 class="subheader">Practice:</h6>
				<p>Nobody gets anything, this is just for practice because practice makes perfect.Also here is no expiration date.</p>
				<hr>
				<h6 class="subheader">What can I do with points? - <i>This feature is not available yet </i></h6>
				<p>You can unlock some special features , do transactions and much more.<p>
				<hr>
				<h6 class="subheader">How is a debate expiration working?</h6>
				<p>At 00:00 GMT+2 the maintanance process runs, and all the debates who were supposed to expire that day will be targeted. During this process the winners are choosen and the points are given.Even if the debate is expired, you still can vote and have fun, but you're not getting any rewards. <p>
				

              </div>
			</div>

			 <?php include 'views/index-right.php'; ?>
 
 
 
          </div>
        </div>
      </div>
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
 <div id="fb-root"></div>
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