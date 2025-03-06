<?php
session_start();
require 'conn.php'; // Include the PDO connection

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and trim form input
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    // Prepare and execute the query to fetch admin details by username
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    // Check if admin exists and the password is correct
    // Assuming passwords are hashed, we use password_verify()
    if ($admin && password_verify($password, $admin['password'])) {
        // Store admin details in session
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['full_name'];
        $_SESSION['admin_role'] = $admin['role'];
        
        // Redirect to dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0A1F44;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: #FFFFFF;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(7, 236, 22, 0.2);
            text-align: center;
            width: 350px;
        }
        .login-container h2 {
            color: rgb(0, 59, 160);
            margin-bottom: 20px;
        }
        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .input-group label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            color: #0A1F44;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #87CEEB;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 5px;
        }
        .login-btn {
            background-color: #FF6700;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        .login-btn:hover {
            background-color: #D35400;
        }
        .forgot-password {
            display: block;
            margin-top: 10px;
            font-size: 14px;
            color: #0A1F44;
            text-decoration: none;
        }
        .forgot-password:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <!-- Display error if credentials are invalid -->
        <?php if (isset($error)) : ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="login-btn">Login</button>
            <a href="#" class="forgot-password">Forgot password?</a>
        </form>
    </div>
</body>
</html>
