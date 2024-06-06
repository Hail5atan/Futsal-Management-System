
<!DOCTYPE html>
<html>
<head>
  <title>Court Book</title>

  <link rel="stylesheet" type="text/css" href="style/index.css">
  <link rel="stylesheet" type="text/css" href="style/book.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <style>
    body{
      background-image: url("image/grass.jpg");
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



    <div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)">Kathmandu</span> 
  <span class="dot" onclick="currentSlide(2)">Bhaktapur</span> 
  <span class="dot" onclick="currentSlide(3)">Lalitpur</span> 
</div>
<div class="slideshow-container">

<div class="mySlides fade">
<?php
  include("Admin/config.php");
  $sql="SELECT * FROM Book WHERE Location='Kathmandu'";
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
  <div class="heading">New Baneshwor, Kathmandu </div>
  <div class="bk">Click on Available court below to Book Now</div>

  <div class="court">
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
                $currDay=date('Y-m-d');
                $currTime=date("H:i:s");

                $time="06:00:00";
                for ($i=0; $i < 15; $i++) { ?>
              
                  <td><?php $time=strtotime($time); echo date('h:iA',$time); $time=date('H:i:s',$time); ?></td>
                 <?php $date=date('Y-m-d');
                  for ($j=0; $j < 7; $j++) { 

                    $Timediff=strtotime($time)-strtotime($currTime);
                    $Timediff=$Timediff/60;

                    $Datediff=strtotime($date)-strtotime($currDay);
                    $Datediff=$Datediff/(24*60*60);
                    $stat="Available";
                    if($Datediff===0 && $Timediff<30){
                        $stat="";
                      }
                     for ($k=0; $k < $count; $k++) {                      
                       if($datas[$k]['Day']===$date && $datas[$k]['startTime']===$time){
                          $stat="";
                       }
                      }

                    ?><td><?php 
                        if($stat===""){
                          echo $stat;
                        }
                        else {
                           ?><?php echo "<a href='form.php?date=".$date."&time=".$time."&Location=Kathmandu'> Available </a>";} ?></td><?php
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

<div class="mySlides fade">
  <?php
  include_once("Admin/config.php");
  $sql="SELECT * FROM Book WHERE location='Bhaktapur' ";
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
  <div class="heading">SuryaBinayak, Bhaktapur</div>
  <div class="bk">Click on Available court below to Book Now</div>
  <div class="court">
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
                $currDay=date('Y-m-d');
                $currTime=date("H:i:s");

                $time="06:00:00";
                for ($i=0; $i < 15; $i++) { ?>
              
                  <td><?php $time=strtotime($time); echo date('h:iA',$time); $time=date('H:i:s',$time); ?></td>
                 <?php $date=date('Y-m-d');
                  for ($j=0; $j < 7; $j++) { 

                    $Timediff=strtotime($time)-strtotime($currTime);
                    $Timediff=$Timediff/60;

                    $Datediff=strtotime($date)-strtotime($currDay);
                    $Datediff=$Datediff/(24*60*60);
                    $stat="Available";
                    if($Datediff===0 && $Timediff<30){
                        $stat="";
                      }
                     for ($k=0; $k < $count; $k++) {                      
                       if($datas[$k]['Day']===$date && $datas[$k]['startTime']===$time){
                          $stat="";
                       }
                      }

                    ?><td><?php 
                        if($stat===""){
                          echo $stat;
                        }
                        else {
                           ?><?php echo "<a href='form.php?date=".$date."&time=".$time."&Location=Bhaktapur'> Available </a>";} ?></td><?php
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

<div class="mySlides fade">
  <?php
  include_once("Admin/config.php");
  $sql="SELECT * FROM Book WHERE Location='Lalitpur'";

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
  <div class="heading">Gwarko, Lalitpur</div>
  <div class="bk">Click on Available court below to Book Now</div>
    <div class="court">
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
                $currDay=date('Y-m-d');
                $currTime=date("H:i:s");

                $time="06:00:00";
                for ($i=0; $i < 15; $i++) { ?>
              
                  <td><?php $time=strtotime($time); echo date('h:iA',$time); $time=date('H:i:s',$time); ?></td>
                 <?php $date=date('Y-m-d');
                  for ($j=0; $j < 7; $j++) { 

                    $Timediff=strtotime($time)-strtotime($currTime);
                    $Timediff=$Timediff/60;

                    $Datediff=strtotime($date)-strtotime($currDay);
                    $Datediff=$Datediff/(24*60*60);
                    $stat="Available";
                    if($Datediff===0 && $Timediff<30){
                        $stat="";
                      }
                     for ($k=0; $k < $count; $k++) {                      
                       if($datas[$k]['Day']===$date && $datas[$k]['startTime']===$time){
                          $stat="";
                       }
                      }

                    ?><td><?php 
                        if($stat===""){
                          echo $stat;
                        }
                        else {
                           ?><?php echo "<a href='form.php?date=".$date."&time=".$time."&Location=Lalitpur'> Available </a>";} ?></td><?php
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

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>


<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>

  </div>
  <footer>
    <div class="last">

      <h1>A.D.R Futsal</h1>
      <h3>Just Play, Forget Rest!!</h3>
      
    </div>
  </div>
  </footer>
</body>
</html>