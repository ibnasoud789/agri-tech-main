<?php
   include("database.php")


?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="login-page/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
    <div class="container">

      <form id="form" action="loginlogic.php" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="login-logo">
          <img src="login-page/login-logo/KRISHI-removebg-preview.png" height="70px" width="70px">
        </div>
        <div><h1>LOGIN</h1></div>
        <div class="id-input">
          <label for="userid">User ID</label>
          <i class="fas fa-user"></i>
          <input type="number" name="userid" placeholder="696969" id="userid">
          <i class="fas fa-circle-exclamation failure-icon"></i>
          <i class="far fa-check-circle success-icon"></i>
          <div class="error"></div>
        </div>
        <div class="password-input">
          <label for="password">Password</label>
          <i class="fas fa-lock"></i>
          <input type="password" name="password" id="password" placeholder="*********">
          <i class="fas fa-circle-exclamation failure-icon"></i>
          <i class="far fa-check-circle success-icon"></i>
          <div class="error"></div>
        </div>
        <div class="user-type">
          <label for="usertype">Choose your User Type</label>
          <select>
            <option>Select</option>
            <option>Farmer</option>
            <option>Loan Provider</option>
            <option>Insurance Provider</option>
            <option>Investor</option>
            <option>Grant Proider</option>
            <option>Admin</option>

          </select>
        </div>
        <input type="submit" class="btn" name="login" id="login" value="Login" required>
      </form>
      <script src="login-page/login.js"></script>
    </div>
  </body>
</html>