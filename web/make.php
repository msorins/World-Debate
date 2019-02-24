<?php
ini_set("session.cookie_httponly", 1);
session_start();
require_once("classes/Login.php");
require_once("libraries/password_compatibility_library.php");
require_once("config/db.php");
require_once ROOT."/classes/SecureInput.php";
?>
<!doctype html>
<html class="no-js" lang="en">
<link rel="shortcut icon" href="/img/upload/favicon.ico" />
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Make a Debate | World-Debate.net</title>
	<meta name="Description" content="World Debate is the best debate platform where you can challenge your friends, chose what you like the most and win points , achievements and a lot more .">
    <link rel="stylesheet" href="/css/foundation.css" />
	<script src="/js/vendor/jquery.js"></script>
	<script src="/js/jquery-ui-1.9.2.js"></script>
	<script src="/js/modernizr.js"></script> 
    <script src="/js/foundation/foundation.js"></script>
	<script src="/js/validate.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
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
	<script>
	// When the browser is ready...
  $(function() {
    $.validator.addMethod("loginRegex", function(value, element) {
        return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
    }, "The field must contain only letters, or numbers.");
    // Setup form validation on the #register-form element
    $("#make-solo").validate({
    
        // Specify the validation rules
        rules: {
            post_title: {
			    loginRegex: true,
			    maxlength: 64,
                required: true,
				remote: {
				url: "/classes/check.php",
				type: "post",
				data: {
				post_title: function() {
					return $( "#post_title" ).val();
									    }
					  }
			    }
            },
			post_description1: {
			    maxlength: 100,
                required: true
            },
			post_description2: {
			    maxlength: 100,
                required: true
            },
			video1: {
			    maxlength: 100
            },
			video2: {
			    maxlength: 100
            },
			image1: {
				required: true,
			},
        },
        
        messages: {
            post_title: {
				required: "Please enter the debate title",
				maxlength: "The title must have maximum 64 characters long",
				remote: 'Title already exists'
			},
			post_description1: {
				required: "Please enter the description",
				maxlength: "The description must have maximum 200 characters long"
			},
			post_description2: {
				required: "Please enter the description",
				maxlength: "The description must have maximum 200 characters long"
			},
			image1: {
				required: "Please upload a file"
			},
			image2: {
				required: "Please upload a file"
			},
			video1: {
				maxlength: "The video link must have maximum 100 characters long"
			},
			video2: {
				maxlength: "The video link must have maximum 100 characters long"
			},
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
	$("#make").validate({
    
        // Specify the validation rules
        rules: {
            post_title: {
		     	loginRegex: true,
			    maxlength: 64,
                required: true,
				remote: {
				url: "/classes/check.php",
				type: "post",
				data: {
				post_title: function() {
					return $( "#post_title" ).val();
									    }
					  }
			    }
            },
			post_target: {
			    maxlength: 64,
                required: true, 
				remote: {
				url: "/classes/check.php",
				type: "post",
				data: {
				post_target: function() {
					return $( "#post_target" ).val();
									    }
					  }
			    }
            },
			post_description1: {
			    maxlength: 100,
                required: true
            }
        },
        
        messages: {
            post_title: {
				required: "Please enter the debate title",
				maxlength: "The title must have maximum 64 characters long",
				remote: 'Title already exists'
			},
			post_target: {
				required: "Please enter the descriptionx",
				remote: 'Username does not exists'
			},
			post_description1: {
				required: "Please enter the description",
				maxlength: "The description must have maximum 200 characters long"
			}
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
  
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
   <?php 
   if($_SESSION["user_name"]!=NULL)
   {
   if(secure($_GET["type"])=="solo")
	{
	?>
	<div style="margin-top:-4px;" class="section-header">
   <h3 id="orientation-detection">Make a solo competitive debate !<span data-tooltip class="has-tip" title="This mode allows you to create a competitive debate by choosing yourself the two pictures."><img style="float:right; margin-top:-7px;" height="66px" width="66px" src="/img/upload/question.jpg"></span>
   <div style="float:right;">
	  <input <?php if(secure($_GET["with"])!="videos") echo "checked"; ?> onChange="location.href='/make/<?php echo secure($_GET["type"]);?>/'+this.value+''" type="radio" value="pictures"><label for="pokemonRed1"><h3 style="font-size:17px;">Pictures</h3></label>
      <input <?php if(secure($_GET["with"])=="videos") echo "checked"; ?> onChange="location.href='/make/<?php echo secure($_GET["type"]);?>/'+this.value+''" type="radio" value="videos"><label for="pokemonRed1"><h3 style="font-size:17px;">Videos</h3></label>
  </div>
  <div style="float:right;">
	  <h3 style="font-size:17px; margin-right:10px;"> Between:  </h3>
  </div>
   </h3>
   
   </div>
   <form novalidate="novalidate" id="make-solo" style="margin-top:10px;" action="/classes/Make-debate.php?type=solo&with=<?php if(secure($_GET["with"])!="videos") echo "picture"; else echo "videos"; ?>" method="post" enctype="multipart/form-data">
    <div class="large-12 columns">
		<label>Title :</label>
		<input maxlength="64" required placeholder="You must fill me." name="post_title" id="post_title" type="text">
	</div>
	<div class="large-12 columns">
      <label>Category</label>
      <select name="post_category">
        <option value="art">Art</option>
        <option value="Auto and Vehicules">Auto & Vehicules</option>
        <option value="Comedy">Comedy</option>
        <option value="Drawn or Cartoons">Drawn/Cartoons</option>
        <option value="Games">Games</option>
        <option value="Love">Love</option>
		<option value="Sports">Sports</option>
        <option value="Nature or Landscape">Nature/Landscape</option>
        <option value="Others">Others</option>
      </select>
    </div>
	<?php if(secure($_GET["with"]!="videos"))
	{ ?>
	<div class="large-6 medium-6 columns">
	<label for="fileup">First image:</label>
	<input <?php if(secure($_GET["with"]!="videos")) echo "required"; ?> type="file" name="image1" id="image1"><br>
	</div>
	
	<div class="large-6 medium-6 columns">
	<label for="fileup">Second image:</label>
	<input <?php if(secure($_GET["with"]!="videos")) echo "required"; ?> type="file" name="image2" id="image2"><br>
	</div>
	<?php } 
	else { ?>
	<div class="large-6 medium-6 columns">
	<label for="fileup">First video link ( just Youtube ) :</label>
	<input maxlength="100" required placeholder="You must fill me." name="video1" id="video1" type="text">
	</div>
	
	<div class="large-6 medium-6 columns">
	<label for="fileup">Second video link ( just Youtube ):</label>
	<input maxlength="100" required placeholder="You must fill me." name="video2" id="video2" type="text">
	</div>
	<?php } ?>
	<div class="large-6 medium-6 columns">
    <label>First <?php if(secure($_GET["with"]!="videos")) echo "image"; else echo "video"; ?> description:</label>
		<textarea required maxlength="200" id="post_description1"  name="post_description1" placeholder="You must fill me."></textarea>
	</div>
	<div class="large-6 medium-6 columns">
	<label>Second <?php if(secure($_GET["with"]!="videos")) echo "image"; else echo "video"; ?> description:</label>
		<textarea  required maxlength="200" id="post_description2" name="post_description2" placeholder="You must fill me."></textarea>
	</div>
	<hr>
	<div class="large-6 columns">
      <label>Be Anonymous ?</label>
      <input type="radio" name="post_anonymus" value="1" id="pokemonRed1"><label for="pokemonRed1">Yes</label>
      <input checked type="radio" name="post_anonymus" value="2" id="pokemonBlue1"><label for="pokemonBlue1">No</label>
    </div>
	<div class="large-6 columns">
	 <label>Expiration date:</label>
	 <select name="post_expire">
        <option value="1">1 day</option>
		<option value="3">3 days</option>
        <option value="7">1 week</option>
        <option value="31">1 month </option>
      </select>
	</div>
	 <button style="margin-left:43%;" class="medium alert button">Save</button>
	 <?php if($_SESSION["post_image_upload"]=="1") { ?>
	 <div style=" height:80px;" data-alert class="alert-box success radius">
	<h3 style="color:white; margin-top:-13px;" class="text-center" > There has been an error at uploading your image, please try again with a different image </h3>
	<a href="#" class="close">&times;</a>
	</div> <?php 
	 $_SESSION["post_image_upload"]=0;
	 } ?>
	 <?php if($_SESSION["post_done"]==1) { ?>
	 <div style=" height:50px;" data-alert class="alert-box success radius">
	<h3 style="color:white; margin-top:-13px;" class="text-center" > Post has been successfully sent </h3>
	<a href="#" class="close">&times;</a>
	</div>
	<?php
	 $_SESSION["post_done"]=0; 
	 }?>
	 </form>
	 <?
	}
	else
	{
	 ?>
	 <div style="margin-top:-4px;" class="section-header">
	 <h3 id="orientation-detection">Make a <?php if(secure($_GET["type"])=="competitive"){
     echo "competitive" ;} else {echo "practice";}?> debate !<span data-tooltip class="has-tip" title="<?php if(secure($_GET["type"])=="competitive") echo "This mode allows you challenge a friend. The winner will get 10 points. <br> The challenge will be public when the provoked person will accept it and upload the other picture. "; else { echo "In this mode you can't win or lose points, this is just for practice."; }?> "><img style="float:right; margin-top:-7px;" height="66px" width="66px" src="/img/upload/question.jpg"></span>
	 <div style="float:right;">
	  <input <?php if(secure($_GET["with"])!="videos") echo "checked"; ?> onChange="location.href='/make/<?php echo secure($_GET["type"]);?>/'+this.value+''" type="radio" value="pictures"><label for="pokemonRed1"><h3 style="font-size:17px;">Pictures</h3></label>
      <input <?php if(secure($_GET["with"])=="videos") echo "checked"; ?> onChange="location.href='/make/<?php echo secure($_GET["type"]);?>/'+this.value+''" type="radio" value="videos"><label for="pokemonRed1"><h3 style="font-size:17px;">Videos</h3></label>
  </div>
  <div style="float:right;">
	  <h3 style="font-size:17px; margin-right:10px;"> Between:  </h3>
  </div>
	 </h3>
   </div>
   <form novalidate="novalidate" id="make" style="margin-top:10px;" action="/classes/Make-debate.php<?php if(secure($_GET["type"])=="competitive"){
   echo "?type=competitive" ;} else {echo "?type=practice";}?>&with=<?php if(secure($_GET["with"])!="videos") echo "picture"; else echo "videos"; ?>" method="post" enctype="multipart/form-data">
    <div class="large-12 medium-12 columns">
			<label>Title :</label>
			<input id="post_title" required maxlength="64 placeholder="You must fill me." name="post_title" type="text">
	</div>
	<div class="large-6 columns">
      <label>Category</label>
      <select name="post_category">
        <option value="art">Art</option>
        <option value="Auto and Vehicules">Auto & Vehicules</option>
        <option value="Comedy">Comedy</option>
        <option value="Drawn or Cartoons">Drawn/Cartoons</option>
        <option value="Games">Games</option>
        <option value="Love">Love</option>
		<option value="Sports">Sports</option>
        <option value="Nature or Landscape">Nature/Landscape</option>
        <option value="Others">Others</option>
      </select>
    </div>
 <script>
$(function() {

	$( "#post_target" ).autocomplete(
	{
		 minlength:2,
		 source:'/classes/user-list.php',
		 select: function(event, ui) {
                $('#post_target').val(ui.item.label);
            }
	})

});
</script>
		<div class="large-6 columns">
			<label>The person who will get the debate :</label>
			<input id="post_target" maxlength="64" required placeholder="You must fill me." name="post_target" type="text">
	</div>
	<?php if(secure($_GET["with"]!="videos"))
	{ ?>
	<div class="large-6 medium-6 columns ">
	<label  for="fileup">The image:</label>
	<input <?php if(secure($_GET["with"]!="videos")) echo "required"; ?>  type="file" name="image1" id="image1"><br>
	</div>
	<?php } else { ?>
	
	<div class="large-6 medium-6 columns">
	<label for="fileup">The video link ( just Youtube ):</label>
	<input maxlength="100" required placeholder="You must fill me." name="video1" id="video1" type="text">
	</div>
	
	<?php } ?>
	<div class="large-6 medium-6 columns">
    <label><?php if(secure($_GET["with"]!="videos")) echo "Image"; else echo "Video"; ?> description:</label>
    <textarea required maxlength="200" id="post_description1" name="post_description1" placeholder="You must fill me."></textarea>
	</div>
	<hr>
	<div class="large-6 columns">
      <label>Be Anonymous ? </label>
      <input type="radio" name="post_anonymus" value="1" id="pokemonRed1"><label for="pokemonRed1">Yes</label>
      <input checked type="radio" name="post_anonymus" value="2" id="pokemonBlue1"><label for="pokemonBlue1">No</label>
    </div>
	<?php if(secure($_GET["type"])!="practice") { ?> 
	<div class="large-6 columns">
	 <label>Expiration date:</label>
	 <select name="post_expire">
        <option value="1">1 day</option>
		<option value="3">3 days</option>
        <option value="7">1 week</option>
        <option value="31">1 month </option>
      </select>
	</div>
	<?php } ?>
	 <button style="margin-left:43%;" class="medium alert button">Save</button>
	 <?php if($_SESSION["post_image_upload"]=="1") { ?>
	 
	 <div style=" height:80px;" data-alert class="alert-box success radius">
	<h3 style="color:white; margin-top:-13px;" class="text-center" > There has been an error at uploading your image, please try again with a different image </h3>
	<a href="#" class="close">&times;</a>
	</div> <?php 
	 $_SESSION["post_image_upload"]=0;
	 } ?>
	 <?php if($_SESSION["post_done"]==1) { ?>
	  <div style=" height:50px;" data-alert class="alert-box success radius">
	<h3 style="color:white; margin-top:-13px;" class="text-center" > Post has been successfully sent </h3>
	<a href="#" class="close">&times;</a>
	</div> <?php
	 $_SESSION["post_done"]=0; 
	 }?>
	 </form>
	 <?php
	 }
	 }
	 else
	 { ?>
	 <h3> You have to be logged in order to access this page </h3> 
	 <?php } ?>
   </div>

   <!-- Footer -->
	<?php include 'views/footer.php'; ?>
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