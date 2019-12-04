<?php
/* Database connection settings */
$host = 'localhost'; // local host because this is stored on the server (pi)
$user = 'conner2';
$pass = 'Password';
$db = 'HR_TEST';
$dbc = mysqli_connect($host,$user,$pass,$db);

// Check connection
if (!$dbc) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
