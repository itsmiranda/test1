<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
	require_once("../main/dbconnect.php");
	
	if ($con)
	{
		$q = "DROP SCHEMA $dbname";
		echo $q . "<br>";
		mysqli_query($con, $q);
		echo mysqli_error($con) . "<br>";
		
		$q = "CREATE SCHEMA $dbname";
		echo $q . "<br>";
		mysqli_query($con, $q);
        echo mysqli_error($con) . "<br>";
		
		$q = "CREATE  TABLE $dbname.`user` (
			  `id` INT NOT NULL AUTO_INCREMENT ,
			  `active` TINYINT(1) NULL ,
			  `login` VARCHAR(20) NULL ,
			  `password` VARCHAR(20) NULL ,
			  `surname` VARCHAR(80) NULL ,
			  `name` VARCHAR(60) NULL ,
			  `email` VARCHAR(50) NULL ,			  
			  PRIMARY KEY (`id`) );";
        mysqli_query($con, $q);
		echo $q . "<br>";
        echo mysqli_error($con) . "<br>";

		$q = "ALTER TABLE $dbname.`user` CHARACTER SET = greek , COLLATE = greek_general_ci";
        mysqli_query($con, $q);
        echo mysqli_error($con) . "<br>";

        $q = "CREATE  TABLE $dbname.`category` (
			  `id` INT NOT NULL AUTO_INCREMENT ,
			  `category` VARCHAR(60) NULL ,
			  PRIMARY KEY (`id`) );";
        mysqli_query($con, $q);
        echo $q . "<br>";
        echo mysqli_error($con) . "<br>";

        $q = "ALTER TABLE $dbname.`category` CHARACTER SET = greek , COLLATE = greek_general_ci";
        mysqli_query($con, $q);
        echo mysqli_error($con) . "<br>";

        $q = "CREATE  TABLE $dbname.`bookmarks` (
			  `id` INT NOT NULL AUTO_INCREMENT ,
			  `catid` INT NULL ,
			  `userid` INT NULL ,
			  `title` VARCHAR(300) NULL ,
			  `authors` VARCHAR(300) NULL ,
			  `venue` VARCHAR(80) NULL ,
			  `year` VARCHAR(20) NULL ,
			  `pages` VARCHAR(50) NULL ,
			  `ee` VARCHAR(200) NULL ,
			  `url` VARCHAR(200) NULL ,
			  `readpp` TINYINT(1) NULL ,
			  `comments` VARCHAR(500) NULL ,
			  PRIMARY KEY (`id`) );";
        mysqli_query($con, $q);
        echo $q . "<br>";
        echo mysqli_error($con) . "<br>";

        $q = "ALTER TABLE $dbname.`bookmarks` CHARACTER SET = greek , COLLATE = greek_general_ci";
        mysqli_query($con, $q);
        echo mysqli_error($con) . "<br>";

	}
	else
	{
        echo mysqli_error($con) . "<br>";
    	mysqli_close($con);
        die("error in database connection");
	}
?>