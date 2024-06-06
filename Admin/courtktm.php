  
<?php
session_start();
if(!isset($_SESSION['Username'])){
    header('location:login.php');
}
?>
<?php
  include_once("config.php");
  $sql="SELECT * FROM Book WHERE Location='Kathmandu' ";
  $result=mysqli_query($conn,$sql);
  $datas=array();
  $count=0;
  if(mysqli_num_rows($result)>0){                 
    while($row=mysqli_fetch_assoc($result)){
      $datas[]=$row;
      $count++;
    }
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
        <a  href="gallery.php"><i class="fa fa-picture-o"></i> Gallery</a>
        <a  href="Team.php"><i class="fa fa-group"></i> Team</a>
        <a href="User.php"><i class="fa fa-user"></i> Users</a>
        <a  href="Contact.php"><i class="fa fa-envelope"></i> Messages </a>   
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

      <a class="active" href="courtktm.php">Kathmandu</a> 
      <a href="courtbkt.php">Bhaktapur</a>
      <a href="courtllt.php">Lalitpur</a>
      <div class="dropdown1">
          <span class="dropbtn1"><a href="Book.php">All Details 
          <i class="fa fa-caret-down"></i></a>
        </span>
    <div class="dropdown-content1">
      <a href="Book.php#pending">Pending</a>
      <a href="Book.php#active">Active</a>
      <a href="Book.php#expired">Expired</a>
    </div>  </div> </div> 
        
    <div class="infodiv">
        <div class="info " id="all">

          <table border="2px">
            <thead>
              <tr>
                <th rowspan="2">Time</th>
                <th colspan="15">Date</th>
              </tr>
              <tr>
              <?php
                
                date_default_timezone_set("Asia/Kathmandu");
                $date=date('Y-m-d');
                for ($i=0; $i < 7; $i++) { 
              ?>
                  <th><?php echo $date ?></th>
              <?php 
                  $date=strtotime($date)+(24*60*60);
                  $date=date('Y-m-d',$date);
                  
                }

              ?>
            
              </tr>
              
            </thead>
            <tbody>
             <tr>
               <?php
                
                date_default_timezone_set("Asia/Kathmandu");
                $time="06:00:00";
                for ($i=0; $i < 15; $i++) { ?>
              
                  <td><?php $time=strtotime($time); echo date('h:iA',$time); $time=date('H:i:s',$time); ?></td>
                 <?php $date=date('Y-m-d');
                  for ($j=0; $j < 7; $j++) { 
                    $stat="";
                     for ($k=0; $k < $count; $k++) {
                      
                       if($datas[$k]['Day']===$date && $datas[$k]['startTime']===$time){
                          $id=$datas[$k]['Book_Id'];
                          $stat=$datas[$k]['Status'];
                       }
                      }

                    ?><td><?php 
                        if($stat===""){
                          echo $stat;
                        }
                        else {
                           ?><a href="displayDetails.php?id=<?php echo $id; ?>"><?php echo $stat; ?></a>
                         <?php } ?></td><?php
                    $date=strtotime($date)+(24*60*60);
                    $date=date('Y-m-d',$date);

                   }
                  ?>
             </tr>
            <?php 
                  $time=strtotime($time)+(60*60);
                  $time=date('H:i:s',$time);
                  
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