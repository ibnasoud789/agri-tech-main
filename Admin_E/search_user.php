<!DOCTYPE html>
<html>

<head>

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: rgb(227, 247, 198);
        }

        h1 {
            text-align: center;
        }

        button {
            width: 80px;
            height: 30px;
            color: aliceblue;
            background-color: rgb(1, 62, 1);
            border-radius: 5px;
            border: 1px solid black;
            transition: ease all 0.5s;
            cursor: pointer;
        }
    </style>

</head>

<body>

    <button onclick="location.href='admin_dashboard.php';">Go Back</button><br><br>

</body>

</html>

<?php


include "admin.php";

if (isset($_GET['search'])) {
    $userID = $_GET['search'];
    $typeQuery = "SELECT user_type FROM user WHERE userID='$userID'";
    $typeResult = mysqli_query($conn, $typeQuery);
    if ($typeResult && mysqli_num_rows($typeResult) > 0) {
        $typeRow = mysqli_fetch_array($typeResult);
        $type = $typeRow["user_type"];
        if ($type == "Farmer") {
            $userNameQuery = "SELECT CONCAT(fname,' ',mname,' ',lname) AS `name` FROM farmer_t WHERE Farmer_ID='$userID'";
        } else {
            $userNameQuery = "SELECT `name` FROM financial_service_provider_t WHERE FSPid='$userID'";
        }
        $userNameResult = mysqli_query($conn, $userNameQuery);
        if ($userNameResult && mysqli_num_rows($userNameResult) > 0) {
            $nameRow = mysqli_fetch_array($userNameResult);
            $userName = $nameRow["name"];
            echo "Name: <b>$userName</b><br>";
            echo "ID: <b>$userID</b><br><br>";
        }
    }
}
?>


<!-- Farmer -->

<?php

include 'admin.php';

