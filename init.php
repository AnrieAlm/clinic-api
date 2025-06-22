<?php
session_start();
require_once 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (login($username, $password)) {
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Invalid credentials. Please try again.');</script>";
    }
}
?>