<?php
include("config.php");
$id=$_GET['id'];
$query = "DELETE FROM Team WHERE Team_Id=$id";
if(mysqli_query($conn,$query))
	header ("Location: Team.php");   

else
	echo "Error".mysqli_error($conn);

?>