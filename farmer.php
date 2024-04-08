<?php
   session_start();   
   include 'database.php';

   if (!isset($_SESSION['userid'])) {
    // Redirect the user to the login page if not logged in
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

   //loan details 
   $loanQuery = "SELECT SUM(amount) AS total_loan_received FROM loan WHERE Farmer_ID='$farmerID'";
   $loanResult = mysqli_query($conn, $loanQuery);
   $loanRow = mysqli_fetch_assoc($loanResult);
   $totalLoanReceived = $loanRow['total_loan_received'];


   //insurance details-user side
   $insuranceQuery= "SELECT * FROM insurance_t WHERE Farmer_ID= '$farmerID'";
   $insuranceResult = mysqli_query($conn, $insuranceQuery);
   $insuranceRow = mysqli_fetch_assoc($insuranceResult);
   $insuranceId= $insuranceRow["insurance_id"];
   $insurancePolicy= $insuranceRow["policy_type"];
   $insuranceCoverage = $insuranceRow["coverage_amount"];
   $premiumAmount = $insuranceRow["premium_amount"];
   $policyPeriod= $insuranceRow["policy_period"];

   //insurance details- provider side
   $insuranceProviderQuery = "SELECT * FROM insurance_t AS I JOIN financial_service_provider_t AS FSP ON I.insurance_provider_id = FSP.FSPid WHERE Farmer_ID= '$farmerID'";
   $insuranceProviderResult= mysqli_query($conn, $insuranceProviderQuery);
   $insuranceProviderRow= mysqli_fetch_assoc($insuranceProviderResult);
   $insuranceProviderId= $insuranceProviderRow["FSPid"];
   $insuranceProviderName= $insuranceProviderRow["name"];

   //grant details
   $grantQuery= "SELECT SUM(Grant_amount) AS grantAmount, Target_beneficiaries FROM grant_t AS g JOIN grant_provider_target_t AS gp ON g.Grant_provider_ID=gp.Grant_provider_ID WHERE Farmer_ID='$farmerID'";
   $grantResult = mysqli_query($conn, $grantQuery);
   $grantRow = mysqli_fetch_assoc($grantResult);
   $grantAmount= $grantRow["grantAmount"];
   $grantTarget= $grantRow["Target_beneficiaries"];



?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style/farmer-header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      
      *{
  margin: 0;
  padding: 0;
  border: none;
  outline: none;
  box-sizing: border-box;
  font-family: Arial, Helvetica, sans-serif;
}

.card-container{
  display: flex;
  flex-direction: column;
  margin-top: 20px;
}

.loan-section, .insurance-section, .grant-section, .investment-section{
  display: flex;
  flex-direction: column;
  height: 35vh;
  background-color:rgb(184, 247, 184);
  border-radius: 10px;
  padding: 10px 2rem;
  margin-bottom: 1rem;
  width: 100%;
}
.loan-section .loan-details, .insurance-section .insurance-details, .grant-section .grant-details{
  display: flex;
}
.loan-section .left,.insurance-details .receiver,.grant-details .receiver{
  width: 50%;
}
.loan-section h3,.insurance-section h3,.grant-section h3,.investment-section h3{
  font-size: 22px;
  margin-bottom: 10px;
  text-align: center;
}
.loan-section p, .insurance-section p, .grant-section p, .investment-section p{
  font-size: 13px;
  margin-bottom: 5px;
}
.loan-section p span, .insurance-section p span, .grant-section p span, .investment-section p span{
  color: rgb(1,62,1);
  font-weight: bold;
  font-size: 18px;
}

.loan-section button, .insurance-section button, .investment-section button, .grant-section button{
  height: 25px;
  width: 110px;
  margin-top: 30px;
  border-radius: 5px;
  background-color: rgb(1, 62, 1);
  color: white;
  font-weight: bold;
}

.loan-section .right,.insurance-details .insurance-provider, .grant-details .grant-provider{
  display: flex;
  flex-direction: column;
  width: 50%;
  justify-content: center;
  align-items: center;
  gap: 5px;
}
.countdown-container {
  display: flex;
  justify-content: space-between;
  width: 300px;
}

.countdown-item {
  text-align: center;
}

#days, #hours, #minutes, #seconds {
  background-color: rgba(3, 72, 3, 0.639);
  color: #fff;
  padding: 10px;
  margin: 5px;
  border-radius: 5px;
}

