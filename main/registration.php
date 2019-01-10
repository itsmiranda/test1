

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ppfinder.gr</title>
</head>
<body>

<?php
  $email = "";
  $login= "";
  $surname= "";
  $name= "";
  $password="";
  $password_1="";
  $errors = array(); 
  
    // connect to the database
    require_once ("dbconnect.php");
	  require_once ("utility.php");
    
    // REGISTER USER
    if (isset($_POST['signup'])) {
      // receive all input values from the form
      $login = mysqli_real_escape_string($con, $_POST["login"]);
      $surname = mysqli_real_escape_string($con, $_POST["surname"]);
      $name = mysqli_real_escape_string($con, $_POST["name"]);
      $email = mysqli_real_escape_string($con, $_POST["email"]);
      $password = mysqli_real_escape_string($con, $_POST["password"]);
      $password_1 = mysqli_real_escape_string($con, $_POST["password_1"]);
      echo "<p>Start</p>";
      // form validation: ensure that the form is correctly filled ...
      // by adding (array_push()) corresponding error unto $errors array
      echo "<p>Start</p>";
      if (empty($email)) { array_push($errors, "Το email απαιτείται"); }
      if (empty($password)) { array_push($errors, "Απαιτείται κωδικός πρόσβασης"); }
      if ($password != $password_1) {
        array_push($errors, "Οι δύο κωδικοί πρόσβασης δεν συμφωνούν");
      }
    
      // first check the database to make sure 
      // a user does not already exist with the same username and/or email
      $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
      $result = mysqli_query($con, $user_check_query);
      $user = mysqli_fetch_assoc($result);
      
      if ($user) { // if user exists
    
        if ($user['email'] === $email) {
          array_push($errors, "Το email υπάρχει");
        }
      }
    
      // Finally, register user if there are no errors in the form
      if (count($errors) == 0) {
          $password = md5($password);//encrypt the password before saving in the database
    
          $query = "INSERT INTO user (login, surname, name, email, password ) 
                    VALUES('$login','$surname','$name','$email', '$psw')";
          mysqli_query($con, $query);
          
          $_SESSION['success'] = "Είστε συνδεδεμένοι";
          header('location: main/loggedmenu.php');
      }
    }
?>

		
</body>
</html>
