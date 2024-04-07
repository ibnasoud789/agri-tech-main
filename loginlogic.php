<?php
    include'database.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        $userid = $_POST['userid'];
        $password = $_POST['password'];
        $usertype = $_POST['usertype'];
    
    
        $query = "SELECT * FROM login_t WHERE ID='$userid' AND Password='$password' ";
        $result = mysqli_query($conn, $query);
    
      
        if(mysqli_num_rows($result) == 1) {
          
            switch($usertype) {
                case 'farmer':
                    header("Location: farmer.php");
                    break;
                case 'loan_provider':
                    header("Location: loanProvider.php");
                    break;
                case 'insurance_provider':
                    header("Location: insuranceProvider.php");
                    break;
                case 'investment_provider':
                    header("Location: investor.php");
                    break;
                case 'grant_provider':
                    header("Location: grantProvider.php");
                    break;
                case 'admin':
                    header("Location: admin_dashboard.php");
                    break;
                default:
                    
                    echo "Invalid user type";
                    break;
            }
        } else {
          
            echo "Invalid credentials";
        }
    
        mysqli_close($connection);
    } 
?>