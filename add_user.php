<?php

include 'admin.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST['userID'];
    $Area = $_POST['Area'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];
    $contact_number = $_POST['contact_number'];
    $user_type = $_POST['user_type'];

    $sql = "INSERT INTO user (userID, Area, city, postcode, contact_number, user_type) VALUES ('$userID', '$Area', '$city', '$postcode','$contact_number','$user_type')";

    if ($conn->query($sql) === TRUE) {
        echo "New user added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

?>



<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <style>
        *{background-color:rgb(184, 247, 184);}
    </style>
</head>
<body>
    <h2>Add User</h2>
    <form action="add_user.php" method="post">
        <label for="userID">userID:</label>
        <input type="text" id="userID" name="userID" required><br><br>
        
        <label for="Area">Area:</label>
        <input type="text" id="Area" name="Area" required><br><br>
        
        <label for="city">city:</label>
        <input type="text" id="city" name="city" required><br><br>

        <label for="postcode">postcode:</label>
        <input type="text" id="postcode" name="postcode" required><br><br>

        <label for="contact_number">contact_number:</label>
        <input type="text" id="contact_number" name="contact_number" required><br><br>

        <label for="user_type">user_type:</label>
        <input type="text" id="user_type" name="user_type" required><br><br>

        <input type="submit" value="Add User">
    </form>
</body>
</html>


