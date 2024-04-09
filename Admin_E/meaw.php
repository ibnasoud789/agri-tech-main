<?php

include 'admin.php';


if(isset($_GET['search'])) {

    $userID = $_GET['search'];
    
    $query = "SELECT loan.Farmer_ID, loan.amount, investment_t.Amount, insurance_t.coverage_amount, insurance_t.premium_amount, grant_t.Grant_amount
                FROM loan
                LEFT JOIN investment_t ON loan.Farmer_ID = investment_t.Farmer_ID
                LEFT JOIN insurance_t ON loan.Farmer_ID = insurance_t.Farmer_ID
                LEFT JOIN grant_t ON loan.Farmer_ID = grant_t.Farmer_id
                WHERE loan.Farmer_ID = $userID";

    // Execute the query
    $result = $conn->query($query);

    // Check if any row was found
    if ($result && $result->num_rows > 0) {
        // Start HTML table
        echo "<table align='center' border='1'>
        
                <tr>
                    <th>Farmer ID</th>
                    <th>Loan Amount</th>
                    <th>Investment Amount</th>
                    <th>Coverage Amount</th>
                    <th>Premium Amount</th>
                    <th>Grant Amount</th>
                </tr>";

        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["Farmer_ID"]."</td>
                    <td>".$row["amount"]."</td>
                    <td>".$row["Amount"]."</td>
                    <td>".$row["coverage_amount"]."</td>
                    <td>".$row["premium_amount"]."</td>
                    <td>".$row["Grant_amount"]."</td>
                </tr>";
        }
        // Close HTML table
        echo "</table>";
    } else {
        echo "No results found.";
    }
}

?>
