<?php
// database information
$servername="mysql.trainee.systematixwebsolutions.com";
$username="traineesipl";
$password="dojobwork";
$database="db_guestbook_rahul";

//create connection
$conn=mysqli_connect($servername, $username, $password, $database);
if(!$conn)
{
die("Connection failed: " . mysqli_connect_error());
}	
?>
