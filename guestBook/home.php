<!DOCTYPE html>
<html>
	<head>
		<title>User Home Page</title>
	    <link href = "css/style.css" type = "text/css" rel = "stylesheet">    <!--External css called here-->	
	    <script src="js/jquery-1.3.2.js" type="text/javascript"></script> 
	  <script>                                       
	     jQuery(document).ready(function(){ 
		 jQuery("button").click(function(){ 	
	     var comment = jQuery("#comment").val();
		jQuery("#comment_div").html(comment);
		});
		});
	  </script>
	</head>
	<body align="center">
<div class = "userHome" align = "right">
<?php
session_start();
echo "You are login as : ".$_SESSION['first_name'];
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="index.php?logout">Logout<a>
	</div>
	<br>
	<img src = "images/myblog.png" width = "40%" height = "25%">
	<br><br>
	<b>Comment :</b>
	<textarea name = "comment" id = "comment" rows = "4" cols = "50"></textarea>
	<button type = "button">Send</button>
	<div id = "comment_div"></div>
</body>
</html>
