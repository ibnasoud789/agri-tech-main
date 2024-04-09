<?php

include "admin.php";


$tables = array(
    "advisor", "advisor expertise", "farmer_cropname_t", "farmer_t", 
    "feedback_t", "financial_service_provider_t", "grant_provider_t", 
    "grant_provider_target_t", "grant_t", "insurance_provider_t", 
    "insurance_t", "investment_t", "investor_t", "loan", "loan_provider", 
    "loan_provider_loan_type", "user"
);

$tableData = array();

foreach ($tables as $table) {

    $sql = "SELECT * FROM $table";

    $result = $conn->query($sql);
    if ($result) {
        
        $columnNames = array();
        while ($column = $result->fetch_field()) {
            $columnNames[] = $column->name;
        }

        $tableData[$table] = array("columns" => $columnNames, "data" => array());
        while ($row = $result->fetch_assoc()) {
            $tableData[$table]["data"][] = $row;
        }
    } else {
        echo "Error retrieving data from table $table: " . $conn->error;
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
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

<button onclick="location.href='admin_dashboard.php';" style="background-color: darkgreen; color: white;">Go Back</button>

<?php foreach ($tableData as $tableName => $table) : ?>
    <h3><?php echo $tableName; ?></h3>
    <?php if (count($table["data"]) > 0) : ?>
        <table>
            <tr>
                <?php foreach ($table["columns"] as $columnName) : ?>
                    <th><?php echo $columnName; ?></th>
                <?php endforeach; ?>
            </tr>
            <?php foreach ($table["data"] as $row) : ?>
                <tr>
                    <?php foreach ($row as $value) : ?>
                        <td><?php echo $value; ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>No data available.</p>
    <?php endif; ?>
<?php endforeach; ?>

</body>
</html>