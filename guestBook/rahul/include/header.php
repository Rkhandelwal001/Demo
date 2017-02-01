<!DOCTYPE HTML>         <!--Header for user's section-->
<html>  
	<head>
		<title>Welcome</title>
		<link href="css/style.css" type="text/css" rel="stylesheet">  <!--External css called here-->		
		<style type="text/css">
         .adHeadline {font: bold 10pt Arial; text-decoration: underline; color: #003366;}
         .adText {font: normal 10pt Arial; text-decoration: none; color: #000000;}
        </style>
        <script src="js/jquery-1.3.2.js" type="text/javascript"></script>
	</head>
<body align="center">
	<div class="header">
		<?php if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) { ?>  <!--Checking session if set-->
		<div><a href="index.php?logout=1">Logout</a></div>
		<?php 
		echo "You are login as :".$_SESSION['first_name'];
		}else{?>
		<nav>
			<a href="register.php">Registration</a> |
			<a href="login.php">Login</a> 
		</nav>	
		<?php }?>
    </div>
<div class="wrapper">
