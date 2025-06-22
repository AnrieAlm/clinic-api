<?php
session_start();
$conn = new mysqli("localhost", "root", "", "clinic_db");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO patients (first_name, last_name, dob, gender, phone, email, address, emergency_contact)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss",
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['dob'],
        $_POST['gender'],
        $_POST['phone'],
        $_POST['email'],
        $_POST['address'],
        $_POST['emergency_contact']
    );
    $stmt->execute();
    $stmt->close();
}
header("Location: index.php");
exit();