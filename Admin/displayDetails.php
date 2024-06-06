<?php
session_start();
if(!isset($_SESSION['Username'])){
    header('location:login.php');
}
?>

<!DOCTYPE html>
<head>
    
    <title>Details </title>

    <link rel="stylesheet" type="text/css" href="style.css">  

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"> </script>

</head>
<body>
    <div class="menu">
      <img src="../image/logo.PNG" height="150px" width="100%">

        
        <a href="dashboard.php"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
        <a  class="active" href="Book.php"><i class="fa fa-soccer-ball-o"></i> Book</a>
        <a  href="gallery.php"><i class="fa fa-picture-o"></i> Gallery</a>
        <a  href="Team.php"><i class="fa fa-group"></i> Team</a>
        <a href="User.php"><i class="fa fa-user"></i> Users</a>
        <a  href="Contact.php"><i class="fa fa-envelope"></i> Messages </a>  
        <a href="Report.php"><i class="fa fa-wallet"></i> Collection </a>   
      </div>


    <div class="fixedmenu">
        <div class="header"> <i class="fa fa-portrait "> Details</i></a></div> 
          
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
        
            <?php
                  include_once("config.php");
                  $id=$_REQUEST['id'];
                  // create a query
                  $sql="SELECT * FROM Book AS b
                  INNER JOIN userlogin AS u
                  ON b.USER_ID=u.USER_ID
                  WHERE Book_Id='$id'";
                  //execute query
                  $result=mysqli_query($conn,$sql);
                    $count=1;
                  if($result){                 
                  while($row=mysqli_fetch_assoc($result)){?>
                 
                <p><strong>User ID: </strong><?php echo $row["User_ID"]?></p>
                <p><strong>Name: </strong><?php echo $row["Name"]; ?></p>
                <p><strong>Phone Number: </strong><?php echo $row["Phone"]; ?></p>
                <p><strong>Gmail: </strong><?php echo $row["Gmail"]; ?> </p>
                <p><strong>Date: </strong><?php echo $row["Day"]; ?></p>
                <p><strong>Starting Time: </strong><?php echo $row["startTime"]; ?></p>
                <p><strong>End Time: </strong><?php echo $row["endTime"]; ?></p>
                <p><strong>Court Location: </strong><?php echo $row["Location"]; ?></p>
                <p><strong>Amount: </strong><?php echo $row["Amount"]; ?></p>
                <p><strong>Payment Mode: </strong><?php echo $row["Payment_Mode"]; ?></p>
                <p><strong>Registered: </strong><?php echo $row["Date"]; ?></p>
                <p><strong>Message: </strong><?php echo $row["Message"]; ?></p>
                <p><strong>Status: </strong><?php echo $row["Status"]; ?></p>

              <?php 
              if($row['Status']==='Pending'){?>
                  <p> Approve <a href="confirmBook.php?id=<?php echo $row["Book_Id"]; ?>"><i class="fa fa-check-square"></i></a></p> 
            <?php }
       

              else{ 
                  echo "<p>Approved By: ".$row['ApprovedBy']."</p>";
                  }
            }
          }
      ?>
               

</div></div>
    
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