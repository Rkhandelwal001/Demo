<?php
 if(isset($_REQUEST['Comments']) && !empty($_REQUEST['Comments']) && isset($_REQUEST['userId']) && !empty($_REQUEST['userId']))
 {
	$comment = $_REQUEST['Comments'];
	$userId = $_REQUEST['userId'];
	 $html = "";
	 $insertComment = "INSERT INTO tbl_comment  (post, user_id)  VALUES ('$comment','$userId')";
	 $resultComment = mysqli_query($conn, $insertComment);
	 if($resultComment)
	 {
		 $selectComment = "SELECT first_name, post FROM tbl_registration INNER JOIN tbl_comment ON tbl_registration.id=tbl_comment.user_id";
         $resultComment = mysqli_query($conn, $selectComment);
         $html .= "<table border='0' align='center'>
          <tr>
		     <th>Name</th>
		     <th>Comments</th>
		  </tr>
		  <tr>";  
             foreach($resultComment as $row) { 
             $html .= "<td>".$row['first_name']."</td>";
             $html .= "<td>".$row['post']."</td>";
		  $html .= "</tr>";
		   } 
        $html .= "</table>";
	 }
	 echo $html;
 }
?>
