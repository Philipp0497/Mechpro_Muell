<?php
  // Verbindung zur Datenbank herstellen (diese Zeilen müssen angepasst werden)
  $host = 'localhost';
  $user = 'root';
  $password = ''; // Das Passwort für den MySQL-Benutzer, falls vorhanden
  $database = 'Mechpro'; // Der Name deiner Datenbank

  $conn = new mysqli($host, $user, $password, $database);
  if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
  }

  // Einträge generieren und einfügen
  $max_bin_id = 20; // Maximale bin_id
  $max_user_id = 5; // Maximale user_id

  for ($bin_id = 1; $bin_id <= $max_bin_id; $bin_id++) {
    $user_id = rand(1, $max_user_id);

    $sql = "INSERT INTO rubbisch_bin (bin_id, user_id) VALUES ($bin_id, $user_id)";
    if ($conn->query($sql) === TRUE) {
      echo "Eintrag mit bin_id $bin_id und user_id $user_id erfolgreich eingefügt.<br>";
    } else {
      echo "Fehler beim Einfügen des Eintrags mit bin_id $bin_id: " . $conn->error . "<br>";
    }
  }

  // Verbindung schließen
  $conn->close();
?>
