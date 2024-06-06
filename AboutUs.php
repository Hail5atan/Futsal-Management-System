
<!DOCTYPE html>
<html>
<head>
	<title>About Us</title>
  
  <link rel="stylesheet" type="text/css" href="style/aboutus.css">
	<link rel="stylesheet" type="text/css" href="style/index.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body >
		<div class="main">
			<div class="menu">
			<img src="image/logo.PNG" height="80px" width="100px">
			<ul>
				<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="Gallery1.php"><i class="fa fa-picture-o"></i> Gallery</a></li>
				<li><a class="active" href="AboutUs.php"><i class="fa fa-group"></i> About Us</a></li>
				<li><a href="Contact.php"><i class="fa fa-envelope"></i> Contact Us</a></li>
        <li><a href="Profile.php"><i class="fa fa-user"></i> Profile</a></li>   		
			</ul></div>
		</div>

	<div class="about-section">
  <p class="info">Welcome to A.D.R Futsal. <br>We are a growing global community of sports clubs who are ambitious to make booking courts and slots as painless as possible. We are also committed to making communication between members and clubs simple and straightforward. The A.D.R Futsal booking platform is a powerful booking system that lets club Administrators manage all aspects of their clubs facilities and bookings whilst making it really easy for members to book time slots.</p>
  <p class="info">We would be delighted to have your club join our community. Why not try our fully functioning, free (no credit card needed) 60 day trial to see what you think.</p>
  <p class="info">We're here for you, your club and your members.</p>

  <div class="infodiv">
  	<p><h1><strong><u>Futsal Detail:</u></strong></h1></p>
  	<p><img src="image/logo.PNG" height="150px" width="200px"></p>
  	<p><strong>Name: </strong>A.D.R Futsal </p>
  	<p><strong>Location: <br></strong></a>SuryaBinayak, Bhaktapur, Nepal<br> New Baneshwor, Kathmandu, Nepal<br> Gwarko, Lalitpur, Nepal </p>
  	<p><strong>Number of field: </strong> 3</p>
  	<p><strong>Facalities: </strong>Free Wifi, Cafe</p>
  	<p><strong>Contacts: </strong> 9865335689</p>
  	<pre><strong>Gmail: </strong><cite style="text-decoration: underline;">info@adrfutsal.com.np</cite></pre>
  	<table border="2px">
  		<tr>
  			<td><b>Timings</b></td>
  			<td>"Morning"<br>(6am - 10am)</td>
  			<td>"Afternoon"<br>(10am – 4pm)</td>
  			<td>"Evening"<br>(4pm – 8pm)</td>
  			<td>"Promotions"<br>(Saturdays)</td>
  		</tr>
  		<tr>
  			<td><b>Rates</b></td>
  			<td>Rs 1200</td>
  			<td>Rs 1300</td>
  			<td>Rs 1500</td>
  			<td>Rs 1400</td>
  		</tr>
  	</table>
  	<p>Share Us on: <br>
  	<div class="share">
  	 	<div class="facebook"> <a href="#"><i class="fa fa-facebook" area hidden="true"></i></a> </div>
  		<div class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></p></div>
  		<div class="instagram"><a href="#"><i class="fa fa-instagram"></i></a></p></div>
  </div>

</div>




<h1 style="text-align:center"><u><i>Our Team</i></u></h1>

<div class="row">
  <?php
    include('Admin/config.php');
    $query="SELECT * FROM Team ORDER BY Team_Id ";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0)
    {
        while($row=mysqli_fetch_array($result))
    {
    ?>
  <div class="column">
    <div class="card">
     
      
      <a href="Admin/upload/<?php echo $row['Image'] ?>"><img src="Admin/upload/<?php echo $row['Image'] ?>" width="100%" height="100%" alt="<?php echo $row['Name'] ?>"/> </a>  
      <div class="container">
        
        <h2><?php echo $row["Name"]; ?></h2>
        <p class="title"><?php echo $row["Position"]; ?></p>
        <p><?php echo $row["Address"]; ?></p>
        <p><?php echo $row["Gmail"]; ?></p>
        <p><button class="button">Contact</button></p>
        
      </div>
      
    </div>
  </div>
  <?php } } ?>
</div>


	<footer>
		<div class="last">

			<h1>A.D.R Futsal</h1>
			<h3>Just Play, Forget Rest!!</h3>
			
		</div>
	</footer>

</body>
</html>