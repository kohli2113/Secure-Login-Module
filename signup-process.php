<?php
session_start();
include "db-conn.php";

function check_pass_complexity($password) {
    $length = strlen($password);
    if (!($length >= 8 && $length <= 16)) {
        return false;
    }
    if (!preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password)) {
        return false;
    }
    if (!preg_match('/\d/', $password)) {
        return false;
    }
    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        return false;
    }
    return true;
}

function encrypt_password($password) {
    $ciphering_value = "AES-128-CTR";
    $encryption_key = "VaibhavKey"; // Replace with your own encryption key

    $encrypted_password = openssl_encrypt($password, $ciphering_value, $encryption_key);
    return $encrypted_password;
}

function decrypt_password($encrypted_password) {
    $ciphering_value = "AES-128-CTR";
    $decryption_key = "VaibhavKey"; // Replace with your own encryption key

    $decrypted_password = openssl_decrypt($encrypted_password, $ciphering_value, $decryption_key);
    return $decrypted_password;
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $pass = validate($_POST['password']);

    if (empty($username)) {
        header("Location: signup.php?error=Username is required");
        exit();
    } elseif (empty($pass)) {
        header("Location: signup.php?error=Password is required");
        exit();
    } else {
        // You may add additional validation and checks here if needed

        // Check if the username already exists in the database
        $check_username_query = "SELECT * FROM users WHERE username='$username'";
        $check_username_result = mysqli_query($conn, $check_username_query);

        if (mysqli_num_rows($check_username_result) > 0) {
            header("Location: signup.php?error=Username already exists");
            exit();
        } else {
            // Perform password complexity check
            if (!check_pass_complexity($pass)) {
                header("Location: signup.php?error=Password does not meet the given requirements.");
                exit();
            }

            // Encrypt the password
            $encrypted_password = encrypt_password($pass);

            echo "<br> Encrypted Input String: " . $encrypted_password  . "\n";  

            // Decrypting the password
            $decrypted_password = decrypt_password($encrypted_password);

            // Insert the new user into the database
            $insert_user_query = "INSERT INTO users (username, password) VALUES ('$username', '$decrypted_password')";
            mysqli_query($conn, $insert_user_query);

            echo "Signup successful!";

            // You can redirect the user to the login page or any other page as desired
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['S.no'] = $row['S.no'];
            header("Location: post-signup.php");
            exit();
        }
    }
} else {
    header("Location: signup.php");
    exit();
}
?>
