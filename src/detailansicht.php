<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Intelligente Mülltonne 2.0 - Detail</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="css/stylesDetail.css">
</head>
<body>
  <?php
  session_start();

  // Überprüfen, ob der Benutzer eingeloggt ist
  if (!isset($_SESSION['user_id'])) {
    // Benutzer ist nicht eingeloggt, Weiterleitung zur Login-Seite
    header("Location: index.php");
    exit();
  }

  // Benutzer-ID aus der Session erhalten
  $clicked_bin_id = $_SESSION['clicked_bin_id'];

  //Überschrift
  echo "<h1>Detail Mülleimer $clicked_bin_id</h1>";



  //Datenbankabfrage aus Sensordata
  // Verbindung zur Datenbank herstellen 
  $host = 'localhost';
  $user = 'muell';
  $password = 'muell123'; 
  $database = 'rbin20'; 

  $conn = new mysqli($host, $user, $password, $database);
  if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
  }
  //Sensordaten abrufen (nur aktuellste Werte)
  $sql = "SELECT * FROM sensor_data WHERE bin_id = $clicked_bin_id ORDER BY timestamp Desc Limit 3";
  $result = $conn->query($sql);
  //$result->fetch_assoc();

  
 // while($row=mysqli_fetch_row($result))
 // {
 //   printf("BIN_ID (%s) (%s) (%s) (%s) (%s)\n", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
 // }
  
  ?>

<table>
    <tr>
      <th>Bin ID</th>
      <th>Zeit</th>
      <th>Temperatur</th>
      <th>Füllstand</th>
      <th>Feuer</th>
      <th>Deckel</th>
    </tr>
    <?php while ($row=mysqli_fetch_row($result)): ?>
      <tr>
        <td><?php echo $row[0]; ?></td>
        <td><?php echo $row[1]; ?></td>
        <td><?php echo $row[2]; ?></td>
        <td><?php echo $row[3]; ?></td>
        <td><?php echo $row[4]; ?></td>
        <td><?php echo $row[5]; ?></td>

        

      </tr>
    <?php endwhile; ?>
  </table>



</body>

</html>