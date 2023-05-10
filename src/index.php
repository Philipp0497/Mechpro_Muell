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
      <form action="uebersicht.php">
        <ul>
          <li>
            <label for="username">Username:</label>
            <input id="username" type ="text" name="username">
          </li>
          <li>
            <label for="passwort">Passwort:</label>
            <input id="passwort" type="password" name="passwort">
          </li>
          <li>
            <button type="submit" id="ButtonLogin">Login</button>
          </li>
        </ul>
    </nav>
  </div>
  <script>
    document.getElementById("ButtonLogin").onclick = function()
    {
      var name = document.getElementById("username").value;
      console.log(name);
    }
  </script>
  <script src="js/vendor/modernizr-{{MODERNIZR_VERSION}}.min.js"></script>
  <script src="js/app.js"></script>

</body>

</html>