if (isset($_GET['search'])) {

    $userID = $_GET['search'];
    //loan details query
    $query = "SELECT DISTINCT loan.Loan_ID, loan.amount, loan.receiving_date, loan.return_date, loan.loan_status,loan.interest_rate,CONCAT(farmer_t.fname, ' ', farmer_t.mname, ' ', farmer_t.lname) AS full_name,fsp.name
    FROM loan
    LEFT JOIN farmer_t ON loan.Farmer_ID = farmer_t.Farmer_ID LEFT JOIN financial_service_provider_t AS fsp ON loan.Loan_Provider_ID=fsp.FSPid
    WHERE farmer_t.Farmer_ID = $userID";
    $result = $conn->query($query);

    //insurance details query
    $insuranceQuery = "SELECT * FROM insurance_t AS i JOIN financial_service_provider_t AS fsp ON i.insurance_provider_id=fsp.FSPid WHERE i.farmer_id=$userID";
    $insuranceResult = mysqli_query($conn, $insuranceQuery);
    //investment details
    $invQuery = "SELECT * FROM investment_t AS i JOIN financial_service_provider_t AS fsp ON i.Investor_ID=fsp.FSPid WHERE i.Farmer_ID=$userID";
    $invResult = mysqli_query($conn, $invQuery);

    //grant details
    $tableQuery = "SELECT * FROM grant_t AS g JOIN financial_service_provider_t AS fsp ON g.Grant_provider_ID=fsp.FSPid WHERE g.Farmer_ID=$userID";
    $tableResult = mysqli_query($conn, $tableQuery);



    // Check if any row was found
    if ($result && $result->num_rows > 0) {
        // loan details

        echo "<b>Loan Details</b>";
        echo "<table align='center' border='1'>
        
        
                <tr>
                    <th>Loan ID</th>
                    <th>Loan Provider Name</th>
                    <th>Loan Amount</th>
                    <th>Interest Rate</th>
                    <th>Receiving Date</th>
                    <th>Repayment Date</th>
                    <th>Status</th>
                
                </tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["Loan_ID"] . "</td>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["amount"] . "</td>
                    <td>" . $row["interest_rate"] . "</td>
                    <td>" . $row["receiving_date"] . "</td>
                    <td>" . $row["return_date"] . "</td>
                    <td>" . $row["loan_status"] . "</td>
                </tr>";
        }
        // Close HTML table
        echo "</table>";
    } else {
        echo "";
    }
    if ($insuranceResult && $insuranceResult->num_rows > 0) {
        echo "<p></p>";
        echo "<b>Insurance Details</b>";
        echo "<table align='center' border='1'>
        
        
        <tr>
            <th>Insurance ID</th>
            <th>Insurance Provider Name</th>
            <th>Insurance Policy</th>
            <th>Coverage Amount</th>
            <th>Premium Amount</th>
            <th>Policy Period</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
        
        </tr>";
        while ($insuranceRow = $insuranceResult->fetch_assoc()) {
            echo "<tr>
                    <td>" . $insuranceRow["insurance_id"] . "</td>
                    <td>" . $insuranceRow["name"] . "</td>
                    <td>" . $insuranceRow["policy_type"] . "</td>
                    <td>" . $insuranceRow["coverage_amount"] . "</td>
                    <td>" . $insuranceRow["premium_amount"] . "</td>
                    <td>" . $insuranceRow["policy_period"] . "</td>
                    <td>" . $insuranceRow["effective_date"] . "</td>
                    <td>" . $insuranceRow["end_date"] . "</td>
                    <td>" . $insuranceRow["insurance_status"] . "</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "";
    }
    if ($invResult && $invResult->num_rows > 0) {
        echo "<p></p>";
        echo "<b>Investment Details</b>";
        echo "<table align='center' border='1'>
        
        
        <tr>
            <th>Investment ID</th>
            <th>Investment Provider Name</th>
            <th>Amount</th>
            <th>Profit Share</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
        
        </tr>";
        while ($invRow = $invResult->fetch_assoc()) {
            echo "<tr>
                  <td>" . $invRow["Investment_ID"] . "</td>
                  <td>" . $invRow["name"] . "</td>
                  <td>" . $invRow["Amount"] . "</td>
                  <td>" . $invRow["Profit_share_rate"] . "</td>
                  <td>" . $invRow["Start_date"] . "</td>
                  <td>" . $invRow["End_date"] . "</td>
                  <td>" . $invRow["investment_status"] . "</td>
                </tr>";
        }
        echo "</table>";
    }
    if ($tableResult && $tableResult->num_rows > 0) {
        echo "<p></p>";
        echo "<b>Grant Details</b>";
        echo "<table align='center' border='1'>
        
        
        <tr>
            <th>Grant ID</th>
            <th>Grant Provider Name</th>
            <th>Grant Amount</th>
            <th>Issue Date</th>     
        </tr>";
        while ($tableRow = $tableResult->fetch_assoc()) {
            echo "<tr>
                <td>" . $tableRow["Grant_ID"] . "</td>
                <td>" . $tableRow["name"] . "</td>
                <td>" . $tableRow["Grant_amount"] . "</td>
                <td>" . $tableRow["Receiving_date"] . "</td>
            </tr>";
        }
        echo "</table>";
    }
}

?>



<!-- Loan -->

<?php

if (isset($_GET['search'])) {

    $userID = $_GET['search'];

    $query = "SELECT financial_service_provider_t.name, loan.Loan_Provider_ID, loan.Loan_ID, loan.amount, loan.Farmer_ID, loan.interest_rate, loan.receiving_date, loan.return_date,loan.loan_status
                FROM loan
                LEFT JOIN financial_service_provider_t ON loan.Loan_Provider_ID = financial_service_provider_t.FSPid
                WHERE loan.Loan_Provider_ID = $userID";

    $result = $conn->query($query);


    if ($result && $result->num_rows > 0) {
        echo "<b >Loan Details</b><br><br>";
        echo "<table align='center' border='1'>
        
                <tr>
                    <th>Loan ID</th>
                    <th>Farmer ID</th>
                    <th>Loan Amount</th>
                    <th>Interest Rate</th>
                    <th>Receiving Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                </tr>";



        // Output data of each row
        while ($row = $result->fetch_assoc()) {

            echo "<tr>
                    <td>" . $row["Loan_ID"] . "</td>
                    <td>" . $row["Farmer_ID"] . "</td>
                    <td>" . $row["amount"] . "</td>
                    <td>" . $row["interest_rate"] . "</td>
                    <td>" . $row["receiving_date"] . "</td>
                    <td>" . $row["return_date"] . "</td>
                    <td>" . $row["loan_status"] . "</td>
                </tr>";
        }

        echo "</table><br><br>";
    } else {
        echo "";
    }
}

