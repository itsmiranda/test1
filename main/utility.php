<?php

function gl_Date($format, $timestamp = -1)
{
	$lang = $_SESSION['lang'];
	
	switch ($lang)
	{
		case 'gr': date_default_timezone_set("Europe/Athens");
		break;
	}

	if ($timestamp == -1)
		$retval = date($format);
	else
		$retval = date($format, $timestamp);
	
	return $retval;
}
				 
function detect_IE()
{
    if (isset($_SERVER['HTTP_USER_AGENT']) && 
    (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
        return true;
    else
        return false;
}

function cleanQuery($con, $string)
{
	if(get_magic_quotes_gpc())  // prevents duplicate backslashes
	{
		$string = stripslashes($string);
	}
	if (phpversion() >= '4.3.0')
	{
		$string = mysqli_real_escape_string($con, $string);
	}
	else
	{
		$string = mysqli_escape_string($con, $string);
	}
	return $string;
}

function findinblob($id, $blob)
{
	$found = false;
	
	$tmpAr = explode(" ", $blob);
	for ($i = 0; $i < sizeof($tmpAr); $i++)
	{
		if ($tmpAr[$i] == $id)
		{
			$found = true;
			break;
		}
	}
	
	return $found;
}

?>