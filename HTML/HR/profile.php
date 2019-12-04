<?php
include("../../Config.php");
$error = "";
include("../../Include/HR_p_check.php");


$sql = ' SELECT * FROM Employee_Records WHERE ID = "' . $_GET['ID'] .' " ';
$result = mysqli_query($dbc,$sql);
$row_cnt = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Contact</title>
        <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../CSS/homepage.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/contact.css">
    </head>
    <body>
        <div class="container-fluid full-page">
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'Home')" id="Home">Home</button>
                <button class="tablinks" onclick="openTab(event, 'My Info')" id="My Info">My Info</button>
                <button class="tablinks" onclick="openTab(event, 'My Benefits')" id="My Benefits">Edit Benefits</button>
                <button class="tablinks" onclick="openTab(event, 'My Taxes')" id="My Taxes">My Finances</button>
                <button class="tablinks" onclick="openTab(event, 'Add Employee')" id="Add Employee">Add Employee</button>
                <button class="tablinks" onclick="openTab(event, 'Edit Employee')" id="Edit Employee">Edit Employee</button>
                <button class="tablinks currentPage" onclick="openTab(event, 'Contact')" id="Contact">Contact</button>
                <button class="tablinks" onclick="logOut()" id="Log Out">Log Out</button>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <img src="../../Images/Employee_Pictures/<?php echo $_SESSION['ID']?>.jpg" class="profile-pic" alt="Profile Picture">
                </div>
                <div class="col-sm-10 ">
                    <h1>Welcome Back, <?php echo $_SESSION['First_Name'] . " " . $_SESSION['Last_Name'] . "<br>"; ?></h1>
                    <h5>Employee at Express Medical</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row justify-content-sm-center">
                        <img src="../../Images/Employee_Pictures/<?php echo $_GET['ID']?>.jpg" class="profile-pic" alt="User Picture">
                    </div>
                    <div class="row justify-content-sm-center">
                        <h3><?php echo $row['First_Name'] . " " . $row['Last_Name'] . "<br>"; ?></h3>
                    </div>
                    <div class="row justify-content-md-center">
                        <p><?php echo $row['Position'] . " ";?>at Express Medical</p>
                            <!-- If need be we can change the name of the hospital -->
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="row justify-content-md-center">
                        <h6>Email Address:</h6>
                            <!-- This is where the email address will be pulled into -->
                        <p><?php echo "\n" . $row['Email'];?></p>
                            <!-- NEED TO FIX THIS SOMEHOW -->
                    </div>
                    <div class="row justify-content-md-center">
                        <h6>Telephone Number:</h6>
                            <!-- This is where their work phone number will be pulled into -->
                        <p><?php echo $row['Phone_Number'];?></p>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script type="text/javascript">
        document.getElementById("Home").onclick = function () {
            location.href = "./homepage.php";
        };
        document.getElementById("My Info").onclick = function () {
            location.href = "./info.php";
        };
        document.getElementById("My Benefits").onclick = function () {
            location.href = "./benefits.php";
        };
        document.getElementById("My Taxes").onclick = function () {
            location.href = "./taxes.php";
        };
        document.getElementById("Add Employee").onclick = function () {
            location.href = "./addEmployee.php";
        };
        document.getElementById("Edit Employee").onclick = function () {
            location.href = "./editEmployee.php";
        };
        document.getElementById("Contact").onclick = function () {
            location.href = "./contact.php";
        };

        function logOut() {
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = '../../Include/logout.inc.php';
            } 
        }
    </script>
</html>