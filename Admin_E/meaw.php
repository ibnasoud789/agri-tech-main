<?php

include 'admin.php';


if(isset($_GET['search'])) {

    $userID = $_GET['search'];
    
    $query = "SELECT CONCAT(farmer_t.fname, ' ', farmer_t.mname, ' ', farmer_t.lname) AS full_name, loan.amount, investment_t.Amount, insurance_t.coverage_amount, insurance_t.premium_amount, grant_t.Grant_amount
                FROM loan
                LEFT JOIN investment_t ON loan.Farmer_ID = investment_t.Farmer_ID
                LEFT JOIN insurance_t ON loan.Farmer_ID = insurance_t.Farmer_ID
                LEFT JOIN grant_t ON loan.Farmer_ID = grant_t.Farmer_id
                LEFT JOIN farmer_t ON loan.Farmer_ID = farmer_t.Farmer_ID
                WHERE loan.Farmer_ID = $userID";

    // Execute the query
    $result = $conn->query($query);

    // Check if any row was found
    if ($result && $result->num_rows > 0) {
        // Start HTML table
        echo "<table align='center' border='1'>
        
        
                <tr>
                    <th>Loan Amount</th>
                    <th>Investment Amount</th>
                    <th>Coverage Amount</th>
                    <th>Premium Amount</th>
                    <th>Grant Amount</th>
                </tr>";

        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<h1>" . htmlspecialchars($row['full_name']) . " Portfolio: </h1>";
            
            echo "<tr>
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
        echo "";
    }
}

?>

<?php

if(isset($_GET['search'])) {

    $userID = $_GET['search'];
    
    $query = "SELECT loan.Loan_Provider_ID, loan.Loan_ID, loan.amount, loan.Farmer_ID, loan.interest_rate, loan.receiving_date, loan.return_date
                FROM loan
                LEFT JOIN investment_t ON loan.Farmer_ID = investment_t.Farmer_ID
                LEFT JOIN insurance_t ON loan.Farmer_ID = insurance_t.Farmer_ID
                LEFT JOIN grant_t ON loan.Farmer_ID = grant_t.Farmer_id
                WHERE loan.Loan_Provider_ID = $userID";

    // Execute the query
    $result = $conn->query($query);

    // Check if any row was found
    if ($result && $result->num_rows > 0) {
        // Start HTML table
        echo "<table align='center' border='1'>
        
        
                <tr>
                    <th>Loan Provider ID</th>
                    <th>Loan ID</th>
                    <th>Loan Amount</th>
                    <th>Farmer ID</th>
                    <th>Interest Rate</th>
                    <th>Receiving Date</th>
                    <th>Return Date</th>
                </tr>";

        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["Loan_Provider_ID"]."</td>
                    <td>".$row["Loan_ID"]."</td>
                    <td>".$row["amount"]."</td>
                    <td>".$row["Farmer_ID"]."</td>
                    <td>".$row["interest_rate"]."</td>
                    <td>".$row["receiving_date"]."</td>
                    <td>".$row["return_date"]."</td>
                </tr>";
        }
        // Close HTML table
        echo "</table>";
    } else {
        echo "";
    }
}

?>