<?php
	include("dbh.inc.php");
	
if (isset($_POST['adduser-submit'])) {

		
    $Password = $_POST['Password'];
	$First_Name = $_POST['First_Name'];
	$Last_Name = $_POST['Last_Name'];
	$DOB = $_POST['DOB'];
	$Email = $_POST['Email'];
	$Address = $_POST['Address'];
	$City = $_POST['City'];
	$State = $_POST['State'];
	$Zip_Code = $_POST['Zip_Code'];
	$SSN = $_POST['SSN'];
	$Position = $_POST['Position'];
	$Phone_Number = $_POST['Phone_Number'];
	
	$Gross_Pay = $_POST['Gross_Pay'];
	  
	  
	$hashedPwd = password_hash($Password, PASSWORD_DEFAULT);


    $sql =" INSERT INTO `Employee_Records`(`Password`, `First_Name`, `Last_Name`, `DOB`, `Email`, `Address`, `City`, `State`, `Zip_Code`, `SSN`, `Position`, `Phone_Number`) VALUES ('$hashedPwd','$First_Name','$Last_Name','$DOB','$Email','$Address','$City','$State','$Zip_Code','$SSN','$Position','$Phone_Number')";
	
    
    if (mysqli_query($dbc,$sql))
    {
        $sql_ssn = ' SELECT ID FROM Employee_Records WHERE SSN = " ' . $SSN . ' " ';
        $result = mysqli_query($dbc,$sql_ssn);
        $row_cnt = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        if ($row_cnt > 0)
        {
            $Username = $Last_Name.$row['ID'];
            $sql_ID =" UPDATE `Employee_Records` SET `Username` = '$Username' WHERE SSN = $SSN ";
            if (mysqli_query($dbc,$sql_ID))
            {
                $error = "Successfully_Added_User";
				
                $id = $row['ID'];
				$Marital_Status = 0;
				$Children = 0;
				$k401 = 0;
				$Healthcare_Plan = 0;
				$Dental = 0;
				$Optical = 0;
				$Life_Insurance_Policy = 0;
                
				$sql2 ="INSERT INTO `Healthcare`(`ID`, `Marital_Status`, `Children`, `401k`, `Healthcare_Plan`, `Dental`, `Optical`, `Life_Insurance_Plan`) VALUES ('$id','$Marital_Status','$Children','$k401','$Healthcare_Plan','$Dental','$Optical','$Life_Insurance_Policy')";
				if (mysqli_query($dbc,$sql2))
				{
					$sql3 ="INSERT INTO `Employee_Finance`(`ID`, `Gross_Pay`) VALUES ('$id','$Gross_Pay')";
					if (mysqli_query($dbc,$sql3))
					{
						header("Location: ../HTML/Admin/addEmployee.php?error=Successfully Added New User, ID = $id");
					}
					else
					{
						$error = "Failed!!";
						header("Location: ../HTML/Admin/addEmployee.php?error=Failed!!");
					}
				}
				 else
				{
					$error = "Failed!!";
					header("Location: ../HTML/Admin/addEmployee.php?error=Failed!!");
				}
            }
            else
            {
                $error = "Failed!!";
                header("Location: ../HTML/Admin/addEmployee.php?error=Failed!!");
            }
        }
	}
	else
	{
		$error = "Failed!";
		header("Location: ../HTML/Admin/addEmployee.php?error=Failed!");
	}
}
else
{
	header("Location ../index.php");
	exit();
}