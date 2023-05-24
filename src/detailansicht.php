<!DOCTYPE html>
<html>
<head>
<title>Mülleimer</title>
</head>
<body>
  <?php
  session_start();

  // Überprüfen, ob der Benutzer eingeloggt ist
  if (!isset($_SESSION['user_id'])) {
    // Benutzer ist nicht eingeloggt, Weiterleitung zur Login-Seite
    header("Location: login.php");
    exit();
  }

  // Benutzer-ID aus der Session erhalten
  $clicked_bin_id = $_SESSION['clicked_bin_id'];

  //Überschrift
  echo "<h1>Detail Mülleimer $clicked_bin_id</h1>";



  //Datenbankabfrage aus Sensordata
  // Verbindung zur Datenbank herstellen 
  $host = 'localhost';
  $user = 'root';
  $password = ''; 
  $database = 'rbin20'; 

  $conn = new mysqli($host, $user, $password, $database);
  if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
  }
  //Sensordaten abrufen (nur aktuellste Werte)
  $sql = "SELECT * FROM sensor_data WHERE bin_id = $clicked_bin_id ORDER BY timestamp Desc Limit 1";
  $result = $conn->query($sql);
  //$result->fetch_assoc();
  while($row=mysqli_fetch_row($result))
  {
    printf("%s (%s) (%s) (%s) (%s) (%s)\n", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
  }
  
  ?>
</body>

</html>