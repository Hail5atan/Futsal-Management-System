<!DOCTYPE html>
<html>
<head>
	<title>GALLERY</title>
	<style type="text/css">
		
		h1{
			color: white;
		}
	</style>

	<link rel="stylesheet" type="text/css" href="style/index.css">
	<link rel="stylesheet" type="text/css" href="style/gallery1.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	
</head>
<body>
	<div class="main">
			<div class="menu">
			<img src="image/logo.PNG" height="80px" width="100px">
			
			<ul>
				<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a class="active" href="Gallery1.php"><i class="fa fa-picture-o"></i> Gallery</a></li>
				<li><a href="AboutUs.php"><i class="fa fa-group"></i> About Us</a></li>
				<li><a href="Contact.php"><i class="fa fa-envelope"></i> Contact Us</a></li>	
				<li><a href="Profile.php"><i class="fa fa-user"></i> Profile</a></li>   	
			</ul></div>
			<p class="pg"><u><h1>Photo Gallery</h1></u></p>
    		
	<main>

    <?php
    	include('Admin/config.php');
    	$query="SELECT Image,Topic FROM Gallery ORDER BY Gallery_Id desc LIMIT 12";
    	$result=mysqli_query($conn,$query);
    	if(mysqli_num_rows($result)>0)
    	{
    	    while($row=mysqli_fetch_array($result))
    	{
    ?>
		<div class="box">
			<a href="Admin/upload/<?php echo $row['Image'] ?>">
				<img src="Admin/upload/<?php echo $row['Image'] ?>" width="250" height="150" alt="<?php echo $row['Topic'] ?>"/> 
			</a>
		</div>

		
		<?php } } ?>
	</main>
   

</body>
</html>