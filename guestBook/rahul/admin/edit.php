<?php
session_start();
include('include/header.php');
include('include/config.php');
   if ((!isset($_SESSION['user_id'])) || empty($_SESSION['user_id']) || $_SESSION['Role'] !=1) { ?>  <!--Checking session for direct access the url of edit page-->
   <script> window.location.href = "../index.php";</script>
   <?php } ?> 
<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
<script>                                        //Ajax for dynamic state list according to country
   jQuery(document).ready(function(){ 
   jQuery('#country').change(function(){ 
   var countryId = $(this).val();
   jQuery.ajax({
   type: "POST",
   url: "states.php",
   data: {country: countryId},
   success: function(data){
   jQuery('#state').html(data); 
   }
  });
 });
});
</script>

<?php
if(isset($_REQUEST['edit']))
{
	    $Id = $_REQUEST['edit'];
	if(isset($_POST['update']))
     {
	     $firstName=$_POST['first_name'];    //taking input tags name attributes to the variables
         $lastName=$_POST['last_name'];
         $phone=$_POST['phone'];
         $gender=$_POST['gender'];
         $language=$_POST['language'];
         $country=$_POST['country'];
         $state=$_POST['state'];
         $city=$_POST['city'];
         $streetAddress=$_POST['street_address'];
         $image = $_POST['fileToUpload'];
         $languages=implode(",", $language);   
          $target_dir = "uploads/";     //image upload code start
          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
          $uploadOk = 1;
          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);   
          move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);  //upload image to the uploads folder  
         $update = "UPDATE tbl_registration SET first_name='$firstName', last_name='$lastName', phone='$phone', gender='$gender', language='$languages', country_id='$country', state_id='$state', city='$city', street_address='$streetAddress', image='$target_file' WHERE id='$Id'";
         $record = mysqli_query($conn, $update);
         if($record)
         { ?>
	       <script> window.location.href = "userList.php?update=1";</script>
        <?php }
         else
         {
	       echo "Error: " . $record . "<br>" . mysqli_error($conn);
         }
     }
	$select = "SELECT first_name, last_name, phone, gender, language, country_id, state_id, city, street_address, image FROM tbl_registration WHERE id = '$Id'";
	$result = mysqli_query($conn, $select);
	if($result->num_rows>0) {
	//taking input records from database to the variables
	while($row=mysqli_fetch_assoc($result))
	{
	   $firstName=$row['first_name'];    
       $lastName=$row['last_name'];
       $phone=$row['phone'];
       $gender=$row['gender'];
       $language=$row['language'];
       $countryId=$row['country_id'];
       $stateId=$row['state_id'];
       $city=$row['city'];
       $streetAddress=$row['street_address'];	
       $image = $row['image'];
       $languages = explode(",",$language);
	}
   } else {
	   echo "No record selected";
   }
}
?>
<h2>Update Form</h2>                        
<form action="#" method="post" class="registration" enctype="multipart/form-data">      <!--Edit form-->
  <table border="1" align="center" class="table">  
    <tr>
      <th>First Name :</th>
      <td><input type="text" name="first_name" value = "<?php echo $firstName;?>" id="first_name"/></td>
    </tr>
    <tr>
      <th>Last Name :</th>
	  <td><input type="text" name="last_name" value="<?php echo $lastName; ?>" id="last_name"></td>
    </tr>
    <tr>
      <th>Phone :</th>
	  <td><input type="text" name="phone" value="<?php echo $phone; ?>" id="phone"></td>
    </tr>
    <tr>
      <th>Gender :</th>
	  <td>
	  <span id="gender">
	    <input type="radio" name="gender" <?php if (isset($gender) && !empty($gender) && ($gender == "male")) {echo "checked='checked'"; }?>  value="male" id="male">Male
	    <input type="radio" name="gender" <?php if (isset($gender) && !empty($gender) && ($gender == "female")) {echo "checked='checked'";}  ?> value="female" id="female">Female
	  </span>
	  </td>
    </tr>
    <tr>
      <th>Language :</th>  <!--Language selection code-->                    
	  <td>
	    <input type="checkbox" name="language[]" <?php if (isset($languages) && in_array("hindi", $languages)) {echo "checked='checked'"; }?> value="hindi" id="hindi">Hindi<br />
	    <input type="checkbox" name="language[]" <?php if (isset($languages) && in_array("english", $languages)) {echo "checked='checked'"; }?> value="english" id="english">English<br />
	    <input type="checkbox" name="language[]" <?php if (isset($languages) && in_array("chinese", $languages)) {echo "checked='checked'"; }?> value="chinese" id="chinese">Chinese<br />
	    <input type="checkbox" name="language[]" <?php if (isset($languages) && in_array("french", $languages)) {echo "checked='checked'"; }?> value="french" id="french">French<br />
	    <input type="checkbox" name="language[]" <?php if (isset($languages) && in_array("japanese", $languages)) {echo "checked='checked'"; }?> value="japanese" id="japanese">Japanese<br >
	    <input type="checkbox" name="language[]" <?php if (isset($languages) && in_array("danish", $languages)) {echo "checked='checked'"; }?> value="danish" id="danish">Danish
	  </td>
    </tr>
    <tr>
	  <td>Country :</td>
      <td>
          <?php
           $select = "SELECT country_id, country_name FROM tbl_country";  //select query for getting country list from tbl_country
           $result = mysqli_query($conn, $select);
           ?>
          <select name="country" id="country">
          <option value="">please select</option>
          <?php while ($row = mysqli_fetch_assoc($result)) { ?>   <!--checking country selected-->
          <option <?php if (isset($countryId) && !empty($countryId) && ($countryId == $row["country_id"])) echo "selected='selected'"; ?>  value="<?php echo $row["country_id"]; ?>">
          <?php
          if (isset($result->num_rows) && !empty($result->num_rows)) {
          echo $row['country_name'];
           }
          ?> 
          </option> 
          <?php } ?>
          </select>
          </td>
          </tr>
          <tr>
          <td>State </td>
          <!-- dropdown for state-->
          <td>
		   <?php
           $select = "SELECT state_id, state_name FROM tbl_state";
           $result = mysqli_query($conn, $select);
           ?>
           <select name="state" id="state">
		   <option value="">please select</option>
		   <?php while ($row = mysqli_fetch_assoc($result)) { ?>
           <option  <?php if(isset($stateId) && !empty($stateId)  && ($stateId == $row["state_id"])) {echo "selected='selected'"; }?> value="<?php echo $row["state_id"]; ?>">
           <?php
           if (isset($result->num_rows) && !empty($result->num_rows)) {
           echo $row['state_name'];
           }
           ?></option>
           <?php } ?>	
           </select>
           </td>
       </tr>
    <tr>
      <th>City :</th>
	  <td><input type="text" name="city" value="<?php echo $city; ?>" id="city"></td>
    </tr>
    <tr>
       <td>Street Address</td>
       <td>  <!--Checking the street address is selected-->
       <textarea rows="4" name="street_address" id="street_address" maxlength="100"><?php if (isset($streetAddress) && !empty($streetAddress)) {echo $streetAddress; }?></textarea>
       </td>
    </tr>
    <tr>
	  <th>Image :</th>
	  <td>
	    <input type="file" name="fileToUpload" id="fileToUpload" value="<?php echo $image; ?>"/>
      </td>
    </tr>
    <tr>                      
      <td colspan="2"><input type="submit" name="update" value="update" id="update" style="background: #EFEFEF;" class="button"/></td>
    </tr>
  </table>
</form>
<?php
include('include/footer.php');
?>
