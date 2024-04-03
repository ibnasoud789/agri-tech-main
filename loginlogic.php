<?php
    include("database.php");
    if(isset($_POST['submit'])){
      $id=$_POST['userid'];
      $password=$_POST['password'];

      $sql = "select * from login where userid='$id' and password = '$password'";
      $result= mysqli_query($conn, $sql);
      $row= mysqli_fetch_array($result, MYSQLI_ASSOC);
      $count= mysqli_num_rows($result);
      if($count==1){
        header("Location:farmer.html");
      }
      else{
        echo '<script>
          alert("Login Failed!")
          </script>';
      }

    } 










?>