?>

<!-- Investment -->

<?php

if (isset($_GET['search'])) {

    $userID = $_GET['search'];

    $query = "SELECT financial_service_provider_t.name, investment_t.Investor_ID, investment_t.Investment_ID, investment_t.Amount, investment_t.Farmer_ID, investment_t.Start_date, investment_t.End_date,investment_t.Profit_share_rate,investment_t.investment_status
                FROM investment_t
                LEFT JOIN financial_service_provider_t ON investment_t.Investor_ID = financial_service_provider_t.FSPid
                WHERE investment_t.Investor_ID = $userID";

    // Execute the query
    $result = $conn->query($query);

    // Check if any row was found
    if ($result && $result->num_rows > 0) {
        // Start HTML table
        echo "<b style=\"text-align: center;\">Investment Details</b><br><br>";


        echo "<table align='center' border='1'>
        
        
                <tr>
                    <th>Investment ID</th>
                    <th>Farmer ID</th>
                    <th>Investment Amount</th>
                    <th>Profit Share</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                </tr>";



        // Output data of each row
        while ($row = $result->fetch_assoc()) {

            echo "<tr>
                    <td>" . $row["Investment_ID"] . "</td>
                    <td>" . $row["Farmer_ID"] . "</td>
                    <td>" . $row["Amount"] . "</td>
                    <td>" . $row["Profit_share_rate"] . "</td>
                    <td>" . $row["Start_date"] . "</td>
                    <td>" . $row["End_date"] . "</td>
                    <td>" . $row["investment_status"] . "</td>
                </tr>";
        }
        // Close HTML table
        echo "</table><br><br>";
    } else {
        echo "";
    }
}

?>


<!-- Insurance -->

<?php

if (isset($_GET['search'])) {

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
        echo "<b>Insurance Details</b><br><br>";
        echo "<table align='center' border='1'>
        
        
                <tr>
                    <th>Insurance ID</th>
                    <th>Farmer ID</th>
                    <th>Coverage Amount</th>
                    <th>Premium Amount</th>
                    <th>Policy Type</th>
                    <th>Policy Period</th>
                    <th>Payment Frequency</th>
                </tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {

            echo "<tr>

                    <td>" . $row["insurance_id"] . "</td>
                    <td>" . $row["Farmer_ID"] . "</td>
                    <td>" . $row["coverage_amount"] . "</td>
                    <td>" . $row["premium_amount"] . "</td>
                    <td>" . $row["policy_type"] . "</td>
                    <td>" . $row["policy_period"] . "</td>
                    <td>" . $row["payment_frequency"] . "</td>
                </tr>";
        }
        // Close HTML table
        echo "</table><br><br>";
    } else {
        echo "";
    }
}

?>



<!-- Grant -->

<?php

if (isset($_GET['search'])) {

    $userID = $_GET['search'];

    $query = "SELECT *
                FROM grant_t
                LEFT JOIN financial_service_provider_t ON grant_t.Grant_provider_ID = financial_service_provider_t.FSPid
                WHERE grant_t.Grant_provider_ID = $userID";

    // Execute the query
    $result = $conn->query($query);

    // Check if any row was found
    if ($result && $result->num_rows > 0) {
        echo "<b>Grant Details</b><br><br>";
        // Start HTML table
        echo "<table align='center' border='1'>
        
        
                <tr>
                    <th>Grant ID</th>
                    <th>Farmer ID</th>
                    <th>Grant Amount</th>
                    <th>Issue Date</th>
                </tr>";


        // Output data of each row
        while ($row = $result->fetch_assoc()) {

            echo "<tr>
                    <td>" . $row["Grant_ID"] . "</td>
                    <td>" . $row["Farmer_id"] . "</td>
                    <td>" . $row["Grant_amount"] . "</td>
                    <td>" . $row["Receiving_date"] . "</td>
                </tr>";
        }
        // Close HTML table
        echo "</table>";
    } else {
        echo "";
    }
}

?>