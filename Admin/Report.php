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
  <title>Collection</title>
  <link rel="stylesheet" type="text/css" href="style.css">  
  <link rel="stylesheet" type="text/css" href="report.css">  

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
        <a class="active" href="Report.php"><i class="fa fa-wallet"></i> Collection </a>   
      </div>

  <div class="fixedmenu">
    <div class="header">Collection <i class="fa fa-wallet"></i></div> 
          
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
           
    <?php
    if(isset($_POST['submit']))
    {
      $date=$_POST['date'];
      echo $date;

      if($date){
        header("Location: reportsearch.php?date=$date");
      }
      
    }
    ?>
    <div class="header1"> 

      <div class="search-container">
  <form class="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <input type="date" value="date" name="date">
      <button type="submit" name="submit" value="submit"><i class="fa fa-search"></i></button>
    </form>
  </div></a>
      <div class="dropdown1">
          <span class="dropbtn1"><a class="active" href="Report.php#all">All Courts
          <i class="fa fa-caret-down"></i></a>
        </span>
    <div class="dropdown-content1">
      <a href="#Kathmandu">Kathmandu</a>
      <a href="#Bhaktapur">Bhaktapur</a>
      <a href="#Lalitpur">Lalitpur</a>
    </div>  </div> </div> 

    <div class="infodiv">
      <div class="info " id="#all" >
       <h1 style="text-decoration: underline;">All Court</h2>

<div class="amtbox" style="background-color: whitesmoke;">

  <div class="amtboxcont">
<div class="info"> 
  <h1 style="text-decoration: underline;"> Daily</h1> 

 
          <table border="2px" style="font-size:20px;">
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>

              </tr>
            </thead>
            <tbody>
            <?php
                  include_once("config.php");
                    date_default_timezone_set("Asia/Kathmandu");
                    $today= date('Y-m-d');
                    
                  // create a query
                  $sql="SELECT Day, SUM(Amount) As Total FROM Book WHERE Status != 'Pending' AND Day='$today'";
                  //execute query
                  $result=mysqli_query($conn,$sql);
                  if($result){                 
                  while($row=mysqli_fetch_assoc($result)){?>
                 <tr>
                <td><?php echo date('jS \of F Y',strtotime($today)); ?></td>
                <td><?php echo $row["Total"]; ?></td>
                    
                </tr>
                    <?php
                    }
                  }
                  ?>
                  
            </tbody>
          </table>
        </div> </div>
      </div>


<div class="amtbox" style="background-color: whitesmoke;">

  <div class="amtboxcont">
<div class="info" id="#today"> 
  <h1 style="text-decoration: underline;"> Weekly</h1> 

 
          <table border="2px" style="font-size:20px;">
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>

              </tr>
            </thead>
            <tbody>
            <?php
                  include_once("config.php");
                    date_default_timezone_set("Asia/Kathmandu");
                      $today=date('Y-m-d');
                      $firstDay = strtotime("Last Sunday");
                      $lastDay = strtotime("+6 days",$firstDay);

                      $firstDay = date('Y-m-d',$firstDay);
                      $lastDay = date('Y-m-d',$lastDay);

                    
                  // create a query
                  $sql="SELECT Day, SUM(Amount) As Total FROM Book WHERE Status != 'Pending' AND Day BETWEEN '$firstDay' AND '$lastDay'";
                  //execute query
                  $result=mysqli_query($conn,$sql);
                  if($result){                 
                  while($row=mysqli_fetch_assoc($result)){?>
                 <tr>
                <td><?php echo date('jS M\-',strtotime($firstDay)).date('jS M Y ',strtotime($lastDay)); ?></td>
                <td><?php echo $row["Total"]; ?></td>
                    
                </tr>
                    <?php
                    }
                  }
                  ?>
                  
            </tbody>
          </table>
        </div> </div>
      </div>

