<?php
include 'admin.php';

if(isset($_POST['userID'])) {
    $userID = $_POST['userID'];

    $matching_rows = array();

    $sql = "SHOW TABLES";
    $result = $conn->query($sql);
    echo($result)

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $table_name = $row['Tables_in_krishi_bandhan']; 

            $sql_user = "SELECT * FROM $table_name WHERE userID = $userID";
            $result_user = $conn->query($sql_user);

            if ($result_user->num_rows > 0) {

                while($row_user = $result_user->fetch_assoc()) {
                    $matching_rows[] = $row_user;
                }
            }
        }
    }

    if (!empty($matching_rows)) {
        echo "<table border='1'>";
        echo "<tr><th>User ID</th><th>Column 1</th><th>Column 2</th><th>...</th></tr>";
        foreach ($matching_rows as $row) {
            echo "<tr>";
            echo "<td>".$row["userID"]."</td>";
            echo "<td>".$row["column1"]."</td>"; // Replace column1, column2, etc. with actual column names
            echo "<td>".$row["column2"]."</td>";
            // Add more columns as needed
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No matching rows found for User ID: $userID";
    }
}

?>
