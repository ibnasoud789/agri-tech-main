<?php
session_start();
include 'database.php';

if (!isset($_SESSION['userid'])) {

  header("Location: login.php");
  exit;
}

$InvestorID = $_SESSION['userid'];

$query = "SELECT * FROM investment_t AS i JOIN farmer_t AS ft ON i.Farmer_ID=ft.Farmer_ID WHERE Investor_ID = '$InvestorID'";
$result = mysqli_query($conn, $query);

//investment provider name
$nameQuery = "SELECT * FROM financial_service_provider_t WHERE FSPid='$InvestorID'";
$nameResult = mysqli_query($conn, $nameQuery);
$nameRow = mysqli_fetch_array($nameResult);
$investorname = $nameRow['name'];


//total investment amount & loan no count
$investmentQuery = "SELECT SUM(Amount) AS total_investment_provided, COUNT(Investment_ID) AS total_investment_count FROM investment_t WHERE Investor_ID = '$InvestorID'";
$investmentResult = mysqli_query($conn, $investmentQuery);
$investmentRow = mysqli_fetch_assoc($investmentResult);
$totalInvstmentProvided = $investmentRow['total_investment_provided'];
$totalInvestmentCount = $investmentRow['total_investment_count'];

//investment application verdict update
$applicationQuery = "SELECT * FROM investment_application_t WHERE Verdict='Pending' AND preferred_investor='$investorname'";
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
      background-color: rgba(120, 120, 252, 0.269);
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

    .loanPortfolioOverview,
    .loanapplication {
      display: flex;
      flex-direction: column;
      height: 60vh;
      background-color: rgba(120, 120, 252, 0.269);
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
        <span>Investor</span>
        <h2>Dashboard</h2>
      </div>
      <div class="user-info">

<<<<<<< Updated upstream
        <h4>Welcome   </h4>
=======
        <h4>Welcome, <?php echo $investorname; ?></h4>
>>>>>>> Stashed changes

        <button onclick="location.href='index.html'">Log Out</button>
      </div>
    </div>
    <div class="card-container">
      <div class="loanPortfolioOverview">
        <h2>Investment Portfolio Overview</h2>


        <p>Total number of investments: <span id="totalLoans"> <?php echo $totalInvestmentCount; ?></span></p>
        <p>Total investment: <span id="totalLoanValue"> BDT <?php echo $totalInvstmentProvided; ?></span></p>
        <div>Details</div>
        <table id="loanTable">

          <tr>
            <th>Investment ID</th>
            <th>Farmer ID</th>
            <th>Farmer Name
            <th>Investment Amount</th>
            <th>Profit Share Rate</th>
            <th>Issue Date</th>
            <th>Investment Return Date</th>
            <th>Status</th>
          </tr>
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['Investment_ID'] . "</td>";
            echo "<td>" . $row['Farmer_ID'] . "</td>";
            echo "<td>" . $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'] . "</td>";
            echo "<td>" . $row['Amount'] . "</td>";
            echo "<td>" . $row['Profit_share_rate'] . "</td>";
            echo "<td>" . $row['Start_date'] . "</td>";
            echo "<td>" . $row['End_date'] . "</td>";
            echo "<td>". $row["investment_status"] . "</td>";
            echo "</tr>";
          }
          ?>
        </table>
      </div>
      <div class="loanapplication">
        <h2>Investment Applications</h2>
        <table id="loanApplicationTable">
          <tr>
            <th>Farmer Name</th>
            <th>Farmer ID</th>
            <th>Investment Amount</th>
            <th>Duration</th>
            <th>Verdict</th>
          </tr>
          <?php
          while ($applicationRow = mysqli_fetch_assoc($applicationResult)) {
            echo "<tr>";
            echo "<td>" . $applicationRow['farmer_name'] . "</td>";
            echo "<td>" . $applicationRow['Farmer_ID'] . "</td>";
            echo "<td>" . $applicationRow['investment_amount'] . "</td>";
            echo "<td>". $applicationRow["Duration"] ."</td>";
            echo "<td>";
            echo "<button class='accept-button' onclick=\"window.location.href='investmentApprovalProcess.php?id=".$applicationRow['Farmer_ID']."'\">Accept</button>";
            echo "<button class='decline-button' onclick=\"window.location.href='investmentDeclineProcess.php?id=".$applicationRow['Farmer_ID']."'\">Decline</button>";
            echo "</td>";
            echo "</tr>";
          }
          ?>

        </table>


      </div>
    </div>
  </div>
  <!--<script>
    function declareProfitShareRate(farmer_id) {

    }

    var profitshareRate = prompt("Please declare the profit share rate:");

    if (profitshareRate !== null && profitshareRate !== "") {

      var verdict = document.querySelector(".verdict[data-farmer-id='" + farmer_id + "']");
      if (verdict) {
        verdict.textContent = "Accepted";
      }

      var buttonContainer = document.getElementById("button_" + farmer_id);
      if (buttonContainer) {
        buttonContainer.style.display = "none";
      }


      alert("Investment approval successful!");
    } else {
      alert("Profit share rate declaration canceled.");


    }

    function declineLoan(farmer_id) {
      document.querySelector(".verdict[data-farmer-id='" + farmer_id + "']").textContent = "Declined";
    }
  </script>-->


  </div>
  </div>
  </div>

</body>

</html>