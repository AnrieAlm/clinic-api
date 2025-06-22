<?php
include 'config.php';

$sql = "SELECT id, first_name, last_name, dob, gender, phone, email, address, emergency_contact, date_added FROM patients";
$result = $conn->query($sql);

$patients = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $patients[] = $row;
    }
}

echo json_encode($patients);
?>