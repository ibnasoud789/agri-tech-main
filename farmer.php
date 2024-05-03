<?php
session_start();
include 'database.php';

if (!isset($_SESSION['userid'])) {
  header("Location: login.php");
  exit;
}

// Retrieve the user's ID from the session
$farmerID = $_SESSION['userid'];

$query = "SELECT * FROM loan WHERE Farmer_ID='$farmerID'";
$result = mysqli_query($conn, $query);

//farmer name 
$nameQuery = "SELECT CONCAT(fname, ' ', mname, ' ', lname) AS farmer_name FROM farmer_t WHERE Farmer_ID='$farmerID'";
$nameResult = mysqli_query($conn, $nameQuery);
$nameRow = mysqli_fetch_assoc($nameResult);
$farmerName = $nameRow['farmer_name'];

//farmer personal information details
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
//loan details
//total loan
$loanQuery = "SELECT SUM(amount) AS total_loan_received FROM loan WHERE Farmer_ID='$farmerID'";
$loanResult = mysqli_query($conn, $loanQuery);
$loanRow = mysqli_fetch_assoc($loanResult);
$totalLoanReceived = $loanRow['total_loan_received'];

//repaid loan
$repaidQuery = "SELECT SUM(amount_returned) AS total_loan_repaid FROM loan WHERE Farmer_ID='$farmerID'";
$repaidResult = mysqli_query($conn, $repaidQuery);
$repaidRow = mysqli_fetch_assoc($repaidResult);
$totalLoanRepaid = $repaidRow['total_loan_repaid'];

//current
$crnloanQuery = "SELECT * FROM loan AS l JOIN financial_service_provider_t AS fsp ON l.Loan_Provider_ID=fsp.FSPid WHERE loan_status!='Repaid' AND Farmer_ID='$farmerID'";
$crnloanResult = mysqli_query($conn, $crnloanQuery);
if ($crnloanResult && mysqli_num_rows($crnloanResult) > 0) {
  $crnloanRow = mysqli_fetch_assoc($crnloanResult);
  $amountOwned = (int)$crnloanRow["amount_owned"];
  $amountreturned = (int)$crnloanRow["amount_returned"];
  $crnloanamount = $amountOwned - $amountreturned;
  $loanreturn = $crnloanRow["return_date"];
  $crnintrate = $crnloanRow["interest_rate"];
  $crnloanprovider = $crnloanRow["name"];
  $crnloanproviderid = $crnloanRow["Loan_Provider_ID"];
} else {
  // No ongoing loan details found
  $crnloanamount = "N/A";
  $crnintrate = "N/A";
  $crnloanprovider = "N/A";
  $crnloanproviderid = "N/A";
  $returndate = "N/A";
}



//insurance details-user side
$insuranceQuery = "SELECT * FROM insurance_t AS i JOIN financial_service_provider_t AS fsp ON i.insurance_provider_id=fsp.FSPid WHERE insurance_status='Ongoing' AND farmer_id= '$farmerID'";
$insuranceResult = mysqli_query($conn, $insuranceQuery);
if ($insuranceResult && mysqli_num_rows($insuranceResult) > 0) {
  $insuranceRow = mysqli_fetch_assoc($insuranceResult);
  $insuranceId = $insuranceRow["insurance_id"];
  $insurancePolicy = $insuranceRow["policy_type"];
  $insuranceCoverage = $insuranceRow["coverage_amount"];
  $premiumAmount = $insuranceRow["premium_amount"];
  $startdate = $insuranceRow["effective_date"];
  $policyPeriod = $insuranceRow["policy_period"];
  $enddate = $insuranceRow["end_date"];
  $insuranceProviderName = $insuranceRow["name"];
  $insuranceProviderId = $insuranceRow["FSPid"];
} else {
  $insuranceId = "N/A";
  $insurancePolicy = "N/A";
  $insuranceCoverage = "N/A";
  $premiumAmount = "N/A";
  $startdate = "N/A";
  $policyPeriod = "N/A";
  $enddate = "N/A";
  $insuranceProviderName = "N/A";
  $insuranceProviderId = "N/A";
}


//grant details
$grantQuery = "SELECT SUM(Grant_amount) AS grantAmount, Target_beneficiaries FROM grant_t AS g JOIN grant_provider_target_t AS gp ON g.Grant_provider_ID=gp.Grant_provider_ID WHERE Farmer_ID='$farmerID'";
$grantResult = mysqli_query($conn, $grantQuery);
if ($grantResult && mysqli_num_rows($grantResult) > 0) {
  $grantRow = mysqli_fetch_assoc($grantResult);
  $grantAmount = $grantRow["grantAmount"];
  $grantTarget = $grantRow["Target_beneficiaries"];
} else {
  // No grants found
  $grantAmount = "N/A";
  $grantTarget = "N/A";
}

