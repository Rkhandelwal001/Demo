<?php 
include('include/header.php');   //including header.php
include('include/config.php');  //included config.php
?>

<?php
if(isset($_POST['submit']))    // checking for submission of form
{
  $firstName=$_POST['first_name'];    //taking input tags name attributes to the variables
  $lastName=$_POST['last_name'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $phone=$_POST['phone'];
  $gender=$_POST['gender'];
  $language=$_POST['language'];
  $countryId=$_POST['country_id'];
  $stateId=$_POST['state_id'];
  $city=$_POST['city'];
  $streetAddress=$_POST['street_address'];	
  
  $languages=implode(",",$language);  // implode function for Array to string conversion
  $path="uploads/";  //folder name// 	 
	$uploadfile = $path . basename($_FILES['photo']['name']);  	  	 
	$movedd = move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile); 	 
	echo $movedd; 	 // end// 	
	 $img_name=$_FILES['photo']['name']; 		
	 $_FILES['photo']['name']; 		
	 $_FILES['photo']['tmp_name']; 
  //insert query
  $insert="INSERT INTO tbl_registration(first_name, last_name, email, password, phone, gender, language, country_id, state_id, city, street_address,photo, role) VALUES ('$firstName','$lastName','$email','$password','$phone','$gender','$languages','$countryId','$stateId','$city','$streetAddress', '$uploadfile',2)";
  if(mysqli_query($conn,$insert))
  {
	  echo "You have Successfully Registered. <a href='login.php'>Click Here</a>for Login";
  }
  else
  {
	  echo "Error: " . $insert . "<br>" . mysqli_error($conn);
  }
  }
 
?>
    <link href="js/style.css" type="text/css" rel="stylesheet">
	<link href="css/jquery.validate.css" type="text/css" rel="stylesheet">
	<script src="js/jquery.validate.js"></script>
	<script src="js/jquery.validation.functions.js" type="text/javascript"></script>
    <script type="text/javascript">
           jQuery(function(){
                 jQuery("#first_name").validate({          //jquery firstname validation
                    expression: "if(VAL.match(/^[^\\W][a-zA-Z]{3,25}$/)) return true; else return false;",
                    message: "Please enter the Required field"
                });
                jQuery("#last_name").validate({           //jquery lastname validation
                    expression: "if(VAL.match(/^[^\\W][a-zA-Z]{3,25}$/)) return true; else return false;",
                    message: "Please enter the Required field"
                });
                 jQuery("#email").validate({               //jquery email validation
                    expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
                    message: "Please enter a valid User ID"
                });
                jQuery("#password").validate({
                    expression: "if (VAL.length > 5 && VAL) return true; else return false;",
                    message: "Please enter a valid Password"
                });
                jQuery("#phone").validate({                //jquery phone number validation
                    expression: "if (VAL.match(/^[^\\W][0-9]{9,10}$/)) return true; else return false;",
                    message: "Please enter a valid Email ID"
                });
                jQuery("#gender").validate({               //jquery gender validation
                    expression: "if (isChecked(SelfID)) return true; else return false;",
                    message: "Please select a radio button"
                });
                jQuery("#language").validate({              //jquery language validation
                    expression: "if (isChecked(SelfID)) return true; else return false;",
                    message: "Please check atleast one checkbox"
                });
                jQuery("#country").validate({               //jquery country validation
                    expression: "if (VAL) return true; else return false;",
                    message: "Please make a selection"
                });
                jQuery("#state").validate({                 //jquery state validation
                    expression: "if (VAL) return true; else return false;",
                    message: "Please make a selection"
                });
                jQuery("#city").validate({                  //jquery city validation
                    expression: "if(VAL.match(/^[^\\W][a-zA-Z]{3,25}$/)) return true; else return false;",
                    message: "Please enter the Required field"
                });
                jQuery("#street_address").validate({        //jquery address validation
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter the Required field"
                });
			});
      </script>
      <script>                                        //Ajax for dynamic state list according to country
	     jQuery(document).ready(function(){ 
		 jQuery('#country').change(function(){ 
		  var countryId = $(this).val();
		 jQuery.ajax({
		     type: "POST",
			 url: "include/states.php",
			 data: {country: countryId},
			 success: function(data){
		 jQuery('#state').html(data); 
		}
		});
		});
		});
	  </script>
	  <script>
	     jQuery(document).ready(function(){ 
			 jQuery('#user_id').blur(function(){ 
				 var user = $('#user_id').val();
				 jQuery.ajax({
					 type: "post",
					 url: "include/userValidation.php",
					 data: {isUser: user},
					 success: function(response){	
					    if(response==1)
					     {
							 jQuery('#user_check').show();
							 jQuery('#user_check').text("This user already Exist");
							 
						 }
						 else 
						 {					 
							 jQuery('#user_check').hide();
							 }
						}
					 });
				 });
			 });
	  </script>
