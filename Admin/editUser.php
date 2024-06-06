<?php
session_start();
if(!isset($_SESSION['Username'])){
    header('location:Login.php');
}
?>
<?php
  
  include_once("config.php");
  $id=$_REQUEST['id'];
  $sql="SELECT * FROM  userlogin WHERE User_ID='$id'";
  $result=mysqli_query($conn,$sql);
  if($result)
      {
        $rows=mysqli_fetch_assoc($result);
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
        <div class="header">Edit User Details <i class="fa fa-user-edit "> </i></div> 
          
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
    if(isset($_POST['new']))
    {
      $id = $_REQUEST['id'];
      $name = $_REQUEST['Name'];
      $phone = $_REQUEST['Phone'];
      $gmail = $_REQUEST['Gmail'];
      $username = $_REQUEST['Username'];
      $password = $_REQUEST['Password'];

        include_once("config.php");

        $update="UPDATE userlogin SET Name='$name', Phone='$phone', Gmail='$gmail', Username='$username', Password='$password' WHERE User_ID='$id' ";
        $result=mysqli_query($conn,$update);
      
        if($result){
         header("Location: User.php");
        }
      
        else{
          echo '<script>alert("Not Updated")</script>' ;
        }
      }
    
    else {
    
    
    ?>

    <div class="profile">
        <form  name="form" method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="new" value="1"/>
        <input name="id" type="hidden" value="<?php echo $rows['User_ID'];?>" />
        Name: <input type="text" name="Name"  required value="<?php echo$rows['Name'];?>" /> <br><br>

        Phone: <input type="number" name="Phone"  required value="<?php echo$rows['Phone'];?>" /> <br><br>

        Gmail: <input type="text" name="Gmail"  required value="<?php echo$rows['Gmail'];?>" /> <br><br>

        Username: <input type="text" name="Username" required value="<?php echo$rows['Username'];?>" /> <br><br>

        Password: <input type="password" name="Password" required value="<?php echo$rows['Password'];?>" /> <br><br>
            <p><input type="submit" name="submit" value=" Update"></p>
    </form>
    </div>

    <?php  }?>

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