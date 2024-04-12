<?php 

$servername = "localhost";
$username = "root";
$password = "";
$database = "krishi_bandhan";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}
else{
    echo "<script>console.log('Database Connected successfully');</script>";
    echo("");
}

?>