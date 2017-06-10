<?php
  require_once('dbinfo.php');

  session_start();

  $error_msg = "";

  if (!isset($_SESSION['userid'])) 
  {
    if (isset($_POST['loging-in'])) {

      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
      $password = mysqli_real_escape_string($dbc, trim($_POST['password']));

      if (!empty($username) && !empty($password)) {
        $query = "SELECT userid, username, city FROM user WHERE username = '$username' AND password = SHA('$password')";
        $data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data) == 1) {
          $row = mysqli_fetch_array($data);
          
          $_SESSION['userid'] = $row['userid'];
          $_SESSION['username'] = $row['username'];
          $_SESSION['city'] = $row['city'];
          
          setcookie('userid', $row['userid'], time() + (60 * 60 * 24 * 30));    
          setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  
          setcookie('city', $row['city'], time() + (60 * 60 * 24 * 30));  
          
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
          header('Location: ' . $home_url);
        }
        else {
          $error_msg = 'Sorry, the username/password you entered is not correct. Try again!';
        }
      }
      else {
        $error_msg = 'Sorry, you must enter your username and password to log in. Try again!';
      }
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
    <div id="caption">
      <h1>CARPOOL</h1>
      <h2>need a ride?</h2>
    </div>
</head>

<?php
  if (empty($_SESSION['userid'])) {
    echo '<p class="error">' . $error_msg . '</p>';
?>

<body>
  <form method="post" action="login.php">
	Username:<br>
	<input type='text' name='username' placeholder="username">
 	<br>
 	<br>
  
  	Password:<br>
  	<input type='password' name='password' placeholder="password">
  	<br>
  	<br>    
  	
  	<input type="submit" value="Log In" name="loging-in" />
  </form>

<?php
  }
  else {
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>');
    echo '<br><a href="logout.php">Log Out</a><br>';
  }
?>

<?php
  	echo '<br><a href="signup.php">Sign Up</a><br>';
    echo '<a href="login.php">Log In</a><br>';
    echo '<a href="add_new_message.php">Leave a Message</a><br>';
    echo '<a href="main_forum.php">Message Log</a><br>';
?>

</body>
</html>