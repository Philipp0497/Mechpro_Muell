# Problems
I can't figure out how to link the return value of the php|js script to the html form element's `action` 😢

## ./index.hmtl

```html
<!-- ./index.hmtl -->

<!doctype html>

<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <title>SmartBin 2.0 - Registration</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="css/styles.css">

</head>
	<body>  
  		<header class="centre"><!-- Title-->
    		Smart Bin 2.0
  		</header>

  		<div class="centre"><!-- Image-->
    	<img 
    		width ="450"
    		src="assets/images/rbin20.webp" <!-- I changed the image's directory to ./assets/images and renamed it-->
    		alt="Picture of a rubbish bin">
  		</div>
  
  <div id ="background_entry">
    <nav class="centre">
      <form action="?login=1" method="post">
        <ul>
          <li>
            <label for="username">Username:</label>
            <input id="username" type ="text" name="username">
          </li>
          <li>
            <label for="password">Password:</label>
            <input id="password" type="password" name="password">
          </li>
          <li>
            <button type="submit" id="login_btn">Login</button>
          </li>
        </ul>
        </form>
    </nav>
  </div>
</body>
    <script type="text/php" src="php/login.php"></script>
    <script type="text/javascript" src="js/index.js"></script>
</html>
```
## ./js/index.js
```javascript
// 
document.getElementById("login_btn").addEventListener("click",
    function () {
        // Get the username and password from the form
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        // Submit the form data to the PHP login script
        var formData = new FormData();
        formData.append("username", username);
        formData.append("password", password);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/login.php");
        xhr.onload = function () {
            if (xhr.status !== 200) {
                // The login failed, show an error message
                alert("Invalid username or password.");
            } else {
                // The login was successful, redirect the user to the overview page
                window.location.href = "../overview.html";
            }
        };
        xhr.send(formData);
    });
```

## ./php/login.php
```php
<?php

// Connect to the MySQL database
$db = new mysqli("localhost", "root", "", "rbin20", 3307);

// Check if the connection was successful
if ($db->connect_error) {
  die("Error connecting to database: " . $db->connect_error);
}

// Get the username and password from the form
$username = $_POST["username"];
$password = $_POST["password"];

// Check if the username and password exist in the database
$sql = "SELECT * FROM rbin.20.user_data WHERE user_id = '$username' AND user_password = '$password'";
$result = $db->query($sql);

// If the user exists, log them in and redirect them to the overview page
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $user_id = $row["user_id"];

  // Set the session variable for the user's ID
  session_start();
  $_SESSION["user_id"] = $user_id;

  // Redirect the user to the overview page
  header("Location: overview.html");
} else {
  // The user does not exist, show an error message
  echo "Invalid username or password.";
}

// Close the database connection
$db->close();

?>
```
