
<?php
include_once("Admin/config.php");
if(isset($_POST['submit'])){

    $Username= $_POST['Username'];
    $Password=$_POST['Password'];

    $sql = "SELECT * FROM userlogin
            where Username='$Username' AND Password= '$Password' ";
    $result= mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)==1){  
        session_start();
        $_SESSION['Username'] = $Username;
        if(isset($_POST['remember'])){
            setcookie('Username' ,$Username,time()+24*60*60);
        }
        // echo "Log In Successful.";
        header("Location:Index.php");
        
    }else{
        echo "login failed";
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}
.modal{
 position:absolute; 
  z-index:  1;
  left:   25%;
  right:  25%;
  top:  5%;
  border: 3px solid #f1f1f1;
  padding:10px;
}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}
span.psw {
  float: right;
  padding-top: 16px;
}
span.sgn{
  float:  right;
  padding-bottom: 16px;
}
 
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  height: 150px;
  width: 150px;
  border-radius: 50%;
}

.container1{
  padding-bottom: 20px;

}
.container2 {
  padding: 16px;
  background-color:#f1f1f1;
}

  
</style>
</head>
<body>

  <div class=" modal ">  

<legend><h2>User Login Form</h2> </legend>
<form name="loginForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method ="post">
  <div class="imgcontainer">
    <img src="image/logo.PNG"  alt="Avatar" class="avatar">
  </div>

  <div class="container1">
    <label for="Username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="Username" required>
    

    <label for="Password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="Password" required>
     

    <button type="submit" name="submit" value="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>

    <span class="sgn">Don't have an Account? <a href="Register.php">Sign Up</a></span>
  </div>

  <div class="container2">
    <button type="reset" class="cancelbtn">Cancel</button>
    <span class="psw"> <a href="#">Forgot password?</a></span>
  </div>
</form>
</div>

</body>
</html>