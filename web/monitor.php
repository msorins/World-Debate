<?php
require "/var/zpanel/hostdata/zadmin/public_html/ironcoders_com/scripts/user_name.php";
	
require "scripts/secure.php";
require "scripts/config.php";
	
$type=NULL; $problem_name=NULL;
if(isset($_GET["type"]))
	$type=$_GET["type"];
if(isset($_GET["name"]))
	$problem_name=$_GET["name"];
	?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IronCoder Home Page</title>
	<link href="css/stylesheet.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/stylesheet.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />
	<script src="/js/editor/ckeditor.js"></script>
  </head>
  <body>
  <?php include 'views/header.php'; ?>
  <img style="margin-top:-20px;" src="../img/site/programming.png" class="img-responsive" alt="Responsive image">
  <div class="main-body" style="width:90%; margin-left:auto; margin-right:auto; min-height:450px;">
 <h3> Monitorul de evaluare </h3>
 <hr>
  <?php if($type!="view" && $type!="view-source")  { ?>
  <div class="bs-example bs-example-tabs">
     <ul id="myTab" class="nav nav-tabs">
		  <li class="active"><a href="#home" data-toggle="tab">
		  <?php if($type==NULL) { ?> Toate sursele <?php } 
		  
		  if($type=="search-1") { ?> Sursele tale la problema:<span style="color:#428bca;"> <?php echo $problem_name ; ?></span><?php } ?>
		  
		  <?php
		  if($type=="search-2") { ?> Sursele utilizatorului <span style="color:#428bca;"> <?php echo $problem_name ; } ?></span> 
		  
		   <?php
		  if($type=="search-3") { ?> Sursele problemei <span style="color:#428bca;"> <?php echo $problem_name ; } ?></span> 
		  
		   <?php
		  if($type=="competitii") { ?> Sursele trimise la competitia cu numele <span style="color:#428bca;"> <?php echo $problem_name ; } ?></span> 
		  
		  </a></li>
		  <?php if($type==NULL) { ?>
		  <li class=""><a href="#profile1" data-toggle="tab">Sursele tale</a></li>
		  <?php } ?>
		  <li class="dropdown">
			<a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">Cauta surse<b class="caret"></b></a>
			<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
			  <li><a href="#dropdown1" tabindex="-1" data-toggle="tab">Dupa utilizator</a></li>
			  <li><a href="#dropdown2" tabindex="-1" data-toggle="tab">Dupa problema</a></li>
			</ul>
		  </li>
     </ul>

    <div id="myTabContent" class="tab-content">
	
	<div id="dropdown1" class="tab-pane fade in">
	<br>
	<form action="/scripts/search-monitor.php?type=2" role="form" method="post" enctype="multipart/form-data" class="form-inline" role="form">
	  <div class="form-group">
		<label for="inputEmail3" class="control-label">Nume utilizator</label>
		<input style="max-width:250px;" type="text" class="form-control" name="search_name" >
		<button type="submit" class="btn btn-default">Cauta</button>
	  </div>
	</form>
	</div>
	
	<div id="dropdown2" class="tab-pane fade in">
	<br>
	<form action="/scripts/search-monitor.php?type=3" role="form" method="post" enctype="multipart/form-data" class="form-inline" role="form">
	  <div class="form-group">
		<label for="inputEmail3" class="control-label">Nume problema</label>
		<input style="max-width:250px;" type="text" class="form-control" name="search_name" >
		<button type="submit" class="btn btn-default">Cauta</button>
	  </div>
	</form>
	</div>
	
      <div class="tab-pane fade active in" id="home">
      <?php if($type!="search-1" || ( $type=="search-1" && $user_name!=NULL) )
      { ?>	  
	  <table class="table table-striped table-bordered">
      <thead>
		  <tr>
			  <th>#</th>
			  <th>Utilizator</th>
			  <th>Problema</th>
			  <th>Runda</th>
			  <th>Limbaj</th>
			  <th>Data</th>
			  <th>Punctaj</th>
			  <th>Detalii evaluare</th>
		  </tr>
      </thead>
	  <tbody>
	  <?php
	  function humanTiming ($time)
		{

			$time = time() - $time; // to get the time since that moment

			$tokens = array (
				31536000 => 'ani',
				2592000 => 'luni',
				604800 => 'saptamani',
				86400 => 'zile',
				3600 => 'ore',
				60 => 'minute',
				1 => 'secunde'
			);

			foreach ($tokens as $unit => $text) {
				if ($time < $unit) continue;
				$numberOfUnits = floor($time / $unit);
				return $numberOfUnits.' '.$text;
			}

		}
	  if($type==NULL)
	  {
	  //NICIUN TYPE, SCRIU TOATE JOB-URILE
		  $query=mysql_query("SELECT * FROM `jobs` ORDER BY `job_id` DESC");
		  while($k=mysql_fetch_array($query))
		  {
			?> <tr>
			<td> <?php echo $k["job_id"]; ?></td>
			<td><a href="#">  <?php echo $k["job_owner"]; ?> </a> </td>
			<td> <a href="/arhiva.php?type=view&name=<?php echo $k["job_problem_name"]; ?>"> <?php echo $k["job_problem_name"]; ?> </a> </td>
			<td><?php echo $k["job_contest"]; ?> </td>
			<td><?php echo $k["job_language"]; ?></td>
			<td>Acum <?php echo humanTiming( strtotime($k["job_date"])); ?></td>
			<td> <?php  echo $k["job_total_points"];?> </td>
			<td><a href="monitor.php?type=view&id=<?php echo $k["job_id"]; ?>">Click</a></td>
			<?php
		  }
	  }
	  if($type="competitii")
	  {
		$competitii_nume=$problem_name;
		$query=mysql_query("SELECT * FROM `jobs`  WHERE `job_contest` LIKE '$competitii_nume' ORDER BY `job_id` DESC");
		  while($k=mysql_fetch_array($query))
		  {
			?> <tr>
			<td> <?php echo $k["job_id"]; ?></td>
			<td><a href="#">  <?php echo $k["job_owner"]; ?> </a> </td>
			<td> <a href="/arhiva.php?type=view&name=<?php echo $k["job_problem_name"]; ?>"> <?php echo $k["job_problem_name"]; ?> </a> </td>
			<td><?php echo $k["job_contest"]; ?> </td>
			<td><?php echo $k["job_language"]; ?></td>
			<td>Acum <?php echo humanTiming( strtotime($k["job_date"])); ?></td>
			<td> <?php  echo $k["job_total_points"];?> </td>
			<td><a href="monitor.php?type=view&id=<?php echo $k["job_id"]; ?>">Click</a></td>
			<?php
		  }
	  }
	  if($type=="search-1" || $type=="search-2" || $type="search-3")
	  {
	  //CAUT JOB-URILE AL UTILIZATORULUI LOGAT DUPA NUMELE PROBLEMEI
	  if($type=="search-1")
		$query2=mysql_query("SELECT * FROM `jobs` WHERE `job_problem_name` LIKE '$problem_name' AND `job_owner` LIKE '$user_name' ORDER BY `job_id` DESC ") or mysql_error();
	  if($type=="search-2")
	  	$query2=mysql_query("SELECT * FROM `jobs` WHERE `job_owner` LIKE '$problem_name' ORDER BY `job_id` DESC ") or mysql_error();
	  if($type=="search-3")
	  	$query2=mysql_query("SELECT * FROM `jobs` WHERE `job_problem_name` LIKE '$problem_name' ORDER BY `job_id` DESC ") or mysql_error();
	  while($k2=mysql_fetch_array($query2))
		{
		?> <tr>
		<td> <?php echo $k2["job_id"]; ?></td>
		<td><a href="#">  <?php echo $k2["job_owner"]; ?> </a> </td>
		<td> <a href="/arhiva.php?type=view&name=<?php echo $k2["job_problem_name"]; ?>"> <?php echo $k2["job_problem_name"]; ?> </a> </td>
		<td><?php echo $k2["job_contest"]; ?> </td>
		<td><?php echo $k2["job_language"]; ?></td>
		<td>Acum <?php echo humanTiming( strtotime($k2["job_date"])); ?></td>
		<td> <?php  echo $k2["job_total_points"];?> </td>
		<td><a href="monitor.php?type=view&id=<?php echo $k2["job_id"]; ?>">Click</a></td>
		<?php
		}
	  }
		?>
	</tbody>
	</table>
	<?php 
	}
	else 
	{
	?><h3> Trebuie sa fii logat pentru a accesa aceasta pagina </h3><?php
	}
	?>
	   
	  </div>
	  
	  
      <div class="tab-pane fade1" id="profile1">
	  <?php
	  $type=NULL;
	  if(isset($_GET["type"]))
		$type=$_GET["type"];
	  if($type==NULL)
	  {
	  //PAGINA DEFAULT
		  if($user_name==NULL)
		  {
			?> <h3> Trebuie sa fii logat pentru a putea accesa aceasta pagina </h3> <?php
		  }
		  else
		  {
			?>
			<table class="table table-striped table-bordered">
			  <thead>
				  <tr>
					  <th>#</th>
					  <th>Utilizator</th>
					  <th>Problema</th>
					  <th>Runda</th>
					  <th>Limbaj</th>
					  <th>Data</th>
					  <th>Punctaj</th>
					  <th>Detalii evaluare</th>
				  </tr>
			  </thead>
			  <tbody>
			<?php
			  $query2=mysql_query("SELECT * FROM `jobs` WHERE `job_owner` LIKE '$user_name' ORDER BY `job_id` DESC ") or mysql_error();
			  while($k2=mysql_fetch_array($query2))
			  {
				?> <tr>
				<td> <?php echo $k2["job_id"]; ?></td>
				<td><a href="#">  <?php echo $k2["job_owner"]; ?> </a> </td>
				<td> <a href="/arhiva.php?type=view&name=<?php echo $k2["job_problem_name"]; ?>"> <?php echo $k2["job_problem_name"]; ?> </a> </td>
				<td><?php echo $k2["job_contest"]; ?> </td>
				<td><?php echo $k2["job_language"]; ?></td>
				<td>Acum <?php echo humanTiming( strtotime($k2["job_date"])); ?></td>
				<td> <?php  echo $k2["job_total_points"];?> </td>
				<td><a href="monitor.php?type=view&id=<?php echo $k2["job_id"]; ?>">Click</a></td>
				<?php
			  }
		  }
	  }
	  ?>
	</tbody>
	</table>
      </div>
    </div>

  </div>
  <?php } 
  if($type=="view")
  {
    $id=NULL; 
    if(isset($_GET["id"]))
	   $id=$_GET["id"];
    $query=mysql_query("SELECT * FROM `jobs` WHERE `job_id` = '$id'");
    $k=mysql_fetch_array($query);
    $memory=explode("#",$k["job_tests_memory"]);
    $time=explode("#",$k["job_tests_time"]);
    $points=explode("#",$k["job_tests_points"]);
    $message=explode("#",$k["job_tests_message"]);
    $total_points=$k["job_total_points"];
    $problem_name=$k["job_problem_name"];
    $query2=mysql_query("SELECT * FROM `arhiva` WHERE `arhiva_nume` LIKE '$problem_name'");
    $k2=mysql_fetch_array($query2);
    $tests=$k2["arhiva_numar_teste"];
  ?>
  <div  style="min-height:500px;" >
  <div class="row">
  <div class="col-md-2">
	<table class="table table-hover">
      <thead>
        <tr>
          <th>Meniu</th>
        </tr>
      </thead>
      <tbody>
         <tr>
          <td><a href="/arhiva.php?type=view&name=<?php echo $problem_name; ?>">Pagina problemei</a></td>
        </tr>
		<tr>
          <td>Ajutor</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-10">
	  <div style="background-color: #f5f5f5; border: 1px solid #ccc; margin-top:20px;" class="row">
		<div class="col-md-6 col-xs-6">
			<dl style="margin-top:5px;" class="dl-horizontal">
			  <dt>Problema: </dt>
			  <dd style="padding-bottom:4px;"><a href="/arhiva.php?type=view&name=<?php echo $k["job_problem_name"]; ?>"><?php echo $k["job_problem_name"];?> </a></dd>
			  <dt>Stare: </dt>
			  <dd style="padding-bottom:4px;"><?php echo $k["job_status"]; ?> </dd>
			  <dt>Data: </dt>
			  <dd><?php echo $k["job_date"]; ?></dd>
			</dl>
		</div>
		<div class="col-md-6 col-xs-6">
			<dl style="margin-top:5px;" class="dl-horizontal">
			  <dt>Limbaj: </dt>
			  <dd style="padding-bottom:4px;"><?php echo $k["job_language"]; ?> </dd>
			  <dt>Runda: </dt>
			  <dd><?php echo $k["job_contest"];?> </dd>
			</dl>
		</div>
		</div>
  </div>
  <br><br>
  <hr>
  <div style="height:50px;"></div>
  <div class="col-md-10">
  <hr>
  <h3> Raport teste <h3>
  <div class="table-responsive">
  <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Nr test </th>
          <th>Timp executie</th>
          <th>Memorie folosita</th>
          <th>Mesaj </th>
          <th>Punctaj / test </th>
        </tr>
      </thead>
      <tbody>
      <?php 
	  for($i=1; $i<=$tests; $i++)
	  {
	  ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $time[$i-1]." ms" ; ?></td>
          <td><?php echo $memory[$i-1]." kb" ; ?></td>
          <td><?php echo $message[$i-1]; ?></td>
          <td><?php echo $points[$i-1]." pc" ; ?></td>
        </tr>
      <?php } ?>
        <tr>
        <tr>
        	<td colspan="4">Punctaj total:</td>
            <td><?php echo $k["job_total_points"]." pc"; ?></td>
        </tr>
      </tbody>
    </table>
    </div>
	<hr>
    <h3>Erori de compilare </h3>
    <?php
	 $err=file_get_contents('/var/zpanel/hostdata/zadmin/public_html/ironcoders_com/evaluator/arhiva/'.$problem_name.'/errors/'.$id.".error"); 
	 if($err==NULL)
	 {
	 ?> <h5> Nu exista erori </h5> <?php	 
	 }
	 else
	 ?> <h5> <?php echo $err; ?></h5><?php ;
	?>
	<hr>
	<h3>Sursa</h3>
	<script type="text/javascript" src="evaluator/syntax/scripts/shCore.js"></script>
	<script type="text/javascript" src="evaluator/syntax/scripts/shBrushCpp.js"></script>
	<link type="text/css" rel="stylesheet" href="evaluator/syntax/styles/shCoreDefault.css"/>
    <script type="text/javascript">SyntaxHighlighter.all();</script>
	<?php
	$fis=$id.".cpp"; $text=null;
	$text=file_get_contents('/var/zpanel/hostdata/zadmin/public_html/ironcoders_com/evaluator/arhiva/'.$problem_name.'/sources/'.$id.".cpp"); 
	$text=ltrim($text); 
	?>	
	<pre class="brush: cpp; tab-size: 4;"> <?php
	echo htmlspecialchars ($text);
    ?>
	</pre>
	<br><br>
  </div>
  <div style="height:50px;">da</div>
	</div>
   </div>
  </div>
  <?php } ?>
  </div>
  <?php  include 'views/footer.php';  ?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>