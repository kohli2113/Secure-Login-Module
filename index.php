<!DOCTYPE html>
<html>
<head>
  <title>Login/Signup Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      max-width: 400px;
      padding: 100px;
      border: 3px solid #ccc;
      border-radius: 5px;
      background-color: #D2B4DE;
    }

    .container h2 {
      text-align: center;
      font-size: 44px;
    }

    .container label {
      font-size: 20px;
      padding: 100px;
    }

    .container input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      cursor: pointer;
      font-size: 16px;
    }
  </style>
  <script>
    function handleFormSubmit(event) {
      event.preventDefault(); // Prevent the form from submitting

      const action = document.querySelector('input[name="action"]:checked').value;

      if (action === "login") {
        window.location.href = "login.php";
      } else if (action === "signup") {
        window.location.href = "signup.php";
      }
    }
  </script>
</head>
<body>
  <div class="container">
    <h2>Login/Signup Page</h2>
    <form onsubmit="handleFormSubmit(event)">
      <label>
        <input type="radio" name="action" value="login" checked>
        <span style="font-size: 24px;">Login</span>
      </label>
      <br>
      <br>
      <label>
        <input type="radio" name="action" value="signup">
        <span style="font-size: 24px;">Signup</span>
      </label>
      <br>
      <br>
      <input type="submit" value="Continue">
    </form>
  </div>
</body>
</html>