<div class="amtbox" style="background-color: whitesmoke;">
  <div class="amtboxcont">

        <div class="info" id="#today"> 

          <h1 style="text-decoration: underline;"> Monthly </h1>
          <table border="2px" style="font-size:20px;">
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>

              </tr>
            </thead>
            <tbody>
            <?php
                  include_once("config.php");
                    date_default_timezone_set("Asia/Kathmandu");
                    $today=date('Y-m-d');
                      // $query_date = '2010-02-04';

                      $firstDay = date('Y-m-01', strtotime($today));
                     
                      $lastDay = strtotime("+1 months -1 days",strtotime($firstDay));
                    $lastDay = date('Y-m-d',$lastDay);


                    
                  // create a query
                  $sql="SELECT Day, SUM(Amount) As Total FROM Book WHERE Status != 'Pending' AND Day BETWEEN '$firstDay' AND '$lastDay'";
                  //execute query
                  $result=mysqli_query($conn,$sql);
                  if($result){                 
                  while($row=mysqli_fetch_assoc($result)){?>
                 <tr>
                <td><?php echo date('F Y',strtotime($firstDay)) ?></td>
                <td><?php echo $row["Total"]; ?></td>
                    
                </tr>
                    <?php
                    }
                  }
                  ?>
                  
            </tbody>
          </table>
        </div>
  </div></div>

        <div class="info " id="Kathmandu" >
       <h1 style="text-decoration: underline;">Kathmandu</h2>

<div class="amtbox" style="background-color: whitesmoke;">

  <div class="amtboxcont">
<div class="info"> 
  <h1 style="text-decoration: underline;"> Daily</h1> 

 
          <table border="2px" style="font-size:20px;">
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>

              </tr>
            </thead>
            <tbody>
            <?php
                  include_once("config.php");
                    date_default_timezone_set("Asia/Kathmandu");
                    $today= date('Y-m-d');
                    
                  // create a query
                  $sql="SELECT Day, SUM(Amount) As Total FROM Book WHERE Status != 'Pending' AND Location='Kathmandu' AND Day='$today'";
                  //execute query
                  $result=mysqli_query($conn,$sql);
                  if($result){                 
                  while($row=mysqli_fetch_assoc($result)){?>
                 <tr>
                <td><?php echo date('jS \of F Y',strtotime($today)); ?></td>
                <td><?php echo $row["Total"]; ?></td>
                    
                </tr>
                    <?php
                    }
                  }
                  ?>
                  
            </tbody>
          </table>
        </div> </div>
      </div>


<div class="amtbox" style="background-color: whitesmoke;">

  <div class="amtboxcont">
<div class="info" id="#today"> 
  <h1 style="text-decoration: underline;"> Weekly</h1> 

 
          <table border="2px" style="font-size:20px;">
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>

              </tr>
            </thead>
            <tbody>
            <?php
                  include_once("config.php");
                    date_default_timezone_set("Asia/Kathmandu");
                      $today=date('Y-m-d');
                      $firstDay = strtotime("Last Sunday");
                      $lastDay = strtotime("+6 days",$firstDay);

                      $firstDay = date('Y-m-d',$firstDay);
                      $lastDay = date('Y-m-d',$lastDay);

                    
                  // create a query
                  $sql="SELECT Day, SUM(Amount) As Total FROM Book WHERE Status != 'Pending' AND Location='Kathmandu' AND Day BETWEEN '$firstDay' AND '$lastDay'";
                  //execute query
                  $result=mysqli_query($conn,$sql);
                  if($result){                 
                  while($row=mysqli_fetch_assoc($result)){?>
                 <tr>
                <td><?php echo date('jS M\-',strtotime($firstDay)).date('jS M Y ',strtotime($lastDay)); ?></td>
                <td><?php echo $row["Total"]; ?></td>
                    
                </tr>
                    <?php
                    }
                  }
                  ?>
                  
            </tbody>
          </table>
        </div> </div>
      </div>

<div class="amtbox" style="background-color: whitesmoke;">
  <div class="amtboxcont">

        <div class="info" id="#today"> 

          <h1 style="text-decoration: underline;"> Monthly </h1>
          <table border="2px" style="font-size:20px;">
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>

              </tr>
            </thead>
            <tbody>
            <?php
                  include_once("config.php");
                    date_default_timezone_set("Asia/Kathmandu");
                    $today=date('Y-m-d');
                      // $query_date = '2010-02-04';

                      $firstDay = date('Y-m-01', strtotime($today));
                     
                      $lastDay = strtotime("+1 months -1 days",strtotime($firstDay));
                    $lastDay = date('Y-m-d',$lastDay);


                    
                  // create a query
                  $sql="SELECT Day, SUM(Amount) As Total FROM Book WHERE Status != 'Pending' AND Location='Kathmandu' AND Day BETWEEN '$firstDay' AND '$lastDay'";
                  //execute query
                  $result=mysqli_query($conn,$sql);
                  if($result){                 
                  while($row=mysqli_fetch_assoc($result)){?>
                 <tr>
                <td><?php echo date('F Y',strtotime($firstDay)) ?></td>
                <td><?php echo $row["Total"]; ?></td>
                    
                </tr>
                    <?php
                    }
                  }
                  ?>
                  
            </tbody>
          </table>
        </div>
  </div></div>

        <div class="info " id="Bhaktapur" >
       <h1 style="text-decoration: underline;">Bhaktapur</h2>

