<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <style>
        body {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      max-width: 600px;
      padding: 50px;
      border: 3px solid #ccc;
      border-radius: 10px;
      padding-left: 30px;
    }

        .container h1 {
            color: #333;
        }

    .container .redirect-button {
      text-align:center;
      padding-top: 10px;
    }
        
    </style>
</head>
<body>
    <div class="container">
    <h1>You have successfully Signed Up</h1>
    <div class="redirect-button">
    <a href="login.php">Login</a>
    <br>
    <br>
    <a href="index.php">Go to Home</a>
    </div>
    </div>
</body>
</html>