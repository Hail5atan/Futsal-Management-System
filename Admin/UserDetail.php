<?php
session_start();
if(!isset($_SESSION['Username'])){
    header('location:login.php');
}
?>
<?php
  include_once("config.php");
  $id = $_REQUEST['id'];
  $sql="SELECT * FROM userlogin WHERE User_ID='$id'";
  $result=mysqli_query($conn,$sql);
  $datas=array();
  if(mysqli_num_rows($result)>0){                 
    while($row=mysqli_fetch_assoc($result)){
      $datas[]=$row;
    }
  }

  include_once("config.php");
  $id = $_REQUEST['id'];
  $sql="SELECT *,COUNT(User_ID) AS court 
  FROM Book WHERE User_ID='$id'";
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
<head>
    
    <title>Users Details</title>

    <link rel="stylesheet" type="text/css" href="style.css">  
    

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"> </script>


</head>
<body>
    <div class="menu">
      <img src="../image/logo.PNG" height="150px" width="100%">

        
        <a href="dashboard.php"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
        <a href="Book.php"><i class="fa fa-soccer-ball-o"></i> Book</a>
        <a href="gallery.php"><i class="fa fa-picture-o"></i> Gallery</a>
        <a href="Team.php"><i class="fa fa-group"></i> Team</a>
        <a class="active"  href="User.php"><i class="fa fa-user"></i> Users</a>
        <a href="Contact.php"><i class="fa fa-envelope"></i> Messages </a>   
        <a href="Report.php"><i class="fa fa-wallet"></i> Collection </a>  
      </div>


    <div class="fixedmenu">
        <div class="header"> <i class="fa fa-user "> </i> User Details (Edit <a href="editUser.php?id=<?php echo $datas[0]['User_ID']; ?>" style="color:black;"><i class="fa fa-edit"></i></a>)</div> 
          
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
    <div class="infodiv">
        
         <p><strong><u style="font-size:50px;">User Profile </u></strong></p>

    <p><strong>Name: </strong><?php echo $datas[0]['Name']; ?> </p>
    <p><strong>Username: </strong><?php echo $datas[0]['Username']; ?> </p>
    <p><strong>Phone: </strong><?php echo $datas[0]['Phone']; ?></p>
    <p><strong>Gmail: </strong> <?php echo $datas[0]['Gmail']; ?></p>
    <p><strong>No. of Court Booked: </strong> <?php echo $data[0]['court']; ?></p>
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
                  include_once("config.php");
                  // create a query
                  $sql="SELECT * FROM Book AS b
                  INNER JOIN userlogin AS u
                  ON b.User_ID=u.User_ID
                  WHERE b.User_ID='$id' ORDER BY Date desc";
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

                <td> Delete <br><a href="deleteDetail.php?id=<?php echo $row["Book_Id"]; ?>" style="color:black;"><i class="fa fa-trash"></i></a></td>
                  <?php 
                    if($row["Status"] == 'Pending'){?>
                      <td>Approve <br><a href="confirmBook.php?id=<?php echo $row["Book_Id"]; ?>"><i class="fa fa-check-square"></i></a></td>
                     
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