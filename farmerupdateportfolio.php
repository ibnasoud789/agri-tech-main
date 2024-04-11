<?php
include 'database.php';

if (isset($_POST['update'])) {
  $farmerid = $_POST['id'];
  $contact = $_POST['contact'];
  $landsize = $_POST['landsize'];
  $area = $_POST['area'];
  $city = $_POST['city'];
  $postcode = $_POST['postcode'];

  $sql = "UPDATE `farmer_t` AS f JOIN `user` AS u ON f.Farmer_ID=u.userID  SET `contact_number`='$contact',`landsize`='$landsize',`area`='$area',`city`='$city',`postcode`='$postcode' WHERE Farmer_ID='$farmerid'";

  $result = $conn->query($sql);

  if ($result == TRUE) {
    echo 'Record updated successfully.';
    echo '</div>';
    echo "<script>console.log('Record updated successfully.');</script>";
    header("refresh:2; url=./farmer.php");
  } else {

    echo "Error:" . $sql . "<br>" . $conn->error;
  }
}

if (isset($_GET['id'])) {

  $farmerID = $_GET['id'];

  $query = "SELECT * FROM farmer_t AS f JOIN user AS u ON f.Farmer_ID=u.userID WHERE Farmer_ID='$farmerID'";

  $result = mysqli_query($conn, $query);

  if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
      $contact = $row['contact_number'];
      $landsize = $row['landsize'];
      $area  = $row['Area'];
      $city = $row['city'];
      $postcode = $row['postcode'];
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Profile</title>
  <style>
    h2 {
      text-align: center;
    }

    form {
      gap: 10px;
      width: 40%;
    }
    form div div{
      display: flex;
      flex-direction: column;
      gap: 5px;
    }
    form div div input{
      height: 20px;
      width: 100%;
      border-radius: 5px;
      padding: 10px;
      background-color: rgb(240, 247, 180);
    }
    button{
      font-weight: bold;
      width: 200px;
      height: 45px;
      margin-top: 10px;
      border-radius: 10px;
      color: white;
      background-color: rgb(1, 62, 1);
    }
  </style>
</head>

<body>
  <form method="post">
    <h2>Update Personal Information</h2>
    <div>
      <div>
        <input type='hidden' name='id' value='<?php echo $farmerID; ?>'>
        <label for="contact">Phone Number:</label>
        <input type='number' name='contact' value='<?php echo $contact; ?>'>
      </div>
      <div>
        <label for="landsize">Land Size:</label>
        <input type='text' name='landsize' value='<?php echo $landsize; ?>'>
      </div>
      <div>
        <label for="area">Area:</label>
        <input type='text' name='area' value='<?php echo $area; ?>'>
      </div>
      <div>
        <label for="city">City:</label>
        <input type='text' name='city' value='<?php echo $city; ?>'>
      </div>
      <div>
        <label for="postal">Postal Code:</label>
        <input type='text' name='postcode' value='<?php echo $postcode; ?>'>
      </div>
    </div>
    <button type='submit' name='update'>Update</button>
  </form>
</body>

</html>