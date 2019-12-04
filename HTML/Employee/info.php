<?php
	include("../../Config.php");
		$error = "";
	include("../../Include/Employee_p_check.php");
?>

<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>My Info</title>
        <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../CSS/homepage.css">
    </head>
    <body>
        <div class="container-fluid full-page">
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'Home')" id="Home">Home</button>
                <button class="tablinks currentPage" onclick="openTab(event, 'My Info')" id="My Info">My Info</button>
                <button class="tablinks" onclick="openTab(event, 'My Benefits')" id="My Benefits">My Benefits</button>
                <button class="tablinks" onclick="openTab(event, 'My Taxes')" id="My Taxes">My Finances</button>
                <button class="tablinks" onclick="openTab(event, 'Contact')" id="Contact">Contact</button>
                <button class="tablinks" onclick="logOut()" id="Log Out">Log Out</button>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <img src="../../Images/Employee_Pictures/<?php echo $_SESSION['ID']?>.jpg" class="profile-pic">
                </div>
                <div class="col-sm-10 ">
                    <h1>Welcome Back, <?php echo $_SESSION['First_Name'] . " " . $_SESSION['Last_Name'] . "<br>"; ?></h1>
                    <h5>Employee at Blah Hospital</h5>
                </div>
            </div>
            <div class="row">
                <div id="My Info" class="tabcontent">
                    <h3>My Info:</h3>
                    <?php
                       
                     														
                                echo "ID: " . $_SESSION['ID'] . "	Username: " . $_SESSION['Username'] . "<br>";
                                echo "First Name: " . $_SESSION['First_Name'] . "	Last Name: " . $_SESSION['Last_Name'] . "<br>";
                                echo "Date of Birth: " . $_SESSION['DOB'] . "	Email: " . $_SESSION['Email'] . "<br>";
                                echo "Address: " . $_SESSION['Address'] . "	City: " . $_SESSION['City'] . "<br>";
                                echo "State: " . $_SESSION['State'] . "	Zip Code: " . $_SESSION['Zip_Code'] . "<br>";
                                echo "Position: " . $_SESSION['Position'] . "	Phone Number: " . $_SESSION['Phone_Number'] . "<br>";
                                echo "<br><br>";

                    ?>
                    </table>
                </div>
            </div>
        </div>
        
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
            document.getElementById("Contact").onclick = function () {
                location.href = "./contact.php";
            };

            function logOut() {
                if (confirm("Are you sure you want to logout?")) {
                    window.location.href = '../../index.php';
                } 
            }
        </script>
    </body>
</html>