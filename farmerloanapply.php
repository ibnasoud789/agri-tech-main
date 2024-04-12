<?php
include "database.php";
$user_name = '';
$userid = '';
$successMessage = '';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['user_name'];
    $userid = $_POST['user_id'];
    $loan_amount = $_POST['loan_amount'];
    $bank = $_POST['bank'];
    $duration = $_POST['duration'];

    $sql = "INSERT INTO loan_application_t (farmer_name, farmer_id, loan_amount, preferred_bank, Verdict,duration) VALUES ('$user_name', '$userid', '$loan_amount', '$bank','Pending','$duration')";
    if ($conn->query($sql) === TRUE) {
        $successMessage = "Loan application submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET["id"])) {
    $farmerID = $_GET["id"];
    $checkLoanQuery = "SELECT * FROM loan WHERE Farmer_ID='$farmerID' AND loan_status='Ongoing'";
    $checkLoanResult = $conn->query($checkLoanQuery);

    if ($checkLoanResult) {
        if ($checkLoanResult->num_rows > 0) {
            echo "<script>alert('You already have a loan package');
            window.location.href = 'farmer.php';</script>";

            exit;
        } else {
            $query = "SELECT Farmer_ID, CONCAT(fname,' ',mname,' ',lname) AS farmer_name FROM farmer_t WHERE Farmer_ID='$farmerID'";
            $result = $conn->query($query);

            if ($result) {
                $row = $result->fetch_assoc();
                $id = $row["Farmer_ID"];
                $name = $row["farmer_name"];
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Application Form</title>
    <style>
        h2 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <h2>Loan Application Form</h2>
    <form action="" method="post">
        <div>
            <label for="user_name">Full Name:</label>
            <input type="text" id="user_name" name="user_name" value="<?php echo $name; ?>" readonly><br><br>
        </div>
        <div>
            <label for="user_id">Your ID:</label>
            <input type="text" id="user_id" name="user_id" value="<?php echo $id; ?>" readonly><br><br>
        </div>
        <div>
            <label for="loan_amount">Loan Amount:</label>
            <input type="number" id="loan_amount" name="loan_amount" required><br><br>
        </div>
        <div>
            <label for="duration">Loan Duration:</label>
            <input type="text" id="duration" name="duration" required><br><br>
        </div>
        <div>
            <label for="provider">Choose a Loan Provider:</label>
            <select id="bank" name="bank" required>
                <option value="">Select Bank</option>
                <option value="Agrani Bank">Agrani Bank</option>
                <option value="City Bank">City Bank</option>
                <option value="Rajshahi Krishi Unnoyon Bank">Rajshahi Krishi Unnoyon Bank</option>
                <option value="Bank Asia">Bank Asia</option>
                <option value="Sonali Bank">Sonali Bank</option>
                <option value="BDBL">BDBL</option>
                <option value="Pubali Bank Limited">Pubali Bank Limited</option>
                <option value="Islami Bank Limited">Islami Bank Limited</option>
                <option value="Grameen Bank">Grameen Bank</option>
                <option value="SBAC Bank">SBAC Bank</option>
            </select><br><br>

        </div>
        <input type="submit" value="Submit">
    </form>
    <script>
        function validateForm() {
            var userName = document.getElementById("user_name").value;
            var userId = document.getElementById("user_id").value;
            var loanAmount = document.getElementById("loan_amount").value;
            var bank = document.getElementById("bank").value;

            if (userName == "" || userId == "" || loanAmount == "" || bank == "") {
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