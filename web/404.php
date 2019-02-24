<?php
require_once("classes/Login.php");
require_once("libraries/password_compatibility_library.php");
require_once("config/db.php");
?>
<!doctype html>
<html class="no-js" lang="en">
<link rel="shortcut icon" href="/img/upload/favicon.ico" />
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>World-Debate | 404 </title>
	<style><?php include ROOT.'/css/foundation.css';?></style>
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
   <body style="background-color: #085a78;">
   <?php include ROOT.'/views/header.php'; ?>
   <div style="background-color:white; margin-top:15px;" class="row">
   <h3 id="orientation-detection">You got to the wrong page budy ! </h3>
  
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