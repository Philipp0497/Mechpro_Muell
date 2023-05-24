<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=testdb', 'root', '');
 
if(isset($_GET['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $statement = $pdo->prepare("SELECT * FROM user_data WHERE username = :user_id");
    $result = $statement->execute(array('username' => $username));
    $user = $statement->fetch();
        
    //Überprüfung des Passworts
    if ($user !== false && password_verify($password, $username['password'])) {
        $_SESSION['user_id'] = $user['id'];
        die('Login erfolgreich. Weiter zu <a href="geheim.php">internen Bereich</a>');
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }
    
}
<!doctype html>

<html class="no-js" lang="de">

<head>
  <meta charset="utf-8">
  <title>Intelligente Mülltonne 2.0 - Anmeldung</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="css/styles.css">
  <script type="text/javascript" src="js/jsIndex.js"></script>

</head>

<body>
  
  <header class="mitte"><!-- Überschrift-->
    Intelligente Mülltonne 2.0
  </header>

  <div class="mitte"><!-- Bild-->
    <img 
    width ="300"
    src="img/Muelleimer_Image.webp" 
    alt="Mülleimer Bild">
  </div>
  
  <div id ="hintergrundEingabe">
    <nav class="mitte">
      <form action="?login=1" method="post">
        <ul>
          <li>
            <label for="username">Username:</label>
            <input id="username" type ="text" name="username">
          </li>
          <li>
            <label for="password">Passwort:</label>
            <input id="passwort" type="password" name="password">
          </li>
          <li>
            <button type="submit" id="ButtonLogin">Login</button>
          </li>
        </ul>
    </nav>
  </div>

  <script>
  /*document.getElementById("ButtonLogin").onclick = function()
  var js_variable_username = document.getElementById("username").value;
  var js_variable_password = document.getElementById("passwort").value;

  window.location.href = "index.php?js_variable_username=" + js_variable_username;
  window.location.href = "index.php?js_variable_passwort=" + js_variable_passwort;*/

  </script>

  <script src="js/vendor/modernizr-{{MODERNIZR_VERSION}}.min.js"></script>
  <script src="js/app.js"></script

</body>

</html>