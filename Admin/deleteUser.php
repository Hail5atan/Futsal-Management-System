<?php
include("config.php");
$id=$_GET['id'];
$query = "DELETE FROM userlogin WHERE User_ID=$id";
if(mysqli_query($conn,$query))
	header ("Location: Team.php");   

else
	// echo "Error".mysqli_error($conn);

?>