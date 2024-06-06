<?php
session_start();
if(!isset($_SESSION['Username'])){
  $user=$_SESSION['Username'];
    header('location:login.php');
}
?>

<?php

  include_once("Admin/config.php");
  $sql="SELECT * FROM Book ";
  $result=mysqli_query($conn,$sql);
  $datas=array();
  $count=0;
  if(mysqli_num_rows($result)>0){                 
    while($row=mysqli_fetch_assoc($result)){
      $datas[]=$row;
      $count++;
    }
  }

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
  $Day = $_POST['Day'];
  $startTime = $_POST['startTime'];
  $User_ID = $_POST['User_ID'];
  $Location = $_POST['Location'];
  $Payment_Mode= $_POST['Payment_Mode'];
  $Message = $_POST['Message'];
  $amount = $_POST['Amount'];
 

  date_default_timezone_set("Asia/Kathmandu");
  $currDay=date('Y-m-d');
  $currTime=date("H:i:s");

  $endTime = strtotime($startTime) + 1*60*60;	
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
 		$flag=0;
 		for ($k=0; $k < $count; $k++) {
 			
        	if($datas[$k]['Location']===$Location && $datas[$k]['Day']===$Day && $datas[$k]['startTime']===$startTime){
        		echo '<script>alert("No Court Available")</script>';
           	 	$flag=1;
        	}
        }
        if ($flag===0){
        
  		$sql =  "INSERT INTO Book(Day,startTime,endTime,Amount,Location,Payment_Mode,Message,User_ID) 
        Values('$Day','$startTime','$endTime','$amount','$Location','$Payment_Mode','$Message','$User_ID')";
  		$result = mysqli_query($conn,$sql);
  			
  		if($result){
    		echo '<script>alert("Form Submitted, We will contact you soon")</script>' ;
    		header('Location:Profile.php#book');
  		}
  
  		else{
  				
   			// echo "Error:".$sql . "<br>". mysqli_error($conn);
   			echo '<script>alert("Not Submitted")</script>' ;
  		}

	}
	}
  }
}

$url='image/grass.jpg';
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>FORM</title>

	<link rel="stylesheet" type="text/css" href="style/index.css">
	<link rel="stylesheet" type="text/css" href="style/form.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	<style>
		body{
			background-image: url(<?php echo $url; ?>);
			background-repeat: no-repeat;
			background-size: cover;
			background-position: cover;
		}
	</style>
</head>
<body>
	<div class="main">
			<div class="menu">
			<img src="image/logo.PNG" height="80px" width="100px">
			
			<ul>
				<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="Gallery1.php"><i class="fa fa-picture-o"></i> Gallery</a></li>
				<li><a href="AboutUs.php"><i class="fa fa-group"></i> About Us</a></li>
				<li><a href="Contact.php"><i class="fa fa-envelope"></i> Contact Us</a></li>
				<li><a href="Profile.php"><i class="fa fa-user"></i> Profile</a></li>   		
			</ul></div>



		<h1 align="center" style="font-size:55px">Futsal Booking</h1>

<?php
include_once("Admin/config.php");

$date=$_REQUEST['date'];
$time=$_REQUEST['time'];
$Location=$_REQUEST['Location'];
$User_ID=$data[0]['User_ID'];


$amount=1400;
$morning="09:00:00";
$afternoon="15:00:00";
$evening="19:00:00";
$promotion=strtotime("Saturday");
if(strtotime($date)===$promotion){
	$amount=1400;
	$offer="Saturday";
}

else if($time<=$morning)
{
	$amount=1200;
	$offer="Morning";
}

else if($time>$morning && $time<=$afternoon)
{
	$amount=1300;
	$offer="Afternoon";
}

else if($time>$afternoon && $time<=$evening)
{
	$amount=1500;
	$offer="Evening";
}
?>
	<table border="4px" align="center" class="contact">
	<form class="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

		<input type="hidden" name="User_ID" value="<?php echo $User_ID; ?>">
		<tr>
			<td>Date: </td> 
			<td><input type="hidden" name="Day" value="<?php echo $date; ?>"><?php echo $date; ?></td>
		</tr>

		<tr>
			<td>Start Time: </td> 
			<td><input type="hidden" name="startTime" value="<?php echo $time; ?>"><?php echo $time; ?></td>
		</tr>

		<tr>
			<td>Duration: </td> 
			<td><input type="hidden" name="Duration" value="1" checked>1 Hours</td>
		</tr>

		<tr>
			<td>Amount: </td> 
			<td><input type="hidden" name="Amount" value="<?php echo $amount; ?>" ><?php echo " Rs.".$amount." ' ".$offer." ' "; ?></td>
		</tr>

		<tr>
			<td>Location: </td> 
			<td><input type="hidden" name="Location" value="<?php echo $Location; ?>"><?php echo $Location; ?></td>
		</tr>


		<tr>
		<td>Mode of payment:</td>
		<td><input type="radio" name="Payment_Mode" value="Esewa" required>Esewa<br>
		<input type="radio" name="Payment_Mode" value="Cash">Cash </td>
		</tr>
			
		<tr>
			<td>Message:</td>
			<td><textarea rows="3" name="Message" value="message" ></textarea></td>
		</tr>
		
		<tr>
			<td colspan="2"><input type="submit" name="submit" value="Submit" onclick="send()">
			<input type="reset" name="reset" value="Reset"></td>
		</tr>
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



