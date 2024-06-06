<?php
$conn = mysqli_connect("localhost","root","","FutsalProject");


if(!$conn){
    echo "Database not connected".mysqli_error($conn);
}else{
    // echo"database connected";
}

?>