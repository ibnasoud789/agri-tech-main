<?php
$hostName= "localhost";
$dbUser="root";
$dbPassword="";
$dbName="practise2";
$conn = new mysqli($hostName,$dbUser,$dbPassword,$dbName,4306);

if ($conn -> connect_error){
  die("Connection error:" .$conn->connect_error);
}

echo"";
