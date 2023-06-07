<!doctype html>
<html class="no-js" lang="de">

<head>
  <meta charset="utf-8">
  <title>Intelligente Mülltonne 2.0 - Uebersicht</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="css/stylesUebersicht.css">

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

  // Verbindung zur Datenbank herstellen 
  $host = 'localhost';
  $user = 'muell';
  $password = 'muell123'; 
  $database = 'rbin20'; 

  $conn = new mysqli($host, $user, $password, $database);
  if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
  }

  // Benutzer-ID aus der Session erhalten
  $user_id = $_SESSION['user_id'];

  // Daten für den eingeloggten Benutzer abrufen
  $sql = "SELECT * FROM rubbish_bin WHERE user_id = $user_id";
  $result = $conn->query($sql);

  // Überprüfen, ob eine bin_id angeklickt wurde
  if (isset($_GET['bin_id'])) {
    $clicked_bin_id = $_GET['bin_id'];

    // bin_id in der Session speichern
    $_SESSION['clicked_bin_id'] = $clicked_bin_id;

    // Weiterleitung zur Detailansicht
    header("Location: detailansicht.php");
    exit();
  }
  ?>
  
  <h1>Übersicht</h1>

  <table>
    <tr>
      <th>Bin_ID</th>
      <th>Größe</th>
      <th>Adresse</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr onclick="window.location.href='?bin_id=<?php echo $row['bin_id']; ?>'">
        <td><?php echo $row['bin_id']; ?></td>
        <td><?php echo $row['bin_size']; ?></td>
        <td><?php echo $row['bin_address']; ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
  
</body>

</html>