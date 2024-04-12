<?php
include 'database.php';

if (isset($_POST['approve'])) {
    $Farmer_ID = $_POST['id'];
    $investor = $_POST['investor'];
    $investment_amount = $_POST['Amount'];
    $Profit_share_rate = $_POST['int_rate'];
    $repaymentdate = $_POST['repaymentdate'];
    $provideridQuery = "SELECT * FROM investment_application_t AS ia JOIN financial_service_provider_t AS fsp ON ia.preferred_investor=fsp.name WHERE preferred_investor='$investor' ";
    $provideridResult = mysqli_query($conn, $provideridQuery);
    $provideridRow = mysqli_fetch_array($provideridResult);
    $providerid = $provideridRow["FSPid"];

    mysqli_begin_transaction($conn);

    $sql = "INSERT INTO `investment_t` 
    SET `Start_date`=CURDATE(),
     `Amount`='$investment_amount', `Profit_share_rate`='$Profit_share_rate',`End_date`='$repaymentdate',`Farmer_ID`='$Farmer_ID',`Investor_ID`='$providerid',`investment_status`='Ongoing' ";
    $result = mysqli_query($conn, $sql);
    if ($result == TRUE) {
        $verdictUpdate = "UPDATE `investment_application_t` SET `Verdict`='Approved' WHERE `Verdict`='Pending' AND Farmer_ID='$Farmer_ID'";
        $verdictUpdateResult = mysqli_query($conn, $verdictUpdate);

        if ($verdictUpdateResult == TRUE) {
            mysqli_commit($conn);
            echo 'Investment Approved Successfully.';
            echo '</div>';
            echo "<script>console.log('Investment Approved Successfully.');</script>";
            header("refresh:2; url=./investor.php");

        } else {
            mysqli_rollback($conn); 
            echo 'Error updating another table.';
        }
    } else {
        echo 'Error inserting into loan table.';
    }
} 


if (isset($_GET['id'])) {
    $Farmer_ID = $_GET['id'];

    $query = "SELECT * FROM investment_application_t WHERE Farmer_ID='$Farmer_ID'";
    $result = mysqli_query($conn, $query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $Farmer_ID = $row['Farmer_ID'];
            $farmername = $row['farmer_name'];
            $investment_amount = $row['investment_amount'];
            $duration = $row['Duration'];
            $investorname = $row['preferred_investor'];
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Approval</title>
</head>

<body>
    <form method='post'>
        <h2>Investment Approval</h2>
        <div>
            <label for="fullname">Full Name:</label>

            <input type='text' name='fullname' value='<?php echo $farmername; ?>' readonly><br><br>
        </div>
        <div>
            <label for="id">User ID:</label>
            <input type='number' name='id' value='<?php echo $Farmer_ID; ?>' readonly><br><br>
        </div>
        <div>
            <label for="investment_amount">Investment Amount:</label>
            <input type='number' name='Amount' value='<?php echo $investment_amount; ?>'><br><br>
        </div>
        <div>
            <label for="duration">Investment Duration:</label>
            <input type='text' name='duration' value='<?php echo $duration; ?>'><br><br>
        </div>
        <div>
            <label for="int_rate">Profit Share Rate:</label>
            <input type='number' name='int_rate' value='' required><br><br>
        </div>
        <div>
            <label for="repaymentdate">End Date</label>
            <input type='date' name='repaymentdate' value='' required><br><br>

        </div>
        <input type='hidden' name='investor' value='<?php echo $investorname; ?>'>
        <button type='submit' name='approve'>Approve</button>



    </form>
</body>

</html>