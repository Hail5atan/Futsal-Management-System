<?php
include("Admin/config.php");
$id=$_GET['id'];
$query = "DELETE FROM Book WHERE Book_Id=$id";
if(mysqli_query($conn,$query))
	header ("Location: Profile.php");   

else
	echo "Error".mysqli_error($conn);

?>