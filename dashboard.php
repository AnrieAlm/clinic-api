<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit();
}

include "includes/db_connection.php";
include "includes/functions.php";

$patients = fetchPatients($conn);
$appointments = fetchAppointments($conn);
$doctors = fetchDoctors($conn);
$medicalRecords = fetchMedicalRecords($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Clinic Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>🏥 Clinic Management System</h1>
    <?php include "includes/alerts.php"; ?>
   <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <p>Welcome, <strong><?= htmlspecialchars($_SESSION['user'] ?? '') ?></strong> (<em><?= ucfirst(htmlspecialchars($_SESSION['role'] ?? '')) ?></em>)</p>
    <a href="?logout=1"><button class="btn logout-btn">Logout</button></a>
</div>

    <!-- Tabs -->
    <div class="nav-tabs">
        <button class="nav-tab active" onclick="showTab('patients')">👥 Patients</button>
        <button class="nav-tab" onclick="showTab('appointments')">📅 Appointments</button>
        <button class="nav-tab" onclick="showTab('records')">📋 Medical Records</button>
    </div>

    <!-- Content Sections -->
    <div id="patients" class="tab-content">
        <?php include "patients/patients_tab.php"; ?>
    </div>

    <div id="appointments" class="tab-content hidden">
        <?php include "appointments/appointments_tab.php"; ?>
    </div>

    <div id="records" class="tab-content hidden">
        <?php include "records/records_tab.php"; ?>
    </div>

    <!-- Modals -->
    <div id="patientModal" class="modal"><?php include "patients/add_patients.php"; ?></div>
    <div id="editAppointmentModal" class="modal"><?php include "appointments/edit_appointment.php"; ?></div>
    <div id="recordModal" class="modal"><?php include "records/add_record.php"; ?></div>


    <script>
        // Tab switching functionality


// Modal handling
function showModal(modalId) {
    document.getElementById(modalId).style.display = "block";
}

function hideModal(modalId) {
    document.getElementById(modalId).style.display = "none";
}

// Populate edit appointment modal with data
function editAppointment(data) {
    document.getElementById("editId").value = data.id;
    document.getElementById("editPatient").value = data.patient_id;
    document.getElementById("editDoctor").value = data.doctor_id;
    document.getElementById("editDate").value = data.appointment_date;
    document.getElementById("editTime").value = data.appointment_time;
    document.getElementById("editReason").value = data.reason;
    document.getElementById("editStatus").value = data.status;
    showModal("editAppointmentModal");
}

// Close modals when clicking outside of them
window.onclick = function (event) {
    const modals = document.getElementsByClassName("modal");
    for (let i = 0; i < modals.length; i++) {
        if (event.target === modals[i]) {
            modals[i].style.display = "none";
        }
    }
}

// Delete appointment confirmation
function deleteAppointment(id) {
    if (confirm("Are you sure you want to delete this appointment?")) {
        window.location.href = "delete_appointment.php?id=" + id;
    }
}

// Filter appointments by date and doctor
function filterAppointments() {
    const dateFilter = document.getElementById("filterDate").value;
    const doctorFilter = document.getElementById("filterDoctor").value.toLowerCase();
    const container = document.getElementById("appointmentsList");
    const items = Array.from(container.children);

    items.forEach((item) => {
        const itemDate = item.querySelector(".date")?.textContent.trim();
        const itemDoctor = item.querySelector(".doctor")?.textContent.trim().toLowerCase();

        const matchDate = !dateFilter || itemDate === dateFilter;
        const matchDoctor = !doctorFilter || itemDoctor.includes(doctorFilter);

        item.style.display = matchDate && matchDoctor ? "block" : "none";
    });
}


// Search functionality for patients, appointments, and records
function search(query, type) {
    query = query.toLowerCase().trim();
    const container = document.getElementById(type + "List");
    const items = Array.from(container.children);

    items.forEach((item) => {
        const patientName = item.querySelector("strong.name")?.textContent.toLowerCase() || "";
        const date = item.querySelector(".date")?.textContent.toLowerCase() || "";
        const doctor = item.querySelector(".doctor")?.textContent.toLowerCase() || "";
        const status = item.querySelector("strong.status")?.textContent.toLowerCase() || "";

        let match = false;

        if (type === "patients") {
            match = patientName.includes(query);
        } else if (type === "appointments") {
            match = patientName.includes(query) || date.includes(query) || doctor.includes(query) || status.includes(query);
        } else if (type === "records") {
            match = patientName.includes(query) || doctor.includes(query) || date.includes(query);
        }

        item.style.display = match ? "block" : "none";
    });
}


    // This runs when the page loads
    window.addEventListener('DOMContentLoaded', () => {
        // Show the default tab based on PHP session
        const activeTab = '<?= isset($_SESSION['user']) ? 'patients' : '' ?>';
        if (activeTab) {
            showTab(activeTab);
        }
    });

    // Function to switch tabs
    function showTab(tabName) {
        const tabs = ["patients", "appointments", "records"];
        tabs.forEach(t => {
            const el = document.getElementById(t);
            if (el) el.style.display = 'none';
        });
        const selected = document.getElementById(tabName);
        if (selected) selected.style.display = 'block';

        // Optional: Add active class to tab button
        document.querySelectorAll('.nav-tab').forEach(btn => btn.classList.remove('active'));
        document.querySelector(`[onclick="showTab('${tabName}')"]`).classList.add('active');
    }
</script>
</body>
</html>