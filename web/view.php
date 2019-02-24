<?php
require_once("classes/Login.php");
require_once("libraries/password_compatibility_library.php");
require_once("config/db.php");
require ROOT."/classes/SecureInput.php";
require ROOT."/config.php";


   $post_title=secure($_GET["name"]); 
   $query=mysql_query("SELECT * FROM `public_posts` WHERE post_title LIKE '$post_title'");
   $i=mysql_fetch_array($query);
   
?>
<!doctype html>
<html class="no-js" lang="en">
<link rel="shortcut icon" href="/img/upload/favicon.ico" />
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $post_title;?> | World-Debate</title>
	<meta name="Description" content="World Debate is the best debate platform where you can challenge your friends, choose what you like the most and win points , achievements and a lot more .">
    <link rel="stylesheet" href="/css/foundation.css" />
    <script src="/js/modernizr.js"></script> 
	<script src="/js/vendor/jquery.js"></script>
	<script src="/js/foundation/foundation.js"></script>
	<script src="//connect.facebook.net/en_US/all.js"></script>
	 <script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-46574893-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	</head>
   <body style="background-color: #085a78;">
   <?php include ROOT.'/views/header.php'; ?>
   <div style="background-color:white; margin-top:15px;" class="row">
   <?php
   if(mysql_num_rows($query)==0)
	{ ?> <h3> No post with this name </h3> <?php }
   else 
   {
   ?>
	<div style="margin-top:-3px;" class="section-header">
			 <h3 class="text-center"><span> /   </span> <?php echo $i["post_title"]; ?> <span> /</span></h3>
	</div>
   <div style="width:80%; margin-left:10%;" class="large-15 small-12 columns"><?php
   require_once(ROOT."/views/post.php"); // aici se afla intregul post
   ?></div>
	<div  id="Opt1" class="reveal-modal text-center" data-reveal>
	<?php if($_SESSION["user_name"]!=NULL) { ?>
	<h3> You can't revert this action, are you sure? </h3>
	<form style="margin-top:10px;" action="/classes/vote.php?postid=<?php echo $i["post_count"];?>&post_name=<?php echo $i["post_title"];?>" method="post">
	<button style="background-color:#32943A;" name="vote" value="1"  class="button radius round tiny">Yes</button>
	</form>
	<?php } else { ?>
	<h3> You must be logged in in order to vote </h3>
	<?php } ?>
	<a class="close-reveal-modal">&#215;</a>
	</div>
	<div  id="Opt2" class="reveal-modal text-center" data-reveal>
	<?php if($_SESSION["user_name"]!=NULL) { ?>
	<h3> You can't revert this action, are you sure? </h3>
	<form style="margin-top:10px;" action="/classes/vote.php?postid=<?php echo $i["post_count"];?>&post_name=<?php echo $i["post_title"];?>" method="post">
	<button style="background-color:#32943A;" name="vote" value="2"  class="button radius round tiny">Yes</button>
	</form>
	<?php } else { ?>
		<h3> You must be logged in in order to vote </h3>
	<?php } ?>
	<a class="close-reveal-modal">&#215;</a>
	</div>
    <div style="margin-top:10px; width:92%; margin-left:4%; height:auto; margin-top:30px;" class="panel large-15 columns">
	<h4> Convince the others to vote the same <?php if(secure($i["post_with"])!="videos") echo "picture"; else echo "video"; ?> as you and the win will be guaranteed!</h4>
	<div class="fb-comments" data-href="http://world-debate.net/view.php?type=public&name=<?php echo secure($_GET["name"]);?>(" data-numposts="10" data-colorscheme="light"></div>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/ro_RO/all.js#xfbml=1&appId=263418157141115";
    fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	</div>
	<?php } ?>
	</div>
   <div style="margin-left:4%"></div>
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