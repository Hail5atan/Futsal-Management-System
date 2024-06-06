  
<?php
session_start();
if(!isset($_SESSION['Username'])){
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Booking Details</title>
  <link rel="stylesheet" type="text/css" href="style.css">  
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"> </script>

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

    <div class="fixedmenu">
    <div class="header">Booking Details <i class="fa fa-soccer-ball-o"></i></div> 
          
                <div class="dropdown">
                  <?php
                  include("config.php");
                  $username=$_SESSION['Username'];
                  $sql="SELECT * FROM Team WHERE username='$username'";
                  $result=mysqli_query($conn,$sql);
                  if($result){
                    $row=mysqli_fetch_assoc($result)
                    ?><?php echo '<img src="Upload/'. $row["Image"].'" class="user " alt="$username">'; ?>
                    
                  <?php } ?><button onclick="myFunction()" class="dropbtn"><i class="fa fa-caret-down" class="dropbtn"></i></button>
                <div id="myDropdown" class="dropdown-content">
                  <a href="../index.php">Home</a>
                   <a href="logout.php">Log Out</a>
                 </div>
                </div> 
               
    </div>
    <div class="main">  
    <div class="header1"> 

      <a href="courtktm.php">Kathmandu</a> 
      <a href="courtbkt.php">Bhaktapur</a>
      <a href="courtllt.php">Lalitpur</a>
      <div class="dropdown1">
          <span class="dropbtn1"><a class="active" href="Book.php">All Details 
          <i class="fa fa-caret-down"></i></a>
        </span>
    <div class="dropdown-content1">
      <a href="#pending">Pending</a>
      <a href="#active">Active</a>
      <a href="#expired">Expired</a>
    </div>  </div> </div>      
    <div class="infodiv">
        <div class="info" id="pending" >
          <h1 style="text-decoration: underline;"> Pending Book </h1>
          <table border="2px" style="font-size:20px;">
            <thead>
              <tr>
                <th>S.N</th>
                <th>User ID</th>
                <th>User Details</th>
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
                  include_once("config.php");
                  // create a query
                  $sql="SELECT * FROM Book AS b
                  INNER JOIN userlogin AS u
                  ON b.USER_ID=u.USER_ID
                  WHERE Status='Pending' ORDER BY Day desc";
                  //execute query
                  $result=mysqli_query($conn,$sql);
                    $count=1;
                  if($result){                 
                  while($row=mysqli_fetch_assoc($result)){?>
                 
                <td><?php echo $count; ?></td>
                <td><?php echo $row["User_ID"]?></td>
                <td><?php echo $row["Name"]; ?><br>
                    <?php echo "Phone: ".$row["Phone"]; ?><br>
                    <?php echo $row["Gmail"]; ?><br>
                    <td><?php echo $row["Location"]; ?></td>
                <td><?php echo $row["Day"].","; ?><br>
                <?php echo $row["startTime"]." - ".$row["endTime"]; ?></td>
                <td><?php echo $row["Amount"]; ?></td>
                <td><?php echo $row["Payment_Mode"]; ?></td>
                <td><?php echo $row["Message"]; ?></td>
                <td><?php echo $row["Status"]; ?></td>
                <td><?php echo $row["Date"];?></td>
                  <td>Approve <br><a href="confirmBook.php?id=<?php echo $row["Book_Id"]; ?>"><i class="fa fa-check-square"></i></a>
                  <td>Delete <br><a href="deleteDetail.php?id=<?php echo $row["Book_Id"]; ?>"><i class="fa fa-trash"></i></a>
                </td>
                    
                </tr>
                <?php $count++;?>
                    <?php
                    }
                  }
                  ?>
                  
            </tbody>
          </table>
        </div>

                <div class="info " id="active" >
                  <h1 style="text-decoration: underline;">Active Book</h2>
          <table border="2px" style="font-size:20px;">
            <thead>
              <tr>
                <th>S.N</th>
                <th>User ID</th>
                <th>User Details</th>
                <th>Court Location</th>
                <th>Time Slot</th>
                <th>Amount</th>
                <th>Payment Mode</th>
                <th>Message</th>
                <th>Approved By</th>
                <th>Registered</th>
                <th colspan="2">Action</th>

              </tr>
            </thead>
            <tbody>
            <?php
                  include_once("config.php");
                  // create a query
                  $sql="SELECT * FROM Book AS b
                  INNER JOIN userlogin AS u
                  ON b.USER_ID=u.USER_ID
                  WHERE Status='Approved' ORDER BY Day desc";
                  //execute query
                  $result=mysqli_query($conn,$sql);
                    $count=1;
                  if($result){                 
                  while($row=mysqli_fetch_assoc($result)){?>
                 
                <td><?php echo $count; ?></td>
                <td><?php echo $row["User_ID"]?></td>
                <td><?php echo $row["Name"]; ?><br>
                    <?php echo "Phone: ".$row["Phone"]; ?><br>
                    <?php echo $row["Gmail"]; ?><br>
                    <td><?php echo $row["Location"]; ?></td>
                <td><?php echo $row["Day"].","; ?><br>
                <?php echo $row["startTime"]." - ".$row["endTime"]; ?></td>
                <td><?php echo $row["Amount"]; ?></td>
                <td><?php echo $row["Payment_Mode"]; ?></td>
                <td><?php echo $row["Message"]; ?></td>
                <td><?php echo $row["ApprovedBy"]; ?></td>
                <td><?php echo $row["Date"];?></td>
                <td>Expire <br><a href="expireBook.php?id=<?php echo $row["Book_Id"]; ?>"><i class="fa fa-times-circle"></i></a></td>
                  <td>Delete <br><a href="deleteDetail.php?id=<?php echo $row["Book_Id"]; ?>"><i class="fa fa-trash"></i></a>
                </td>
                    
                </tr>
                <?php $count++;?>
                    <?php
                    }
                  }
                  ?>
                  
            </tbody>
          </table>
        </div>

        <div class="info" id="expired" >
                  <h1 style="text-decoration: underline;">Expired Book</h2>
          <table border="2px" style="font-size:20px;">
            <thead>
              <tr>
                <th>S.N</th>
                <th>User ID</th>
                <th>User Details</th>
                <th>Court Location</th>
                <th>Time Slot</th>
                <th>Amount</th>
                <th>Payment Mode</th>
                <th>Message</th>
                <th>Approved By</th>
                <th>Registered</th>
                <th colspan="2">Action</th>

              </tr>
            </thead>
            <tbody>
            <?php
                  include_once("config.php");
                  // create a query
                  $sql="SELECT * FROM Book AS b
                  INNER JOIN userlogin AS u
                  ON b.USER_ID=u.USER_ID
                  WHERE Status='Expired' ORDER BY Day desc";
                  //execute query
                  $result=mysqli_query($conn,$sql);
                    $count=1;
                  if($result){                 
                  while($row=mysqli_fetch_assoc($result)){?>
                 
                <td><?php echo $count; ?></td>
                <td><?php echo $row["User_ID"]?></td>
                <td><?php echo $row["Name"]; ?><br>
                    <?php echo "Phone: ".$row["Phone"]; ?><br>
                    <?php echo $row["Gmail"]; ?><br>
                    <td><?php echo $row["Location"]; ?></td>
                <td><?php echo $row["Day"].","; ?><br>
                <?php echo $row["startTime"]." - ".$row["endTime"]; ?></td>
                <td><?php echo $row["Amount"]; ?></td>
                <td><?php echo $row["Payment_Mode"]; ?></td>
                <td><?php echo $row["Message"]; ?></td>
                <td><?php echo $row["ApprovedBy"]; ?></td>
                <td><?php echo $row["Date"];?></td>
                  <td>Delete <br><a href="deleteDetail.php?id=<?php echo $row["Book_Id"]; ?>"><i class="fa fa-trash"></i></a></td>

                    
                </tr>
                <?php $count++;?>
                    <?php
                    }
                  }
                  ?>
                  
            </tbody>
          </table>
        </div>
    </div>

    
</div>

  <script type="text/javascript">
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
</body>
</html>