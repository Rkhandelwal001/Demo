<?php
session_start();
include("include/header.php");
include("include/config.php");?>
 <?php if ((!isset($_SESSION['user_id'])) || empty($_SESSION['user_id']) || $_SESSION['Role'] !=1) { ?>   <!--Checking session for direct access admin index page-->
   <script> window.location.href = "../index.php";</script>
   <?php } ?>
<div>
<img src="../images/admin.png"/>  <!--Admin Image code-->
</div>
      <script src="js/jquery.validate.js"></script>
      <script src="js/jquery.validation.functions.js" type="text/javascript"></script>
      <script src="js/jquery-2.1.4.js" ></script>
      <script>                                        
	     jQuery(document).ready(function(){       
			 jQuery('.delete').click(function(){   
			    var deleteComment = jQuery(this).attr('name');
			    jQuery.ajax({     //ajax for deleting comments
				   type: "POST",
				   url: "index.php",
				   data: {deleteComments: deleteComment},
				   success: function(res)
				     { 
				       $('body').html(res);  //putting response of ajax in body
				     }   
			     });
			 });
		 });
	  </script>
	  <?php
	  if(isset($_REQUEST['deleteComments']) && !empty($_REQUEST['deleteComments'])) {  // for checking the data, comming from the ajax request 
	  $html = '';
	  $Id = $_REQUEST['deleteComments'];
	    $updateComment = "UPDATE tbl_comment SET is_deleted=1 WHERE comment_id='$Id'";  // update tbl_comment
	    $resultComment = mysqli_query($conn, $updateComment);
	    if($resultComment) {
		   $selectComment = "SELECT comment_id, first_name,post FROM tbl_registration INNER JOIN tbl_comment ON tbl_registration.id=tbl_comment.user_id WHERE tbl_comment.is_deleted=0";  // Select records from tbl_comment
           $resultComment = mysqli_query($conn, $selectComment);
           echo "Comment deleted successfully.";
           $html .= "<table border='1' class='table' align='center'>
	   <tr>
	      <th>Sr No.</th>
	      <th>Name</th>
	      <th>Posts</th>
	      <th>Action</th>
	   </tr>";
          $i=1;
	      foreach($resultComment as $row) { 
	       $html .= "<tr>";
		   $html .= "<td>".$i."</td>";
		   $html .= "<td>".$row['first_name']."</td>";
		   $html .= "<td>".$row['post']."</td>";
		   $html .= "<td><a name='".$row['comment_id']."' onclick='return confirm('Are you sure?')' class='delete'>Delete</a></td>";
	   $html .= "</tr>";
	     $i++;
	     }
	   $html .= "</table>";	
		}  
		echo $html;  //Giving the resonse to the commentList 
	} else if(isset($_REQUEST['comment']) && !empty($_REQUEST['comment']) && ($_REQUEST['comment']==1)){
	   $selectComment = "SELECT comment_id, first_name, post FROM tbl_registration INNER JOIN tbl_comment ON tbl_registration.id=tbl_comment.user_id WHERE tbl_comment.is_deleted=0";
       $resultComment = mysqli_query($conn, $selectComment);
       if($resultComment->num_rows>0) {	
	  ?>
<div id="comment_list">
    <table border="1" class="table" align="center">
	   <tr>
	      <th>Sr. No.</th>
	      <th>Name</th>
	      <th>Posts</th>
	      <th>Action</th>
	   </tr>
	   <?php 
	      $i=1;
	      foreach($resultComment as $row) { 
	   ?>
	   <tr>
		   <td><?php echo $i; ?></td>
		   <td><?php echo $row['first_name']; ?></td>
		   <td><?php echo $row['post']; ?></td>
		   <td><a name="<?php echo $row['comment_id'];?>" onclick="return confirm('Are you sure?')" class="delete">Delete</a></td>
	   </tr>
	   <?php  $i++; } ?>
	</table>
</div>
<?php } else { 
	    echo "No record Found";
        }
	 ?>
<?php } 
include("include/footer.php");
?>
