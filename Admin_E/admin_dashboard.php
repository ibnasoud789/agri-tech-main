<?php

session_start();
include 'admin.php';

if (!isset($_SESSION['userid'])) {

  header("Location: ../login.php");
  exit;
}

$sql = "SELECT u.userID AS ID,
CASE
WHEN u.user_type='Farmer' THEN CONCAT(f.fname,' ',f.mname,' ',f.lname)
WHEN u.user_type='Advisor' THEN CONCAT(a.fname,' ',a.mname,' ',a.lname)
ELSE fsp.name
END AS `name`, 
u.Area AS Area,u.city AS city,u.postcode AS postcode,u.contact_number AS contact_number,u.user_type  FROM user AS u LEFT JOIN farmer_t AS f ON u.userID=f.Farmer_ID LEFT JOIN financial_service_provider_t AS fsp ON u.userID=fsp.FSPid LEFT JOIN Advisor AS a ON u.userID=a.`Advisor ID`";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    * {
      box-sizing: border-box;
    }


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

      .topnav a,
      .topnav input[type=text],
      .topnav .search-container button {
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

    .header-wrapper {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      background-color: rgb(184, 247, 184);
      border-radius: 10px;
      padding: 10px 2rem;
      margin-bottom: 1rem;
    }

    .header-title {
      color: rgb(1, 62, 1);
    }

    .user-info {
      display: flex;
      align-items: center;
      gap: 1rem;
    }


    button {
      background-color: darkgreen;
      /* Green */
      border: none;
      color: white;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 8px;
    }

    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td,
    th {
      border: 1px solid black;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: rgb(227, 247, 198);
    }
  </style>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart', 'bar']
    });
    google.charts.setOnLoadCallback(drawStuff);

    function drawStuff() {

      var button = document.getElementById('change-chart');
      var chartDiv = document.getElementById('chart_div');

      var data = google.visualization.arrayToDataTable([
        ['Year', 'Loan Amount', 'Loan Count'],
        <?php
        $chartSql = "SELECT YEAR(receiving_date) AS year, SUM(amount) AS total_amount, COUNT(*) AS loan_count FROM loan GROUP BY YEAR(receiving_date)";
        $chartResult = $conn->query($chartSql);
        while ($row = $chartResult->fetch_assoc()) {
          echo "['" . $row['year'] . "', " . $row['total_amount'] . ", " . $row['loan_count'] . "],";
        }

        ?>
      ]);

      var materialOptions = {
        width: 900,
        chart: {
          title: 'Loan Statistics Year-wise',
          subtitle: 'Loan Amount on the left, Loan Count on the right'
        },
        series: {
          0: {
            axis: 'Loan_Amount'
          }, // Bind series 0 to an axis named 'distance'.
          1: {
            axis: 'Loan_Count'
          } // Bind series 1 to an axis named 'brightness'.
        },
        axes: {
          y: {
            Loan_Amount: {
              label: 'BDT'
            }, // Left y-axis.
            Loan_Count: {
              side: 'right',
              label: 'Number'
            } // Right y-axis.
          }
        }
      };

      var classicOptions = {
        width: 900,
        series: {
          0: {
            targetAxisIndex: 0
          },
          1: {
            targetAxisIndex: 1
          }
        },
        title: 'Loan Statistics Year-wise - Loan Amount on the left, Loan Count on the right',
        vAxes: {
          // Adds titles to each axis.
          0: {
            title: 'BDT'
          },
          1: {
            title: 'Number'
          }
        }
      };

      function drawMaterialChart() {
        var materialChart = new google.charts.Bar(chartDiv);
        materialChart.draw(data, google.charts.Bar.convertOptions(materialOptions));
        button.innerText = 'Change to Classic';
        button.onclick = drawClassicChart;
      }

      function drawClassicChart() {
        var classicChart = new google.visualization.ColumnChart(chartDiv);
        classicChart.draw(data, classicOptions);
        button.innerText = 'Change to Material';
        button.onclick = drawMaterialChart;
      }

      drawMaterialChart();
    };
  </script>
  <script type="text/javascript">
    google.charts.load("current", {
      packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Stakeholder', 'Number'],
        <?php
        $sql = "SELECT user_type, COUNT(*) as count FROM user GROUP BY user_type";
        $result = $conn->query($sql);

        // Loop through the result set and generate data rows
        while ($row = $result->fetch_assoc()) {
          echo "['" . $row['user_type'] . "', " . $row['count'] . "],";
        }
        ?>
      ]);

      var options = {
        title: 'Distribution of Stakeholders',
        is3D: true,
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
      chart.draw(data, options);
    }
  </script>

</head>

<body>
  <div class="header-wrapper">
    <div class="header-title">
      <span>Admin</span>
      <h2>Dashboard</h2>
    </div>
    <div class="user-info">
      <form action="search_user.php" method="GET">
        <input type="text" style="background-color: white; color: black; height:40px; width:200px; border:none;border-radius:10px;" placeholder="Search User ID" name="search" required>
        <button type="submit">Search</button>
      </form>
      <button onclick="location.href='../index.html'">Log Out</button>
    </div>
  </div>
  <button id="change-chart">Change to Classic</button>
  <br><br>
  <div id="chart_div" style="width: 800px; height: 500px;"></div>
  <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
  <div>
    <h2>User Table</h2>
    <table>
      <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>Area</th>
        <th>City</th>
        <th>Post Code</th>
        <th>Contact Number</th>
        <th>User Type</th>
      </tr>
      <?php foreach ($data as $row) { ?>
        <tr>
          <td><?php echo $row["ID"]; ?></td>
          <td><?php echo $row["name"]; ?></td>
          <td><?php echo $row["Area"]; ?></td>
          <td><?php echo $row["city"] ?></td>
          <td><?php echo $row["postcode"] ?></td>
          <td><?php echo $row["contact_number"] ?></td>
          <td><?php echo $row["user_type"]; ?></td>
        </tr>
      <?php } ?>
    </table>
  </div>
  <div>
    <button onclick="location.href='add_user.php';">Add User</button>
    <button onclick="location.href = 'delete_user.php';">Delete User</button>
    <button onclick="location.href = 'update.php';">Update User</button>
  </div>
</body>

</html>