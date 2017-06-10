<?php 
  session_start(); 
  
  if (isset($_SESSION['userid'])) { 
  
  $_SESSION = array(); 
  
  if (isset($_COOKIE[session_name()])) { 
  setcookie(session_name(), '', time() - 3600); 
  } 
  
  session_destroy(); 
  } 
  
  setcookie('userid', '', time() - 3600); 
  setcookie('username', '', time() - 3600); 
  setcookie('city', '', time() - 3600); 
  
  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php'; 
  header('Location: ' . $home_url);

  	echo '<br><a href="signup.php">Sign Up</a><br>';
    echo '<a href="login.php">Log In</a><br>';
    echo '<a href="add_new_message.php">Leave a Message</a><br>';
    echo '<a href="main_forum.php">Message Log</a><br>';
?>