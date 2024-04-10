<?php
include "connection.php";
$user_name = '';
$userid = '';
$successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['user_name'];
    $userid = $_POST['user_id'];
    $insurance_amount = $_POST['insurance_amount'];
    $provider = $_POST['provider'];

    $sql = "INSERT INTO insurance_application_t (farmer_name, farmer_id, insurance_amount, preferred_provider, Verdict) VALUES ('$user_name', '$userid', '$insurance_amount', '$provider','Pending')";
    if ($conn->query($sql) === TRUE) {
        $successMessage = "Insurance application submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

if (isset($_GET["id"])) {
    $farmerID= $_GET["id"];
    $query="SELECT Farmer_ID, CONCAT(fname,' ',mname,' ',lname) AS farmer_name FROM farmer_t WHERE Farmer_ID='$farmerID'";
    $result = mysqli_query($conn,$query);
    $row=mysqli_fetch_array($result);
    $id= $row["Farmer_ID"];
    $name= $row["farmer_name"]; 
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Application Form</title>
</head>

<body>
    <h2>Insurance Application Form</h2>
    <form action="" method="post">
        <label for="user_name">Full Name:</label>
        <input type="text" id="user_name" name="user_name" value="<?php echo $name; ?>" readonly><br><br>

        <label for="user_id">Your ID:</label>
        <input type="text" id="user_id" name="user_id" value="<?php echo $id; ?>" readonly><br><br>

        <label for="insurance_amount">Insurance Amount:</label>
        <input type="number" id="insurance_amount" name="insurance_amount" required><br><br>

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
            var insuranceAmount = document.getElementById("insurance_amount").value;
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