<h2>Fill the Registration form </h2>                        

<form action="#" method="post" class="registration">      <!--registration form-->
<table border="1" align="center" class="table">  
<tr>
    <th>First Name :</th>
    <td><input type="text" name="first_name" id="first_name" /></td>
</tr>
<tr>
    <th>Last Name :</th>
	<td><input type="text" name="last_name" value="" id="last_name"></td>
</tr>
<tr>
    <th>User Id :</th>
	<td><input type="text" name="user_id" value="" id="user_id"><span id="user_check"></span></td>
	
</tr>

<tr>
	<th>Password :</th>
	<td><input type="password" name="password" value="" id="password"></td>
</tr>
<tr>
    <th>Phone :</th>
	<td><input type="text" name="phone" value="" id="phone"></td>
</tr>
<tr>
    <th>Gender :</th>
	<td>
	<span id="gender">
	<input type="radio" name="gender" value="male" id="male">Male
	<input type="radio" name="gender" value="female" id="female">Female
	</span>
	</td>
</tr>
<tr>
    <th>Language :</th>  <!--Language selection code-->                    
	<td>
	<span id="language">
	<input type="checkbox" name="language[]" value="hindi" id="hindi">Hindi
	<input type="checkbox" name="language[]" value="english" id="english">English<br />
	<input type="checkbox" name="language[]" value="chinese" id="chinese">Chinese
	<input type="checkbox" name="language[]" value="french" id="french">French<br />
	<input type="checkbox" name="language[]" value="japanese" id="japanese">Japanese
	<input type="checkbox" name="language[]" value="danish" id="danish">Danish
	</span>
	</td>
</tr>
<tr>
    <th>Country :</th>
	<td>
	<?php
	$select="SELECT country_id, country_name FROM tbl_country";
	$result=mysqli_query($conn,$select);
	?>
	<select name="country" id="country">
	<option value="">Select country</option>
	<?php
	while($data=mysqli_fetch_array($result)) {
	?>
	<option value="<?php echo $data['country_id']?>"><?php echo $data['country_name']?></option>
	<?php } ?>
	</select>
	</td>
</tr>
<tr>
    <th>State :</th> <!--state list code-->
	<td> 
	<select name="state" id="state">
	<option value="">Select state</option>
	</select>
	</td>
</tr>
<tr>
    <th>City :</th>
	<td><input type="text" name="city" value="" id="city"></td>
</tr>
<tr>
    <th>Street Address :</th>
	<td><textarea name="street_address" value="" id="street_address"></textarea></td>
</tr>
<tr>
	<th>Image :</th>
	<td>
	
	<form action="#" method="post" enctype="multipart/form-data" id="image_form">
    <input type="file" name="photo" id="photo" value="photo"/>
    <input type="submit" value="Upload Image" name="image_button">
    </form>
	
	</td>
</tr>
<tr>                      
    <td colspan="2"><input type="submit" name="submit" value="Submit" id="submit" style="background: #EFEFEF;"/></td>
</tr>
</table>
</form>
		
<?php
include('include/footer.php');
?>
