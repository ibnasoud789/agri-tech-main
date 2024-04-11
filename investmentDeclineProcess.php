<?php
include 'database.php';
if (isset($_POST['decline'])) {
  $Farmer_ID=$_POST['id'];
  $verdictUpdate = "UPDATE `investment_application_t` SET `Verdict`='Declined' WHERE Farmer_ID='$Farmer_ID'";
  $verdictUpdateResult = mysqli_query($conn, $verdictUpdate);

  if ($verdictUpdateResult == TRUE) {
    mysqli_commit($conn);
    echo 'Investment Declined Successfully.';
    echo '</div>';
    echo "<script>console.log('Investment Declined Successfully.');</script>";
    header("refresh:2; url=./investor.php");
  } else {
    mysqli_rollback($conn);
    echo 'Error updating another table.';
  }
}
if (isset($_GET['id'])) {
    $Farmer_ID = $_GET['id'];

  $query = "SELECT * FROM investment_application_t WHERE Farmer_ID='$Farmer_ID'";
  $result = mysqli_query($conn, $query);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $Farmer_ID = $row['Farmer_ID'];
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form method='post'>
    <h2>Decline Investment Approval</h2>
    <input type='hidden' name='id' value='<?php echo $Farmer_ID; ?>' readonly>
    <label for="decision">Click below to decline investment request</label>
    <button type='submit' name='decline'>Decline</button>
  </form>
</body>

</html>