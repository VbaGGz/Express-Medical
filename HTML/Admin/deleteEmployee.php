<?php
	include("../../Include/dbh.inc.php");
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
        <title>Delete Employee</title>
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
                <button class="tablinks" onclick="openTab(event, 'Add Employee')" id="Add Employee">Add Employee</button>
                <button class="tablinks" onclick="openTab(event, 'Edit Employee')" id="Edit Employee">Edit Employee</button>
                <button class="tablinks currentPage" onclick="openTab(event, 'Delete Employee')" id="Delete Employee">Delete Employee</button>
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
                <div id="Delete Employee" class="tabcontent">
                    <h3>Delete Employee:</h3>
                    <?php if($_SERVER["REQUEST_METHOD"] == "POST") {
                    $SID = $_POST['ID'];
                    $sql = " SELECT * FROM Employee_Records WHERE ID = '$SID' ";
                    $result = mysqli_query($dbc, $sql);
                    $row_cnt = mysqli_num_rows($result);
                    $row = mysqli_fetch_assoc($result);

                    if ($row_cnt > 0)
                        {
                            echo "ID: " . $row["ID"] ;
                            echo "<br>";
                            echo "Name: " . $row["First_Name"].' ' .$row["Last_Name"]  ;
                            echo "<br>";
                            echo "Position: " . $row["Position"] ;
                            echo "<br>";
                            echo "Email: " . $row["Email"] ;
                            echo "<br>";
                           ?> <button onclick="deleteuser()">Delete User</button>
                    <?php
                        }
                    else
                        {
                            echo "0 results";
                        }
                    }
                    ?>
                    <div>
                        <form action="" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Username">Please Enter The ID of The User You Would Like To Delete</label>
                                    <input type="text" class="form-control" id="ID" name="ID" placeholder= "" maxlength="25">
                                </div>
                                <input type="submit" value="Submit" name= adduser-submit>
                        </form>
                    </div>
                </div>
                <div style = "font-size:18px; color:#cc0000; margin-top:10px"><?php $error=$_GET['error']; echo $error; ?></div>
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
            document.getElementById("Delete Employee").onclick = function () {
                location.href = "./deleteEmployee.php";
            };
            document.getElementById("Contact").onclick = function () {
                location.href = "./contact.php";
            };

            function deleteuser() {
                if (confirm("Are you sure you want to delete this user?")) {
                    window.location.href = '../../Include/delete.inc.php?ID= <?php echo$SID;?>';
                }
            }
            function logOut() {
                if (confirm("Are you sure you want to logout?")) {
                   window.location.href = '../../Include/logout.inc.php';
                } 
            }
        </script>
    </body>
</html>