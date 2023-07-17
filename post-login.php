<?php 
session_start();
if (isset($_SESSION['S.no']) && isset($_SESSION['username'])) {
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


        h1 {
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
    <h1>You have successfully Logged In, <?php echo $_SESSION['username']; ?></h1>
    <div class="redirect-button">
    <a href="logout.php">Logout</a>
    </div>
</div>
</body>
</html>

<?php 
} else {
    header("Location: login.php?error=Can't show more");
    exit();
}
?>