<?php
include'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $userid = $_POST['userid'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];

    // Query the database to check credentials
    $query = "SELECT * FROM login_t WHERE ID='$userid' AND Password='$password' ";
    $result = mysqli_query($connection, $query);

    // Check if the query returned any rows
    if(mysqli_num_rows($result) == 1) {
        // Login successful, redirect to appropriate dashboard
        switch($usertype) {
            case 'farmer':
                header("Location: farmer.php");
                break;
            case 'loan_provider':
                header("Location: loanProvider.php");
                break;
            case 'insurance_provider':
                header("Location: insuranceProvider.php");
                break;
            case 'investment_provider':
                header("Location: investor.php");
                break;
            case 'grant_provider':
                header("Location: grantProvider.php");
                break;
            case 'admin':
                header("Location: admin_dashboard.php");
                break;
            default:
                // Invalid user type
                echo "Invalid user type";
                break;
        }
    } else {
        // Login failed
        echo "Invalid credentials";
    }

    mysqli_close($connection);
} else {
    // Redirect back to login page if accessed directly
    header("Location: login.php");
}
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
