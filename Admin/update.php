<?php

include 'admin.php';

if(isset($_POST['submit'])) {

    $userID = $_POST['userID'];
    $Area = $_POST['Area'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];
    $contact_number = $_POST['contact_number'];
    $user_type = $_POST['user_type'];


    $sql = "UPDATE `user` SET `userID`='$userID',`Area`='$Area',`city`='$city',`postcode`='$postcode',`contact_number`='$contact_number', 'user_type'='$user_type' WHERE `userID`='$user_ID'"; 

    $result = $conn->query($sql); 

    if ($result == TRUE) {

        echo '<div class="alert alert-success" role="alert">';
        echo 'Record updated successfully.';
        echo '</div>';
        echo "<script>console.log('Record updated successfully.');</script>";
        header( "refresh:2; url=./view.php" ); 

    }else{

        echo "Error:" . $sql . "<br>" . $conn->error;

    }

}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <style>
        *{background-color:rgb(184, 247, 184);}
    </style>
</head>
<body>

<h2>Update User</h2>

<form action="update_user.php" method="post">
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
        <input type="submit" name="submit" value="Update User">
</form>

</body>
</html>