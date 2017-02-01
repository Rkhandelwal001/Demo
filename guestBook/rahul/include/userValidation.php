<?php
include('config.php');
$userId = $_REQUEST['isUser'];  // Getting userId from Registration page using AJAX
$select = "SELECT email from tbl_registration WHERE email = '$userId'";
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
