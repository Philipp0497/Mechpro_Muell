<?php
session_start();

// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'rbin20';

// Try and connect using the info above.
$con = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ($con->connect_error) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . $con->connect_error);
}

if (isset($_POST['userid'], $_POST['password'])) {
	$UserID = $_POST['userid'];
	$Password = $_POST['password'];

	$sql = "SELECT * FROM user_data WHERE user_id = '$UserID'";
	$result = $con->query($sql);
	$row = $result->fetch_assoc();

	if ($row['user_password'] === $Password) {
		// Correct username and password
		$_SESSION['user_id'] = $UserID;
		header("Location: uebersicht.php");
		exit;
	} else {
		// Incorrect username and/or password
		echo 'Incorrect username and/or password!';
	}
}

$con->close();
?>

<!doctype html>

<html class="no-js" lang="de">

<head>
  <meta charset="utf-8">
  <title>Intelligente Mülltonne 2.0 - Anmeldung</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="css/styles.css">


</head>

<body>
  
  <header class="mitte"><!-- Überschrift-->
    Intelligente Mülltonne
  </header>

  <div class="mitte"><!-- Bild-->
    <img 
    width ="300"
    src="img/Muelleimer_Image.webp" 
    alt="Mülleimer Bild">
  </div>
  
  <div id="hintergrundEingabe">
    <nav class="mitte">
      <form method="POST" action="index.php">
        <ul>
          <li>
            <label for="userid"></label>
            <input type="text" name="userid" placeholder="Username" id="userid" required>
          </li>
          <li>
            <label for="password"></label>
            <input type="password" name="password" placeholder="Password" id="password" required>
          </li>
          <li>
            <button type="submit">Senden</button>
          </li>
        </ul>
      </form>
    </nav>
  </div>

</body>

</html>
