<?php
require_once 'db.php';

function get_total_patients() {
    global $pdo;
    return $pdo->query("SELECT COUNT(*) FROM patients")->fetchColumn();
}

function get_total_appointments() {
    global $pdo;
    return $pdo->query("SELECT COUNT(*) FROM appointments")->fetchColumn();
}

function get_new_patients_this_month() {
    global $pdo;
    $currentMonth = date("Y-m");
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM patients WHERE DATE_FORMAT(date_added, '%Y-%m') = ?");
    $stmt->execute([$currentMonth]);
    return $stmt->fetchColumn();
}

function get_today_appointments() {
    global $pdo;
    $today = date("Y-m-d");
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM appointments WHERE appointment_date = ?");
    $stmt->execute([$today]);
    return $stmt->fetchColumn();
}