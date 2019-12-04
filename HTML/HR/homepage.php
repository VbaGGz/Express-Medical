<?php
	include("../../Config.php");
		$error = "";
	include("../../Include/HR_p_check.php");
?>

<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Home</title>
        <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../CSS/homepage.css">
    </head>
    <body>
        <div class="container-fluid full-page">
            <div class="tab">
                <button class="tablinks currentPage" onclick="openTab(event, 'Home')" id="Home">Home</button>
                <button class="tablinks" onclick="openTab(event, 'My Info')" id="My Info">My Info</button>
                <button class="tablinks" onclick="openTab(event, 'My Benefits')" id="My Benefits">Edit Benefits</button>
                <button class="tablinks" onclick="openTab(event, 'My Taxes')" id="My Taxes">My Finances</button>
                <button class="tablinks" onclick="openTab(event, 'Add Employee')" id="Add Employee">Add Employee</button>
                <button class="tablinks" onclick="openTab(event, 'Edit Employee')" id="Edit Employee">Edit Employee</button>
                <button class="tablinks" onclick="openTab(event, 'Contact')" id="Contact">Contact</button>
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
                <div id="Home" class="tabcontent">
                    <h3>Home</h3>
                    <p>Hi, I'm Paul.</p>
                    <div class="row news-row">
                        <div class="col-md-6 news-col">
                            <img src="../../Images/newspost1.jpg" class="newsphoto">
                            <h3>Socioeconomic Status Affects Which Kids Survive 
                                Cancer</h3>
                            <p>Socioeconomic factors play a big role in survival
                                 rates...</p>
                        </div>
                        <div class="col-md-3 news-col">
                            <div class="row">
                                <div class="col-md-12 news-col">
                                <img src="../../Images/newspost3.jpg" class="newsphoto">
                                <h3>A Lifeline for Rural Hospitals</h3>
                                <p>A move by Georgia lawmakers to aid hospitals
                                        on the brink is already paying off...</p>
                                </div>
                                <div class="col-md-12 news-col">
                                    <img src="../../Images/newspost2.jpg" class="newsphoto">
                                    <h3>Lyft and Uber for Patient Transportation</h3>
                                    <p>Health care providers are exploring 
                                        ride-hailing services for nonemergency 
                                        transportation...</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 news-col">
                            <img src="../../Images/newspost4.jpg" class="newsphoto">
                            <h3>Four-legged infection fighter hits the 
                                road to detect C. difficile</h3>
                            <p>Vancouver Coastal Health's four-legged 
                                infection fighter is taking a road-trip
                                 to showcase his C. difficile detection 
                                 abilities...</p>
                        </div>
                    </div>
                    <div class="row news-row">
                        <div class="col-md-2 news-col">
                            <img src="../../Images/newspost5.jpg" class="newsphoto">
                            <h3>The hidden dangers of testosterone
                                replacement therapy you should know about</h3>
                            <p>Testosterone replacement therapy is gaining
                                 wider use, but there are potential health 
                                 risks. These include heart attack and 
                                 stroke in men over 65 and infertility in 
                                 young men...</p>
                        </div>
                        <div class="col-md-6 news-col">
                            <img src="../../Images/newspost7.jpg" class="newsphoto">
                            <h3>Cities Try to Tame Health Care Costs</h3>
                            <p>Proposed ballot measures in two California cities would 
                                limit how much hospitals and doctors can charge for 
                                patient care...</p>
                        </div>
                        <div class="col-md-4 news-col">
                            <img src="../../Images/newspost6.jpg" class="newsphoto">
                            <h3>Hospital chain to pay $260 million to settle Medicare fraud charges</h3>
                            <p>HMA, which was acquired by the for-profit 
                                hospital Community Health Systems in 2014, 
                                overbilled federal health programs and paid
                                 kickbacks to physicians, prosecutors said...</p>
                        </div>
                    </div>
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
    </body>
</html>