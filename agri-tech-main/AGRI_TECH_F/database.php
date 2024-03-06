<?php
$hostName= "localhost";
$dbUser="root";
$dbPassword="";
$dbName="agritech";


$mysqli= new mysqli(hostname: $hostName,
                    username: $dbUser,
                    password: $dbPassword,
                    database: $dbName
);

if ($mysqli -> connect_errno){
  die("Connection error:" .$mysqli->connect_error);
}

return $mysqli;
?>