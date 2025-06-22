<?php
require_once 'db.php';

function get_all_patients() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM patients ORDER BY date_added DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function add_patient($data) {
    global $pdo;
    $stmt = $pdo->prepare("
        INSERT INTO patients 
        (first_name, last_name, dob, gender, phone, email, address, emergency_contact)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    return $stmt->execute([
        $data['firstName'], $data['lastName'], $data['dob'], $data['gender'],
        $data['phone'], $data['email'], $data['address'], $data['emergencyContact']
    ]);
}

function update_patient($id, $data) {
    global $pdo;
    $stmt = $pdo->prepare("
        UPDATE patients SET
        first_name = ?, last_name = ?, dob = ?, gender = ?, phone = ?, 
        email = ?, address = ?, emergency_contact = ?
        WHERE id = ?
    ");
    return $stmt->execute([
        $data['firstName'], $data['lastName'], $data['dob'], $data['gender'],
        $data['phone'], $data['email'], $data['address'], $data['emergencyContact'], $id
    ]);
}

function delete_patient($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM patients WHERE id = ?");
    return $stmt->execute([$id]);
}