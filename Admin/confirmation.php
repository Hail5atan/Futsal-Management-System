<?php
include_once("Admin/config.php");
if(isset($_POST['submit'])){
  $Name = $_POST['Name'];
  $Phone = $_POST['Phone'];
  $Email = $_POST['Email'];
  $Address= $_POST['Address'];
  $Day = $_POST['Day'];
  $startTime = $_POST['startTime'];
  $Duration = $_POST['Duration'];
  $Location = $_POST['Location'];
  $Payment_Mode= $_POST['Payment_Mode'];
  $Message = $_POST['Message'];

  date_default_timezone_set("Asia/Kathmandu");
  $currDay=date('Y-m-d');
  $currTime=date("H:i:s");

  $endTime = strtotime($startTime) + $Duration*60*60;	
  $endTime = date("H:i:s",$endTime);

  $Timediff=strtotime($startTime)-strtotime($currTime);
  $Timediff=$Timediff/60;

  $Datediff=strtotime($Day)-strtotime($currDay);
  $Datediff=$Datediff/(24*60*60);
  

  if($Datediff<0 || $Datediff>7)
  	echo '<script>alert("Please Select Between Upcoming 7 Days.")</script>' ;
  
  else {
  	if($Datediff===0 && $Timediff<30)	
  		echo '<script>alert("Please Select Time After 30 Minutes.")</script>' ;

 	else {
  		$sql =  "INSERT INTO Book(Name,Phone,Email,Address,Day,startTime,Duration,endTime,Location,Payment_Mode,Message) 
        Values('$Name','$Phone','$Email','$Address','$Day','$startTime','$Duration','$endTime','$Location','$Payment_Mode','$Message')";
  		$result = mysqli_query($conn,$sql);
  			
  		if($result)
    		header('Location:confirmation.php');
  		
  
  		else{
  			// echo "Error:".$sql . "<br>". mysqli_error($conn);
   			echo '<script>alert("Not Submitted")</script>' ;
  		}

	}
  }
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>FORM</title>

	<link rel="stylesheet" type="text/css" href="style/index.css">
	<link rel="stylesheet" type="text/css" href="style/form.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"> </script>

	<style>
		body{
			background-image: url("image/grass.jpg");
			background-repeat: no-repeat;
			background-size: 100%;
			background-position: center;
			text-align: cover;

		}
	</style>
</head>
<body>
	<div class="menu">
      <img src="../image/logo.PNG" height="150px" width="100%">

        
        <a href="dashboard.php"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
        <a class="active" href="Book.php"><i class="fa fa-soccer-ball-o"></i> Book</a>
        <a href="gallery.php"><i class="fa fa-picture-o"></i> Gallery</a>
        <a href="Team.php"><i class="fa fa-group"></i> Team</a>
        <a href="User.php"><i class="fa fa-user"></i> Users</a>
        <a href="Contact.php"><i class="fa fa-envelope"></i> Messages </a>
        <a href="Report.php"><i class="fa fa-wallet"></i> Collection </a>   
      </div>




	<table border="4px" align="center" class="contact">
		<h1 align="center">Futsal Booking</h1>
	<form class="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<tr><td>Name:</td><td><input type="text" name="Name" required></td></tr>

		<tr><td>Phone no:</td><td><input type="number" name="Phone" required></td></tr>

		<tr><td>E-mail:</td><td><input type="email" name="Email" required></td></tr>

		<tr><td>Address:</td><td><input type="text" name="Address" required></td></tr>

		<tr><td>Date: </td><td><input type="date" name="Day" placeholder="Select Upto 7 days.." required></td></tr>
		<tr>
			<td>Time: </td> 
			<td><select name="startTime">
				<option value="05:00:00" required>05:00 AM</option>
				<option value="06:00:00">06:00 AM</option>
				<option value="07:00:00">07:00 AM</option>
				<option value="08:00:00">08:00 AM</option>
				<option value="09:00:00">09:00 AM</option>
				<option value="10:00:00">10:00 AM</option>
				<option value="11:00:00">11:00 AM</option>
				<option value="12:00:00">12:00 PM</option>
				<option value="13:00:00">01:00 PM</option>
				<option value="14:00:00">02:00 PM</option>
				<option value="15:00:00">03:00 PM</option>
				<option value="16:00:00">04:00 PM</option>
				<option value="17:00:00">05:00 PM</option>
				<option value="18:00:00">06:00 PM</option>
				<option value="19:00:00">07:00 PM</option>
			</select></td>
		</tr>

		<tr>
			<td>Duration:</td>
			<td><input type="radio" name="Duration" value="1" checked>1 Hour <br>
				</td>
			
		</tr>
		
		<tr>
			<td>Court Location:</td>
			<td><select name="Location">
				<option value="Kathmandu" required>Kathmandu</option>
				<option value="Bhaktapur">Bhaktapur</option>
				<option value="Lalitpur" >Lalitpur</option>
		</select></td>
		</tr>
		
		<tr>
		<td>Mode of payment:</td>
		<td><input type="radio" name="Payment_Mode" value="Online" required>Online Payment<br>
		<input type="radio" name="Payment_Mode" value="Cash">Cash in Hand<td>
		</tr>
			
		<tr>
			<td>Message:</td>
			<td><textarea rows="3" name="Message" value="message" ></textarea></td>
		</tr>
		
		<tr>
			<td colspan="2"><input type="submit" name="submit" value="Submit" onclick="send()">
			<input type="reset" name="reset" value="Reset"></td></tr>
		</form>


</table>
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



