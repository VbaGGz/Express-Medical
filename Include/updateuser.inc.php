<?php
	include("dbh.inc.php");
		$error = "";
	
if (isset($_POST['update-submit'])) {

	  $ID = $_GET['ID'];
	  $Username = $_POST['Username'];
	  $First_Name = $_POST['First_Name'];
	  $Last_Name = $_POST['Last_Name'];
	  $DOB = $_POST['DOB'];
	  $Email = $_POST['Email'];
	  $Address = $_POST['Address'];
	  $City = $_POST['City'];
	  $State = $_POST['State'];
	  $Zip_Code = $_POST['Zip'];
	  $Position = $_POST['Position'];
	  $Phone_Number = $_POST['Phone_Number'];
	  $Gross_Pay = $_POST['Gross_Pay'];

        $sql = " UPDATE `Employee_Records` SET  `Username` = '$Username',`First_Name` = '$First_Name', `Last_Name` = '$Last_Name', `DOB` = '$DOB', `Email` = '$Email', `Address` = '$Address', `City` = '$City', `State` = '$State', `Zip_Code` = '$Zip_Code', `SSN` = '$SSN', `Position` = '$Position', `Phone_Number` = '$Phone_Number' WHERE ID  = '$ID' ";
        $sql2 = " UPDATE `Employee_Finance` SET  `Gross_Pay` = '$Gross_Pay' WHERE ID  = '$ID'";
       			 if (mysqli_query($dbc,$sql))
        			{
                        mysqli_query($dbc,$sql2);
  						header("Location: ../HTML/Admin/editEmployee.php?error=Success");
        			}
                else
                	{
                    	header("Location: ../HTML/Admin/editEmployee.php?error=Update_Failed_Please_Contact_Admin");
                	}	
		}
	  else
	  {
	  	header("Location: ../index.php?error=STOP");
	    exit();
	  }