<?php
session_start();
if(!isset($_SESSION['Username'])){
  $user=$_SESSION['Username'];
    header('location:login.php');
}
?>

<?php
include("Admin/config.php");

$username=$_SESSION['Username'];
  $sql="SELECT * FROM userlogin WHERE Username='$username'";
  $result=mysqli_query($conn,$sql);
  $data=array();
  $c=0;
  if(mysqli_num_rows($result)>0){                 
    while($row=mysqli_fetch_assoc($result)){
      $data[]=$row;
      $c++;
    }
  }

if(isset($_POST['submit'])){
    $User_ID = $_POST['User_ID'];
    $Location = $_POST['Location'];
    $Message = $_POST['Message'];
    
    $sql = "INSERT INTO  feedback(User_ID,Location,Message) Values('$User_ID','$Location','$Message')";
    $result= mysqli_query($conn,$sql);
    if($result)
    {
         echo '<script>alert("Submitted")</script>' ;
    }
    else{
        echo "Error:".$sql . "<br>". mysqli_error($conn);
    }
}
    

?>
<!DOCTYPE html>
<html>
<head>
	<title>Contact Us</title>

	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style/index.css">
	<link rel="stylesheet" type="text/css" href="style/contactus.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
		<div class="main">
			<div class="menu">
			<img src="image/logo.PNG" height="80px" width="100px">
			<ul>
				<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="Gallery1.php"><i class="fa fa-picture-o"></i> Gallery</a></li>
				<li><a href="AboutUs.php"><i class="fa fa-group"></i> About Us</a></li>
				<li><a class="active" href="Contact.php"><i class="fa fa-envelope"></i>Contact Us</a></li>
				<li><a href="Profile.php"><i class="fa fa-user"></i> Profile</a></li>   		
			</ul></div>
		</div>

		<div class="ContactUs">
		<h2 > Contact Us</h2>
		<span class="border"></span>
		<div class="ps">
			<a href="#p1"><img src="image/futsal.jpg" alt="" height="300" width="350"></a>
			<a href="#p2"><img src="image/court.jpg" alt=""height="300" width="350"></a>
			<a href="#p3"><img src="image/futsal1.jpg" alt=""height="300" width="350"></a>
		</div>
		<div class="section" id="p1">
			<span class="name">Kathmandu Branch</span>
			<span class="border"></span>
			<p>
		
	<form class="contact" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		
	<fieldset >
			<legend >Contact Form</legend>
			<input type="hidden" name="User_ID" value="<?php echo $data[0]['User_ID']; ?>">
	
	<label for="FirstName">Name</label>
    <input type="text" id="Name" name="FirstName" value="<?php echo $data[0]['Name']; ?>" readonly>  <br>  

    <label for="Phone">Phone Number</label>
    <input type="Number" id="Phone" name="Phone" value="<?php echo $data[0]['Phone']; ?>" readonly>  <br> 

    <label for="Gmail">Gmail</label>
    <input type="email" id="Gmail" name="Gmail" value="<?php echo $data[0]['Gmail']; ?>" readonly>  <br>

    <label for="City">Court Location</label>
    <select id="country" name="Location">
      <option value="Kathmandu">Kathmandu</option>
      <option value="Lalitpur">Lalitpur</option>
      <option value="Bhaktapur">Bhaktapur</option>
    </select>   <br>

    <label for="subject">FeedBack*</label>
    <textarea id="subject" name="Message" placeholder="Write something.." style="height:100px" required></textarea>   <br>

    <td colspan="2"><input type="submit" name="submit" value="Submit" onclick="send()">
			<!-- <input type="reset" name="reset" value="Reset"></td></tr> -->
	</form>

	</fieldset></p>
		</div>
		
		<div class="section" id="p2">
			<span class="name">Kathmandu Branch</span>
			<span class="border"></span>
			<p>
		
	<form class="contact" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		
	<fieldset >
			<legend >Contact Form</legend>
			<input type="hidden" name="User_ID" value="<?php echo $data[0]['User_ID']; ?>">
	
	<label for="FirstName">Name</label>
    <input type="text" id="Name" name="FirstName" value="<?php echo $data[0]['Name']; ?>" readonly>  <br>  

    <label for="Phone">Phone Number</label>
    <input type="Number" id="Phone" name="Phone" value="<?php echo $data[0]['Phone']; ?>" readonly>  <br> 

    <label for="Gmail">Gmail</label>
    <input type="email" id="Gmail" name="Gmail" value="<?php echo $data[0]['Gmail']; ?>" readonly>  <br>

    <label for="City">Court Location</label>
    <select id="country" name="Location">
      <option value="Bhaktapur">Bhaktapur</option>
      <option value="Kathmandu">Kathmandu</option>
      <option value="Lalitpur">Lalitpur</option>
    </select>   <br>

    <label for="subject">FeedBack*</label>
    <textarea id="subject" name="Message" placeholder="Write something.." style="height:100px" required></textarea>   <br>

    <td colspan="2"><input type="submit" name="submit" value="Submit" onclick="send()">
			<!-- <input type="reset" name="reset" value="Reset"></td></tr> -->
	</form>

	</fieldset></p>
		</div>
	

	<div class="section" id="p3">
			<span class="name">Kathmandu Branch</span>
			<span class="border"></span>
			<p>
		
	<form class="contact" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		
	<fieldset >
			<legend >Contact Form</legend>
			<input type="hidden" name="User_ID" value="<?php echo $data[0]['User_ID']; ?>">
	
	<label for="FirstName">Name</label>
    <input type="text" id="Name" name="FirstName" value="<?php echo $data[0]['Name']; ?>" readonly>  <br>  

    <label for="Phone">Phone Number</label>
    <input type="Number" id="Phone" name="Phone" value="<?php echo $data[0]['Phone']; ?>" readonly>  <br> 

    <label for="Gmail">Gmail</label>
    <input type="email" id="Gmail" name="Gmail" value="<?php echo $data[0]['Gmail']; ?>" readonly>  <br>

    <label for="City">Court Location</label>
    <select id="country" name="Location">
      <option value="Lalitpur">Lalitpur</option>
      <option value="Kathmandu">Kathmandu</option>
      <option value="Bhaktapur">Bhaktapur</option>
    </select>   <br>

    <label for="subject">FeedBack*</label>
    <textarea id="subject" name="Message" placeholder="Write something.." style="height:100px" required></textarea>   <br>

    <td colspan="2"><input type="submit" name="submit" value="Submit" onclick="send()">
			<!-- <input type="reset" name="reset" value="Reset"></td></tr> -->
	</form>

	</fieldset></p>
		</div>
	</div>

	
<footer>
		<div class="last">

			<h1>A.D.R Futsal</h1>
			<h3>Just Play, Forget Rest!!</h3>
			
		</div>
	</div>
	</footer>

	<script type="text/javascript">
		function send() {
			alert("Are you sure");
		}
	</script>

</body>
</html>