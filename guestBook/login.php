<?php
include('include/header.php');          //header included
include('include/config.php');

if(isset($_POST['login']))
{
   session_start();
   $userId = $_POST['user_id'];
   $password =	$_POST['password']; 
   $select="SELECT pk_id, first_name, user_id, password, role FROM tbl_registration WHERE user_id='$userId'";
   $result=mysqli_query($conn,$select);
   
   foreach($result as $row)
   {
	  if(($row['user_id']==$userId) && ($row['password']==$password))
	  {
		  if($row['role'] == 1)
		  {
			  $_SESSION['id'] = $row['pk_id'];
			  $_SESSION['first_name'] = $row['first_name'];
			  $_SESSION['user_id'] = $row['user_id'];
			  header("Location: admin/index.php");
		  }
		  else
		  {
		      $_SESSION['id'] = $row['pk_id'];
			  $_SESSION['first_name'] = $row['first_name'];
			  $_SESSION['user_id'] = $row['user_id'];
			  header("Location: home.php");  
		  }
	  }
	  else
	  {
		 echo "Invalid Username or Password";  
	  }
	     
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
	  jQuery("#user_id").validate({               //jQuery validation for user-id
		expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
        message: "Please enter a valid User ID"
	  });
     jQuery("#password").validate({
        expression: "if (VAL.length > 5 && VAL) return true; else return false;",
        message: "Please enter a valid Password"
      });
      
	});
</script>
<h2>Login Form</h2>          
<form name="login_form" id="login_form" method="post" action="#">    <!--Login Form Started-->
	<table border="1" align="center">
		<tr>
			<th>User-Id :</th>
			<td><input type="text" name="user_id" value="" id="user_id"></td>
			</tr>
			<tr>
				<th>Password :</th>
				<td><input type="password" name="password" value="" id="password"></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="login" value="Login"></td>
					</tr>
		</table>
	</form>    <!--Login Form Started-->
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />	
<?php
include('include/footer.php');             //footer included
?>
