<?php
session_start();
if(!isset($_SESSION['Username'])){
  $user=$_SESSION['Username'];
    header('location:login.php');
}
?>
<?php
  include_once("Admin/config.php");
  $username=$_SESSION['Username'];
  $sql="SELECT * FROM userlogin WHERE Username='$username'";
  $result=mysqli_query($conn,$sql);
  $datas=array();
  if(mysqli_num_rows($result)>0){                 
    while($row=mysqli_fetch_assoc($result)){
      $datas[]=$row;
    }
  }

  include_once("Admin/config.php");
  $User_ID=$datas[0]['User_ID'];
  $sql="SELECT *,COUNT(User_ID) AS court 
  FROM Book WHERE User_ID='$User_ID'";
  $result=mysqli_query($conn,$sql);
  $data=array();
  $count=0;
  if(mysqli_num_rows($result)>0){                 
    while($row=mysqli_fetch_assoc($result)){
      $data[]=$row;
      $count++;
    }
  }
?>


<!DOCTYPE html>
<html>
<head>
	<title>My Profile</title>
  
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
				<li><a href="AboutUs.php"><i class="fa fa-group"></i> About Us</a></li>
				<li><a href="Contact.php"><i class="fa fa-envelope"></i> Contact Us</a></li>    
        <li><a class="active" href="Profile.php"><i class="fa fa-user"></i> Profile</a></li>    
			</ul></div>
		</div>

  <div class="profile">
  	<p><h1><strong><u>My Profile </u></strong></h1></p><br>

    <p><strong>Name: </strong><?php echo $datas[0]['Name']; ?> </p><br>
    <p><strong>Username: </strong><?php echo $datas[0]['Username']; ?> </p><br>
  	<p><strong>Phone: </strong><?php echo $datas[0]['Phone']; ?></p><br>
  	<p><strong>Gmail: </strong> <?php echo $datas[0]['Gmail']; ?></p><br>
  	<p><strong>No. of Court Booked: </strong> <?php echo $data[0]['court']; ?></p><br>
    <?php if ($data[0]['court']!=0) { ?>
  	<table border="2px" style="font-size:25px; text-align:center; padding:2px; margin-bottom: 20px;">
  		<thead>
              <tr>
                <th>Id</th>
                <th>Court Location</th>
                <th>Time Slot</th>
                <th>Amount</th>
                <th>Payment Mode</th>
                <th>Message</th>
                <th>Status</th>
                <th>Registered</th>
                <th colspan="2">Action</th>

              </tr>
            </thead>
  		<tbody>
            <?php
                  include_once("Admin/config.php");
                  // create a query
                  $sql="SELECT * FROM Book AS b
                  INNER JOIN userlogin AS u
                  ON b.User_ID=u.User_ID
                  WHERE b.User_ID='$User_ID' ORDER BY Date desc";
                  //execute query
                  $result=mysqli_query($conn,$sql);
                    $count=1;
                  if($result){                 
                  while($row=mysqli_fetch_assoc($result)){?>
                 
                <td><?php echo $count; ?></td>
                    <td><?php echo $row["Location"]; ?></td>
                <td><?php echo $row["Day"].","; ?><br>
                <?php echo $row["startTime"]." - ".$row["endTime"]; ?></td>
                <td><?php echo $row["Amount"]; ?></td>
                <td><?php echo $row["Payment_Mode"]; ?></td>
                <td><?php echo $row["Message"]; ?></td>
                <td><?php echo $row["Status"]; ?></td>
                <td><?php echo $row["Date"];?></td>

                <td>
                  <?php 
                    if($row["Status"] == 'Pending'){?>
                      Delete <br><a href="deleteRequest.php?id=<?php echo $row["Book_Id"]; ?>" style="color:black;"><i class="fa fa-trash"></i></a>
                    <?php } ?>
                    
                </tr>
                <?php $count++;?>
                    <?php
                    }
                  }
                  ?>
                  
            </tbody>
  	</table>
<?php } ?>
    <p><strong>Edit </strong><a href="editUser.php?id=<?php echo $User_ID?>" style="color:black;"><i class="fa fa-edit"></i></a></p><br>
    <p><strong>Logout </strong><a href="logout.php" style="color:black;"><i class="fa fa-sign-out"></i></a></p>
  	

</div>


</body>
</html>