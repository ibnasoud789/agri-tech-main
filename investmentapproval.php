<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    
    if (isset($data['Farmer_ID'], $data['investment_amount'], $data['Profit_share_rate'], $data['End_date'])) {
      
        $Farmer_ID = $data['Farmer_ID'];
        $investment_amount = $data['investment_amount'];
        $Profit_share_rate = $data['Profit_share_rate'];
        $End_date = $data['End_date'];

        
        $Investor_ID = $_SESSION['userid'];

        
        $insert_query = "INSERT INTO investment_t (Farmer_ID,Investor_ID, Amount,Profit_share_rate, Start_date , End_date) 
                         VALUES ('$Farmer_ID', '$Investor_ID', '$investment_amount', '$Profit_share_rate', NOW(), '$End_date')";

        if (mysqli_query($conn, $insert_query)) {
            echo "Investment approval successful!";
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
