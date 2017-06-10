<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="style.css">
      <div id="caption">
      <h1>CARPOOL</h1>
      <h2>need a ride?</h2>
    </div>
</head>

<body>
<?php
session_start();
require_once('dbinfo.php');

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if (isset($_POST['signing-up'])) {
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
    $city = mysqli_real_escape_string($dbc, trim($_POST['city']));

    if (!empty($username) && !empty($password1) && !empty($password2) && !empty($city) && ($password1 == $password2)) {

      $query = "SELECT * FROM user WHERE username = '$username'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {

      	$query = "INSERT INTO user (username, password, city) VALUES ('$username', SHA('$password1'), '$city')"; 
        mysqli_query($dbc, $query);
        
        $query = "SELECT userid FROM user WHERE username = '$username'";
        $data = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($data);
        
        $_SESSION['userid'] = $row['userid'];
        $_SESSION['username'] = $username;
        $_SESSION['city'] = $city;
        setcookie('userid', $row['userid'], time() + (60 * 60 * 24 * 30));    
        setcookie('username', $username, time() + (60 * 60 * 24 * 30));       
        setcookie('city', $city, time() + (60 * 60 * 24 * 30));  
        
        mysqli_close($dbc);
                
        echo 'Thanks for signing up, '. $username .'!</br>';
        echo '<p>Your new account has been successfully created. <a href="index.php">Go back to the homepage</a>.</p>';
        
        exit();
      }
      else {

        echo 'An account already exists for this username. Please use a different address.';
        $username = "";
      }
    }
    else {
      echo 'You must enter all of the sign-up data, including the desired password twice.';
    }
  }

  mysqli_close($dbc);
?>

<p>Please type in a username and password to sign up</p>

<form action='signup.php' method='post'>
	Username:<br>
	<input type='text' name='username' placeholder="username">
 	<br><br>
  
	City:<br>
	<input type='text' name='city' placeholder="city">
 	<br><br>

  	Enter a password:<br>
  	<input type='password' name='password1' placeholder="password">
  	<br><br>

  	Retype the password:<br>
  	<input type='password' name='password2' placeholder="password">
  	<br><br>
  		
	<input type='submit' value='Sign Up' name='signing-up'>
</form>

<?php
  	echo '<br><a href="signup.php">Sign Up</a><br>';
    echo '<a href="login.php">Log In</a><br>';
    echo '<a href="add_new_message.php">Leave a Message</a><br>';
    echo '<a href="main_forum.php">Message Log</a><br>';
?>

</body>
</html>