//investment details
//total
$totalinvestmentQuery = "SELECT SUM(Amount) AS investmentAmount FROM investment_t WHERE Farmer_ID= '$farmerID'";
$totalinvestmentResult = mysqli_query($conn, $totalinvestmentQuery);
$totalinvestmentRow = mysqli_fetch_assoc($totalinvestmentResult);
$totalinvestment = $totalinvestmentRow["investmentAmount"];
//current
$crninvQuery = "SELECT * FROM investment_t AS i JOIN financial_service_provider_t AS fsp ON i.Investor_ID=fsp.FSPid WHERE investment_status='Ongoing' AND Farmer_ID= '$farmerID'";
$crninvResult = mysqli_query($conn, $crninvQuery);
if ($crninvResult && mysqli_num_rows($crninvResult) > 0) {
  $crninvRow = mysqli_fetch_assoc($crninvResult);
  $crninvestorid = $crninvRow["Investor_ID"];
  $crninvestorname = $crninvRow["name"];
  $crninvestmentamount = $crninvRow["Amount"];
  $returndate = $crninvRow['End_date'];
  $crnprofitRate = $crninvRow['Profit_share_rate'];
} else {
  // No ongoing investment found
  $crninvestorid = "N/A";
  $crninvestorname = "N/A";
  $crninvestmentamount = "N/A";
  $returndate = "N/A";
  $crnprofitRate = "N/A";
}
//Queries table
$helpQuery = "SELECT * FROM advising WHERE Farmer_ID='$farmerID'";
$helpResult = mysqli_query($conn, $helpQuery);

// credit score
$creditScoreQuery = "SELECT SUM(credit_score)/COUNT(Farmer_ID) AS creditscore FROM loan WHERE loan_status!='Ongoing' AND Farmer_ID='$farmerID'";
$creditScoreResult = mysqli_query($conn, $creditScoreQuery);
$creditScoreRow = mysqli_fetch_assoc($creditScoreResult);
$creditScore = $creditScoreRow["creditscore"];

?>


