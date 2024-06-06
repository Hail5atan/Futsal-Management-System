<?php
session_start();
if(!isset($_SESSION['Username'])){
  $user=$_SESSION['Username'];
    header('location:login.php');
}
?>
<?php
  
  include_once("Admin/config.php");
  $id=$_REQUEST['id'];
  $sql="SELECT * FROM  userlogin WHERE User_ID='$id'";
  $result=mysqli_query($conn,$sql);
  if($result)
      {
        $row=mysqli_fetch_assoc($result);
      }
?>


<!DOCTYPE html>
<html>
<head>
  <title>edit Profile</title>
  
  <link rel="stylesheet" type="text/css" href="style/aboutus.css">
  <link rel="stylesheet" type="text/css" href="style/index.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body >
    <div class="main">
      <div class="menu">
      <img src="image/logo.PNG" height="80px" width="100px">
      <ul>
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="Gallery1.php"><i class="fa fa-picture-o"></i> Gallery</a></li>
        <li><a href="AboutUs.php"><i class="fa fa-group"></i> About Us</a></li>
        <li><a href="Contact.php"><i class="fa fa-envelope"></i> Contact Us</a></li>    
        <li><a class="active" href="Profile.php"><i class="fa fa-user"></i> Profile</a></li>    
      </ul></div>
    </div>

  
    <?php
    if(isset($_POST['new']))
    {
      $id = $_REQUEST['id'];
      $name = $_REQUEST['Name'];
      $phone = $_REQUEST['Phone'];
      $gmail = $_REQUEST['Gmail'];
      $username = $_REQUEST['Username'];
      $password = $_REQUEST['Password'];

        include_once("Admin/config.php");

        $update="UPDATE userlogin SET Name='$name', Phone='$phone', Gmail='$gmail', Username='$username', Password='$password' WHERE User_ID='$id' ";
        $result=mysqli_query($conn,$update);
      
        if($result){
         header("Location: Profile.php");
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
        <input name="id" type="hidden" value="<?php echo $row['User_ID'];?>" />
        Name: <input type="text" name="Name"  required value="<?php echo$row['Name'];?>" /> <br><br>

        Phone: <input type="number" name="Phone"  required value="<?php echo$row['Phone'];?>" /> <br><br>

        Gmail: <input type="text" name="Gmail"  required value="<?php echo$row['Gmail'];?>" /> <br><br>

        Username: <input type="text" name="Username" required value="<?php echo$row['Username'];?>" /> <br><br>

        Password: <input type="password" name="Password" required value="<?php echo$row['Password'];?>" /> <br><br>
            <p><input type="submit" name="submit" value=" Update"></p>
    </form>
    </div>

    <?php  }?>

</div></div>

</div>


</body>
</html>