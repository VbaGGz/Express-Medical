<?php
	include("../../Config.php");
		$error = "";
	include("../../Include/Admin_p_check.php");
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
                <button class="tablinks" onclick="openTab(event, 'Delete Employee')" id="Delete Employee">Delete Employee</button>
                <button class="tablinks currentPage" onclick="openTab(event, 'Contact')" id="Contact">Contact</button>
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
                <div id="Contact" class="tabcontent">
                    <table>
                        <h2>Contact</h2>

                        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

                        <table id="myTable">
                            <tr class="header">
                                <th style="width:25%;">Name</th>
                                <th style="width:25%;">Position</th>
                                <th style="width:25%;">Email</th>
                                <th style="width:25%;">Phone #</th>
                                <th style="width:25%;">ID #</th>
                            </tr>
                            <?php
                            $sql = "SELECT `ID`,`First_Name`,`Last_Name`,`Email`,`Position`,`Phone_Number`FROM Employee_Records ";
                            $result = mysqli_query($dbc,$sql);
                            $row_cnt = mysqli_num_rows($result);
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                            <tr class='clickable-row' data-href='profile.php?<?php echo"ID=".$row['ID'];?>'>
                                <td> <?php echo $row['First_Name'] . " " . $row['Last_Name']; ?> </td>
                                <td> <?php echo $row['Position']; ?> </td>
                                <td> <?php echo $row['Email']; ?> </td>
                                <td> <?php echo $row['Phone_Number']; ?> </td>
                                <td> <?php echo $row['ID']; ?> </td>
                                </tr><?php
                            }
                            ?>
                        </table>
                </div>
            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $(".clickable-row").click(function() {
                    window.location = $(this).data("href");
                });
            });
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
            document.getElementById("Delete Employee").onclick = function () {
                location.href = "./deleteEmployee.php";
            };
            document.getElementById("Contact").onclick = function () {
                location.href = "./contact.php";
            };

            function logOut() {
                if (confirm("Are you sure you want to logout?")) {
                    window.location.href = '../../Include/logout.inc.php';
                } 
            }

            function myFunction() {
                var input, filter, table, tr, name, department, position, extension, i;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    name = tr[i].getElementsByTagName("td")[0];
                    department = tr[i].getElementsByTagName("td")[1];
                    position = tr[i].getElementsByTagName("td")[2];
                    extension = tr[i].getElementsByTagName("td")[3];
                    if (name) {
                        if (name.innerHTML.toUpperCase().indexOf(filter) > -1
                          || department.innerHTML.toUpperCase().indexOf(filter) > -1
                          || position.innerHTML.toUpperCase().indexOf(filter) > -1
                          || extension.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        }
                        else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        </script>
    </body>
</html>