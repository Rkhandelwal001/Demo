<?php 
   include('include/config.php');
   $countryId=$_REQUEST['country'];  //Getting countryId from the admin Edit page by Ajax request
   $select="SELECT state_id, state_name from tbl_state WHERE country_id='$countryId'"; // 
   $result=mysqli_query($conn,$select);
   print_r($result);
?>
<option value="">Select state</option>
<?php
   while($data = mysqli_fetch_assoc($result)) {  
?>
<option value="<?php echo $data["state_id"]?>"><?php echo $data["state_name"]?></option>   <!--Giving response to the Edit page-->
<?php
   }
?>
