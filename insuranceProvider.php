<?php
session_start();
include '../database.php';

if (!isset($_SESSION['userid'])) {

  header("Location: ../login.php");
  exit;
}

$insuranceProviderID = $_SESSION['userid'];

$query = "SELECT * FROM insurance_t AS ins JOIN farmer_t AS ft ON ins.Farmer_ID=ft.Farmer_ID WHERE insurance_provider_id='$insuranceProviderID'";
$result = mysqli_query($conn, $query);

//insurance provider name
$nameQuery = "SELECT * FROM financial_service_provider_t WHERE FSPid='$insuranceProviderID'";
$nameResult = mysqli_query($conn, $nameQuery);
$nameRow = mysqli_fetch_array($nameResult);
$insuranceprovidername = $nameRow['name'];


//total insurance amount & insurance no count
$insuranceQuery = "SELECT SUM(coverage_amount + premium_amount) AS total_insurance_provided, COUNT(insurance_id) AS total_insurance_count FROM insurance_t WHERE Insurance_Provider_ID = '$insuranceProviderID'";
$insuranceResult = mysqli_query($conn, $insuranceQuery);
$insuranceRow = mysqli_fetch_assoc($insuranceResult);
$totalInsuranceProvided = $insuranceRow['total_insurance_provided'];
$totalInsuranceCount = $insuranceRow['total_insurance_count'];


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
      background-color: rgb(249, 172, 125);
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
      background-color: rgb(248, 188, 156);
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
      height: 60vh;
      background-color: rgb(250, 205, 180);
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
      background-color: rgb(250, 205, 180);
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
        <span>Insurance Provider</span>
        <h2>Dashboard</h2>
      </div>
      <div class="user-info">
        <h4>Welcome, <?php echo $insuranceprovidername; ?>!</h4>
        <button onclick="location.href='index.html'">Log Out</button>
      </div>
    </div>
    <div class="card-container">
      <div class="loanPortfolioOverview">
        <h2>Insurance Portfolio Overview</h2>
        <p>Total number of insurance: <span id="totalLoans"> <?php echo $totalInsuranceCount; ?></span></p>
        <p>Total insurance value: <span id="totalLoanValue"> BDT <?php echo $totalInsuranceProvided; ?></span></p>
        <div>Details:</div>
        <table id="loanTable">
          <tr>
            <th>Insurance ID</th>
            <th>Farmer ID</th>
            <th>Farmer Name
            <th>Insurance Amount</th>
            <th>Effective Date</th>
            <th>Payment Method</th>
            <th>Policy Type</th>
          </tr>

          <?php
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['insurance_id'] . "</td>";
            echo "<td>" . $row['Farmer_ID'] . "</td>";
            echo "<td>" . $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'] . "</td>";
            echo "<td>" . ($row['coverage_amount'] + $row['premium_amount']) . "</td>";
            echo "<td>" . $row['effective_date'] . "</td>";
            echo "<td>" . $row['payment_method'] . "</td>";
            echo "<td>" . $row['policy_type'] . "</td>";
            echo "</tr>";
          }
          ?>


        </table>
      </div>
      <div class="loanapplication">
        <h2>Insurance Applications</h2>
        <table id="loanApplicationTable">
          <tr>
            <th>Farmer Name</th>
            <th>Farmer ID</th>
            <th>Insurance Amount</th>
            <th>Verdict</th>
          </tr>
          <!--sql-->
        </table>


      </div>
    </div>
  </div>
  <script>

  </script>


</body>

</html>