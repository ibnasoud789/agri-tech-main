<?php
include 'database.php';

if (isset($_GET["id"])) {
  $farmerID = $_GET["id"];
  //farmer personal information details
  $nameQuery = "SELECT CONCAT(fname, ' ', mname, ' ', lname) AS farmer_name FROM farmer_t WHERE Farmer_ID='$farmerID'";
  $nameResult = mysqli_query($conn, $nameQuery);
  $nameRow = mysqli_fetch_assoc($nameResult);
  $farmerName = $nameRow['farmer_name'];
  $infoQuery = "SELECT * FROM farmer_t AS f LEFT JOIN user AS u ON f.Farmer_ID=u.userID LEFT JOIN farmer_cropname_t AS fc ON f.Farmer_ID=fc.Farmer_ID
  WHERE f.Farmer_ID='$farmerID'";
  $infoResult = mysqli_query($conn, $infoQuery);
  $infoRow = mysqli_fetch_assoc($infoResult);
  $area = $infoRow['Area'];
  $city = $infoRow['city'];
  $postcode = $infoRow['postcode'];
  $contact = $infoRow['contact_number'];
  $landsize = $infoRow['landsize'];

  $cropQuery = "SELECT GROUP_CONCAT(Cropname) AS Crops FROM farmer_cropname_t WHERE Farmer_ID='$farmerID' GROUP BY Farmer_ID";
  $cropResult = mysqli_query($conn, $cropQuery);
  $cropRow = mysqli_fetch_assoc($cropResult);
  $crops = $cropRow["Crops"];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Farmer Details</title>
  <style>
    form {
      height: 60vh;

    }

    form h2 {
      text-align: center;
    }

    form div {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 20px;

    }

    form div div {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    form div div input {
      height: 25px;
      width: 80%;
      border-radius: 5px;
      padding: 10px;
      background-color: rgb(240, 247, 180);
    }
  </style>
</head>

<body>
  <div id="profile" class='profile'>
    <form>
      <h2>Farmer Personal Details</h2>
      <div>
        <div>
          <div>
            <label for="fullname">Full Name:</label>
            <input type='text' name='fullname' value='<?php echo $farmerName; ?>' readonly>
          </div>
          <div>
            <label for="id">User ID:</label>
            <input type='number' name='id' value='<?php echo $farmerID; ?>' readonly>
          </div>
          <div>
            <label for="landsize">Land Size:</label>
            <input type='text' name='landsize' value='<?php echo $landsize; ?>' readonly>
          </div>
          <div>
            <label for='cropname'>Cropname:</label>
            <input type='text' name='cropname' value='<?php echo $crops ?>' readonly>
          </div>
        </div>
        <div>
          <div>
            <label for="contact">Phone Number:</label>
            <input type='number' name='contact' value='<?php echo $contact; ?>' readonly>
          </div>
          <div>
            <label for="area">Area:</label>
            <input type='text' name='area' value='<?php echo $area; ?>' readonly>
          </div>
          <div>
            <label for="city">City:</label>
            <input type='text' name='city' value='<?php echo $city; ?>' readonly>
          </div>
          <div>
            <label for="postal">Postal Code:</label>
            <input type='text' name='postal' value='<?php echo $postcode; ?>' readonly>
          </div>
        </div>
      </div>

    </form>
  </div>
</body>

</html>