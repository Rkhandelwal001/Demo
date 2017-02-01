<?php
include('config.php');
$userId = $_REQUEST['isUser'];
$select = "SELECT user_id from tbl_registration WHERE user_id = '$userId'";
$sel = mysqli_query($conn,$select);
$row=$sel->num_rows;
if($row==1)
{
echo 1;	
}
else
{
echo 0;
}
?>
