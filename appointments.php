<?php
require_once 'db.php';

function get_all_appointments() {
    global $pdo;
    $stmt = $pdo->query("
        SELECT a.*, p.first_name, p.last_name 
        FROM appointments a
        JOIN patients p ON a.patient_id = p.id
        ORDER BY a.appointment_date DESC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function add_appointment($data) {
    global $pdo;
    $stmt = $pdo->prepare("
        INSERT INTO appointments 
        (patient_id, doctor, appointment_date, appointment_time, reason, status)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    return $stmt->execute([
        $data['patientId'], $data['doctor'], $data['date'], $data['time'],
        $data['reason'], $data['status']
    ]);
}

function delete_appointment($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM appointments WHERE id = ?");
    return $stmt->execute([$id]);
}