<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
	require_once("../main/dbconnect.php");
	
	$con = mysqli_connect($host, $login, $pass);
	
	if ($con)
	{
		mysqli_query($con, "INSERT INTO $dbname.`user` (`active`, `login`, `password`) VALUES (1, 'test', '123')");
        mysqli_query($con, "INSERT INTO $dbname.`category` (`category`) VALUES ('Networks')");
        mysqli_query($con, "INSERT INTO $dbname.`category` (`category`) VALUES ('Graphics')");
        mysqli_query($con, "INSERT INTO $dbname.`category` (`category`) VALUES ('Machine Learning')");
        mysqli_query($con, "INSERT INTO $dbname.`category` (`category`) VALUES ('NLP')");
        mysqli_query($con, "INSERT INTO $dbname.`category` (`category`) VALUES ('Software Engineering')");
        mysqli_query($con, "INSERT INTO $dbname.`category` (`category`) VALUES ('HCI')");
        mysqli_query($con, "INSERT INTO $dbname.`category` (`category`) VALUES ('Virtual Reality')");
	}
	else
	{
		echo mysqli_error($con);
		die("error in database connection");
		mysqli_close($con);
	}
	
?>