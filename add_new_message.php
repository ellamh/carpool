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
 
if($dbc === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
$name = mysqli_real_escape_string($dbc, $_REQUEST['name']);
$message = mysqli_real_escape_string($dbc, $_REQUEST['message']);
$city = mysqli_real_escape_string($dbc, $_REQUEST['city']);

 if (!empty($name) && !empty($message) && !empty($city)) {

    $query = "SELECT * FROM messages WHERE messageid = '$messageid'";
    $data = mysqli_query($dbc, $query);
    if (mysqli_num_rows($data) == 0) {

    $sql = "INSERT INTO messages (name, message, city) VALUES ('$name', '$message', '$city')";
    if(mysqli_query($dbc, $sql)){

    mysqli_close($dbc);

     echo 'Thank you for your message '. $name .'!</br>';
     echo '<p><a href="index.php">Go back to the homepage</a>.</p>';

        exit();
        
} else {
    echo "Was not able to execute $sql. " . mysqli_error($dbc);
}
}
}

mysqli_close($dbc);
?>

<p>Leave a message!</p>

<form action="add_new_message.php" method="post">
    <p>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
    </p>
    <p>
        <label for="message">Message:</label>
        <input type="text" name="message" id="message">
    </p>
    <p>
        <label for="city">City:</label>
        <input type="text" name="city" id="city">
    </p>
    <input type="submit" value="Submit">
</form>

<?php
  	echo '<br><a href="signup.php">Sign Up</a><br>';
    echo '<a href="login.php">Log In</a><br>';
    echo '<a href="add_new_message.php">Leave a Message</a><br>';
    echo '<a href="main_forum.php">Message Log</a><br>';
?>

</body>
</html>