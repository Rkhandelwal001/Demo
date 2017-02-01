<?php
session_start();
include('include/header.php');          //header included
include('include/config.php');
  if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && ($_SESSION['Role'])==1) { ?>  <!--Checking session for direct access login page-->
	  <script> window.location.href = "admin/index.php";</script> 
      <?php } else if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){  ?>
      <script> window.location.href = "index.php";</script>
      <?php } 
if(isset($_POST['login']))  // Checking login is selected or not
{
   $email = $_POST['email'];
   $password =	$_POST['password']; 
   $select="SELECT id, first_name, email, password, role FROM tbl_registration WHERE email='$email'";
   $result=mysqli_query($conn,$select);
   if($result->num_rows>0) {
   foreach($result as $row)
   {
	   $_SESSION['user_id'] = $row['id'];
	   $_SESSION['first_name'] = $row['first_name'];
	   $_SESSION['email'] = $row['email'];
	   $_SESSION['Role'] = $row['role']; 
	  if(($row['email']==$email) && ($row['password']==$password))
	  {
		  if($_SESSION['Role'] == 1) {  ?>
			  <script>window.location.href = "admin/index.php";</script>  <!--Redirecting to the admin's index as role=1-->
			  <?php }
		  else { ?>
			  <script>window.location.href = "index.php";</script>    <!--Redirecting to the user's index as role=2-->
		  <?php
		  }
	  }
	  else
	  {
		 echo "Invalid Username or Password";  
	  }
	     
	}
  } else {
	  echo "No record selected";
    }
}
?>
<br /><br /><br /><br />
<link href="js/style.css" type="text/css" rel="stylesheet">    <!--External CSS-->
<link href="css/jquery.validate.css" type="text/css" rel="stylesheet">   <!--External CSS-->
<script src="js/jquery.validate.js"></script>   <!--Script included-->
<script src="js/jquery.validation.functions.js" type="text/javascript"></script> <!--Script included-->
<script type="text/javascript"> 
    jQuery(function(){
	  jQuery("#email").validate({               //jQuery validation for user-id
		expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
        message: "Please enter a valid User ID"
	  });
     jQuery("#password").validate({
        expression: "if (VAL.length > 5 && VAL) return true; else return false;",
        message: "Please enter a valid Password"
      });
      
	});
</script>
<div class="container">
<div class="parallel">
<h2>Login Form</h2>          
<form name="login_form" id="login_form" method="post" action="#">    <!--Login Form Started-->
	<table border="1" align="center" class="table">
		<tr>
			<th>User-Id :</th>
			<td><input type="text" name="email" value="" id="email"></td>
		</tr>
		<tr>
			<th>Password :</th>
			<td><input type="password" name="password" value="" id="password"></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="login" value="Login" class="button"></td>
		</tr>
	</table>
</form>    <!--Login Form End-->
</div>
<div class="parallel">
<img src="images/login.jpg"/>  <!--Login Image-->
</div>
</div>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />	
<?php
include('include/footer.php');             //footer included
?>
