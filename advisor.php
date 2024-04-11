<?php
session_start();

include 'database.php';

if (!isset($_SESSION['userid'])) {

  header("Location: login.php");
  exit;
}
$advisorID= $_SESSION["userid"];

$query="SELECT * FROM advising AS ad JOIN farmer_t AS ft ON ad.Farmer_ID=ft.Farmer_ID WHERE Advisor_ID='$advisorID' ";
$result=mysqli_query($conn, $query);

//advior name
$nameQuery="SELECT CONCAT(fname,' ',mname,' ',lname) AS adname, Expertise FROM advisor WHERE Advisor ID='$advisorID'";;
$nameResult = mysqli_query($conn,$nameQuery);
$nameRow=mysqli_fetch_array($nameResult);
$name=$nameRow["adname"];
$expertise=$nameRow["Expertise"];

//total no of solutions provided
$advisingQuery= "SELECT COUNT(Advise_ID) AS total_advising FROM advising WHERE Advisor_ID='$advisorID'";
$advisingResult = mysqli_query($conn,$advisingQuery);
$advisingRow=mysqli_fetch_array($advisingResult);
$totalAdvisingCount= $advisingRow["total_advising"];

//advising application
$adApplicationQuery= "SELECT * FROM advising_application WHERE Solution_status='Pending' AND Category='$expertise'";
$adApplicationResult = mysqli_query($conn,$adApplicationQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Advisor</title>
  <style>
    *{
  margin: 0;
  padding: 0;
  border: none;
  outline: none;
  box-sizing: border-box;
  font-family: Arial, Helvetica, sans-serif;
}

body{
  display: flex;
}
.main-section{
  position: relative;
  background-color: white;
  width: 100%;
  padding: 1.5rem;
}

.header-wrapper{
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  background-color:rgb(148, 232, 218);
  border-radius: 10px;
  padding: 10px 2rem;
  margin-bottom: 1rem;
}

.header-title{
  color: rgb(1,62,1);
}

.user-info{
  display: flex;
  align-items: center;
  gap: 1rem;
}

.search-box{
  background: rgb(213, 245, 164);
  border-radius: 15px;
  color: rgb(1,62,1);
  display: flex;
  align-items: center;
  gap: 5px;
  padding: 4px 12px;
}

.search-box input{
  background: transparent;
  padding: 10px;
}

.search-box i {
  font-size: 1.2rem;
  cursor: pointer;
  transition: all 0.5s ease-out;
}

.search-box i:hover{
  transform: scale(1.2);
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: rgb(162, 245, 248);
}

.card-container{
  display: flex;
  flex-direction: column;
  margin-top: 20px;
}
.loanPortfolioOverview, .loanapplication{
  display: flex;
  flex-direction: column;
  height: 60vh;
  background-color:rgb(194, 247, 238);
  border-radius: 10px;
  padding: 10px 2rem;
  margin-bottom: 1rem;
  width: 100%;
}


h2{
  font-size: 22px;
  margin-bottom: 10px;
  text-align: center;
}
.loanPortfolioOverview p {
  font-size: 15px;
  margin-bottom: 5px;
}

.loanPortfolioOverview p span{
  color: rgb(1,62,1);
  font-weight: bold;
  font-size: 18px;
}

.loanapplication{
  display: flex;
  flex-direction: column;
  height: 40vh;
  background-color:rgb(194, 247, 238);
  border-radius: 10px;
  padding: 10px 2rem;
  margin-bottom: 1rem;
  width: 100%;
}

.user-info button{
  width: 60px;
  height: 30px;
  color: aliceblue;
  background-color: rgb(1,62,1);
  border-radius: 5px;
 transition: ease all 0.5s;
  cursor: pointer;
}

.user-info button:hover{
  background-color: rgb(1,62,1,.9);
  transform: scale(1.1);
}
.button{
  display:flex ;
  gap: 2px;
  
}
.accept-button{
width: 60px;
height: 20px;
border-radius: 5px;
cursor: pointer;
color: white; 
 background-color: green;
 }
 .accept-button:active{
 background-color: rgb(1,62,1,.8);
 }
.decline-button{
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
        <span>Advisor</span>
        <h2>Dashboard</h2>
      </div>
      <div class="user-info">
        <h4>Welcome, <?php echo $name;?>!</h4>
        <button onclick="location.href='index.html'">Log Out</button>
      </div>
    </div>
    <div class="card-container">
      <div class="loanPortfolioOverview">
        <h2>Advisor Portfolio Overview</h2>
        <p>Total number of solutions provided: <span id="totalLoans"> <?php echo $totalAdvisingCount; ?></span></p>
        <div>Details</div>
        <table id="loanTable">
          <tr>
            <th>Query ID</th>
            <th>Farmer ID</th>
            <th>Farmer Name</th>
            <th>Problem</th>
            <th>Problem Issue Date</th>
            <th>Solution Providing Date</th>
            <th>Solution</th>
          </tr>
          <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['Advise_ID']."</td>";
                echo "<td>".$row['Farmer_ID']."</td>";
                echo "<td>".$row['fname'].' '.$row['mname'].' '.$row['lname']."</td>";
                echo "<td>".$row['Problem_statement']."</td>";
                echo "<td>".$row['Problem_issue_date']."</td>";
                echo "<td>".$row['Solution_date']."</td>";
                echo "<td>".$row['Solution']."</td>";
                echo "</tr>";
            }
            ?>
        </table>
      </div>
      <div class="loanapplication">
        <h2>Advising Applications</h2>
        <table id="loanApplicationTable">
         <tr>
            <th>Farmer Name</th>
            <th>Farmer ID</th>
            <th>Problem Statement</th>
            <th>Problem Issue Date</th>
            <th>Solution</th>
          </tr>
          <?php
             while ($adApplicationRow = mysqli_fetch_assoc($adApplicationResult)) {
              echo "<tr>";
              echo "<td>".$adApplicationRow['Farmer_Name']."</td>";
              echo "<td>".$adApplicationRow['Farmer_ID']."</td>";
              echo "<td>".$adApplicationRow['Problem_statement']."</td>";
              echo "<td>".$adApplicationRow["Problem_issue_date"]."</td>";
              echo "<td>";
              echo "<button class='accept-button' onclick=\"window.location.href='advisorSolutionProcess.php?id=".$adApplicationRow['Farmer_ID']."'\">Provide Solution</button>";
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