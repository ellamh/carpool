<?php
  session_start();

  if (!isset($_SESSION['userid'])) {
    if (isset($_COOKIE['userid']) && isset($_COOKIE['username'])) {
      $_SESSION['userid'] = $_COOKIE['userid'];
      $_SESSION['username'] = $_COOKIE['username'];
      $_SESSION['city'] = $_COOKIE['city']; 
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

<body>

<?php
 
  if (isset($_SESSION['userid'])) {
  	echo 'Hello, '. $_SESSION['username'] . '!'; 
  	echo '<br>';
    echo 'You need a ride from ' . $_SESSION['city'] . '!';
    echo '<br><br>';
    echo '<a href="logout.php">Log Out</a><br>';
    echo '<a href="add_new_message.php">Leave a Message</a><br>';
    echo '<a href="main_forum.php">Message Log</a><br>';
  }
  else {
    echo "<br>Please Sign Up if you don't have an account.<br>Login if you already have an account.<br><br>";
  	echo '<br><a href="signup.php">Sign Up</a><br>';
    echo '<a href="login.php">Log In</a><br>';
    echo '<a href="add_new_message.php">Leave a Message</a><br>';
    echo '<a href="main_forum.php">Message Log</a><br>';
  }
?>

</body>

</html>
