<?php
include "database.php";
$user_name = '';
$userid = '';
$successMessage = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $repayAmount = $_POST['repay'];
  $loanid = $_POST['loanid'];
  $amountowned = $_POST['loan_amount'];
  $returned = $_POST['returned'];
  $totalPayback = $returned + $repayAmount;
  $sql = "UPDATE `loan` SET `amount_returned`=$returned + $repayAmount 
  WHERE `Loan_ID`='$loanid'";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    $Statusquery = "SELECT * FROM loan WHERE Loan_ID='$loanid'";
    $StatusResult = mysqli_query($conn, $Statusquery);
    $StatusRow = mysqli_fetch_array($StatusResult);
    $owned = $StatusRow["amount_owned"];
    $return = $StatusRow["amount_returned"];

    if ($owned == $return) {
      $loanStatus = 'Repaid';
    } else {
      $loanStatus = 'Partially Paid';
    }
    $creditScore = ($return / $owned) * 100;
    $sqlUpdateStatus = "UPDATE `loan` SET `loan_status`='$loanStatus',`credit_score`= '$creditScore' WHERE Loan_ID='$loanid'";
    $resultUpdateStatus = mysqli_query($conn, $sqlUpdateStatus);
    if ($resultUpdateStatus == TRUE) {
      mysqli_commit($conn);
      echo 'Repayment Successful.';
      echo '</div>';
      echo "<script>console.log('Repayment Successful.');</script>";
      header("refresh:2; url=./farmer.php");
    } else {
      mysqli_rollback($conn);
      echo 'Error updating loan status.';
    }
  } else {
    echo 'Error updating returned amount.';
  }
}

if (isset($_GET["id"])) {
  $farmerID = $_GET["id"];
  $loanAmountQuery = "SELECT * FROM loan WHERE Farmer_ID='$farmerID' AND loan_status!='Repaid'";
  $loanAmountResult = mysqli_query($conn, $loanAmountQuery);
  if ($loanAmountResult->num_rows > 0) {
    while ($loanAmountRow = $loanAmountResult->fetch_assoc()) {
      $amountOwned = (int)$loanAmountRow["amount_owned"];
      $amountReturned = (int)$loanAmountRow["amount_returned"];
      $payableAmount = $amountOwned - $amountReturned;
      $loanID = $loanAmountRow["Loan_ID"];
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loan Repayment</title>
</head>

<body>
  <h2>Repay Your Loan</h2>
  <form action="" method="post">
    <div>
      <input type='hidden' id='loanid' name='loanid' value='<?php echo $loanID ?>'>
      <input type='hidden' id='returned' name='returned' value='<?php echo $amountReturned ?>'>
      <label for='loan_amount'>Total Amount Owned</label>
      <input type='number' id='loan_amount' name='loan_amount' value="<?php echo $payableAmount ?>" readonly><br><br>
    </div>
    <div>
      <label for='repay'>Add Amount:</label>
      <input type='number' id='repay' name='repay' value=''><br><br>
    </div>
    <input type='submit' value='Pay'>

  </form>
</body>

</html>