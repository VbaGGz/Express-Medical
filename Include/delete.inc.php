<?php
include("dbh.inc.php");
$error = "";
include("Admin_p_check.php");

$ID = $_GET['ID'];
if ($ID != $_SESSION['ID']) {
    $sql = "DELETE FROM Employee_Records WHERE `ID` = '$ID' ";
    if (mysqli_query($dbc, $sql)) {
        header("Location: ../HTML/Admin/deleteEmployee.php?error=Successfull");
    } else {
        header("Location: ../HTML/Admin/deleteEmployee.php?error=Failed!");
    }
}
else{
    header("Location: ../HTML/Admin/deleteEmployee.php?error=DONT_DELETE_YOUR_OWN_ACCOUNT");
    }
?>