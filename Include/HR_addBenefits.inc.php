<?php
	include("dbh.inc.php");
		$error = "";
		
if (isset($_POST['addBenefits-submit'])) {

	  $ID = $_GET['ID'];//not working with GET (as we did with updateuser) but working with a hardcoded number lol
      $Marital_Status = $_POST['Marital_Status'];
	  $Children = $_POST['Children'];
	  $k401 = $_POST['k401'];
	  $Healthcare_Plan = $_POST['Healthcare_Plan'];
	  $Dental = $_POST['Dental'];
	  $Optical = $_POST['Optical'];
	  $Life_Insurance_Plan = $_POST['Life_Insurance_Plan'];
	  
	  
	  
	$sql = " UPDATE `Healthcare` SET  `Marital_Status` = '$Marital_Status',`Children` = '$Children', `401k` = '$k401', `Healthcare_Plan` = '$Healthcare_Plan', `Dental` = '$Dental', `Optical` = '$Optical', `Life_Insurance_Plan` = '$Life_Insurance_Plan' WHERE ID  = '$ID' ";
        
       			 if (mysqli_query($dbc,$sql))
        			{
  						header("Location: ../HTML/HR/benefits.php?error=Success");
        			}
                else
                	{
                    	header("Location: ../HTML/HR/benefits.php?error=Failed");
                	}	
	}
	  
	  else
	  {
	  	header("Location ../index.php");
	    exit();
	  }