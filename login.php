<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
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
    <h2>Login</h2>
    <?php
    session_start();
    include "db-conn.php";

    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        function validate($data){
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
        }
        
        $username = validate($_POST['username']);
        $pass = validate($_POST['password']);
        
        if (empty($username)) {
            $error = "User Name is required";
        } else if (empty($pass)) {
            $error = "Password is required";
        } else {
            $sql = "SELECT * FROM users WHERE username='$username' AND password='$pass'";
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                
                if ($row['username'] === $username && $row['password'] === $pass) {
                    echo "Logged in!";
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['S.no'] = $row['S.no'];
                    header("Location: post-login.php");
                    exit();
                } else {
                    // Increment login attempts on failed login
                    $_SESSION['login_attempts']++;

                    if ($_SESSION['login_attempts'] >= 3) {
                        $error = "Maximum login attempts exceeded. Please try again later.";
                    } else {
                        $error = "Incorrect username or password";
                    }
                }
            } else {
                $error = "Incorrectusername or password";
            }
        }
    }
    ?>

    <?php if (isset($error)) { ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>

    <form method="post">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Login">
    </form>
    
    <div class="redirect-button">
      <a href="index.php">Go to Home</a>
    </div>
  </div>
</body>
</html>