<div class="amtbox" style="background-color: whitesmoke;">

  <div class="amtboxcont">
<div class="info"> 
  <h1 style="text-decoration: underline;"> Daily</h1> 

 
          <table border="2px" style="font-size:20px;">
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>

              </tr>
            </thead>
            <tbody>
            <?php
                  include_once("config.php");
                    date_default_timezone_set("Asia/Kathmandu");
                    $today= date('Y-m-d');
                    
                  // create a query
                  $sql="SELECT Day, SUM(Amount) As Total FROM Book WHERE Status != 'Pending' AND Location='Bhaktapur' AND Day='$today'";
                  //execute query
                  $result=mysqli_query($conn,$sql);
                  if($result){                 
                  while($row=mysqli_fetch_assoc($result)){?>
                 <tr>
                <td><?php echo date('jS \of F Y',strtotime($today)); ?></td>
                <td><?php echo $row["Total"]; ?></td>
                    
                </tr>
                    <?php
                    }
                  }
                  ?>
                  
            </tbody>
          </table>
        </div> </div>
      </div>


<div class="amtbox" style="background-color: whitesmoke;">

  <div class="amtboxcont">
<div class="info" id="#today"> 
  <h1 style="text-decoration: underline;"> Weekly</h1> 

 
          <table border="2px" style="font-size:20px;">
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>

              </tr>
            </thead>
            <tbody>
            <?php
                  include_once("config.php");
                    date_default_timezone_set("Asia/Kathmandu");
                      $today=date('Y-m-d');
                      $firstDay = strtotime("Last Sunday");
                      $lastDay = strtotime("+6 days",$firstDay);

                      $firstDay = date('Y-m-d',$firstDay);
                      $lastDay = date('Y-m-d',$lastDay);

                    
                  // create a query
                  $sql="SELECT Day, SUM(Amount) As Total FROM Book WHERE Status != 'Pending' AND Location='Bhaktapur' AND Day BETWEEN '$firstDay' AND '$lastDay'";
                  //execute query
                  $result=mysqli_query($conn,$sql);
                  if($result){                 
                  while($row=mysqli_fetch_assoc($result)){?>
                 <tr>
                <td><?php echo date('jS M\-',strtotime($firstDay)).date('jS M Y ',strtotime($lastDay)); ?></td>
                <td><?php echo $row["Total"]; ?></td>
                    
                </tr>
                    <?php
                    }
                  }
                  ?>
                  
            </tbody>
          </table>
        </div> </div>
      </div>

<div class="amtbox" style="background-color: whitesmoke;">
  <div class="amtboxcont">

        <div class="info" id="#today"> 

          <h1 style="text-decoration: underline;"> Monthly </h1>
          <table border="2px" style="font-size:20px;">
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>

              </tr>
            </thead>
            <tbody>
            <?php
                  include_once("config.php");
                    date_default_timezone_set("Asia/Kathmandu");
                    $today=date('Y-m-d');
                      // $query_date = '2010-02-04';

                      $firstDay = date('Y-m-01', strtotime($today));
                     
                      $lastDay = strtotime("+1 months -1 days",strtotime($firstDay));
                    $lastDay = date('Y-m-d',$lastDay);


                    
                  // create a query
                  $sql="SELECT Day, SUM(Amount) As Total FROM Book WHERE Status != 'Pending' AND Location='Bhaktapur' AND Day BETWEEN '$firstDay' AND '$lastDay'";
                  //execute query
                  $result=mysqli_query($conn,$sql);
                  if($result){                 
                  while($row=mysqli_fetch_assoc($result)){?>
                 <tr>
                <td><?php echo date('F Y',strtotime($firstDay)) ?></td>
                <td><?php echo $row["Total"]; ?></td>
                    
                </tr>
                    <?php
                    }
                  }
                  ?>
                  
            </tbody>
          </table>
        </div>
  </div></div>

        <div class="info " id="Lalitpur" >
       <h1 style="text-decoration: underline;">Lalitpur</h2>

