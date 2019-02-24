<?php
require_once("classes/Login.php");
require_once("libraries/password_compatibility_library.php");
require_once("config/db.php");
require_once ROOT."/classes/SecureInput.php";
ini_set("session.cookie_httponly", 1);
session_start();
?>
<!doctype html>
<html class="no-js" lang="en">
<link rel="shortcut icon" href="/img/upload/favicon.ico" />
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Report | World Debate</title>
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
  <!-- End Top Bar -->
  <div  style="width:100%" class="row">
    <div style="width:100%" class="large-12 columns">
      <div class="row">
        <div class="large-12 columns">
          <div class="row">
            <!-- Shows -->
            <div class="large-9 small-12 columns">
			<div class="section-header">
			 <h3 class="text-center"><span> /   </span> Report a bug <span> /</span></h3>
			</div>
			<form action="/report.php" method="post">
			<div style="height:180px; margin-top:20px;" class="panel">
			<div class="large-12 medium-12 columns">
			<label>Description:</label>
			<textarea required maxlength="1000" id="description"  name="description" placeholder="Fill me with the description of the bug."></textarea>
			</div>
			<button style="margin-left:43%;" class="medium alert button">Send</button>
			</div>
			</form>
			</div>

			 <div class="large-3 small-6 columns show-for-medium-up">
 
              <div class="section-header">
			  <h3 class="text-center"><span> /</span> Facebook <span> /</span></h3>
			  </div>
              <div style="padding-left:0px; padding-right:0px" class="panel">
                <div class="fb-like-box" data-href="https://www.facebook.com/WorldDebate.net" data-width="220px" data-height="532" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
              </div>
			  
            </div>
 
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
<?php 
	$description=secure($_POST["description"]);
	$_POST["description"]=0;
	if($description!=NULL)
	{
		mysql_query("INSERT INTO `worlddeb_db1`.`bug_report` (`logs_description`) VALUES ('$description')");
	}
?>
</html>