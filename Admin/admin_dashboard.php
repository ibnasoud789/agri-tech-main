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

echo("User Details"); 


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

<!DOCTYPE html>
<html>

<head>
    <style>
        *{background-color:rgb(184, 247, 184);}
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

<!-- Add button -->
<br><br>
<button onclick="location.href='add_user.php';">Add User</button>
<button onclick="location.href = 'delete_user.php';">Delete User</button>


</body>
</html>
