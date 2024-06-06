
<?php
$errUsername = $errPassword =  " ";
if(isset($_POST['submit'])){
    $Username= $_POST['Username'];
    $Password = $_POST['Password'];
    

    if(empty($Username) && empty($Password)){
        $errUsername ="Enter Your Name";
        $errPassword = "Enter  Your password";
    }else{
        include_once("config.php");
        $sql = "INSERT INTO login(Username,Password)
        Values('$Username','$Password')";
        $result = mysqli_query($conn,$sql);
        if($result){
            // echo"New Record is uploaded";
            header("Location: Login.php");
        }else{
            "Record not uploaded".mysqli_error($conn);
        }
    }
}

?>


<!DOCTYPE html>
<html>
<style>
body {
    margin: 30px 30px;
    padding: 50px;
    font-family: Arial, Helvetica, sans-serif;
}
* {
    box-sizing: border-box
}
.modal{
  position:absolute ; 
  z-index:  1;
  left:   25%;
  right:  25%;
  top:  5%;
  border: 3px solid #f1f1f1;
  padding:10px;
}


/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}
span.psw {
  float: right;
  padding-top: 16px;
}
/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>
<body>
  <div class="modal">
<form name="loginForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method ="post" style="border:1px solid #ccc">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="Username"><b>Username</b></label>
    <input type="text" placeholder="Enter username" name="Username" required>

    <label for="Password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="Password" required>

    <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>
    <span class="psw">Already have an Account? <a href="Login.php" style="color:dodgerblue">Log In</a></span>
    
    
    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button type="reset" name="reset" value="reset" class="cancelbtn">Cancel</button>
      <button type="submit" name="submit" value="submit" class="signupbtn">Sign Up</button>
    </div>
  </div>
</form>

</div>
</body>
</html>
