<!DOCTYPE html>
<html>
<head>
    <title>Secure Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #0070c9, #00aaff);
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .login-box {
            background: white;
            padding: 30px;
            margin: 100px auto;
            width: 320px;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.2);
            transition: transform 0.3s ease;
        }
        .login-box:hover {
            transform: scale(1.05);
        }
        input {
            width: 90%;
            padding: 12px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: border-color 0.3s;
        }
        input:focus {
            border-color: #0070c9;
            outline: none;
            box-shadow: 0 0 5px rgba(0,112,201,0.5);
        }
        button {
            padding: 12px 20px;
            background-color: #0070c9;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #005fa3;
        }
        .toggle-password {
            cursor: pointer;
            font-size: 12px;
            color: #0070c9;
        }
        .loading {
            display: none;
            margin-top: 15px;
            font-size: 14px;
            color: #0070c9;
        }
    </style>
</head>
<body>
    <div class="login-box" action='login.php'>
        <h2>Bank Login</h2>
        <form method="POST" action="login.php" onsubmit="showLoading()">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" id="password" name="password" placeholder="arpi@1233" required><br>
            <span class="toggle-password" onclick="togglePassword()">Show/Hide Password</span><br><br>
            <button type="submit">Login</button>
            <div class="loading" id="loading">Authenticating...</div>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }

        function showLoading() {
            document.getElementById("loading").style.display = "block";
        }
    </script>
<?php

// Database connection
$conn = mysqli_connect("localhost", "root", "", "test");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get user input
$username = $_POST['username'];
$password = $_POST['password'];

// Vulnerable SQL Query (NO security)
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";

$result = mysqli_query($conn, $query);

// Check login
if (mysqli_num_rows($result) > 0) {
    echo "<h3 style='color:green;'>Login Successful!</h3>";
} else {
    echo "<h3 style='color:red;'>Invalid Username or Password</h3>";
}

?>
</body>
</html>

