<?php
include 'admin.php';

$sql = "SELECT * FROM user";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

?>

<! top search bar>

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #e9e9e9;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #2196F3;
  color: white;
}

.topnav .search-container {
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}

.topnav .search-container button {
  float: right;
  padding: 6px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

@media screen and (max-width: 600px) {
  .topnav .search-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }
}
        button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;}

    </style>
</head>

<body>

<div class="topnav">
  <a class="active" href="#goback">Go Back</a>
  <a href="#logout">Log Out</a>
  <a href="#contact">Contact</a>
  <div class="search-container">
    <form action="test.php"> 
      <input type="text" style="background-color: white; color: black;" placeholder="Search User ID" name="search">
      <button type="submit" style="background-color: darkgreen; color: white;">Search</button> 
    </form>
  </div>
</div>


<div style="padding-left:16px">
</div>

</body>
</html>

<! COMMENT: ptint database>

<?php


$html_table = '<table border="1">';
$html_table .= '<tr>';
foreach (array_keys($data[0]) as $column) {
    $html_table .= '<th>' . $column . '</th>';
}
$html_table .= '</tr>';
foreach ($data as $row) {
    $html_table .= '<tr>';
    foreach ($row as $value) {
        $html_table .= '<td>' . $value . '</td>';
    }
    $html_table .= '</tr>';
}
$html_table .= '</table>';

echo $html_table;

?>

<! COMMENT: add buttons>

<!DOCTYPE html>
<html>

<head>

<style>
*{background-color:rgb(184, 247, 184);}
</style>

</head>

<body>
<!-- Add button -->
<br><br>
<button onclick="location.href='add_user.php';">Add User</button>
<button onclick="location.href = 'delete_user.php';">Delete User</button>
<button onclick="location.href = 'update.php';">Update User</button>


</body>
</html>

