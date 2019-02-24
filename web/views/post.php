<?php 
if(isset($_GET["name"])){ $name=secure($_GET["name"]); }
if(isset($_GET["type"])){ $type=secure($_GET["type"]); } else {$type="blabla";}
if(!isset($i)) $i=1;
?>

<div class="post" style="margin-top:20px; min-width:250px;" >
             <div class="row" style="padding-left:15px; padding-right:15px;min-width:234px; ">
			 
			 <!-- left -->
			 <div  style="min-width:220px; padding-left:0px; padding-right:0px; padding-top:0px;"  class="large-4 small-4 colums panel left">
			 <div class="post-header-block"><a href="/<?php echo $i["post_owner"]; ?>" class="post-header"><?php echo $i["post_owner"]; ?></a>
			 <!--Inceput obiecte bara albastra-->
			 <?php if($i["post_competitive"]==1){?>
			 <div style="float:right; margin-left:-15px; margin-top:2px; margin-right:2px;">
			 <span style="position:relative; margin-left:20px;" data-tooltip class="has-tip" title="Competitive mode is enabled! <br> In this mode the likes are not shown until the debate expires.">
			 <img style="" src="/img/upload/competition.png">
			 </span>
			 </div>
			 <?php } ?>
			 <div style="float:right; margin-right:3%;"><a href="/view/<?php echo $i["post_title"];?>" class="post-header"><?php if($i["post_competitive"]!=1){ echo $i["post_likes1"]; } else { echo "?"; }
			?></a></div>
			 <img style="float:right; height:24px;" src="/img/upload/vote.jpg">
			 <!--Sfarsit obiecte bara albastra-->
	
			 </div>
			 <?php if($i["post_with"]!="videos") { ?>
			 <a style="width:100%" class="th" href="/view/<?php echo $i["post_title"];?>">
				<img alt="<?php echo $i["post_title"]; ?>" src="/img/public_posts/<?echo $i["post_image1"];?>">
			  </a>
			  <?php } else { ?>
			  <div id="iframe" class="flex-video2">
					<iframe  style="width:100%" height="230" src="<?php echo $i["post_video1"];?>" frameborder="0" allowfullscreen></iframe>
			  </div>
			  <?php } ?>
			 <p style="color:#A4A4A4;" class="text-center"><i><?php echo $i["post_description1"];?></i></p>
			 
			 <?php if(isset($name)){ ?>
			 <a style="background-color:#32943A; margin-left:0%; margin-top:10px; margin-bottom:-22px;" data-reveal-id="Opt1" href="#" class="button tiny">Choose 1st <?php if($i["post_with"]!="videos") echo "picture"; else echo "video"; ?></a>
			 <?php } ?>
			 </div>
			 <!-- middle -->
			 <?php if($i["post_is_expired"]==1 && $i["post_type"]!="practice"){ ?>
			 <span class="show-for-medium-up" style="margin-top:170px; margin-left:44%; position:absolute ;padding: 5px 0px 10px 0px ;" data-tooltip class="has-tip tip-top" title="<?php if($i["post_winner"]==1) echo "The first image has won"; if($i["post_winner"]==2) echo "The second has won"; if($i["post_winner"]!=1 && $i["post_winner"]!=2) echo "It's a tie"; ?> !"><img style="margin-bottom:20px; margin-top:20px; height:50px; width:50px;"  src="/img/upload/winner.png"></span>
			 <?php } ?>
			 <div href="/view/<?php echo $i["post_title"];?>" class="show-for-medium-up"style="margin-left:42%; position:absolute"><img style="height:80px; width:80px;" src="/img/upload/vs.png"><br><br><br>
			 <?php 
			 if(isset($_GET["name"]))
			    $name_cr=secure($_GET["name"]);
			 
			 if(isset($name_cr)) {  ?>
			 <a href="/view/<?php echo $i["post_title"];?>" class="button expand round">Vote</a>
			 <?php } else { 
			 if($i["post_type"]!="practice")
			 {
			 ?>
			 <p class="panel" style="margin-left:-35px; z-index:-999;" ><?php 
			 if($_GET["type"]=="received")
			 {
				echo " Choose an action ";
			 }
			 else
			 {
				$days = (strtotime($i["post_expire"]) - strtotime(date("Y-m-d"))) / (60 * 60 * 24);
				 if($days!=0 && $days>0)
				 {
					echo "Expires in ".$days." day";
					if($days>1)
					echo "s";
				 }
				else
					if($days>=0)
						echo "Expires today ";
					else
						echo " Already expired " ;
				 }
		 
			?>
			 </p>
			 <?php } } ?>
			 </div>
			 <div  class="show-for-small-only"style="margin-left:40%; position:absolute"><img style="height:80px; width:80px;" src="/img/upload/vs.png"><br><br><br>
			 <?php if(isset($_GET["name"])) { ?>
			 <a href="/view/<?php echo $i["post_title"];?>" class="button expand round">Vote</a>
			 <?php } ?>
			 </div>
			 <?php 
			 if(isset($_SESSION["vote"]))
				$vote=$_SESSION["vote"];
			else
				$vote=0;
			 
			 if($vote==1 || $vote==2) { 
			  echo "<script>";
			  echo "FB.init({ appId: '263418157141115', status: true, cookie: true, xfbml: true, oauth: true });
    FB.login(function(response) {
      if (response.authResponse) {
        FB.ui({
            method: 'feed', 
            name: 'World-Debate',
            link: 'http://world-debate.net/view.php?type=public&name=";
			echo $i["post_title"];
			echo "',
            picture: 'http://world-debate.net/img/upload/site-logo.png',
            caption: '";
			echo $i["post_title"]." Debate ";
			echo "',
            description: 'I just took part at a debate , help me to be on the victorious side.'
        },
        function(response) {
          
        });
      } else {
        
      }
    }, {scope: 'user_likes,offline_access,publish_stream'});"; 
		echo "</script>"; } ?>
			 <?php if($vote==1) { ?>
			 <div style="margin-left:38%; position:absolute; margin-top:170px;">
			 <p> Vote successfully sent <p>
			 </div> <?php 
			 $_SESSION["vote"]=0;
			 } ?>
			 
			 <?php if($vote==2) { ?>
			 <div style="margin-left:34%; position:absolute; margin-top:170px;">
			 <p> You can't vote more than once </p> 
			  </div><?php
			  $_SESSION["vote"]=0;
			 } ?>
			 
			 <?php 
			 if($type!="received") { ?>
			 <!-- right  normal-->
			 <div  style="min-width:220px; padding-left:0px; padding-right:0px; padding-top:0px;"  class="large-4 small-4 colums panel right">
			 <div class="post-header-block"><a href="/<?php if($i["post_target"]!=NULL) echo $i["post_target"]; else echo $i["post_owner"]; ?>" class="post-header"><?php  if($i["post_target"]!=NULL) echo $i["post_target"]; else echo $i["post_owner"]; ?></a>
			 <!--Inceput obiecte bara albastra-->
			 <?php if($i["post_competitive"]==1){?>
			 <div style="float:right; margin-left:-15px; margin-top:2px; margin-right:2px;">
			 <span style="position:relative; margin-left:20px;" data-tooltip class="has-tip" title="Competitive mode is enabled! <br> In this mode the likes are not shown until the debate expires.">
			 <img style="" src="/img/upload/competition.png">
			 </span>
			 </div>
			 <?php } ?>
			 <div style="float:right; margin-right:3%;"><a href="/view/<?php echo $i["post_title"];?>" class="post-header"><?php if($i["post_competitive"]!=1){ echo $i["post_likes2"]; } else { echo "?"; }
			?></a></div>
			 <img style="float:right; height:24px;" src="/img/upload/vote.jpg">
			 <!--Sfarsit obiecte bara albastra-->
	
			 </div>
			  <?php if($i["post_with"]!="videos") { ?>
			 <a style="width:100%" class="th" href="/view/<?php echo $i["post_title"];?>">
				<img alt="<?php echo $i["post_title"]; ?>" src="/img/public_posts/<?echo $i["post_image2"];?>">
			  </a>
			  <?php } else { ?>
			  <div class="flex-video2">
					<iframe style="width:100%" height="230" src="<?php echo $i["post_video2"];?>" frameborder="0" allowfullscreen></iframe>
			  </div>
			  <?php } ?>
			 <p style="color:#A4A4A4;" class="text-center"><i><?php echo $i["post_description2"];?></i></p>
			<?php if(isset($name)){ ?>
			 <a style="background-color:#32943A; margin-left:0%; margin-top:10px; margin-bottom:-22px;" data-reveal-id="Opt2" href="#" class="button tiny">Choose 2nd <?php if($i["post_with"]!="videos") echo "picture"; else echo "video"; ?></a>
			 <?php } ?>
			</div>
			<?php } 
			else { // right pentru received
			?>
			<form id="received-post" action="/classes/Make-debate.php?type=received&count=<?php echo $i["post_count"];?>&with=<?php if($i["post_with"]!="videos") echo "picture"; else echo "videos"; ?>" method="post" enctype="multipart/form-data">
			 <div  style="padding-left:0px; padding-right:0px; padding-top:0px;"  class="large-4 small-4 colums panel right">
			 <div class="post-header-block"><a href="/<?php if($i["post_target"]!=NULL){ echo $i["post_target"]; } else { echo $i["post_owner"]; }?>" class="post-header"><?php if($i["post_target"]!=NULL){ echo $i["post_target"]; } else { echo $i["post_owner"]; }?></a>
			 <!--Inceput obiecte bara albastra-->
			 <?php if($i["post_competitive"]==1){?>
			 <div style="float:right; margin-left:-15px; margin-top:2px; margin-right:2px;">
			 <span style="position:relative; margin-left:20px;" data-tooltip class="has-tip" title="Competitive mode is enabled! <br> In this mode the likes are not shown until the debate expires.">
			 <img style="" src="/img/upload/competition.png">
			 </span>
			 </div>
			 <?php } ?>
			 <div style="float:right; margin-right:3%;"><a href="/view/<?php echo $i["post_title"];?>" class="post-header"><?php if($i["post_competitive"]!=1){ echo $i["post_likes2"]; } else { echo "?"; }
			?></a></div>
			 <img style="float:right; height:24px;" src="/img/upload/vote.jpg">
			 <!--Sfarsit obiecte bara albastra-->
			 </div>
			 <?php if($i["post_with"]!="videos") { ?>
			 <div style="height:79px;" >
				<label style="margin-left:10px; margin-top:10px;" for="fileup">Your image :</label>
				<input  type="file" name="image2" id="image2"><br>
			 </div>
			 <?php } else { ?>
			 <div style="height:60px; margin-top:19px;" >
			 <label for="fileup">Second video link:</label>
				<input maxlength="100" required placeholder="You must fill me." name="video2" id="video2" type="text">
			 </div>
			 <?php } ?>
			 <hr>
			 <div>
			<label>Your description:</label>
			<textarea maxlength="200" id="post_description2" name="post_description2" placeholder="You must fill me."></textarea>
			</div>
			<div style="margin-bottom:-20px;" >
				<ul style="margin-bottom:-50px;" class="button-group right">
				<li><button style="width:127px" class="button">Confirm</button>
				<li><a href="/classes/Make-debate.php?type=received&count=<?php echo $i["post_count"];?>&delete=1" style="width:127px" name="delete" value="1" class="button">Delete</a>
				</ul>
			</div>
			</div>
			</form>
			<?php } ?>
			
            </div>
</div>
<?php if(isset($name)){ ?>
<hr class="hr-nice">
<?php } ?>
