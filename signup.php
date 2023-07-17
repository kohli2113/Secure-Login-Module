<!DOCTYPE html>
<html>
<head>
  <title>Signup</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      max-width: 500px;
      padding: 50px;
      border: 3px solid #ccc;
      border-radius: 10px;
      padding-left: 30px;
    }

    .container h2 {
      text-align: center;
      font-size: 44px;
    }

    .container input[type="text"],
    .container input[type="password"]{
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      font-size: 16px;
      margin-right: 20px;
    }

    .container input[type="submit"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      font-size: 16px;
      margin-left: 15px;
    }

    .container input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      border: 3px #bbb;
      cursor: pointer;
      align-content: center;
    }

    .container .redirect-button {
      text-align:center;
      padding-top: 10px;
    }

  </style>
</head>
<body>
  <div class="container">
    <div class="row col-md-6 col-md-offset-3">
      <h2>Signup</h2>
      <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>
      <form action="signup-process.php" method="post">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Signup">
    </form>
    </div>
    <div class="redirect-button">
      <a href="index.php">Go to Home</a>
    </div>
  </div>
</body>
</html>
