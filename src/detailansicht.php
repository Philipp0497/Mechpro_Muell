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
  //Überschrift
  echo "<h1>Detail Mülleimer $clicked_bin_id</h1>";

  // Benutzer-ID aus der Session erhalten
  $clicked_bin_id = $_SESSION['clicked_bin_id'];

  //Datenbankabfrage aus Sensordata
  // Verbindung zur Datenbank herstellen 
  $host = 'localhost';
  $user = 'root';
  $password = ''; 
  $database = 'Mechpro'; 

  $conn = new mysqli($host, $user, $password, $database);
  if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
  }
  //Sensordaten abrufen (nur aktuellste Werte)
  $sql = "SELECT TOP 1 * FROM sensor_data WHERE bin_id = $clicked_bin_id ORDER BY timestamp";
  $result = $conn->query($sql);
  echo $result;
  ?>
</body>

</html>