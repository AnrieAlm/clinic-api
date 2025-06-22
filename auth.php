<?php
session_start();

require_once 'db.php';

function login($username, $password) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role']
        ];
        return true;
    }
    return false;
}

function logout() {
    session_unset();
    session_destroy();
}

function is_logged_in() {
    return isset($_SESSION['user']);
}

function current_user() {
    return $_SESSION['user'] ?? null;
}