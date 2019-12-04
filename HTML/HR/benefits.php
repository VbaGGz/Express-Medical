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
		<title>Add Employee Benefits</title>
		<link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../../CSS/homepage.css">
	</head>
	<body>
		<div class="container-fluid full-page">
			<div class="tab">
				<button class="tablinks" onclick="openTab(event, 'Home')" id="Home">Home</button>
				<button class="tablinks" onclick="openTab(event, 'My Info')" id="My Info">My Info</button>
				<button class="tablinks currentPage" onclick="openTab(event, 'My Benefits')" id="My Benefits">Edit Benefits</button>
				<button class="tablinks" onclick="openTab(event, 'My Taxes')" id="My Taxes">My Finances</button>
				<button class="tablinks" onclick="openTab(event, 'Add Employee')" id="Add Employee">Add Employee</button>
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
					<h2>Edit Employee Benefits:</h2>
					<?php
					if($_SERVER["REQUEST_METHOD"] == "POST") 
							{
								$SID = $_POST['ID'];
								$sql = ' SELECT * FROM Healthcare WHERE ID = "' . $SID .' " ';
								$result = mysqli_query($dbc,$sql);
								$row_cnt = mysqli_num_rows($result);
								$row = mysqli_fetch_assoc($result);
		
								if ($row_cnt > 0) 
									{	
										echo "ID: " . $row["ID"] ;
										echo "<br>";
										?>
										<form action="../../Include/HR_addBenefits.inc.php?ID=<?php echo $row['ID']; ?>" method="post">
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="Marital_Status">Marital Status</label>
													<input type="text" class="form-control" id="Marital_Status" name="Marital_Status"value = "<?php echo $row['Marital_Status']; ?>">
												</div>
												<div class="form-group col-md-6">
													<label for="Children">Children</label>
													<input type="text" class="form-control" id="Children" name="Children" maxlength="2"value = "<?php echo $row['Children']; ?>">
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-4">
													<label for="k401">401k</label>
													<input type="text" class="form-control" id="k401" name="k401"value = "<?php echo $row['401k']; ?>">
												</div>
												<div class="form-group col-md-8">
													<label for="Healthcare_Plan">Healthcare Plan</label>
													<input type="text" class="form-control" id="Healthcare_Plan" name="Healthcare_Plan"value = "<?php echo $row['Healthcare_Plan']; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="Dental">Dental</label>
												<input type="text" class="form-control" id="Dental" name="Dental"value = "<?php echo $row['Dental']; ?>">
											</div>
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="Optical">Optical</label>
													<input type="text" class="form-control" id="Optical" name="Optical"value = "<?php echo $row['Optical']; ?>">
												</div>
												<div class="form-group col-md-2">
													<label for="Life_Insurance_Plan">Life Insurance Plan</label>
													<input type="text" class="form-control" id="Life_Insurance_Plan" name="Life_Insurance_Plan"value = "<?php echo $row['Life_Insurance_Plan']; ?>">
												</div>
											</div>
											<input type="submit" value="Submit" name="addBenefits-submit">
										</form>
									<?php 
									} 
									else 
									{
										echo "0 results";
									}
								}
							?>
					<div style = "font-size:18px; color:#cc0000; margin-top:10px"><?php $error= $_GET['error']; echo $error; ?></div>
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