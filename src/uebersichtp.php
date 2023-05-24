<!DOCTYPE html>
<html>
<head>
  <title>Übersicht</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
    tr:hover {
      background-color: #e6e6e6;
      cursor: pointer;
    }
  </style>
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

  // Verbindung zur Datenbank herstellen 
  $host = 'localhost';
  $user = 'root';
  $password = ''; 
  $database = 'Mechpro'; 

  $conn = new mysqli($host, $user, $password, $database);
  if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
  }

  // Benutzer-ID aus der Session erhalten
  $user_id = $_SESSION['user_id'];

  // Daten für den eingeloggten Benutzer abrufen
  $sql = "SELECT bin_id FROM rubbisch_bin WHERE user_id = $user_id";
  $result = $conn->query($sql);

  // Überprüfen, ob eine bin_id angeklickt wurde
  if (isset($_GET['bin_id'])) {
    $clicked_bin_id = $_GET['bin_id'];

    // bin_id in der Session speichern
    $_SESSION['clicked_bin_id'] = $clicked_bin_id;

    // Weiterleitung zur Detailansicht
    header("Location: muelleimer.php");
    exit();
  }
  ?>
  
  <h1>Übersicht</h1>

  <table>
    <tr>
      <th>Mülleimer</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr onclick="window.location.href='?bin_id=<?php echo $row['bin_id']; ?>'">
        <td><?php echo $row['bin_id']; ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
  
</body>
</html>
