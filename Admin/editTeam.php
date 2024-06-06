<?php
session_start();
if(!isset($_SESSION['Username'])){
    header('location:login.php');
}
?>

<!DOCTYPE html>
<head>
    
    <title>Edit Team </title>

    <link rel="stylesheet" type="text/css" href="style.css">  

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"> </script>

</head>
<body>
    <div class="menu">
      <img src="../image/logo.PNG" height="150px" width="100%">

        <a  href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>
        <a  href="Book.php"><i class="fa fa-soccer-ball-o"></i> Book</a>
        <a  href="gallery.php"><i class="fa fa-picture-o"></i> Gallery</a>
        <a  class="active" href="Team.php"><i class="fa fa-group"></i> Team</a>
        <a href="User.php"><i class="fa fa-user"></i> Users</a>
        <a  href="Contact.php"><i class="fa fa-envelope"></i> Messages </a>   
        <a href="Report.php"><i class="fa fa-wallet"></i> Collection </a>  
      </div>


    <div class="fixedmenu">
        <div class="header"> <i class="fa fa-user "> Edit Team</i></a></div> 
          
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
      include_once  ('config.php');
      $id=$_REQUEST['id'];
      $uname=$_SESSION['Username'];
      $sql="SELECT * FROM Team AS t
      INNER JOIN Login AS l
      ON t.username = l.Username
      WHERE Team_Id='$id'";
      $result=mysqli_query($conn,$sql);
      if($result)
      {
        $row=mysqli_fetch_assoc($result);
      }
    ?>
    
    <?php
    if(isset($_POST['new']))
    {
      $id = $_REQUEST['id'];
      $image = $_FILES["file"]["name"];
      $name = $_REQUEST['name'];
      $position = $_REQUEST['position'];
      $address = $_REQUEST['address'];
      $gmail = $_REQUEST['gmail'];
      $password = $_REQUEST['password'];
      $username = $_REQUEST['username'];

      $update="UPDATE Team SET Image='$image' ,Name='$name', position='$position', Address='$address', Gmail='$gmail' WHERE Team_Id='$id' ";
      $result=mysqli_query($conn,$update);

      if($result){
        if($uname == $username){
          $update="UPDATE Login SET Password='$password' WHERE Username='$uname' ";
          $result=mysqli_query($conn,$update);

          if($result)
            header("Location: Team.php");
        }
        else{
          header("Location: Team.php");
        }
      }
      else{
        echo"Record not Updated".mysqli_error($conn);
      }
    }
    
    else{
    ?>

        <div>
        <form  name="form" method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="new" value="1"/>
        <input name="id" type="hidden" value="<?php echo $row['Team_Id'];?>" />
        <p><?php echo '<img src="Upload/'. $row["Image"].'"height= "100" width="100" alt=" ">'; ?>
        <input type="file" name="file"  required value="<?php echo$row['Image'];?>" /></p>
        Name: <input type="text" name="name"  required value="<?php echo$row['Name'];?>" /> <br><br>
        Position: <input type="text" name="position"  required value="<?php echo$row['Position'];?>" /> <br><br>
        Address: <input type="text" name="address"  required value="<?php echo$row['Address'];?>" /> <br><br>
        Gmail: <input type="text" name="gmail"  required value="<?php echo$row['Gmail'];?>" /> <br><br>
        

        <?php if ($uname == $row['username'] ){
          ?>
          Username: <input type="text" name="username"  readonly value="<?php echo $row['username'];?>" /> <br><br>
          Password: <input type="password" name="password"  required value="<?php echo $row['Password'];?>" /> <br><br>
          <?php } 
          else{?>
              <input type="hidden" name="username" value="<?php echo $row['username'];?>" />
              <input type="hidden" name="password" value="<?php echo $row['Password'];?>" />
            <?php } ?>
            <p><input type="submit" name="submit" value=" Update"></p>
    </form>
    </div>

    <?php } ?>

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