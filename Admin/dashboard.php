<?php
session_start();
if(!isset($_SESSION['Username'])){
  $user=$_SESSION['Username'];
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
  <style>

</style>
  <title>DashBoard</title>
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
        <a href="User.php"><i class="fa fa-user"></i> Users</a>
        <a href="Contact.php"><i class="fa fa-envelope"></i> Messages </a>
        <a href="Report.php"><i class="fa fa-wallet"></i> Collection </a>   
      </div>

  <div class="fixedmenu">
    <div class="header">DashBoard <i class="fa fa-tachometer-alt"></i></div> 
          
                <div class="dropdown">
                  <?php
                  include("config.php");
                  $username=$_SESSION['Username'];
                  $sql="SELECT * FROM Team WHERE username='$username'";
                  $result=mysqli_query($conn,$sql);
                  if($result){
                    $row=mysqli_fetch_assoc($result)
                    ?><?php echo '<img src="Upload/'.$row["Image"].'" class="user " alt="$username">'; ?>
                    
                  <?php } ?><button onclick="myFunction()" class="dropbtn"><i class="fa fa-caret-down" class="dropbtn"></i></button>
                <div id="myDropdown" class="dropdown-content">
                  <a href="../index.php">Home</a>
                   <a href="logout.php">Log Out</a>
                 </div>
                </div> 
               
    </div>
        
    <div class="main">
    <div class="infodiv">

<div class="box" style="background-image: url(Upload/wallpaper.jpg);">
  <div class="boxcont">
<?php
  include_once("config.php");
  $sql="SELECT * FROM Book WHERE Status='Pending'";
  $result=mysqli_query($conn,$sql);
  $count=0;
  if($result){                 
  while($row=mysqli_fetch_assoc($result)){
    $count++;
  }}
?>
  <i class="fa fa-soccer-ball-o"></i>        
  <h3><?php echo $count ?> Pending</h3>
   <p>Click on button below to view all Pending Book.</p><br><br>
    <a href="Book.php" ><button class=" btn">View all Book</button></a>
  </div>
</div> 



<div class="box" style="background-image: url(Upload/wallpaper2.jpg);">
  <div class="boxcont">
<?php
  include_once("config.php");
  $sql="SELECT * FROM userlogin";
  $result=mysqli_query($conn,$sql);
  $count=0;
  if($result){                 
  while($row=mysqli_fetch_assoc($result)){
    $count++;
  }}
?>
  <i class="fa fa-user"></i>        
  <h3><?php echo $count ?> Users</h3>
   <p>Click on button below to view all Users.</p><br><br>
    <a href="User.php" ><button class=" btn">View all Users</button></a>
  </div>
</div> 



<div class="box" style="background-image: url(Upload/wallpaper1.jpg);">
  <div class="boxcont">
<?php
  include_once("config.php");
  $sql="SELECT * FROM feedback";
  $result=mysqli_query($conn,$sql);
  $count=0;
  if($result){                 
  while($row=mysqli_fetch_assoc($result)){
    $count++;
  }}
?>
  <i class="fa fa-envelope"></i>        
  <h3><?php echo $count ?> Messages</h3>
   <p>Click on button below to view all Messages.</p><br><br>
    <a href="Contact.php" ><button class=" btn">View all Messages</button></a>
  </div>
</div> 
      

<div class="box" style="background-image: url(Upload/wallpaper3.jpg);">
  <div class="boxcont">
<?php
  include_once("config.php");
  $sql="SELECT * FROM Gallery";
  $result=mysqli_query($conn,$sql);
  $count=0;
  if($result){                 
  while($row=mysqli_fetch_assoc($result)){
    $count++;
  }}
?>
  <i class="fa fa-photo"></i>        
  <h3><?php echo $count ?> Photos</h3>
   <p>Click on button below to view all Photos.</p><br><br>
    <a href="Gallery.php" ><button class=" btn">View all Photos</button></a>
  </div>
</div> 
    
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

  </header>
<!--   <footer>
    <div class="last">

      <h1>A.D.R Futsal</h1>
      <h3>Just Play, Forget Rest!!</h3>
      
    </div>
  </footer> -->
  

</body>
</html>