<?php 
session_start(); 
include "db-conn.php";

if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
    $username = validate($_POST['username']);
    $pass = validate($_POST['password']);
    if (empty($username)) {
        header("Location: login.php?error=User Name is required");
        exit();
    }else if(empty($pass)){
        header("Location: login.php?error=Password is required");
        exit();
    }else{
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
            }else {
                // Increment login attempts on failed login
                $_SESSION['login_attempts']++;
    
                if ($_SESSION['login_attempts'] >= 3) {
                    header("Location: login.php?error=Maximum login attempts exceeded. Please try again later.");
                    exit();
                } else {
                    header("Location: login.php?error=Incorrect Username or password");
                    exit();
                }
            }
        }else{
            header("Location: login.php?error=Incorect Username or password");
            exit();
        }
    }
}else{
    header("Location: login.php");
    exit();
}