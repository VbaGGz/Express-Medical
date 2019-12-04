<?php
	include("Config.php");
		$error = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		
	  $Username = $_POST['Username'];
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
	  
	  

        $sql =" INSERT INTO `Employee_Records`(`Username`, `Password`, `First_Name`, `Last_Name`, `DOB`, `Email`, `Address`, `City`, `State`, `Zip_Code`, `SSN`, `Position`, `Phone_Number`) VALUES ('$Username','$Password','$First_Name','$Last_Name','$DOB','$Email','$Address','$City','$State','$Zip_Code','$SSN','$Position','$Phone_Number')";
	  
        
        if (mysqli_query($dbc,$sql))
        {
            ?>  <h3>Successfully added to Database</h3> <?php  ;
                }
                else
                {
                    $error = "Failed!";
                }

	}
	  
		   

		   
		
?>