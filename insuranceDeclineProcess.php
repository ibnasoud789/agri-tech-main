<?php
include 'database.php';
if (isset($_POST['decline'])) {
  $farmerid = $_POST['id'];
  $verdictUpdate = "UPDATE `insurance_application` SET `status`='Declined' WHERE farmer_id='$farmerid'";
  $verdictUpdateResult = mysqli_query($conn, $verdictUpdate);

  if ($verdictUpdateResult == TRUE) {
    mysqli_commit($conn);
    echo 'Insurance Application Declined Successfully.';
    echo '</div>';
    echo "<script>console.log('Insurance Application Declined Successfully.');</script>";
    header("refresh:2; url=./insuranceProvider.php");
  } else {
    mysqli_rollback($conn);
    echo 'Error updating another table.';
  }
}
if (isset($_GET['id'])) {
  $farmerid = $_GET['id'];
  $query = "SELECT * FROM insurance_application WHERE farmer_id='$farmerid'";
  $result = mysqli_query($conn, $query);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $farmerid = $row['farmer_id'];
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
    <h2>Decline Insurance Request</h2>
    <input type='hidden' name='id' value='<?php echo $farmerid; ?>' readonly>
    <label for="decision">Click to decline insurance request</label>
    <button type='submit' name='decline'>Decline</button>
  </form>
</body>

</html>