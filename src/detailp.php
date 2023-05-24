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
    echo "<h1>Detail Mülleimer $clicked_bin_id</h1>";
  ?>
</body>
</html>
