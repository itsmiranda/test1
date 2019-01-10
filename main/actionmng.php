<?php
	session_start();
	$userdata = $_SESSION['userdata'];
	$userid = $userdata['id'];

	require_once("dbconnect.php");

	if ($_GET['action'] == 1) // Insert
	{
		//echo $_GET['authors'];
        //echo $userdata['password'];
        $res = mysqli_query($con, "SELECT * FROM bookmarks WHERE userid='$userid' AND catid='$_POST[catid]' AND title='$_POST[title]' AND authors='$_POST[authors]'");

        if ($res->num_rows == 0)
        {
            $query = "INSERT INTO bookmarks (catid, userid, title, authors, venue, year, pages, ee, url) VALUES ('$_POST[catid]', '$userid', '$_POST[title]', '$_POST[authors]', '$_POST[venue]', '$_POST[year]', '$_POST[pages]', '$_POST[ee]', '$_POST[url]')";
            $res = mysqli_query($con, $query);
        }
        else
            echo "-1";

        /*
		else
		{
			$query = "UPDATE student SET active='$_POST[active]', login='$_POST[login]', password='$_POST[password]', surname='$_POST[surname]', name='$_POST[name]', email='$_POST[email]', class='$_POST[class]', section='$_POST[section]' WHERE id='$rid'";	
			
			$res = mysql_query($query, $con);		
		}*/
	}

	else if ($_GET['action'] == 2) // Read Titles
	{
		//$query = "SELECT * FROM bookmarks WHERE userid='$userid' AND catid='$_POST[catid]' ASC";
        $res = mysqli_query($con, "SELECT * FROM bookmarks WHERE userid='$userid' AND catid='$_POST[catid]'");

        echo "<select id='titleSEL' style='width: 390px; height: 100px' size='5' onchange='OnSelectPaper();'>";
        while($row = mysqli_fetch_array($res))
        {
            $id = $row['id'];
            $title = $row['title'];
            echo "<option value='$id'>$title</option>";
        }
        echo "</select>";
    }
    else if ($_GET['action'] == 3) // Read Paper Data
    {
        $res = mysqli_query($con, "SELECT * FROM bookmarks WHERE id='$_POST[id]'");
        $row = mysqli_fetch_array($res);

        //print_r($row);
        //echo "<div id='controlsDIV' style='display: none'>";
        echo "<img src='../skins/default/btn_save.png' onclick=\"OnSave();\" onMouseOver=\"return tooltip('AA', '', 'width:100,border:2,textcolor:#007700');\" onMouseOut=\"return hideTip();\">";
        echo "<img src='../skins/default/btn_del.png' onclick=\"OnDelete();\" onMouseOver=\"return tooltip('AA', '', 'width:100,border:2,textcolor:#007700');\" onMouseOut=\"return hideTip();\">";
        echo "<img src='../skins/default/btn_go.png' onclick=\"OnVisit('$row[ee]');\" onMouseOver=\"return tooltip('AA', '', 'width:100,border:2,textcolor:#007700');\" onMouseOut=\"return hideTip();\">";

        echo "<br>";
        if ($row['readpp'] == "1")
            echo "<input type='checkbox' id='readCHK' checked>Read";
        else
            echo "<input type='checkbox' id='readCHK'>Read";
        echo "<br>";
        echo "Title " . $row['title'] . "<br>";
        echo "Authors " . $row['authors'] . "<br>";
        echo "Venue " . $row['venue'] . ", pages " . $row['pages'] . "<br>";
        echo "Comments";
        echo "<textarea id='commentsTA' rows='4' cols='50'>$row[comments]</textarea>";
        echo "</div>";
    }
    else if ($_GET['action'] == 4) // Update Paper Data
    {
        $query = "UPDATE bookmarks SET comments='$_POST[comments]', readpp=$_POST[chkbox] WHERE id='$_POST[id]'";
        //echo $query;
        $res = mysqli_query($con, $query);
        echo $res;
    }
    else if ($_GET['action'] == 5) // Delete Paper
    {
        $query = "DELETE FROM bookmarks WHERE id='$_POST[id]'";
        //echo $query;
        $res = mysqli_query($con, $query);
        echo $res;
    }

	mysqli_close($con);
?>
