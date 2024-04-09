<!-- Farmer -->

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

        if ($row = $result->fetch_assoc()) {
            echo "<h2>" . htmlspecialchars($row['name']) . "  Portfolio: </h2>";
        }

        // Output data of each row
        while($row = $result->fetch_assoc()) {

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


<!-- Loan -->

<?php

if(isset($_GET['search'])) {

    $userID = $_GET['search'];
    
    $query = "SELECT financial_service_provider_t.name, loan.Loan_Provider_ID, loan.Loan_ID, loan.amount, loan.Farmer_ID, loan.interest_rate, loan.receiving_date, loan.return_date
                FROM loan
                LEFT JOIN financial_service_provider_t ON loan.Loan_Provider_ID = financial_service_provider_t.FSPid
                WHERE loan.Loan_Provider_ID = $userID";

    // Execute the query
    $result = $conn->query($query);

    // Check if any row was found
    if ($result && $result->num_rows > 0) {
        // Start HTML table
        echo "<table align='center' border='1'>
        
        
                <tr>
                    <th>Loan ID</th>
                    <th>Loan Amount</th>
                    <th>Farmer ID</th>
                    <th>Interest Rate</th>
                    <th>Receiving Date</th>
                    <th>Return Date</th>
                </tr>";

        if ($row = $result->fetch_assoc()) {
            echo "<h2>" . htmlspecialchars($row['name']) . " Loan Portfolio: </h2>";
        }

        // Output data of each row
        while($row = $result->fetch_assoc()) {
       
            echo "<tr>
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

<!-- Investment -->

<?php

if(isset($_GET['search'])) {

    $userID = $_GET['search'];
    
    $query = "SELECT financial_service_provider_t.name, investment_t.Investor_ID, investment_t.Investment_ID, investment_t.Amount, investment_t.Farmer_ID, investment_t.Start_date, investment_t.End_date
                FROM investment_t
                LEFT JOIN financial_service_provider_t ON investment_t.Investor_ID = financial_service_provider_t.FSPid
                WHERE investment_t.Investor_ID = $userID";

    // Execute the query
    $result = $conn->query($query);

    // Check if any row was found
    if ($result && $result->num_rows > 0) {
        // Start HTML table
        echo "<table align='center' border='1'>
        
        
                <tr>
                    <th>Investment ID</th>
                    <th>Investment Amount</th>
                    <th>Farmer ID</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>";

        if ($row = $result->fetch_assoc()) {
            echo "<h2>" . htmlspecialchars($row['name']) . " Investment Portfolio: </h2>";
        }

        // Output data of each row
        while($row = $result->fetch_assoc()) {
       
            echo "<tr>
                    <td>".$row["Investment_ID"]."</td>
                    <td>".$row["Amount"]."</td>
                    <td>".$row["Farmer_ID"]."</td>
                    <td>".$row["Start_date"]."</td>
                    <td>".$row["End_date"]."</td>
                </tr>";
        }
        // Close HTML table
        echo "</table>";
    } else {
        echo "";
    }
}

?>


<!-- Insurance -->

<?php

if(isset($_GET['search'])) {

    $userID = $_GET['search'];
    
    $query = "SELECT financial_service_provider_t.name, insurance_t.insurance_provider_id, insurance_t.insurance_id, insurance_t.premium_amount, insurance_t.coverage_amount, insurance_t.Farmer_ID, insurance_t.policy_type, insurance_t.policy_period, insurance_t.payment_frequency
                FROM insurance_t
                LEFT JOIN financial_service_provider_t ON insurance_t.insurance_provider_id = financial_service_provider_t.FSPid
                WHERE insurance_t.insurance_provider_id = $userID";

    // Execute the query
    $result = $conn->query($query);

    // Check if any row was found
    if ($result && $result->num_rows > 0) {
        // Start HTML table
        echo "<table align='center' border='1'>
        
        
                <tr>
                    <th>Insurance ID</th>
                    <th>Coverage Amount</th>
                    <th>Premium Amount</th>
                    <th>Farmer ID</th>
                    <th>Policy Type</th>
                    <th>Policy Period</th>
                    <th>Payment Frequency</th>
                </tr>";

        if ($row = $result->fetch_assoc()) {
            echo "<h2>" . htmlspecialchars($row['name']) . " Insurance Portfolio: </h2>";
        }

        // Output data of each row
        while($row = $result->fetch_assoc()) {
       
            echo "<tr>
                    <td>".$row["insurance_id"]."</td>
                    <td>".$row["coverage_amount"]."</td>
                    <td>".$row["premium_amount"]."</td>
                    <td>".$row["Farmer_ID"]."</td>
                    <td>".$row["policy_type"]."</td>
                    <td>".$row["policy_period"]."</td>
                    <td>".$row["payment_frequency"]."</td>
                </tr>";
        }
        // Close HTML table
        echo "</table>";
    } else {
        echo "";
    }
}

?>



<!-- Grant -->

<?php

if(isset($_GET['search'])) {

    $userID = $_GET['search'];
    
    $query = "SELECT financial_service_provider_t.name, grant_t.Grant_provider_ID, grant_t.Grant_ID, grant_t.Farmer_id, grant_t.Grant_amount, grant_t.Start_date, grant_t.End_date
                FROM grant_t
                LEFT JOIN financial_service_provider_t ON grant_t.Grant_provider_ID = financial_service_provider_t.FSPid
                WHERE grant_t.Grant_provider_ID = $userID";

    // Execute the query
    $result = $conn->query($query);

    // Check if any row was found
    if ($result && $result->num_rows > 0) {
        // Start HTML table
        echo "<table align='center' border='1'>
        
        
                <tr>
                    <th>Grant ID</th>
                    <th>Grant Amount</th>
                    <th>Farmer ID</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>";

        if ($row = $result->fetch_assoc()) {
        echo "<h2>" . htmlspecialchars($row['name']) . " Grant Portfolio: </h2>";
        }

        // Output data of each row
        while($row = $result->fetch_assoc()) {
       
            echo "<tr>
                    <td>".$row["Grant_ID"]."</td>
                    <td>".$row["Grant_amount"]."</td>
                    <td>".$row["Farmer_id"]."</td>
                    <td>".$row["Start_date"]."</td>
                    <td>".$row["End_date"]."</td>
                </tr>";
        }
        // Close HTML table
        echo "</table>";
    } else {
        echo "";
    }
}

?>


<!DOCTYPE html>
<html>

<head>

<style>
*{background-color:rgb(184, 247, 184);}
</style>

</head>

<body>

</body>
</html>