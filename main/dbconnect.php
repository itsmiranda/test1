<?php
	$host = "localhost";
	$login = "root";
	$pass = "";
	$dbname = "ppfinder";
/*
    $host = "nireas.it.teithe.gr";
    $login = "webeng5";
    $pass = "webeng5pwd";
    $dbname = "webeng5";
*/

	$con = mysqli_connect($host, $login, $pass);
	
	if ($con)
	{
		mysqli_select_db($con, $dbname);
	}
	else
	{
		echo mysqli_error();
		die("error in database connection");
		mysqli_close($con);
	}
	
?>