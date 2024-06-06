
<?php
session_start();
if(!isset($_SESSION['Username'])){
    header('location:login.php');
}
?>
<!DOCTYPE html>
<head>
  <title>Gallery</title>

    <link rel="stylesheet" type="text/css" href="style.css">  

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"> </script>

</head>
<body>
    <div class="menu">
      <img src="../image/logo.PNG" height="150px" width="100%">

        
        <a href="dashboard.php"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
        <a  href="Book.php"><i class="fa fa-soccer-ball-o"></i> Book</a>
        <a  class="active" href="gallery.php"><i class="fa fa-picture-o"></i> Gallery</a>
        <a  href="Team.php"><i class="fa fa-group"></i> Team</a>
        <a href="User.php"><i class="fa fa-user"></i> Users</a>
        <a  href="Contact.php"><i class="fa fa-envelope"></i> Messages </a> 
        <a href="Report.php"><i class="fa fa-wallet"></i> Collection </a>    
      </div>

  <div class="fixedmenu">
        <div class="header  ">Image <a href="insertImage.php"><i class="fa fa-image"> (Click To Add Image )</i></a></div> 
          
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
        <div class="info " >
          <table  border="2px">
            <thead>
              <tr>
                <th>S.N</th>
                <th>Image</th>
                <th>Topics</th>
                <th>Added By</th>
                <th>Registered Date</th>
                <th colspan="2">ACTION</th>

              </tr>
            </thead>
            <tbody>
              <tr>
            <?php
                  include_once("config.php");
                  // create a query
                  //$sql="SELECT first,last,email,course,level,status FROM record";
                  $sql="SELECT * FROM Gallery ORDER BY Gallery_Id desc";
                  //execute query
                  $result=mysqli_query($conn,$sql);
                    $count=1;
                  if($result){                 
                  while($row=mysqli_fetch_assoc($result)){?>
                  <tr>
                <td ><?php echo $count; ?></td>
                <td><?php echo '<img src="Upload/'. $row["Image"].'"height= "100" width="100" alt=" ">'; ?></td>
                <td ><?php echo $row["Topic"]; ?></td>
                <td ><?php   echo $row["Bywhom"]; ?></td> 
                <td ><?php   echo $row["Date"]; ?></td>
                <td><a href="editimage.php?id=<?php echo $row["Gallery_Id"]; ?>"><i class="fa fa-edit"></i></a></td>
                <td><a href="deleteImage.php?id=<?php echo $row["Gallery_Id"]; ?>"><i class="fa fa-trash"></i></a></td>
                    
                </tr>
                <?php $count++;?>
                    <?php
                    }
                  }
                  ?>
                  </tr>
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