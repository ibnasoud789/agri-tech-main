
<?php
include 'database.php';

if(isset($_POST['submit'])){
  $farmerid=$_POST['farmerid'];
  $farmername=$_POST['farmername'];
  $problemStatement=$_POST['problem'];
  $issuedate=$_POST['issuedate'];
  $category=$_POST['category'];
  $solution=$_POST['solution'];

  $advisorQuery="SELECT * FROM advising_application AS aa JOIN advisor AS a ON aa.Category=a.Expertise WHERE Category='$category'";
  $advisorResult=mysqli_query($conn,$advisorQuery);
  $advisorRow=mysqli_fetch_array($advisorResult);
  $advisorId= $advisorRow["Advisor ID"];

  mysqli_begin_transaction($conn);
  $sql="INSERT INTO advising (Advisor_ID,Farmer_ID,Problem_statement,Solution,Problem_issue_date,Solution_date) VALUES ('$advisorId','$farmerid','$problemStatement','$solution','$issuedate',CURDATE()) ";
  $result=mysqli_query($conn,$sql);
  if($result == TRUE){
    $statusUpdate="UPDATE advising_application SET Solution_status='Given' WHERE Farmer_ID='$farmerid'";
    $statusUpdateResult=mysqli_query($conn,$statusUpdate);
    if($statusUpdateResult == TRUE){
      mysqli_commit($conn);
      echo 'Solution Submitted Successfully.';
      echo '</div>';
      echo "<script>console.log('Solution Submitted Successfully.');</script>";
      header("refresh:2; url=./advisor.php");
  } else {
      mysqli_rollback($conn); 
      echo 'Error updating another table.';
  }
} else {
  echo 'Error inserting into advising table.';
}
} 
    
  

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $query="SELECT * FROM advising_application WHERE Farmer_ID='$id'";
  $result=mysqli_query($conn,$query);
  if (mysqli_num_rows($result)> 0){
    while($row=mysqli_fetch_assoc($result)){
      $id = $row["Farmer_ID"];
      $farmername= $row["Farmer_Name"];
      $problem= $row["Problem_statement"];
      $issuedate= $row["Problem_issue_date"];
      $status= $row["Solution_status"];
      $category=$row["Category"];

    }
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Advisor Solution</title>
  <style>
    form{
      display: flex;
      flex-direction: column;
      width: 50%;
    }
  </style>
</head>
<body>
  <h2>Solution to query</h2>
  <form method='post'>
    <input type='hidden' id='farmerid' name='farmerid' value='<?php echo $id; ?>'>
    <input type='hidden' id='farmername' name='farmername' value='<?php echo $farmername;?>'>
    <input type='hidden' id='problem' name='problem' value='<?php echo $problem;?>'>
    <input type='hidden' id='issuedate' name='issuedate' value='<?php echo $issuedate ?>'>
    <input type='hidden' id='status' name='status' value='<?php echo $status;?>'>
    <input type='hidden' id='category' name='category' value='<?php echo $category; ?>'>

    <label for='problem'>Problem Statement:</label>
    <input type='text' name='problem' id='problem' value='<?php echo $problem; ?>' readonly>
    <label for='solution'>Solution:</label>
    <textarea id='solution' name='solution' cols='90' rows='10' required></textarea>
    <input type='submit' name='submit' value='Submit'>


    
  </form>
</body>
</html>




