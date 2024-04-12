<?php
include 'database.php';

if (isset($_POST['approve'])) {
    $farmerid = $_POST['id'];
    $insuranceprovider = $_POST['provider'];
    $coverage_amount = $_POST['coverage_amount'];
    $premium_amount = $_POST['premium_amount'];
    $policy_type = $_POST['policy'];
    $policy_period = $_POST['duration'];
    $payment_frequency = $_POST['payment_frequency'];
    $enddate = $_POST['end_date'];

    $provideridQuery = "SELECT * FROM insurance_application AS insa JOIN financial_service_provider_t AS fsp ON insa.preferred_provider=fsp.name WHERE preferred_provider='$insuranceprovider' ";
    $provideridResult = mysqli_query($conn, $provideridQuery);
    $provideridRow = mysqli_fetch_array($provideridResult);
    $providerid = $provideridRow["FSPid"];

    mysqli_begin_transaction($conn);

    $sql = "INSERT INTO `insurance_t` 
    SET `effective_date`=CURDATE(),
     `policy_period`='$policy_period',  `policy_type`='$policy_type', `payment_frequency`='$payment_frequency',  `coverage_amount`='$coverage_amount',`premium_amount`='$premium_amount',`farmer_id`='$farmerid',`insurance_provider_id`='$providerid',`insurance_status`='Ongoing',
      `end_date`='$enddate'";
    $result = mysqli_query($conn, $sql);
    if ($result == TRUE) {
        $verdictUpdate = "UPDATE `insurance_application` SET `status`='Approved' WHERE `status`='Pending' AND farmer_id='$farmerid'";
        $verdictUpdateResult = mysqli_query($conn, $verdictUpdate);

        if ($verdictUpdateResult == TRUE) {
            mysqli_commit($conn);
            echo 'Insurance Approved Successfully.';
            echo '</div>';
            echo "<script>console.log('Insurance Approved Successfully.');</script>";
            header("refresh:2; url=./insuranceProvider.php");
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

    $query = "SELECT * FROM insurance_application WHERE farmer_id='$farmerid'";
    $result = mysqli_query($conn, $query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $farmerid = $row['farmer_id'];
            $farmername = $row['farmer_name'];
            $insurance_policy = $row['policy'];
            $duration = $row['duration'];
            $providername = $row['preferred_provider'];
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insurance Approval</title>
</head>

<body>
    <form method='post'>
        <h2>Insurance Approval</h2>
        <div>
            <label for="fullname">Full Name:</label>
            <input type='text' name='fullname' value='<?php echo $farmername; ?>' readonly><br><br>
        </div>
        <div>
            <label for="id">User ID:</label>
            <input type='number' name='id' value='<?php echo $farmerid; ?>' readonly><br><br>
        </div>
        <div>
            <label for="policy">Insurance Policy:</label>
            <input type='text' name='policy' value='<?php echo $insurance_policy; ?>' readonly><br><br>
        </div>
        <div>
            <label for="duration">Policy Period:</label>
            <input type='text' name='duration' value='<?php echo $duration; ?>' readonly><br><br>
        </div>
        <div>
            <label for="coverage_amount">Coverage Amount:</label>
            <input type='number' name='coverage_amount' value='' required><br><br>
        </div>
        <div>
            <label for="premium_amount">Premium Amount:</label>
            <input type='number' name='premium_amount' value='' required><br><br>
        </div>
        <div>
            <label for='frequency'>Payment Frequency:</label>
            <input type='text' name='payment_frequency' value='' required><br><br>
        </div>

        <div>
            <label for="end_date">End Date:</label>
            <input type='date' name='end_date' value=''><br><br>
        </div>

        <input type='hidden' name='provider' value='<?php echo $providername; ?>'>
        <button type='submit' name='approve'>Approve</button>



    </form>
</body>

</html>