.right button{
  height: 40px;
  width: 100px;
  margin-top: 15px;
  border-radius: 5px;
  background-color: rgb(1, 62, 1);
  color: white;
  font-weight: bold;
}

button{
  cursor: pointer;
  transition: 0.2s ease all;
}
button:hover{
  background-color: rgb(1, 62, 1,0.8);
  transform: scale(1.02);
}

.insurance-section,.grant-section{
  display: flex;
  height: 45vh;
}
.insurance-section .receiver,.grant-section .receiver{
  display: flex;
  flex-direction: column;
}
.insurance-section button{
  width: 150px;
  height: 25px;
}

.grant-section{
  height: 35vh;
}

.investment-section{
  height: 35vh;
  
}

    </style>
  </head>
  <body>
    <div class="sidebar-section">
      <div class="logo">
        <img src="images/KRISHI-removebg-preview.png" width="50px" height="60px">
      </div>
      <ul class="menu">
        <li class="active">
          <a href="#">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="#"> 
            <i class="fas fa-user"></i>
            <span>Profile</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fas fa-chart-bar"></i>
            <span>Statistics</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fas fa-question-circle"></i>
            <span>Help</span>
          </a>
        </li>
        <li class="logout">
          <a href="#">
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
            <h4>Welcome, <?php echo $farmerName;?></h4>
          </div>
          <img src="images/farmer/fisherman-5970480_1920.jpg">
        </div>
      </div>
      <div class="card-container">
        <div class="loan-section">
          <div><h3>Loan Portfolio</h3></div>
          <div class="loan-details">
            <div class="left">
              <p>Total loan received: <span>BDT <?php echo $totalLoanReceived; ?></span></p>
              <p>Total loan repaid: <span>BDT <?php echo $totalLoanReceived; ?></span></p>
              <p>Current loan amount: <span>BDT 60000</span></p>
              <div>
                <a href="farmerloandetails.php" target="_blank"><button>Show Details</button></a>
                <a href="farmerloanapply.php" target="_blank"><button>Apply for loan</button></a>
              </div>
            </div>
            <div class="right">
              <h4>Your next repayment date</h4>
              <div class="timer">
                <div class="countdown-container">
                  <div id="days" class="countdown-item"></div>
                  <div id="hours" class="countdown-item"></div>
                  <div id="minutes" class="countdown-item"></div>
                  <div id="seconds" class="countdown-item"></div>
                </div>
              </div>
              <button>Repay loan</button>
            </div>
          </div>
          
        </div>

        <div class="insurance-section">
          <div><h3>Insurance Portfolio</h3></div>
          <div class="insurance-details">
            <div class="receiver">
              <p>Insurance ID:<span><?php echo $insuranceId; ?></span></p>
              <p>Current Insurance Policy : <span><?php echo $insurancePolicy; ?></span></p>
              <p>Coverage Amount : <span> BDT <?php echo $insuranceCoverage; ?></span></p>
              <p>Premium Amount : <span>BDT <?php echo $premiumAmount; ?></span></p>
              <p>Policy Period : <span><?php echo $policyPeriod; ?></span></p>
              <p>Next Payment Date : <span>12/10/2024</span></p>
              <button>Pay Premium Amount</button>
            </div>
            <div class="insurance-provider">
              <p>Provider Name:<span><?php echo $insuranceProviderName; ?></span></p>
              <p>Provider ID:<span><?php echo $insuranceProviderId; ?></span></p>
            </div>
          </div>
        </div>
        <div class="grant-section">
          <div><h3>Grant Portfolio</h3></div>
          <div class="grant-details">
            <div class="receiver">
              <p>Total Grant Received : <span> <?php echo $grantAmount; ?></span></p>
              <p>Beneficiary Category: <span><?php echo $grantTarget; ?></span></p>
              <div>
                <a href="farmergrantdetails.php"><button>Show Details</button></a>
                <button> Apply for grant</button>
              </div>
            </div>
          </div>
        </div>
        <div class="investment-section">
          <div><h3>Investment Portfolio</h3></div>
          <div class="investment-details">
              <p>Total Investment Received: <span>BDT 200000</span></p>
              <p>Current Investment Amount: <span>BDT 100000</span></p>
              <p>Current Investor ID: <span>1000021</span></p>
              <p>Current Investor Name: <span>Agrani Bank</span></p>
              <button>Show Details</button>
            </div>
          </div>
        </div>
      </div>

      <script src="countdown.js"></script>
      </div>
    </div>
  </body>
</html>