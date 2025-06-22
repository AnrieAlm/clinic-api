<!-- Appointments Tab -->
<div id="appointments" class="tab-content hidden">
    <div style="display:flex;flex-wrap:wrap;gap:10px;align-items:center;">
        <h2>Appointment Management</h2>
        <a href="add_appointment.php"><button type="button" class="btn">➕ Schedule Appointment</button></a>
        <input type="date" id="filterDate" onchange="filterAppointments()" />
        <select id="filterDoctor" onchange="filterAppointments()">
            <option value="">All Doctors</option>
            <?php foreach ($doctors as $d): ?>
                <option value="<?= htmlspecialchars($d['name']) ?>">
                    <?= htmlspecialchars($d['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="text" placeholder="Search..." onkeyup="search(this.value, 'appointments')" />
    </div>

    <div id="appointmentsList" class="appointment-grid">
        <?php foreach ($appointments as $a): ?>
            <div class="appointment-card">
                <strong class="name"><?= htmlspecialchars($a['first_name'] . ' ' . $a['last_name']) ?></strong><br/>
                Date: <span class="date"><?= htmlspecialchars($a['appointment_date']) ?></span><br/>
                Time: <?= htmlspecialchars($a['appointment_time']) ?><br/>
                Doctor: <span class="doctor"><?= htmlspecialchars($a['doctor']) ?></span><br/>
                Reason: <?= htmlspecialchars($a['reason']) ?><br/>
                Status: <strong class="status"><?= htmlspecialchars($a['status']) ?></strong><br/>
                <button class="btn small" onclick="editAppointment(<?= json_encode($a) ?>)">✏️ Edit</button>
                <button class="btn small danger" onclick="deleteAppointment(<?= $a['id'] ?>)">🗑️ Delete</button>
            </div>
        <?php endforeach; ?>
    </div>
</div>