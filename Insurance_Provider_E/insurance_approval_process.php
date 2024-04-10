<?php
include 'connection.php';

if (isset($_POST['approve'])) {
    $farmerid=$_POST['id'];
    $insuranceprovider=$_POST['provider'];
    $amount=$_POST['amount'];
    $coverage_amount=$_POST['coverage_amount'];
    $premium_amount=$_POST['premium_amount'];
    $policy_type=$_POST['policy_type'];
    $policy_period=$_POST['policy_period'];
    $payment_frequency=$_POST['payment_frequency'];

    $provideridQuery="SELECT * FROM insurance_application_t AS insa JOIN financial_service_provider_t AS fsp ON insa.preferred_provider=fsp.name WHERE preferred_provider='$insuranceprovider' ";
    $provideridResult=mysqli_query($conn,$provideridQuery);
    $provideridRow=mysqli_fetch_array($provideridResult);
    $providerid= $provideridRow["FSPid"];


    $sql="INSERT INTO `insurance_t` 
    SET `receiving_date`=CURDATE(),
     `policy_period`='$policy_period',  `policy_type`='$policy_type', `payment_frequency`='$payment_frequency',  `coverage_amount`='$coverage_amount',`premium_amount`='$premium_amount',`Farmer_ID`='$farmerid',`insurance_provider_id`='$providerid',`insurance_status`='Ongoing' ";
    $result=mysqli_query($conn,$sql);
    if($result==TRUE){
        echo 'Insurance Approved Successfully.';
        echo '</div>';
        echo "<script>console.log('Insurance Approved Successfully.');</script>";
        header("refresh:2; url=./insuranceProvider.php");
    

}else {

    echo "Error:" . $sql . "<br>" . $conn->error;
  }
}


if (isset($_GET['id'])) {
    $farmerid = $_GET['id'];

    $query = "SELECT * FROM insurance_application_t WHERE farmer_id='$farmerid'";
    $result = mysqli_query($conn, $query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $farmerid = $row['farmer_id'];
            $farmername = $row['farmer_name'];
            $insurance_amount = $row['insurance_amount'];
            $duration = $row['duration'];
            $providername= $row['preferred_provider'];
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
            <input type='text' name='fullname' value='<?php echo $farmername; ?>' readonly>
        </div>
        <div>
            <label for="id">User ID:</label>
            <input type='number' name='id' value='<?php echo $farmerid; ?>' readonly>
        </div>
        <div>
            <label for="loanamount">Loan Amount:</label>
            <input type='number' name='amount' value='<?php echo $loanamount;?>'>
        </div>
        <div>
            <label for="duration">Loan Duration:</label>
            <input type='text' name='duration' value='<?php echo $duration;?>'>
        </div>
        <div>
            <label for="coverage_amount">Coverage Amount:</label>
            <input type='number' name='coverage_amount' value=''>
        </div>
        <div>
            <label for="premium_amount">Premium Amount:</label>
            <input type='number' name='premium_amount' value=''>
        </div>

        <div>
            <label for="policy_period">Policy Period:</label>
            <input type='number' name='policy_period' value=''>
        </div>

        <label for="type">Choose a Policy Type:</label>
        <select id="type" name="type" required>
            <option value="">Select Type</option>
            <option value="Revenue Based">Revenue Based</option>
            <option value="Area Based">Area Based</option>
            <option value="Yield Based">Yield Based</option>
        </select><br><br>

        <div>
            <label for="repaymentdate">Repayment Date</label>
            <input type='date' name='repaymentdate' value=''>
        </div>

        <input type='hidden' name='provider' value='<?php echo $providername; ?>'>
        <button type='submit' name='approve'>Approve</button>



    </form>
</body>

</html>