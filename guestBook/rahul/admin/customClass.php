<?php
class GuestBook {	
function stateName($stateId)   //function for returning state name to userList
{
	include("include/config.php");  
	$selectState = "SELECT state_name from tbl_state WHERE state_id = '$stateId'";
	$resultState = mysqli_query($conn, $selectState);
	$state = mysqli_fetch_assoc($resultState);
	return $state['state_name'];
}
function countryName($countryId)   //function for returning country name to userList
{
	include("include/config.php");
	$selectCountry = "SELECT country_name from tbl_country WHERE country_id = '$countryId'";
	$resultCountry = mysqli_query($conn, $selectCountry);
	$country = mysqli_fetch_assoc($resultCountry);
	return $country['country_name'];
}
}
?>
