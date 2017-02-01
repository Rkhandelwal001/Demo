<?php
// database information
$servername="localhost";
$username="root";
$password="";
$database="db_rahul";

//create connection
$conn=mysqli_connect($servername, $username, $password, $database);
if(!$conn)
{
die("Connection failed: " . mysqli_connect_error());
}	
?>
