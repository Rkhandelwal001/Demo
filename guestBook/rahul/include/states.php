<?php
   include('config.php');
   $countryId=$_REQUEST['country'];  // Getting country_id from registration page using Ajax
   $select="SELECT state_id, state_name from tbl_state WHERE country_id='$countryId'";
   $result=mysqli_query($conn,$select);
   if($result->num_rows>0) {
?>
<option value="">Select state</option>
<?php
   while($data = mysqli_fetch_assoc($result)) {  
?>
<option value="<?php echo $data["state_id"]?>"><?php echo $data["state_name"]?></option>  <!--Sending response of the Ajax request to the Registration page-->
<?php
   }
} else {
	echo "No record selected";
}
?>
