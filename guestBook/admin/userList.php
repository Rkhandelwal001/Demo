<?
include("include/header.php");
include("include/config.php");

$select = "select id, first_name, last_name, email, password, phone, country_name, state_name, city, created_date from tbl_registration";
$result = mysqli_query($conn, $select); 
?>
<table border = "1" align = "center">
  <tr>
	  <th>Id</th>
	  <th>First Name</th>
	  <th>Last Name</th>
	  <th>Email</th>
	  <th>Password</th>
	  <th>Phone</th>
	  <th>Country</th>
	  <th>State</th>
	  <th>City</th>
	  <th>Created Date</th>
	  <th>Action</th>
  </tr>
  <tr>
    <?php while($row = mysqli_fetch_array($result)) {?>  
      <td><?php echo $row['id'] ?></td>
      <td><?php echo $row['first_name'] ?></td>
      <td><?php echo $row['last_name'] ?></td>
      <td><?php echo $row['email'] ?></td>
      <td><?php echo $row['password'] ?></td>
      <td><?php echo $row['phone'] ?></td>
      <td><?php echo $row['country_id'] ?></td>
      <td><?php echo $row['state_id'] ?></td>
      <td><?php echo $row['city'] ?></td>
      <td><?php echo $row['created_date'] ?></td>
      <td><a href="#">Edit</a>&nbsp;<a href="#">Delete</a></td>
      <?php } ?>
  </tr>  
</table>
<?
include("include/footer.php");
?>