<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="style/farmer-header.css">
  <link rel="stylesheet" href="style/farmer-body.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(function() {
      drawChart(<?php echo json_encode($farmerID); ?>);
    });

    function drawChart(farmerID) {
      var data;
      <?php
      $sql = "SELECT Investment_ID, Amount AS Investment, Farmer_Sales AS Sales 
              FROM investment_t 
              WHERE Farmer_ID='$farmerID'";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        $data = array();
        $data[] = ['Investment ID', 'Investment', 'Sales'];
        // Output data of each row
        $index = 1; // Start index for naming investments
        while ($row = $result->fetch_assoc()) {
          // Format the investment ID
          $investmentID = "Investment-" . $index;
          $data[] = [$investmentID, (int) $row["Investment"], (int) $row["Sales"]];
          $index++; // Increment index for the next investment
        }
        echo "data = google.visualization.arrayToDataTable(" . json_encode($data) .
          ");";
      } else {
        echo "data = google.visualization.arrayToDataTable([ ['Investment ID', 'Investment', 'Sales'],
          ['No data available', 0, 0]
      ]);
    ";
      } ?>

      var options = {
        title: 'Farm Performance',
        curveType: 'function',
        legend: {
          position: 'bottom'
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

      chart.draw(data, options);
    }
  </script>
</head>

<body>
  <div class="sidebar-section">
    <div class="logo">
      <img src="images/KRISHI-removebg-preview.png" width="50px" height="60px">
    </div>
    <ul class="menu">
      <li class="active">
        <a href="#dashboard">
          <i class="fas fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="#profile">
          <i class="fas fa-user"></i>
          <span>Profile</span>
        </a>
      </li>
      <li>
        <a href="#statistics">
          <i class="fas fa-chart-bar"></i>
          <span>Statistics</span>
        </a>
      </li>
      <li>
        <a href="#help">
          <i class="fas fa-question-circle"></i>
          <span>Help</span>
        </a>
      </li>
      <li class="logout">
        <a href="index.html">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span>
        </a>
      </li>
    </ul>
  </div>

  <div class="main-section">
    <div class="header-wrapper">
      <div class="header-title">
        <span>Primary</span>
        <h2>Dashboard</h2>
      </div>
      <div class="user-info">
        <div class="username">
          <h4>Welcome, <?php echo $farmerName; ?></h4>
          <h5>ID:<span><?php echo $farmerID; ?></span></h5>
        </div>
      </div>
    </div>
    <div class="card-container" id="dashboard">
      <div class="loan-section">
        <div>
          <h3>Loan Portfolio</h3>
        </div>
        <div class="loan-details">
          <div class="left">
            <p>Total loan received: <span>BDT <?php echo $totalLoanReceived; ?></span></p>
            <p>Total loan repaid: <span>BDT <?php echo $totalLoanRepaid; ?></span></p>
            <p>Current loan amount: <span>BDT <?php echo $crnloanamount ?></span></p>
            <p>Interest Rate: <span><?php echo $crnintrate ?><span></p>
            <p>Return Date:<span><?php echo $returndate ?></span></p>
            <div>
              <a href="farmerloandetails.php" target="_blank"><button>Show Details</button></a>
              <a href="farmerPayLoan.php?id=<?php echo $farmerID ?>" target='_blank'><button>Repay Loan</button></a>
              <a href="farmerloanapply.php?id=<?php echo $farmerID ?>"><button>Apply for loan</button></a>
            </div>
          </div>
          <div class="right">
            <p>Current Loan Provider Name: <span><?php echo $crnloanprovider ?></span></p>
            <p>Current Loan Provider ID: <span><?php echo $crnloanproviderid ?></span></p>
          </div>
        </div>

      </div>

      <div class="insurance-section">
        <div>
          <h3>Insurance Portfolio</h3>
        </div>
        <div class="insurance-details">
          <div class="receiver">
            <p>Current Insurance ID:<span><?php echo $insuranceId; ?></span></p>
            <p>Insurance Policy : <span><?php echo $insurancePolicy; ?></span></p>
            <p>Coverage Amount : <span> BDT <?php echo $insuranceCoverage; ?></span></p>
            <p>Premium Amount : <span>BDT <?php echo $premiumAmount; ?></span></p>
            <p>Start Date:<span> <?php echo $startdate; ?></span></p>
            <p>Policy Period : <span><?php echo $policyPeriod; ?></span></p>
            <p>End Date: <span><?php echo $enddate; ?></span></p>
            <div>
              <a href='farmerInsuranceDetails.php' target='_blank'><button>View Details</button></a>
              <button>Pay Premium Amount</button>
              <a href='farmer_insurance_apply.php?id=<?php echo $farmerID; ?>'><button>Apply for Insurance</button></a>
            </div>

          </div>
          <div class="insurance-provider">
            <p>Insurance Provider Name:<span><?php echo $insuranceProviderName; ?></span></p>
            <p>Insurance Provider ID:<span><?php echo $insuranceProviderId; ?></span></p>
          </div>
        </div>
      </div>
      <div class="grant-section">
        <div>
          <h3>Grant Portfolio</h3>
        </div>
        <div class="grant-details">
          <div class="receiver">
            <p>Total Grant Received : <span> <?php echo $grantAmount; ?></span></p>
            <p>Beneficiary Category: <span><?php echo $grantTarget; ?></span></p>
            <div>
              <a href="farmergrantdetails.php" target="_blank"><button>Show Details</button></a>
              <button> Apply for grant</button>
            </div>
          </div>
        </div>
      </div>
      <div class="investment-section">
        <div>
          <h3>Investment Portfolio</h3>
        </div>
        <div class="investment-details">
          <p>Total Investment Received: <span>BDT <?php echo $totalinvestment; ?></p>
          <p>Current Investor ID: <span><?php echo $crninvestorid; ?></span></p>
          <p>Current Investor Name: <span><?php echo $crninvestorname; ?></span></p>
          <p>Current Investment Amount: <span>BDT <?php echo $crninvestmentamount; ?></span></p>
          <p>Profit Share Rate: <span><?php echo $crnprofitRate; ?></span></p>
          <p>Return Date: <span><?php echo $returndate; ?></span></p>

          <div>
            <a href="investmentdetails.php" target="_blank"><button>Show Details</button></a>
            <a href='farmerinvestmentapply.php?id=<?php echo $farmerID; ?>'><button style="width: 150px;">Apply For Investment</button></a>
          </div>


        </div>
      </div>
    </div>
    <div id="profile" class='profile'>
      <form>
        <h2>Personal Information</h2>
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
        <div class='btn-div'>
          <a href="farmerupdateportfolio.php?id=<?php echo $farmerID; ?>" target='_blank'><button type="button" class='update-btn'>Update Portfolio</button></a>
        </div>
      </form>
    </div>
    <div class="statistics" id='statistics'>
      <h2>Statistics</h2>
      <p>Credit Score: <span><?php echo $creditScore  ?></span></p>
      <div id="curve_chart" style="width: 900px; height: 500px"></div>
    </div>
    <div class='help' id='help'>
      <h2>Help</h2>
      <p>Got any issues? Click Below:</p>
      <a href="farmerAdvisingApplication.php?id=<?php echo $farmerID ?>"><button>Seek Help</button></a>
      <div class='past-queries'>
        <h4>Your Past Queries</h4>
        <table>
          <tr>
            <th>Query ID</th>
            <th>Problem Statement</th>
            <th>Problem Issue Date</th>
            <th>Solution</th>
            <th>Solution date</th>
          </tr>
          <?php
          while ($helpRow = mysqli_fetch_assoc($helpResult)) {
            echo "<tr>";
            echo "<td>" . $helpRow["Advise_ID"] . "</td>";
            echo "<td>" . $helpRow["Problem_statement"] . "</td>";
            echo "<td>" . $helpRow["Problem_issue_date"] . "</td>";
            echo "<td>" . $helpRow["Solution"] . "</td>";
            echo "<td>" . $helpRow["Solution_date"] . "</td>";
            echo "</tr>";
          } ?>
        </table>
      </div>

    </div>

  </div>

</body>

</html>