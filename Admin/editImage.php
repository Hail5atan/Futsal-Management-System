
<?php
session_start();
if(!isset($_SESSION['Username'])){
    header('location:login.php');
}
?>

<!DOCTYPE html>
<head>
    
    <title>Edit Gallery </title>
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
      <div class="header  "><i class="fa fa-image"> Edit Gallery</i></a></div> 
          
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
      $sql="SELECT * FROM Gallery where Gallery_Id='$id'";
      $result=mysqli_query($conn,$sql);
      if($result)
      {
        $row=mysqli_fetch_assoc($result);
      }
    ?>
    
    <?php
    if(isset($_POST['new']))
    {
      $id=$_REQUEST['id'];
      $image=$_FILES["file"]["name"];
      $topic=$_REQUEST['topic'];
      $Bywhom = $_SESSION['Username'];

      $update="UPDATE Gallery set Image='$image' ,Topic='$topic', Bywhom='$Bywhom' where Gallery_Id='$id' ";
      $result=mysqli_query($conn,$update);
      if($result){
        header("Location: Gallery.php");
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
        <input name="id" type="hidden" value="<?php echo $row['Gallery_Id'];?>" />
        <p><?php echo '<img src="Upload/'. $row["Image"].'"height= "100" width="100" alt=" ">'; ?></p>
        <input type="file" name="file"  required value="<?php echo$row['Image'];?>" />
        Topic: <input type="text" name="topic"  required value="<?php echo$row['Topic'];?>" />
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