<div class="amtbox" style="background-color: whitesmoke;">

  <div class="amtboxcont">
<div class="info"> 
  <h1 style="text-decoration: underline;"> Daily</h1> 

 
          <table border="2px" style="font-size:20px;">
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>

              </tr>
            </thead>
            <tbody>
            <?php
                  include_once("config.php");
                    date_default_timezone_set("Asia/Kathmandu");
                    $today= date('Y-m-d');
                    
                  // create a query
                  $sql="SELECT Day, SUM(Amount) As Total FROM Book WHERE Status != 'Pending' AND Location='Lalitpur' AND Day='$today'";
                  //execute query
                  $result=mysqli_query($conn,$sql);
                  if($result){                 
                  while($row=mysqli_fetch_assoc($result)){?>
                 <tr>
                <td><?php echo date('jS \of F Y',strtotime($today)); ?></td>
                <td><?php echo $row["Total"]; ?></td>
                    
                </tr>
                    <?php
                    }
                  }
                  ?>
                  
            </tbody>
          </table>
        </div> </div>
      </div>


<div class="amtbox" style="background-color: whitesmoke;">

  <div class="amtboxcont">
<div class="info" > 
  <h1 style="text-decoration: underline;"> Weekly</h1> 

 
          <table border="2px" style="font-size:20px;">
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>

              </tr>
            </thead>
            <tbody>
            <?php
                  include_once("config.php");
                    date_default_timezone_set("Asia/Kathmandu");
                      $today=date('Y-m-d');
                      $firstDay = strtotime("Last Sunday");
                      $lastDay = strtotime("+6 days",$firstDay);

                      $firstDay = date('Y-m-d',$firstDay);
                      $lastDay = date('Y-m-d',$lastDay);

                    
                  // create a query
                  $sql="SELECT Day, SUM(Amount) As Total FROM Book WHERE Status != 'Pending' AND Location='Lalitpur' AND Day BETWEEN '$firstDay' AND '$lastDay'";
                  //execute query
                  $result=mysqli_query($conn,$sql);
                  if($result){                 
                  while($row=mysqli_fetch_assoc($result)){?>
                 <tr>
                <td><?php echo date('jS M\-',strtotime($firstDay)).date('jS M Y ',strtotime($lastDay)); ?></td>
                <td><?php echo $row["Total"]; ?></td>
                    
                </tr>
                    <?php
                    }
                  }
                  ?>
                  
            </tbody>
          </table>
        </div> </div>
      </div>

<div class="amtbox" style="background-color: whitesmoke;">
  <div class="amtboxcont">

        <div class="info" > 

          <h1 style="text-decoration: underline;"> Monthly </h1>
          <table border="2px" style="font-size:20px;">
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>

              </tr>
            </thead>
            <tbody>
            <?php
                  include_once("config.php");
                    date_default_timezone_set("Asia/Kathmandu");
                    $today=date('Y-m-d');
                      // $query_date = '2010-02-04';

                      $firstDay = date('Y-m-01', strtotime($today));
                     
                      $lastDay = strtotime("+1 months -1 days",strtotime($firstDay));
                    $lastDay = date('Y-m-d',$lastDay);


                    
                  // create a query
                  $sql="SELECT Day, SUM(Amount) As Total FROM Book WHERE Status != 'Pending' AND Location='Lalitpur' AND Day BETWEEN '$firstDay' AND '$lastDay'";
                  //execute query
                  $result=mysqli_query($conn,$sql);
                  if($result){                 
                  while($row=mysqli_fetch_assoc($result)){?>
                 <tr>
                <td><?php echo date('F Y',strtotime($firstDay)) ?></td>
                <td><?php echo $row["Total"]; ?></td>
                    
                </tr>
                    <?php
                    }
                  }
                  ?>
                  
            </tbody>
          </table>
        </div>
  </div></div>
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

  </header>
<!--   <footer>
    <div class="last">

      <h1>A.D.R Futsal</h1>
      <h3>Just Play, Forget Rest!!</h3>
      
    </div>
  </footer> -->
  

</body>
</html>