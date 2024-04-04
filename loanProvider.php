<?php 
  include 'database.php';
  $query = "SELECT * FROM loan WHERE Loan_Provider_ID=1000033";
  $result = mysqli_query($conn, $query);

  $loanQuery = "SELECT SUM(amount) AS total_loan_provided, COUNT(Loan_ID) AS total_loan_count FROM loan WHERE Loan_Provider_ID = '1000033'";
  $loanResult = mysqli_query($conn, $loanQuery);
  $loanRow = mysqli_fetch_assoc($loanResult);
  $totalLoanProvided = $loanRow['total_loan_provided'];
  $totalLoanCount = $loanRow['total_loan_count'];

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style/loanprovider.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <div class="main-section">
    <div class="header-wrapper">
      <div class="header-title">
        <span>Primary</span>
        <h2>Dashboard</h2>
      </div>
      <div class="user-info">
        <h4>Welcome, Agrani Bank!</h4>
        <div class="search-box">
          <i class="fa-solid fa-search"></i>
          <input type="text" placeholder="Search"/>
        </div>
      </div>
    </div>
    <div class="card-container">
      <div class="loanPortfolioOverview">
        <h2>Loan Portfolio Overview</h2>
        <p>Total number of loans: <span id="totalLoans"> <?php echo $totalLoanCount; ?></span></p>
        <p>Total loan value: <span id="totalLoanValue"> <?php echo $totalLoanProvided; ?></span></p>
        <div>Details</div>
        <table id="loanTable">
          <tr>
            <th>Loan ID</th>
            <th>Farmer ID</th>
            <th>Loan Amount</th>
            <th>Interest Rate</th>
            <th>Issue Date</th>
            <th>Repayment Date</th>
          </tr>
          <?php
            // Loop through the fetched data and display it in the table
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['Loan_ID']."</td>";
                echo "<td>".$row['Farmer_ID']."</td>";
                echo "<td>".$row['amount']."</td>";
                echo "<td>".$row['interest_rate']."</td>";
                echo "<td>".$row['receiving_date']."</td>";
                echo "<td>".$row['return_date']."</td>";
                echo "</tr>";
            }
            ?>
        </table>
      </div>
    </div>
  </div>

</body>
</html>
