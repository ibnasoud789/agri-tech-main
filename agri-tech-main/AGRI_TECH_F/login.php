<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $mysqli = require __DIR__ . "/database.php";

  $sql = sprintf("SELECT * FROM login
                  WHERE userid='%s'",
                  $mysqli->real_escape_string($_POST["userid"]));
  $result = $mysqli -> query($sql);
  $user = $result ->fetch_assoc();

  if($user){
    if (password_verify($_POST["password"], $user["password_hash"])){
      die("Login Successful");
      header("Location: index.php");
    }
  }
}
        $is_invalid = true;

      ?>