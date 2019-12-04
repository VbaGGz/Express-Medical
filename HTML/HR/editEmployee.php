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
        <title>Edit Employee</title>
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
                <button class="tablinks currentPage" onclick="openTab(event, 'Edit Employee')" id="Edit Employee">Edit Employee</button>
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
                <div id="Edit Employee" class="tabcontent">
                    <h3>Edit Employee:</h3>
                    <?php 
                     if($_SERVER["REQUEST_METHOD"] == "POST") 
  					 {
   						$SID = $_POST['ID'];
						$sql = ' SELECT * FROM Employee_Records WHERE ID = "' . $SID .' " ';
						$result = mysqli_query($dbc,$sql);
                        $row_cnt = mysqli_num_rows($result);
                        $row = mysqli_fetch_assoc($result);

						if ($row_cnt > 0) 
							{	
								echo "ID: " . $row["ID"] ;
								echo "<br>";
								?>

								<form action="../../Include/updateuserHR.inc.php?ID=<?php echo $row['ID']; ?>" method="post">
                                    
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="First_Name">First Name</label>
                                <input type="text" class="form-control" id="First_Name" name="First_Name"value = "<?php echo $row['First_Name']; ?>" maxlength="25">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Last_Name">Last Name</label>
                                <input type="text" class="form-control" id="Last_Name" name="Last_Name"value = "<?php echo $row['Last_Name']; ?>" maxlength="25">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="DOB">Date of Birth</label>
                                <input type="date" class="form-control" id="DOB" value = "<?php echo $row['DOB']; ?>" name="DOB">
                            </div>
                            <div class="form-group col-md-8">
                                <label for="Email">Email</label>
                                <input type="email" class="form-control" id="Email" name="Email"value = "<?php echo $row['Email']; ?>" maxlength="50">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Address">Address</label>
                            <input type="text" class="form-control" id="Address" name="Address" value = "<?php echo $row['Username']; ?>" maxlength="50">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="City">City</label>
                                <input type="text" class="form-control" id="City" name="City" value= "<?php echo $row['City']; ?>" maxlength="20">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="State">State</label>
                                <select id="State" class="form-control" name="State">
                                    <option selected><?php echo $row['State']; ?></option>
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
                                <label for="Zip">Zip</label>
                                <input type="number" class="form-control" id="Zip" name="Zip" value = "<?php echo $row['Zip_Code']; ?>"min="00000" max="99999">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="Position">Position in Company</label>
                                <input type="text" class="form-control" id="Position" name="Position"value = "<?php echo $row['Position']; ?>" maxlength="25">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Phone_Number">Phone Number</label>
                                <input type="number" class="form-control" id="Phone_Number" name="Phone_Number"value = "<?php echo $row['Phone_Number']; ?>" min="00000000000" max="99999999999">
                            </div>
                        </div>
                        
                        <input type="submit" value="Submit" name= update-submit>
                    </form>
                    <?php 
							} 
						else 
							{
								echo "0 results";
							}
						}
                     ?>
                </div>
            </div>
			<div>
			<form action="" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="Username">Please Enter The ID of The User You Would Like To Edit</label>
                                <input type="text" class="form-control" id="ID" name="ID" placeholder= "" maxlength="6">
                            </div>
                            <div class="form-row">
                           <input type="submit" value="Search" name= adduser-submit>
                    </div>
			</form>
                <div style = "font-size:18px; color:#cc0000; margin-top:10px"><?php $error= $_GET['error']; echo $error; ?></div>
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