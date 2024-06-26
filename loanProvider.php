<?php
session_start();
include 'database.php';

if (!isset($_SESSION['userid'])) {

  header("Location: login.php");
  exit;
}

$loanProviderID = $_SESSION['userid'];

$query = "SELECT * FROM loan AS l JOIN farmer_t AS ft ON l.Farmer_ID=ft.Farmer_ID WHERE Loan_Provider_ID='$loanProviderID'";
$result = mysqli_query($conn, $query);

//loan provider name
$nameQuery = "SELECT * FROM financial_service_provider_t WHERE FSPid='$loanProviderID'";
$nameResult = mysqli_query($conn, $nameQuery);
$nameRow = mysqli_fetch_array($nameResult);
$loanprovidername = $nameRow['name'];


//total loan amount & loan no count
$loanQuery = "SELECT SUM(amount) AS total_loan_provided, COUNT(Loan_ID) AS total_loan_count FROM loan WHERE Loan_Provider_ID = '$loanProviderID'";
$loanResult = mysqli_query($conn, $loanQuery);
$loanRow = mysqli_fetch_assoc($loanResult);
$totalLoanProvided = $loanRow['total_loan_provided'];
$totalLoanCount = $loanRow['total_loan_count'];

//loan application 
$applicationQuery = "SELECT * FROM loan_application_t WHERE Verdict='Pending' AND  preferred_bank='$loanprovidername'";
$applicationResult = mysqli_query($conn, $applicationQuery);
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
      background-color: rgb(148, 232, 218);
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
      background-color: rgb(162, 245, 248);
    }

    .card-container {
      display: flex;
      flex-direction: column;
      margin-top: 20px;
    }

    .loanPortfolioOverview,
    .loanapplication {
      display: flex;
      flex-direction: column;
      height: 50vh;
      background-color: rgb(194, 247, 238);
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

    .loanapplication {
      display: flex;
      flex-direction: column;
      height: 40vh;
      background-color: rgb(194, 247, 238);
      border-radius: 10px;
      padding: 10px 2rem;
      margin-bottom: 1rem;
      width: 100%;
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

    .button {
      display: flex;
      gap: 2px;

    }

    .accept-button {
      width: 60px;
      height: 20px;
      border-radius: 5px;
      cursor: pointer;
      color: white;
      background-color: green;
    }

    .accept-button:active {
      background-color: rgb(1, 62, 1, .8);
    }

    .decline-button {
      width: 60px;
      height: 20px;
      border-radius: 5px;
      cursor: pointer;
      color: white;
      background-color: red;
    }
  </style>
</head>

<body>
  <div class="main-section">
    <div class="header-wrapper">
      <div class="header-title">
        <span>Loan Provider</span>
        <h2>Dashboard</h2>
      </div>
      <div class="user-info">
        <h4>Welcome, <?php echo $loanprovidername; ?>!</h4>
        <button onclick="location.href='index.html'">Log Out</button>
      </div>
    </div>
    <div class="card-container">
      <div class="loanPortfolioOverview">
        <h2>Loan Portfolio Overview</h2>
        <p>Total number of loans: <span id="totalLoans"> <?php echo $totalLoanCount; ?></span></p>
        <p>Total loan value: <span id="totalLoanValue"> BDT <?php echo $totalLoanProvided; ?></span></p>
        <div>Details</div>
        <table id="loanTable">
          <tr>
            <th>Loan ID</th>
            <th>Farmer ID</th>
            <th>Farmer Name</th>
            <th>Loan Amount</th>
            <th>Interest Rate</th>
            <th>Issue Date</th>
            <th>Repayment Date</th>
            <th>Loan Status</th>
          </tr>
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['Loan_ID'] . "</td>";
            echo "<td>" . $row['Farmer_ID'] . "</td>";
            echo "<td>" . $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'] . "</td>";
            echo "<td>" . $row['amount'] . "</td>";
            echo "<td>" . $row['interest_rate'] . "</td>";
            echo "<td>" . $row['receiving_date'] . "</td>";
            echo "<td>" . $row['return_date'] . "</td>";
            echo "<td>" . $row["loan_status"] . "</td>";
            echo "</tr>";
          }
          ?>
        </table>
      </div>
      <div class="loanapplication">
        <h2>Loan Applications</h2>
        <table id="loanApplicationTable">
          <tr>
            <th>Farmer Name</th>
            <th>Farmer ID</th>
            <th>Loan Amount</th>
            <th>Duration</th>
            <th>Verdict</th>
          </tr>
          <?php
          while ($applicationRow = mysqli_fetch_assoc($applicationResult)) {
            echo "<tr>";
            echo "<td><a href='farmerPersonalDetails.php?id=" . $applicationRow['farmer_id'] . "' target='_blank' style='color: green; text-decoration: none;'>" . $applicationRow['farmer_name'] . "</a></td>";
            echo "<td>" . $applicationRow['farmer_id'] . "</td>";
            echo "<td>" . $applicationRow['loan_amount'] . "</td>";
            echo "<td>" . $applicationRow["duration"] . "</td>";
            echo "<td>";
            echo "<button class='accept-button' onclick=\"window.location.href='loanApprovalProcess.php?id=" . $applicationRow['farmer_id'] . "'\">Accept</button>";
            echo "<button class='decline-button' onclick=\"window.location.href='loanDeclineProcess.php?id=" . $applicationRow['farmer_id'] . "'\">Decline</button>";
            echo "</td>";
            echo "</tr>";
          }
          ?>

        </table>


      </div>
    </div>
  </div>
</body>

</html>