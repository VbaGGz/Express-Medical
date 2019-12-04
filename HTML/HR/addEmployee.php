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
    <title>Add Employee</title>
    <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../CSS/homepage.css">
</head>
<body>
<div class="container-fluid full-page">
    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'Home')" id="Home">Home</button>
        <button class="tablinks" onclick="openTab(event, 'My Info')" id="My Info">My Info</button>
        <button class="tablinks" onclick="openTab(event, 'My Benefits')" id="My Benefits">Edit Benefits</button>
        <button class="tablinks" onclick="openTab(event, 'My Taxes')" id="My Taxes">My Finances</button>
        <button class="tablinks currentPage" onclick="openTab(event, 'Add Employee')" id="Add Employee">Add Employee</button>
        <button class="tablinks" onclick="openTab(event, 'Edit Employee')" id="Edit Employee">Edit Employee</button>
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
        <div id="Add Employee" class="tabcontent">
            <h2>Add Employee:</h2>

            <form action="../../Include/HR_adduser.inc.php" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="First_Name">First Name</label>
                        <input type="text" class="form-control" id="First_Name" name="First_Name" maxlength="25" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Last_Name">Last Name</label>
                        <input type="text" class="form-control" id="Last_Name" name="Last_Name" maxlength="25" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="DOB">Date of Birth</label>
                        <input type="date" class="form-control" id="DOB" name="DOB" max="2018-12-31" required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="Email">Email</label>
                        <input type="email" class="form-control" id="Email" name="Email" maxlength="50" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Address">Address</label>
                    <input type="text" class="form-control" id="Address" name="Address" placeholder="1234 Main St" maxlength="50" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="City">City</label>
                        <input type="text" class="form-control" id="City" name="City" maxlength="20" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="State">State</label>
                        <select id="State" class="form-control" name="State" required>
                            <option selected></option>
                            <option>AL</option>
                            <option>AK</option>
                            <option>AZ</option>
                            <option>AR</option>
                            <option>CA</option>
                            <option>CO</option>
                            <option>CT</option>
                            <option>DE</option>
                            <option>DC</option>
                            <option>FL</option>
                            <option>GA</option>
                            <option>HI</option>
                            <option>ID</option>
                            <option>IL</option>
                            <option>IN</option>
                            <option>IA</option>
                            <option>KS</option>
                            <option>KY</option>
                            <option>LA</option>
                            <option>ME</option>
                            <option>MD</option>
                            <option>MA</option>
                            <option>MI</option>
                            <option>MN</option>
                            <option>MS</option>
                            <option>MO</option>
                            <option>MT</option>
                            <option>NE</option>
                            <option>NV</option>
                            <option>NH</option>
                            <option>NJ</option>
                            <option>NM</option>
                            <option>NY</option>
                            <option>NC</option>
                            <option>ND</option>
                            <option>OH</option>
                            <option>OK</option>
                            <option>OR</option>
                            <option>PA</option>
                            <option>RI</option>
                            <option>SC</option>
                            <option>SD</option>
                            <option>TN</option>
                            <option>TX</option>
                            <option>UT</option>
                            <option>VT</option>
                            <option>VA</option>
                            <option>WA</option>
                            <option>WV</option>
                            <option>WI</option>
                            <option>WY</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="Zip_Code">Zip</label>
                        <input type="text" class="form-control" id="Zip_Code" name="Zip_Code" pattern="[0-9]{5}" title="Please enter a valid Zip" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" pattern=".{8,50}" id="Password" name="Password" title="8 to 50 characters" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ConfPassword">Confirm Password</label>
                        <input type="password" class="form-control" pattern=".{8,50}" id="ConfPassword" name="ConfPassword" title="8 to 50 characters" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="SSN">Social Security Number</label>
                        <input type="password" class="form-control" id="SSN" name="SSN" pattern="[0-9]{9}" title="Please enter a valid SSN" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ConfSSN">Confirm Social Security Number</label>
                        <input type="password" class="form-control" id="ConfSSN" name="ConfSSN" pattern="[0-9]{9}" title="Please enter a valid SSN" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="Position">Position in Company</label>
                        <input type="text" class="form-control" id="Position" name="Position" maxlength="25" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="Phone_Number">Phone Number</label>
                        <input type="tel" class="form-control" id="Phone_Number" name="Phone_Number" pattern="[0-9]{11}" title="Please enter a valid phone number" required>
                    </div>					
                </div>

                <input type="submit" value="Submit" name="adduser-submit">
            </form>
            <div style = "font-size:18px; color:#cc0000; margin-top:10px"><?php $error= $_GET['error']; echo $error; ?></div>
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

    var password = document.getElementById("Password"), confirm_password = document.getElementById("ConfPassword");
    function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        }
        else {
            confirm_password.setCustomValidity('');
        }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;


    var ssn = document.getElementById("SSN"), confirm_ssn = document.getElementById("ConfSSN");
    function validateSSN(){
        if(ssn.value != confirm_ssn.value) {
            confirm_ssn.setCustomValidity("SSNs Don't Match");
        }
        else {
            confirm_ssn.setCustomValidity('');
        }
    }
    ssn.onchange = validateSSN;
    confirm_ssn.onkeyup = validateSSN;
</script>
</body>
</html>