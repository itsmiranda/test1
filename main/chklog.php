<?php
	$logged = false;
	if (isset($_SESSION["logged"]))
	{
		if ($_SESSION["logged"] == true)
			$logged = true;
	}
	if (!$logged)
	{
		echo "<h2>Authentication Error</h2>";
?>		
		<script type="text/javascript">	
		window.location = "../index.php";
		</script>
<?php        
	}
?>
