<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "clinic_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO patients (first_name, last_name, dob, gender, phone, email, address, emergency_contact, date_added)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $dateAdded = date('Y-m-d H:i:s');
    $stmt->bind_param("sssssssss",
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['dob'],
        $_POST['gender'],
        $_POST['phone'],
        $_POST['email'],
        $_POST['address'],
        $_POST['emergency_contact'],
        $dateAdded
    );

    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    $stmt->close();
    header("Location: dashboard.php");
    exit();
}
?>
