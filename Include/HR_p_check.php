<?php

session_start();

if (!$_SESSION['P_Level']) 
{
	header("Location: ../../index.php?error=notloggedin");
}
else
{
		if ($_SESSION['P_Level'] == 1) 
		{
			header("Location: ../../HTML/Employee/homepage.php");
		}
		else if ($_SESSION['P_Level'] == 2) 
		{
			
		}	
		else if ($_SESSION['P_Level'] == 3) 
		{
			header("Location: ../../HTML/Admin/homepage.php");
		}
}