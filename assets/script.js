// Tab switching functionality
function showTab(tabName) {
    const tabs = ["patients", "appointments", "records"];
    tabs.forEach(t => {
        document.getElementById(t).style.display = 'none';
    });
    document.getElementById(tabName).style.display = 'block';
document.querySelectorAll('.nav-tab').forEach(btn => btn.classList.remove('active'));
document.querySelector(`[onclick="showTab('${tabName}')"]`).classList.add('active');

// Clear search input
    const searchInput = document.querySelector(`input[onkeyup*='${tabName}']`);
    if (searchInput) searchInput.value = "";
}

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

