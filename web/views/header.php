<!--Login sistem-->
<?php
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    require_once("libraries/password_compatibility_library.php");
}
$login = new Login();
	?>
      <!-- Navigation -->
  <nav class="top-bar" data-topbar>
    <ul class="title-area">
      <!-- Title Area -->
      <li class="name">
        <h1>
          <a href="/index.php">
           <span style="color: #78ac30;">W</span>orld-<span style="color: #78ac30;">Debate</span>.net
          </a>
        </h1>
      </li>
      <li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
    </ul>
 
    <section class="top-bar-section">
      <!-- Right Nav Section -->
      <ul class="right">
        <li class="divider"></li>
        <li class="has-dropdown">
          <a>Categories</a>
          <ul class="dropdown">
            <li><label>Section Name</label></li>
            <li> <a href="/category/art" class="">Art</a></li>
            <li><a href="/category/Auto and Vehicules">Auto & Vehicules</a></li>
            <li><a href="/category/Comedy">Comedy</a></li>
            <li><a href="/category/Drawn or Cartoons">Drawn/Cartoons</a></li>
            <li><a href="/category/Games">Games</a></li>
			<li><a href="/category/Love">Love</a></li>
			<li><a href="/category/Sports">Sports</a></li>
			<li><a href="/category/Nature or Landscape">Nature/Landscape</a></li>
			<li><a href="/category/Pets and Animals">Pets & Animals</a></li>
            <li class="divider"></li>
			<li><a href="/category/Others">Others</a></li>
            <li><a href="/category/all">See all →</a></li>
          </ul>
        </li>
		<li class="divider"></li>
		<?php
		if (isset($_SESSION["user_name"])) {
		?>
		<li class="has-dropdown">
          <a href="/make/competitive">Make a Debate</a>
          <ul class="dropdown">
            <li><label>Choosee</label></li>
            <li><a href="/make/competitive">Competitive debate</a></li>
			<li><a href="/make/solo">Solo competitive debate</a></li>
			<li><a href="/make/practice">Practice debate</a></li>
          </ul>
        </li>
		<li class="divider"></li>
		 <li><i class="foundicon-inbox"></i></li>
		<li class="divider"></li>
		<li class="has-dropdown profile-header user-profile">
          <a href="/<?php echo $_SESSION['user_name']; ?>"><img style="margin-top:-4px;" height="40px;" width="40px;" src="/img/upload/profile.png"></a>
          <ul class="dropdown">
            <li><label>Hi, <?php echo $_SESSION['user_name']; ?></label></li>
            <li><a href="/<?php echo $_SESSION['user_name']; ?>"><span style="color: #fca13f !important; font-family:helvetica; font-size:17px;">View</span></a></li>
			<li><a href="/feed.php"><span style="color: #248aaf !important; font-family:helvetica; font-size:17px;">Feed</span></a></li>
			<li><a href="/friends.php"><span style="color: #B40431 !important; font-family:helvetica; font-size:17px;">Friends</span></a></li>
			<?php
			require ROOT."/config.php";
			$user2_name=$_SESSION['user_name'];
			$queryuletz=mysql_query("SELECT * FROM `users` WHERE user_name LIKE '$user2_name'");
			$h=mysql_fetch_array($queryuletz);
			?>
			<li class="divider"></li>
			<li><a href="/profile/received"><span style="color: #669 !important; font-family:helvetica; font-size:17px; ">Received debates </span>( <span style="color:red"><?php echo $h["user_notifications"];?> </span>)</a></li>
            <li><a href="/profile/edit"><span style="color: #3cbc8d !important; font-family:helvetica; font-size:17px;">Settings</span></a></li>
			<li><label>Notifications !</label></li>
			<?php  
			$q=mysql_query("SELECT * FROM `logs` WHERE `logs_user_name`='$user2_name' ORDER BY logs_count DESC LIMIT 5");
			while($c=mysql_fetch_array($q))
			{ ?>
			<li><a href="/view/<?php echo $c["logs_post_name"];?>"><span style="color:grey"><?php echo $c["logs_date"]; ?></span>-<?php echo $c["logs_message"]; ?></a></li>
			<?php 
			if(mysql_num_rows($q)==0)
				echo "No notifications ";
			}
			?>
          </ul>
        </li>
		<li>
		<li class="has-form">
		<a href="/index.php?logout" class="button expand">Logout</a>
		</li>
		<?php
		} else {
		?>
		<li class="divider"></li>
		<li class="has-form">
		<a data-reveal-id="LoginModal" href="#" class="button">Login</a>
		<div  id="LoginModal" class="reveal-modal" data-reveal>
		<h2>World-Debate Login Form</h2>
		<?php
		
		// show negative messages
		if ($login->errors) {
			foreach ($login->errors as $error) {
				echo $error;    
			}
		}
		?>
		<form method="post" action="index.php" name="loginform">

		<label for="login_input_username">Username</label>
		<input id="login_input_username" class="login_input" type="text" name="user_name" required />

		<label for="login_input_password">Password</label>
		<input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />

		<input type="submit"  class="medium alert button" name="login" value="Log in" />

		</form>
		<a class="close-reveal-modal">&#215;</a>
		</div>
		</li>
		<li class="has-form">
		<a data-reveal-id="RegisterModal"  href="#" class="medium button">Register</a>
		 <div  id="RegisterModal" class="reveal-modal" data-reveal>
		<h2>Register on World-Debate fast and easy.</h2>
		<?php
		require_once("classes/Registration.php");
		$registration = new Registration();
		?>
		<form method="post" action="index.php" name="registerform">   
    
    <!-- the user name input field uses a HTML5 pattern check -->
    <label for="login_input_username">Username (only letters and numbers, 2 to 64 characters)</label>
    <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
    
    <!-- the email input field uses a HTML5 email type check -->
    <label for="login_input_email">User's email</label>    
    <input id="login_input_email" class="login_input" type="email" name="user_email" required />        
    
    <label for="login_input_password_new">Password (min. 6 characters)</label>
    <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />  
    
    <label for="login_input_password_repeat">Repeat password</label>
    <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />        
    <input type="submit"  class="medium alert button" name="register" value="Register" />
    
</form>
		</div>
		</li>
		<?php } ?>
      </ul>
    </section>
  </nav>
<?php if(isset($_COOKIE["login-error"])) { ?>
<div style="margin-bottom:-20px;" data-alert class="alert-box">
  <?php echo $_COOKIE["login-error"]; 
  setcookie("login-error", "0", time()-3600);
  ?>
  <a href="#" class="close">&times;</a>
</div>
<?php } ?>
<?php if(isset($_COOKIE["register-info"])) { ?>
<div style="margin-bottom:-20px;" data-alert class="alert-box">
  <?php echo $_COOKIE["register-info"]; 
  setcookie("register-info", "0", time()-3600);
  ?>
  <a href="#" class="close">&times;</a>
</div>
<?php } ?>