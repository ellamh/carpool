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
<table>
<?php

session_start();
require_once('dbinfo.php');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
if($dbc === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
$sql = "SELECT * FROM messages";
if($result = mysqli_query($dbc, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table width='100%' border-collapse='collapse'>";
            echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>Message</th>";
                echo "<th>City</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['message'] . "</td>";
                echo "<td>" . $row['city'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "Sorry, could not execute $sql. " . mysqli_error($dbc);
}

  	echo '<br><a href="signup.php">Sign Up</a><br>';
    echo '<a href="login.php">Log In</a><br>';
    echo '<a href="add_new_message.php">Leave a Message</a><br>';
    echo '<a href="main_forum.php">Message Log</a><br>';
 
mysqli_close($dbc);
?>
</table>
</body>
</html>
