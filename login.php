<?php
include "loginlogic.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
</head>
<style>
    body {
        height: 100vh;
        font-family: sans-serif;
        display: flex;
        justify-content: center;
        background: linear-gradient(90deg,
                rgba(7, 97, 19, 0.916) 0%,
                rgb(46, 237, 129) 35%,
                rgb(132, 218, 117) 100%);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 35%;
        background-color: transparent;
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        padding: 50px;
        align-items: center;
    }

    .login-logo {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
    }

    label {
        display: block;
        color: #006838;
    }

    input,
    select {
        width: 200px;
        height: 35px;
        border-radius: 8px;
        border: 2px solid #c4c4c4;
        padding: 0 30px;
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
    }

    select {
        width: 264px;
    }

    input:focus,
    select:focus {
        border: 2px solid black;
        transform: scale(1.05);
    }

    .btn {
        width: 268px;
        height: 35px;
        background-color: rgb(135, 253, 135);
        color: rgb(1, 62, 1);
        font-size: 17px;
        font-weight: bold;
        border: 2px solid white;
        border-radius: 10px;
        margin-top: 20px;
        cursor: pointer;
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
        text-align: center;
    }

    .btn:hover {
        transform: scale(1.05);
        color: black;
        border: 2px solid black;
    }
</style>

<body>
    <form action method="post">
        <div class="login-logo">
            <img src="login-page/login-logo/KRISHI-removebg-preview.png" height="70px" width="70px">
        </div>
        <h2>Login</h2>
        <div>
            <label for="userid">User ID:</label><br />
            <input type="text" id="userid" name="userid" /><br />
        </div>
        <div>
            <label for="password">Password:</label><br />
            <input type="password" id="password" name="password" /><br />
        </div>
        <div>
            <label for="usertype">User Type:</label><br />
            <select id="usertype" name="usertype">
                <option value="farmer">Farmer</option>
                <option value="loan_provider">Loan Provider</option>
                <option value="insurance_provider">Insurance Provider</option>
                <option value="investment_provider">Investment Provider</option>
                <option value="grant_provider">Grant Provider</option>
                <option value="admin">Admin</option>
                <option value="advisor">Advisor</option>
            </select><br /><br />
        </div>
        <input type="submit" value="Login" class="btn" />
    </form>
</body>

</html>