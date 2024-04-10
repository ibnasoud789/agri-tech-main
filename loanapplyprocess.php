<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    
    if (isset($data['farmer_id'], $data['loan_amount'], $data['interest_rate'], $data['return_date'])) {
      
        $farmer_id = $data['farmer_id'];
        $loan_amount = $data['loan_amount'];
        $interest_rate = $data['interest_rate'];
        $return_date = $data['return_date'];

        
        $loan_provider_id = $_SESSION['userid'];

        
        $insert_query = "INSERT INTO loan (Farmer_ID, Loan_Provider_ID, amount, interest_rate, receiving_date, return_date) 
                         VALUES ('$farmer_id', '$loan_provider_id', '$loan_amount', '$interest_rate', NOW(), '$return_date')";

        if (mysqli_query($conn, $insert_query)) {
            echo "Loan approval successful!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
      
        echo "Error: Required data fields are missing.";
    }
} else {

    header("Location: index.php");
    exit;
}
?>
