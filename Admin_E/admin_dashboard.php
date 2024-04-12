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

<! top search bar>

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
  </body>

  </html>

  <!DOCTYPE html>
  <html>

  <head>

  </head>

  <body>
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
  </body>

  </html>

  <! COMMENT: add buttons>

    <!DOCTYPE html>
    <html>

    <head>


    </head>

    <body>
      <!-- Add button -->
      <br><br>
      <button onclick="location.href='add_user.php';">Add User</button>
      <button onclick="location.href = 'delete_user.php';">Delete User</button>
      <button onclick="location.href = 'update.php';">Update User</button>


    </body>

    </html>