<?php
include "loginlogic.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="" method="post">
        <label for="userid">User ID:</label><br>
        <input type="text" id="userid" name="userid"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <label for="usertype">User Type:</label><br>
        <select id="usertype" name="usertype">
            <option value="farmer">Farmer</option>
            <option value="loan_provider">Loan Provider</option>
            <option value="insurance_provider">Insurance Provider</option>
            <option value="investment_provider">Investment Provider</option>
            <option value="grant_provider">Grant Provider</option>
            <option value="admin">Admin</option>
        </select><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>