<?php
session_start();
include("include/header.php");
include("include/config.php");
include("customClass.php");    //class included
$obj = new GuestBook;  // Object of the GuestBook class
   if ((!isset($_SESSION['user_id'])) || empty($_SESSION['user_id']) || $_SESSION['Role'] !=1) { ?>  <!--Checking session for direct access userList-->
   <script> window.location.href = "../index.php";</script>
   <?php } 
?>
	<script src="js/jquery.validate.js"></script>
	<script src="js/jquery.validation.functions.js" type="text/javascript"></script>
    <script src="js/jquery-2.1.4.js" ></script>
    <script>                                        
	     jQuery(document).ready(function(){     //Ajax for getting user list 
			 jQuery('.delete').click(function(){ 
			    var editId = jQuery(this).attr('name');
			    jQuery.ajax({
				   type: "POST",
				   url: "userList.php",
				   data: {editUserRecord: editId},
				   success: function(res)
				     {
				       $('body').html(res);  //putting response of ajax in body
				     }   
			     });
			 });
		 });
	  </script>
<?php
	if(isset($_REQUEST['editUserRecord']) && !empty($_REQUEST['editUserRecord'])) {    //checking ajax request
		$html = ""; 
	    $delete = "UPDATE tbl_registration SET is_deleted = 1 WHERE id = '".$_REQUEST['editUserRecord']."'";   //update query for replacing is_deleted=1
		$result = mysqli_query($conn, $delete);  
		if($result){ 	       
		  $select = "select id, first_name, last_name, email, phone, country_id, state_id, city, created_date, is_deleted, role from tbl_registration WHERE is_deleted=0 AND role=2"; // Select query for getting users 
		  $result = mysqli_query($conn, $select);
		  echo "Record deleted successfully";		
		  $html .= "<br><br> <h2>Users List</h2>";
          $html .= "<table border = '1' align = 'center' class = 'table'> 
                    <tr>
		    	    <th>Sr. No.</th>
			    	<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Country</th>
					<th>State</th>
					<th>City</th>
					<th>Created Date</th>
					 <th>Action</th>
				     </tr>"; 
          $i=1;
          while($record = mysqli_fetch_array($result)) {  //for showing records in table 
          $html .= "<tr>";
          $html .= "<td>".$i."</td>";
          $html .= "<td>".$record['first_name']."</td>";
          $html .= "<td>".$record['last_name']."</td>";
          $html .= "<td>".$record['email']."</td>";
          $html .= "<td>".$record['phone']."</td>";
          $html .= "<td>".$obj->countryName($record['country_id'])."</td>";
          $html .= "<td>".$obj->stateName($record['state_id'])."</td>";
          $html .= "<td>".$record['city']."</td>";
          $html .= "<td>".$record['created_date']."</td>";
          $html .= "<td><a href='edit.php?edit=".$record['id']."'>Edit</a>&nbsp;<a name='".$record['id']."' onclick='return confirm('Are you sure?')' class='delete'>Delete</a></td>";
          $html .= "</tr>";  
          $i=$i+1;
          } 
          $html .= "</table>";  
	}
   echo $html;	  // Giving response to the Ajax request
}
else {   //for loading users list on click of user list link
// for select records from the database
$select = "select id, first_name, last_name, email, phone, country_id, state_id, city, created_date, is_deleted, role from tbl_registration WHERE is_deleted=0 AND role=2";
$result = mysqli_query($conn, $select); 
?>
<div id="showUsersListData">
	<?php if(isset($_REQUEST['update']) && !empty($_REQUEST['update']) && ($_REQUEST['update']==1)) { echo "Record Updated Successfully";}?>
<br><br> <h2>Users List</h2>
<table border = "1" align = "center" class = "table">
  <tr>
	  <th>Sr. No.</th>
	  <th>First Name</th>
	  <th>Last Name</th>
	  <th>Email</th>
	  <th>Phone</th>
	  <th>Country</th>
	  <th>State</th>
	  <th>City</th>
	  <th>Created Date</th>
	  <th>Action</th>
  </tr>
<?php
   $i=1;
   while($record = mysqli_fetch_array($result)) {  //for showing records in table 
?>
  <tr>
      
      <td><?php echo $i; ?></td>
      <td><?php echo $record['first_name']; ?></td>
      <td><?php echo $record['last_name']; ?></td>
      <td><?php echo $record['email']; ?></td>
      <td><?php echo $record['phone']; ?></td>
      <td><?php echo $obj->countryName($record['country_id']); ?></td>
      <td><?php echo $obj->stateName($record['state_id']); ?></td>
      <td><?php echo $record['city']; ?></td>
      <td><?php echo $record['created_date']; ?></td>
      <td><a href="edit.php?edit=<?php echo $record['id'];?>">Edit</a>&nbsp;<a name="<?php echo $record['id'];?>" onclick="return confirm('Are you sure?')" class="delete">Delete</a></td>
  </tr>  
  <?php $i=$i+1;
  } }?>
</table>
</div>
<?php
include("include/footer.php");
?>
