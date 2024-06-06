<?php
include("config.php");
$id=$_GET['id'];
$query = "DELETE FROM Gallery WHERE Gallery_Id=$id";
if(mysqli_query($conn,$query))
	header ("Location: Gallery.php");   

else
	echo "Error".mysqli_error($conn);

?>