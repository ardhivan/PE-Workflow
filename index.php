<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!DOCTYPE HTML>
<html>
<head>
<title>Yamaha Electronic Manufacturing Indonesia</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link href="./css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Custom Theme files -->
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>



<!--//fonts-->

<!--css datatable-->
<!--end css datatable-->
<?php include "connect.php";?>
</head>
<body>
<!--header-->
  <div class="header">
		<div class="container">	
			<div class="logo">
				<h1><a href="index.php"><img src="images/logo.png" alt="">
				</a></h1>
				<h4>
				Yamaha Electronic Manufacturing Indonesia
				<br/>
				Production Engineering Division
				</h4>
			</div>
			<div class="header-bottom">
				<div class="top-nav">
					<span class="menu"></span>
					<ul>
						<li><a href="index.php?page=schedule" >Schedule</a></li>
						<li><a href="index.php?page=drawing" >Drawing</a></li>
						<li><a href="index.php?page=dcn" >DCN </a></li>
						<li><a href="index.php?page=partspec" >Part Spec</a></li>
						<li><a href="admin/pages/login.php" ><span class="glyphicon glyphicon-cog"></span></a></li>
						
					</ul>

			 
			
			
		</div>
		<div class="clearfix"> </div>
		</div>
	</div>
	<!---->
	 <?php
		  if(isset($_GET['page'])) { $page = $_GET['page']; } 
			else { $page = ""; } 
		  //$page = $_GET['page'];
		  if($page){
		  	require_once($page.".php");
		  } else {
		  	require_once("home.php");
		  }
		  ?>
				
				<!---End-blog----->
			<!---->
<div class="footer" >
			    <div class="container">

			<div class="footer-bottom">
			<img src="images/footerlogo.png" alt="">
				
				<p class="footer-class">Copyright 2015 Yamaha Electronic Manufacturing Indonesia <br>
				</p>
				
				<div class="clearfix"></div>
			</div>						
		</div>
	</div>
</body>
</html>