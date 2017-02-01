<?php
session_start(); 
include('include/header.php');	
include('include/config.php');
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {  //Checking session for direct access the index page of user
	if(isset($_SESSION['Role']) && $_SESSION['Role'] == 1){ ?>
	  <script> window.location.href = "admin/index.php";</script> 
	<?php }
	}
      
if(isset($_REQUEST['logout']) && !empty($_REQUEST['logout']) && ($_REQUEST['logout']==1)){      //Session and cookie unset code
  if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
	 if(isset($_COOKIE['user_id']) && !empty($_COOKIE['user_id'])) {
		unset($_COOKIE['user_id']);
	 }
	unset($_SESSION['user_id']);
	unset($_SESSION['first_name']);
	unset($_SESSION['email']);
	unset($_SESSION['Role']); ?>
	<script> window.location.href = "index.php";</script>
<?php } } ?>  
<h1>Welcome</h1>
<div class="parallel">   <!--parallel div 1-->
  <img src="images/nature.jpg" width = "90%" height = "40%"/>
  <br>
<?php
  if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) { ?>  <!--Checking session for showing comment box-->
	  <div id = "comment_box">       <!--comment box-->
	  <textarea name = "comment" id = "comment" rows = "4" cols = "50"></textarea>
	  <button type='button'>Send</button> 
	<?php } ?>  
</div>
</div>	 <!--parallel div 1 end-->  
     <?php 
        $selectComment = "SELECT first_name, image, post FROM tbl_registration INNER JOIN tbl_comment ON tbl_registration.id=tbl_comment.user_id WHERE tbl_comment.is_deleted=0";
        $resultComment = mysqli_query($conn, $selectComment);
        if($resultComment->num_rows>0) {
     ?> 
<div class="parallel">  <!--parallel div 2-->
<?php $url = $_SERVER['HTTP_HOST'];?> <!--Getting base url--> 
     <div id ="comment_div"> 
        <table border="0" align="center">
          <tr>
			 <th>Image</th>
		     <th>Name</th>
		     <th>Comments</th>
		  </tr>
		  <tr>  
             <?php foreach($resultComment as $row) {      //Comment list show code
			  $img = "http://".$url."/rahul/".$row['image']; ?> 
             <td><img src="<?php echo $img; ?>" class="image"></td>
             <td><?php echo $row['first_name']; ?></td>
             <td><?php echo $row['post']; ?></td>
		  </tr>
		  <?php }?> 
        </table> 
        <?php } else { echo "No record selected"; } ?>
    </div>
</div>   <!--parallel div 2 end-->
 <link href="js/style.css" type="text/css" rel="stylesheet">
	<link href="css/jquery.validate.css" type="text/css" rel="stylesheet">
	<script src="js/jquery.validate.js"></script>
	<script src="js/jquery.validation.functions.js" type="text/javascript"></script>
	<script>
		jQuery(document).ready(function(){    //Ajax code for showing comments 
			jQuery('button').click(function(){ 
				var comments = jQuery('#comment').val(); 
			    var userid = '<?php echo $_SESSION['user_id'] ?>';
			    jQuery.ajax({ 
				   type: "POST",
				   url: "commentList.php",
				   data: {Comments: comments, userId: userid},
				   success: function(res)
				     { jQuery('#comment').val('');
				       jQuery('#comment_div').html(res);  //putting response of ajax in body
				     }   
			     });
				});
			});
		</script>
<?php include('include/footer.php'); ?>
