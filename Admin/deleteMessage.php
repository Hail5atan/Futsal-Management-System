<?php
include("config.php");
$id=$_GET['id'];
$query = "DELETE FROM ContactUs WHERE Contact_Id=$id";
if(mysqli_query($conn,$query))
	header ("Location: Contact.php");   

else
	echo "Error".mysqli_error($conn);

?>