<?php
function fetchPatients($conn) {
    $patients = [];
    $result = $conn->query("SELECT * FROM patients");
    while ($row = $result->fetch_assoc()) $patients[] = $row;
    return $patients;
}

function fetchAppointments($conn) {
    $appointments = [];
    $sql = "SELECT a.id, p.first_name, p.last_name, a.appointment_date, a.appointment_time, d.name AS doctor, a.reason, a.status 
            FROM appointments a
            JOIN patients p ON a.patient_id = p.id
            JOIN doctors d ON a.doctor_id = d.id";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) $appointments[] = $row;
    return $appointments;
}

function fetchDoctors($conn) {
    $doctors = [];
    $result = $conn->query("SELECT * FROM doctors");
    while ($row = $result->fetch_assoc()) $doctors[] = $row;
    return $doctors;
}

function fetchMedicalRecords($conn) {
    $medicalRecords = [];
    $sql = "SELECT m.id, p.first_name, p.last_name, m.diagnosis, m.treatment, m.notes, m.doctor, m.date_recorded
            FROM medical_records m
            JOIN patients p ON m.patient_id = p.id";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) $medicalRecords[] = $row;
    return $medicalRecords;
}
?>