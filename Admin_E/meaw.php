<?php

include 'admin.php';


//Join the tables

$query = "SELECT * 
          FROM loan
          JOIN investment_t ON loan.Farmer_ID = investment_t.Farmer_ID
          JOIN insurance_t ON loan.Farmer_ID = insurance_t.Farmer_ID
          JOIN grant_t ON loan.Farmer_ID = grant_t.Farmer_id";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query executed successfully
if (!$result) {
    echo "Error: " . mysqli_error($conn);
} else {
    echo("Success.");
}



?>
