<?php
include "database.php";
$user_name = '';
$userid = '';
$successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['user_name'];
    $userid = $_POST['user_id'];
    $investment_amount = $_POST['investment_amount'];
    $investor = $_POST['investor'];
    $duration= $_POST['duration'];

    $sql = "INSERT INTO investment_application_t (farmer_name, Farmer_ID,investment_amount , preferred_investor,Duration,Verdict) VALUES ('$user_name', '$userid', '$investment_amount', '$investor','$duration','Pending')";
    if ($conn->query($sql) === TRUE) {
        $successMessage = "Investment application submitted successfully.";
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
    <h2>Investment Application Form</h2>
    <form action="" method="post">
        <label for="user_name">Full Name:</label>
        <input type="text" id="user_name" name="user_name" value="<?php echo $name; ?>" readonly><br><br>

        <label for="user_id">Your ID:</label>
        <input type="text" id="user_id" name="user_id" value="<?php echo $id; ?>" readonly><br><br>

        <label for="investment_amount">Investment Amount:</label>
        <input type="number" id="investment_amount" name="investment_amount" required><br><br>

        <label for="duration" >Investment Duration:</label>
        <input type="text" id="duration" name="duration" required><br><br>

        <label for="provider">Choose a Investor:</label>
        <select id="investor" name="investor" required>
            <option value="">Select Investor</option>
            <option value="Agrani Bank">Agrani Bank</option>
            <option value="Fatima Ahmed Foundation">Fatima Ahmed Foundation</option>
            <option value="Nasir Uddin Ahmed">Nasir Uddin Ahmed</option>
            <option value="Green Delta Insurance Limited">Green Delta Insurance Limited</option>
            <option value="BDBL">BDBL</option>
            <option value="Krishok Kollan Porishod">Krishok Kollan Porishod</option>
            <option value="Khan Krishi Foundation">Khan Krishi Foundation</option>
        </select><br><br>

        
        
        
        <input type="submit" value="Submit">
    </form>
    <script>
        function validateForm() {
            var userName = document.getElementById("user_name").value;
            var userId = document.getElementById("user_id").value;
            var InvestmentAmount = document.getElementById("investment_amount").value;
            var investor = document.getElementById("investor").value;

            if (userName == "" || userId == "" || InvestmentAmount == "" || investor == "") {
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