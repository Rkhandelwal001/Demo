<?php
session_start();

if(isset($_SESSION['id']) && !empty($_SESSION['id']))
{
	include('include/header.php');
	echo "You are login as :".$_SESSION['first_name'];
    ?>
    
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
    
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="index.php?logout=1">Logout<a>

   <br /><br /><br /><br />
   <h1>Welcome</h1>
   <div class="parallel">
	<img src="images/nature.jpg" width = "70%" height = "50%"/>
	<br><br>
	<b>Comment :</b>
	<textarea name = "comment" id = "comment" rows = "4" cols = "50"></textarea>
	<button type = "button">Send</button>
	<div id = "comment_div"></div>
	</div>  
	<div class="parallel">
	     <b>Rahul:</b><p>Very Nice.</p>
	     <b>Khushbu:</b><p>I love nature.</p>
	     <b>Hansraj:</b><p>It feels cool.</p>
	</div>
	<br><br>
	<br><br>
	<br><br>
	<br><br>
	<br><br>
	<br><br>
	<br><br>
	<br><br>
	<br><br>
	<br><br>
	<br><br>
	<br><br>
	<br><br>
	<br><br>
	<br><br>
	<br><br>
<?php
include('include/footer.php');    
}
else if(isset($_POST['logout']))
{
	session_start();
	{
	unset($_SESSION['id']);
     }
 include('include/header.php');	
 ?>

<div class="header">
<nav>
	<a href="register.php">Registration</a> |
	<a href="login.php">Login</a> 
</nav>	
</div>

<br /><br /><br /><br />
   <h1>Welcome</h1>
   <div class="parallel">
	<img src="images/nature.jpg" width = "50%" height = "30%"/>
	</div>  
	<div class="parallel">
	    <b>Rahul:</b><p>Very Nice.</p>
	     <b>Khushbu:</b><p>I love nature.</p>
	     <b>Hansraj:</b><p>It feels cool.</p>
	</div>

<?php
include('include/footer.php');
}
?>
<br /><br /><br /><br /><br /><br /><br /><br /><br />
<?php

?>

