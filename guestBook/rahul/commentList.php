<?php
include('include/config.php');
 if(isset($_REQUEST['Comments']) && !empty($_REQUEST['Comments']) && isset($_REQUEST['userId']) && !empty($_REQUEST['userId']))  // Checking userId and Comments set, comming from the index page using Ajax
 {
	$comment = $_REQUEST['Comments'];
	$userId = $_REQUEST['userId'];
	 $html = "";
	 $insertComment = "INSERT INTO tbl_comment  (post, user_id)  VALUES ('$comment','$userId')";  // Insert code for putting comments in database
	 $resultComment = mysqli_query($conn, $insertComment);
		 $url = $_SERVER['HTTP_HOST']; //Getting base url
		 $selectComment = "SELECT first_name, image, post FROM tbl_registration INNER JOIN tbl_comment ON tbl_registration.id=tbl_comment.user_id WHERE tbl_comment.is_deleted=0";
         $resultComment = mysqli_query($conn, $selectComment);
         if($resultComment->num_rows>0)
	  {
         $html .= "<table border='0' align='center'>
          <tr><th>Image</th>
		     <th>Name</th>
		     <th>Comments</th>
		  </tr>
		  <tr>";  
             foreach($resultComment as $row) { 
             $img = "http://".$url."/rahul/".$row['image'];   //Taking source of image in $img variable
             $html .= "<td><img src='".$img."' class='image'></td>";
             $html .= "<td>".$row['first_name']."</td>";
             $html .= "<td>".$row['post']."</td>";
		  $html .= "</tr>";
		   } 
        $html .= "</table>";
	 } else { 
		 echo "No record selected";
	 }
	 echo $html;
 }
?>
