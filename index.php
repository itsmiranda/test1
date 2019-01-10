<?php include('main/registration.php') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">

<?php
	session_start();
	$_SESSION['title'] = "ppfinder.gr";
?>

<head>
<link REL="SHORTCUT ICON" HREF="css/library_logo.png">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo "<title>$_SESSION[title]</title>"; ?>
<link href="css/index.css" rel="stylesheet" type="text/css" />
<link href='skins/default/dropmenu/dropmenu.css' media='screen' rel='stylesheet' type='text/css'>
</head>

<!-- 	STANDARDS END HERE     -->
<!-- TODO   Check if logged and redirect appropriately   -->

<body class="background">

<img src="css/banner.png" class="responsive" alt="<b> Paperfinder.gr </b>"  width="250" height="150" />

<?php
	$act = '';
	$attempt= 0;
	if (isset($_REQUEST['action']))
		$act = $_REQUEST['action'];
	
	if (isset($_REQUEST['attempt']))
		$attempt = $_REQUEST['attempt'];

	$lang = "gr";
	if (isset($_REQUEST['lang']))
		$lang = $_REQUEST['lang'];
		
	switch ($lang)
	{
		case 'gr':
			require_once ("lang/gr_index.php");
		break;
		case 'eng':
			require_once ("lang/eng_index.php");
		break;
	}

	switch ($act)
	{
		case 'login':
			require ("main/login.php");
    break;
   
	}

	$attempt++;
	
  $actstr = "index.php?lang=$lang&action=login&attempt=$attempt";
 
?>

<div class="wrapperMENU">
<ul id="menu">
    <li class="logo">
        <?php echo "<img style='float:left;' alt='' src='skins/default/dropmenu/banner.png'>"; ?>
        <ul id="main" style="position:relative; top:0px; ">
            <li><?php echo $glL['ppfinder'] ?></li>
            <li class="last">
                <?php echo "<img class='corner_left' alt='' src='skins/default/dropmenu/corner_blue_left.png'/>"; ?>
                <?php echo "<img class='middle' alt='' src='skins/default/dropmenu/dot_blue.png'/>"; ?>
                <?php echo "<img class='corner_right' alt='' src='skins/default/dropmenu/corner_blue_right.png'/>"; ?>
            </li>
        </ul>
        
    </li>
    <li><a href="#"><?php echo $glL['mnu_what'] ?></a></li>
    <li><a href="#"><?php echo $glL['mnu_who'] ?></a></li>
    <li><a href="#"><?php echo $glL['mnu_contact'] ?></a></li>    
</ul>
<?php echo "<img style='float:left;' alt='' src='skins/default/dropmenu/menu_right.png'/>"; ?>
</div>

<div class="TEXTBOX">
<h3>Καλώς όρισες στο Paperfinder.gr!<h3> <br>
<h7>
<i class="fa fa-save" style="font-size:34px;color:black;"></i> Αποθήκευσε τις δημοσιεύσεις που σε ενδιαφέρουν! <br>
<i class="fa fa-heart" style="font-size:34px;color:black;"></i> Δημιούργησε τη λίστα με τις αγαπημένες σου!<br>
<i class="fa fa-pencil" style="font-size:34px;color:black;"></i> Πρόσθεσε σχόλια σε αυτές! <br>
<i class="fa fa-book" style="font-size:34px;color:black;"></i>Σημείωσε ποιές έχεις διαβάσει! <br>
</h7>
</div> 

<div class="LOGINBOX">
<?php
	echo "<form action='$actstr' method='post'>";
?>
<h4 class="headline"><?php echo $glL['entry'] ?></h4>
<h5 class="headline"><?php echo $glL['uid'] ?></h5>
<input type="text" name="login" size="30" />
<h5 class="headline"><?php echo $glL['pass'] ?></h5>
<input type="password" name="password" size="31"/>
<br /><br />
<input type="submit" style="height: 25px; width: 80px; text-align:center;" value="<?php echo $glL['entry'] ?>" />
</form>
<!-- Button to open the modal -->
<button onclick="document.getElementById('id01').style.display='block'" name="register">Εγγραφή</button>

<!-- The Modal (contains the Sign Up form) -->

<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">Επιστροφή</span>
  <form class="modal-content" method="post" action="main/registration.php">
    <div class="container">
      <h1>Εγγραφή Χρήστη</h1>
      <p>Παρακαλώ, συμπληρώστε την παρακάτω φόρμα ώστε να δημιουργήσετε λογαριασμό.</p>
      <hr>
      <label for="login"><b>Όνομα Χρήστη</b></label>
      <input type="text" placeholder="Enter Username" name="login" required>

      <label for="surname"><b>Επώνυμο </b></label>
      <input type="text" placeholder="Enter surname" name="surname" required>

      <label for="name"><b>Όνομα </b></label>
      <input type="text" placeholder="Enter name" name="name" required>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

      <label for="psw"><b>Κωδικός πρόσβασης</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <label for="psw-repeat"><b>Επανάληψη κωδικού πρόσβασης</b></label>
      <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

      <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Θυμήσου με
      </label>

      <p>Με τη δημιουργία λογαριασμού συμφωνείτε με τους <a href="https://www.lawspot.gr/nomikes-plirofories/nomothesia/genikos-kanonismos-gia-tin-prostasia-dedomenon?lspt_context=gdpr" style="color:dodgerblue">Όρους και προϋποθέσεις</a>.</p>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Ακύρωση</button>
        <button type="submit" class="signup">Εγγραφή</button>
      </div>
    </div>
  </form>
</div>

<a href="index.php?lang=gr"><img src="css/greece_flag.png" alt="Ελληνικά" style="position:absolute;left:27%;top:428px;border:none"></a>
<a href="index.php?lang=eng"><img src="css/england_flag.png" alt="English" style="position:absolute;left:53%;top:428px;border:none"></a>
</div>

</body>
</html>
