<?php
include "database.php";
$id='';
$applicationSuccess='';
$name='';
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $fid=$_POST['id'];
  $fname=$_POST['name'];
  $category=$_POST['problem_cat'];
  $problem=$_POST['problem'];
  $helpsql="INSERT INTO advising_application (Farmer_ID,Farmer_Name,Category,Problem_statement,Solution_status,Problem_issue_date) VALUES ('$fid','$fname','$category','$problem','Pending',CURDATE())";
  if ($conn->query($helpsql) === TRUE) {
    $applicationSuccess="Query submitted successfully.";
    }else{
      echo "Error: ". $helpsql . "<br>". mysqli_error($conn);
    }
}

if(isset($_GET["id"])){
  $farmerID=$_GET["id"];
  $query = "SELECT Farmer_ID, CONCAT(fname,' ',mname,' ',lname) AS farmer_name FROM farmer_t WHERE Farmer_ID='$farmerID'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  $id = $row["Farmer_ID"];
  $name = $row["farmer_name"];

}
$conn->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h2>Your Query</h2>
  <form action="" method="post">
      <label for='problem_field'>Select Your Problem Category:</label>
      <input type='hidden' name='id' id='id' value='<?php echo $id; ?>'>
      <input type='hidden' name='name' id='name' value='<?php echo $name ;?>'>
      <select id='problem_cat' name='problem_cat' id='problem_cat' required>
        <option value=''>Select a category</option>
        <option value='Agronomy'>Agronomy</option>
        <option value='Crop Rotation'>Crop Rotation</option>
        <option value='Soil Health Management'>Soil Health Management</option>
        <option value='Cash Flow Management'>Cash Flow Management</option>
        <option value='Pest Control'>Pest Control</option>
        <option value='Precision Farming'>Precision Farming</option>
      </select>
    </div>
    <div>
      <label for='problem'>Explain Your Problem:</label>
      <textarea id='problem' name='problem' cols='90' rows='10' placeholder="Your Query" required></textarea>
    </div>
    <div>
      <input type='submit' name='submit' value='Submit'>
    </div>
  </form>
  <script>
        function validateForm() {
            var userName = document.getElementById("name").value;
            var userId = document.getElementById("id").value;
            var category = document.getElementById("problem_cat").value;
            var problem = document.getElementById("problem").value;

            if (category == "" || bank == "") {
                alert("All fields are required");
                return false;
            }
        }
        window.onload = function() {
            <?php if (!empty($applicationSuccess)) : ?>
                alert("<?php echo $applicationSuccess; ?>");
                window.location.href = "farmer.php";
            <?php endif; ?>
        };
    </script>
</body>

</html>