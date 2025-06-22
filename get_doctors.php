<?php
// Start session if needed (optional)
session_start();

// Include the database configuration file
include 'config.php';

// Query to fetch doctors from the database
$sql = "SELECT name, specialty FROM doctors";
$result = $conn->query($sql);

// Initialize an empty array to store doctors
$doctors = [];

if ($result->num_rows > 0) {
    // Loop through the result set and add each doctor to the array
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
}

// Close the database connection
$conn->close();

// Set the content type to JSON
header('Content-Type: application/json');

// Output the doctors as JSON
echo json_encode($doctors);
?>