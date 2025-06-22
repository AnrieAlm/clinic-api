<?php
session_start();
include "../includes/db_connection.php";
include "../includes/functions.php";

$validUsers = [
    'admin' => ['password' => 'admin123', 'role' => 'admin'],
    'doctor' => ['password' => 'doc123', 'role' => 'doctor'],
    'nurse' => ['password' => 'nurse123', 'role' => 'nurse'],
    'receptionist' => ['password' => 'rec123', 'role' => 'receptionist']
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (isset($validUsers[$username]) && $validUsers[$username]['password'] === $password && $validUsers[$username]['role'] === $role) {
        $_SESSION['user'] = $username;
        $_SESSION['role'] = $role;
        header("Location: ../dashboard.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid credentials. Please try again.";
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div id="loginForm" class="container">
    <h2>Clinic Management System</h2>
    <?php include "../includes/alerts.php"; ?>
    <form method="POST">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" required />
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required />
        </div>
        <div class="form-group">
            <label>Role:</label>
            <select name="role" required>
                <option value="">Select Role</option>
                <option value="admin">Administrator</option>
                <option value="doctor">Doctor</option>
                <option value="nurse">Nurse</option>
                <option value="receptionist">Receptionist</option>
            </select>
        </div>
        <button class="btn" name="login" type="submit">Login</button>
        <p style="margin-top: 20px;">
            <strong>Demo Credentials:</strong><br/>
            admin / admin123 / Administrator<br/>
            doctor / doc123 / Doctor<br/>
            nurse / nurse123 / Nurse
        </p>
    </form>
</div>
</body>
</html>