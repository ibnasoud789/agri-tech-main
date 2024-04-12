<?php
include "database.php";
$user_name = '';
$userid = '';
$successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['user_name'];
    $userid = $_POST['user_id'];
    $insurance_policy = $_POST['insurance_policy'];
    $duration = $_POST['duration'];
    $provider = $_POST['provider'];

    $sql = "INSERT INTO insurance_application(farmer_name, farmer_id,`policy`,duration, preferred_provider, `status`) VALUES ('$user_name', '$userid', '$insurance_policy','$duration', '$provider','Pending')";
    if ($conn->query($sql) === TRUE) {
        $successMessage = "Insurance application submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET["id"])) {
    $farmerID = $_GET["id"];

    // Check if the farmer has a current insurance
    $checkInsuranceQuery = "SELECT * FROM insurance_t WHERE Farmer_ID='$farmerID' AND insurance_status='Ongoing'";
    $checkInsuranceResult = $conn->query($checkInsuranceQuery);

    if ($checkInsuranceResult) {
        if ($checkInsuranceResult->num_rows > 0) {
            echo "<script>alert('You already have an active insurance.');
            window.location.href = 'farmer.php';</script>";
            exit;
        } else {
            // Fetch farmer details if there is no active insurance
            $query = "SELECT Farmer_ID, CONCAT(fname,' ',mname,' ',lname) AS farmer_name FROM farmer_t WHERE Farmer_ID='$farmerID'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($result);
            $id = $row["Farmer_ID"];
            $name = $row["farmer_name"];
        }
    } else {
        echo "Error: " . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insurance Application Form</title>
</head>

<body>
    <h2>Insurance Application Form</h2>
    <form action="" method="post">
        <label for="user_name">Full Name:</label>
        <input type="text" id="user_name" name="user_name" value="<?php echo $name; ?>" readonly><br><br>

        <label for="user_id">Your ID:</label>
        <input type="text" id="user_id" name="user_id" value="<?php echo $id; ?>" readonly><br><br>

        <label for="insurance_policy">Insurance Policy:</label>
        <select type="number" id="insurance_policy" name="insurance_policy" required>
            <option value="">Select a policy:</option>
            <option value="Multi-Peril Crop Insurance (MPCI)">Multi-Peril Crop Insurance (MPCI)</option>
            <option value="Crop Revenue Insurance">Crop Revenue Insurance</option>
            <option value="Crop Yield Insurance">Crop Yield Insurance</option>
            <option value="Area-Based Crop Insurance">Area-Based Crop Insurance</option>
        </select><br><br>
        <label for="duration">Duration</label>
        <select id='duration' name='duration' required>
            <option value='6 Months'>6 Months</option>
            <option value='1 Year'>1 Year</option>
            <option value='2 Year'>2 Year</option>
            <option value='3 Year'>3 Year</option>
            <option value='4 Year'>4 Year</option>
            <option value='5 Year'>5 Year</option>
        </select><br><br>
        <label for="provider">Choose a Insurance Provider:</label>
        <select id="provider" name="provider" required>
            <option value="">Select Provider</option>
            <option value="Sonali Bank">Sonali Bank</option>
            <option value="Rajshahi Krishi Unnoyon Bank">Rajshahi Krishi Unnoyon Bank</option>
            <option value="Green Delta Insurance Limited">Green Delta Insurance Limited</option>
            <option value="City Bank">City Bank</option>
            <option value="BDBL">BDBL</option>
            <option value="Krishok Kollan Porishod">Krishok Kollan Porishod</option>
            <option value="Prime Insurance Company Limited">Prime Insurance Company Limited</option>
            <option value="Khan Krishi Foundation">Khan Krishi Foundation</option>
        </select><br><br>

        <input type="submit" value="Submit">
    </form>
    <script>
        function validateForm() {
            var userName = document.getElementById("user_name").value;
            var userId = document.getElementById("user_id").value;
            var insurancePolicy = document.getElementById("insurance_policy").value;
            var provider = document.getElementById("provider").value;

            if (userName == "" || userId == "" || insuranceAmount == "" || provider == "") {
                alert("All fields are required");
                return false;
            }
        }
        window.onload = function() {
            <?php if (!empty($successMessage)) : ?>
                alert("<?php echo $successMessage; ?>");
                window.location.href = "farmer.php";
            <?php endif; ?>
        };
    </script>
</body>

</html>