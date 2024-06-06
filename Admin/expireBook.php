<?php
session_start();
if(!isset($_SESSION['Username'])){
  header('location:login.php');
}

  include_once  ('config.php');
  $id=$_REQUEST['id'];
  $ApprovedBy = $_SESSION['Username'];
  $sql="SELECT Status FROM Book where Book_Id='$id'";
  $result=mysqli_query($conn,$sql);
  if($result)
  {
    $row=mysqli_fetch_assoc($result);
      
    $update="UPDATE Book SET Status='Expired' WHERE Book_Id='$id' ";
    $result=mysqli_query($conn,$update);
    
    if($result){
        header("Location: Book.php#active");
      }
      
    else{
      echo"Record not Approved".mysqli_error($conn);
    }
  }     
  ?>  