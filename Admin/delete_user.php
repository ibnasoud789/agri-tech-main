<?php

include 'admin.php';

if(isset($_POST['submit'])) {
    $userID = $_POST['userID'];

    $sql = "DELETE FROM user WHERE userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);

    if ($stmt->execute()) {
        echo "<p>User with ID $userID deleted successfully.</p>";
    } else {
        echo "<p>Error deleting user: " . $conn->error . "</p>";
    }

    $stmt->close();
}
?>


 


<!DOCTYPE html>
<html>
<head>
    <title>Delete User</title>
</head>
<body>

<h2>Delete User</h2>

<form method="post">
    <label for="userID">userID:</label>
    <input type="text" id="userID" name="userID" required><br><br>
    <input type="submit" name="submit" value="Delete User">
</form>

</body>
</html>