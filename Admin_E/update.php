<?php 

include "admin.php";

if(isset($_GET['userID']) && isset($_GET['Area']) && isset($_GET['city']) && isset($_GET['postcode']) && isset($_GET['contact_number']) && isset($_GET['user_type'])) {
  
    $userID = $_GET['userID'];
    $newArea = $_GET['Area'];
    $newCity = $_GET['city'];
    $newPostcode = $_GET['postcode'];
    $newContactNumber = $_GET['contact_number'];
    $newUserType = $_GET['user_type'];

    $sql = "UPDATE user SET Area = ?, city = ?, postcode = ?, contact_number = ?, user_type = ? WHERE userID = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }

    $stmt->bind_param("sssssi", $newArea, $newCity, $newPostcode, $newContactNumber, $newUserType, $userID);
    if (!$stmt->execute()) {
        echo "Error executing statement: " . $stmt->error;
        exit;
    }

    echo "User with ID $userID updated successfully.";
    
    $stmt->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Update User Information</title>
    <style>
        *{background-color:rgb(184, 247, 184);}
    </style>
</head>
<body>

<h2>Update User Information</h2>

<form action="update.php" method="get">
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

        <input type="submit" value="Update User">
</form>

</body>
</html>
