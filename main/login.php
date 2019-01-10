<?php
	if (session_id() == "")
		session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ppfinder.gr</title>
</head>
<body>

<?php
	require_once ("dbconnect.php");
	require_once ("utility.php");				   

	if (isset($_SESSION['logged']))
		unset($_SESSION['logged']);

	$url = "";
	if (isset($_REQUEST['url']))
		$url = $_REQUEST['url'];

	if (isset($_REQUEST['action']))
		$act = $_REQUEST['action'];

	$_SESSION['lang'] = $_REQUEST['lang'];

	$logged = false;
	if (isset($_POST["login"]) && isset ($_POST["password"]))
	{
		$login = cleanQuery($con, $_POST["login"]);
		$password = cleanQuery($con, $_POST["password"]);
		$_SESSION['logged'] = 0;

		if ($con)
		{
			switch ($act)
			{
				case 'login':
					$query = "SELECT * FROM user WHERE login='$login' AND password='$password'";
					$res = mysqli_query($con, $query);
					$row = mysqli_fetch_array($res);
			
					// It should find only one if we are here!
					if ($row)
					{
						if ($row['active'] == 1)
						{
							$_SESSION['logged'] = 1;
							$_SESSION['userdata'] = $row;
							$logged = true;		
?>							
							<script type="text/javascript">
								window.location = "main/loggedmenu.php";
							</script>		
<?php							
						}
						else
						{
							echo "activate your account";			
						}
					}
					else
					{   echo '<script language="javascript">';
						echo 'alert("Wrong username or password!")';
						echo '</script>';	
					}
					mysqli_close($con);
					break;
			}
		}
	}
?>

		
</body>
</html>
