<?php
include("config.php");
$id=$_GET['id'];
$query = "DELETE FROM Book WHERE Book_Id=$id";
if(mysqli_query($conn,$query))
	header ("Location: Book.php#pending");   

else
	echo "Error".mysqli_error($conn);

?>