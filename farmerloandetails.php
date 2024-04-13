<?php
session_start();
include 'database.php';

if (!isset($_SESSION['userid'])) {
  header("Location: login.php");
  exit;
}


$farmerID = $_SESSION['userid'];


//farmer name 
$nameQuery = "SELECT CONCAT(fname, ' ', mname, ' ', lname) AS farmer_name FROM farmer_t WHERE Farmer_ID='$farmerID'";
$nameResult = mysqli_query($conn, $nameQuery);
$nameRow = mysqli_fetch_assoc($nameResult);
$farmerName = $nameRow['farmer_name'];

//loan details
$tableQuery = "SELECT * FROM loan AS l JOIN financial_service_provider_t AS fsp ON l.Loan_Provider_ID=fsp.FSPid WHERE Farmer_ID='$farmerID'";
$tableResult = mysqli_query($conn, $tableQuery);

//total loan amount & loan no count
$loanQuery = "SELECT SUM(amount) AS total_loan_received, COUNT(Loan_ID) AS total_loan_count FROM loan WHERE Farmer_ID = '$farmerID'";
$loanResult = mysqli_query($conn, $loanQuery);
$loanRow = mysqli_fetch_assoc($loanResult);
$totalLoanReceived = $loanRow['total_loan_received'];
$totalLoanCount = $loanRow['total_loan_count'];

?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    * {
      margin: 0;
      padding: 0;
      border: none;
      outline: none;
      box-sizing: border-box;
      font-family: Arial, Helvetica, sans-serif;
    }

    body {
      display: flex;
    }

    .main-section {
      position: relative;
      background-color: white;
      width: 100%;
      padding: 1.5rem;
    }

    .header-wrapper {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      background-color: rgb(184, 247, 184);
      border-radius: 10px;
      padding: 10px 2rem;
      margin-bottom: 1rem;
    }

    .header-title {
      color: rgb(1, 62, 1);
    }

    .user-info {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .search-box {
      background: rgb(213, 245, 164);
      border-radius: 15px;
      color: rgb(1, 62, 1);
      display: flex;
      align-items: center;
      gap: 5px;
      padding: 4px 12px;
    }

    .search-box input {
      background: transparent;
      padding: 10px;
    }

    .search-box i {
      font-size: 1.2rem;
      cursor: pointer;
      transition: all 0.5s ease-out;
    }

    .search-box i:hover {
      transform: scale(1.2);
    }

    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td,
    th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: rgb(227, 247, 198);
    }

    .card-container {
      display: flex;
      flex-direction: column;
      margin-top: 20px;
    }

    .loanPortfolioOverview {
      display: flex;
      flex-direction: column;
      height: 50vh;
      background-color: rgb(184, 247, 184);
      border-radius: 10px;
      padding: 10px 2rem;
      margin-bottom: 1rem;
      width: 100%;
    }

    h2 {
      font-size: 22px;
      margin-bottom: 10px;
      text-align: center;
    }

    .loanPortfolioOverview p {
      font-size: 15px;
      margin-bottom: 5px;
    }

    .loanPortfolioOverview p span {
      color: rgb(1, 62, 1);
      font-weight: bold;
      font-size: 18px;
    }

    .loanApplication {
      display: flex;
      flex-direction: column;
      height: 40vh;
      background-color: rgb(184, 247, 184);
      border-radius: 10px;
      padding: 10px 2rem;
      margin-bottom: 1rem;
      width: 100%;
    }

    .user-info button {
      width: 30px;
      height: 15px;
      background-color: aqua;
    }

    .user-info button {
      width: 60px;
      height: 30px;
      color: aliceblue;
      background-color: rgb(1, 62, 1);
      border-radius: 5px;
      transition: ease all 0.5s;
      cursor: pointer;
    }

    .user-info button:hover {
      background-color: rgb(1, 62, 1, .9);
      transform: scale(1.1);
    }
  </style>
</head>

<body>
  <div class="main-section">
    <div class="header-wrapper">
      <div class="header-title">
        <span>User Loan</span>
        <h2>Dashboard</h2>
      </div>
      <div class="user-info">
        <h4>Welcome, <?php echo $farmerName; ?>!</h4>
        <button onclick="location.href='farmer.php'">Go Back</button>
      </div>
    </div>
    <div class="card-container">
      <div class="loanPortfolioOverview">
        <h2>Loan Details</h2>
        <p>Total number of loans: <span id="totalLoans"> <?php echo $totalLoanCount; ?></span></p>
        <p>Total loan value: <span id="totalLoanValue"> BDT <?php echo $totalLoanReceived; ?></span></p>
        <div>Details</div>
        <table id="loanTable">
          <tr>
            <th>Loan ID</th>
            <th>Loan Provider ID</th>
            <th>Loan Provider Name</th>
            <th>Loan Amount</th>
            <th>Interest Rate</th>
            <th>Issue Date</th>
            <th>Repayment Date</th>
            <th>Loan Status</th>
          </tr>
          <?php
          while ($row = mysqli_fetch_assoc($tableResult)) {
            echo "<tr>";
            echo "<td>" . $row['Loan_ID'] . "</td>";
            echo "<td>" . $row['Loan_Provider_ID'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['amount'] . "</td>";
            echo "<td>" . $row['interest_rate'] . "</td>";
            echo "<td>" . $row['receiving_date'] . "</td>";
            echo "<td>" . $row['return_date'] . "</td>";
            echo "<td>" . $row['loan_status'] . "</td>";
            echo "</tr>";
          }
          ?>
        </table>
      </div>
      <div class="pending">

      </div>
    </div>
  </div>

</body>

</html>