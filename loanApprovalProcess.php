<?php
include 'database.php';

if (isset($_POST['approve'])) {
    $farmerid = $_POST['id'];
    $loanprovider = $_POST['provider'];
    $amount = $_POST['amount'];
    $interest = $_POST['int_rate'];
    $repaymentdate = $_POST['repaymentdate'];
    $provideridQuery = "SELECT * FROM loan_application_t AS la JOIN financial_service_provider_t AS fsp ON la.preferred_bank=fsp.name WHERE preferred_bank='$loanprovider' ";
    $provideridResult = mysqli_query($conn, $provideridQuery);
    $provideridRow = mysqli_fetch_array($provideridResult);
    $providerid = $provideridRow["FSPid"];

    mysqli_begin_transaction($conn);

    $sql = "INSERT INTO `loan` 
    SET `receiving_date`=CURDATE(),
     `amount`='$amount', `interest_rate`='$interest',`return_date`='$repaymentdate',`Farmer_ID`='$farmerid',`Loan_Provider_ID`='$providerid',
     `amount_owned` = '$amount' * (1 + '$interest' / 100),
     `loan_status`='Ongoing' ";
    $result = mysqli_query($conn, $sql);
    if ($result == TRUE) {
        $verdictUpdate = "UPDATE `loan_application_t` SET `Verdict`='Approved' WHERE `Verdict`='Pending' AND farmer_id='$farmerid'";
        $verdictUpdateResult = mysqli_query($conn, $verdictUpdate);

        if ($verdictUpdateResult == TRUE) {
            mysqli_commit($conn);
            echo 'Loan Approved Successfully.';
            echo '</div>';
            echo "<script>console.log('Loan Approved Successfully.');</script>";
            header("refresh:2; url=./loanProvider.php");
        } else {
            mysqli_rollback($conn);
            echo 'Error updating another table.';
        }
    } else {
        echo 'Error inserting into loan table.';
    }
}


if (isset($_GET['id'])) {
    $farmerid = $_GET['id'];

    $query = "SELECT * FROM loan_application_t WHERE farmer_id='$farmerid'";
    $result = mysqli_query($conn, $query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $farmerid = $row['farmer_id'];
            $farmername = $row['farmer_name'];
            $loanamount = $row['loan_amount'];
            $duration = $row['duration'];
            $providername = $row['preferred_bank'];
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
    <style>
        h2 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>

<body>
    <form method='post'>
        <h2>Loan Approval</h2>
        <div>
            <label for="fullname">Full Name:</label>
            <input type='text' name='fullname' value='<?php echo $farmername; ?>' readonly>
        </div>
        <div>
            <label for="id">User ID:</label>
            <input type='number' name='id' value='<?php echo $farmerid; ?>' readonly>
        </div>
        <div>
            <label for="loanamount">Loan Amount:</label>
            <input type='number' name='amount' value='<?php echo $loanamount; ?>'>
        </div>
        <div>
            <label for="duration">Loan Duration:</label>
            <input type='text' name='duration' value='<?php echo $duration; ?>'>
        </div>
        <div>
            <label for="int_rate">Interest Rate:</label>
            <input type='number' name='int_rate' value='' required>
        </div>
        <div>
            <label for="repaymentdate">Repayment Date</label>
            <input type='date' name='repaymentdate' value='' required>
        </div>
        <input type='hidden' name='provider' value='<?php echo $providername; ?>'>
        <button type='submit' name='approve'>Approve</button>



    </form>
</body>

</html>