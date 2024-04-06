<?php 
 include "database.php";
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user_name = $_POST['user_name'];
  $email = $_POST['user_id'];
  $loan_amount = $_POST['loan_amount'];
  $bank = $_POST['bank'];

  $sql = "INSERT INTO loan_application_t (farmer_name, farmer_id, loan_amount, preferred_bank) VALUES ('$user_name', '$email', '$loan_amount', '$bank')";
  if ($conn->query($sql) === TRUE) {
      echo "Loan application submitted successfully.";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Close database connection
  $conn->close();
 }


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loan Application Form</title>
</head>
<body>
    <h2>Loan Application Form</h2>
    <form action="" method="post">
        <label for="user_name">Full Name:</label>
        <input type="text" id="user_name" name="user_name" required><br><br>

        <label for="user_id">Your ID:</label>
        <input type="text" id="user_id" name="user_id" required><br><br>
      
        <label for="loan_amount">Loan Amount:</label>
        <input type="number" id="loan_amount" name="loan_amount" required><br><br>
        
        <label for="provider">Choose a Loan Provider:</label>
        <select id="bank" name="bank" required>
            <option value="">Select Bank</option>
            <option value="Agrani Bank">Agrani Bank</option>
            <option value="City Bank">City Bank</option>
            <option value="Sonali Bank">Sonali Bank</option>
            <!-- Add more banks as needed -->
        </select><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>