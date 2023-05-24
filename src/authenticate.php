<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'testdb2';

// Try and connect using the info above.
$con = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( $con->connect_error ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . $conn->connect_error);
}

$_UserID = $_POST['user_id'];
$_Password = $_POST['password'];


// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['user_id'], $_POST['password'] )) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}
else{

}

$sql = "SELECT * FROM user_data WHERE user_id = $_UserID";
$result = $con->query($sql);
$row = $result->fetch_assorc();

if($row['user_id'] === $_UserID)
{
    if($row['password' === $_Password])
    {
        $_SESSION['user_id'] = $_UserID;
        {
            header("Location: uebersicht.php");
    
        }
    }
    else {
            // Incorrect password
            echo 'Incorrect username and/or password!';
        }
} else {
        // Incorrect username
        echo 'Incorrect username and/or password!';
    }


	$stmt->close();
?>