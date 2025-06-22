<div style="display:flex;justify-content:space-between;align-items:center;">
    <h2>Patient Management</h2>
   <button type="button" class="btn" onclick="showModal('patientModal')">➕ Add New Patient</button>
</div>

<input type="text" id="patientSearch" placeholder="Search patients by name..." onkeyup="search(this.value, 'patients')" />



<div id="patientsList" class="patient-grid">
    <?php foreach ($patients as $p): ?>
        <div class="patient-card">
            <strong class="name"><?= htmlspecialchars($p['first_name'] . ' ' . $p['last_name']) ?></strong><br/>
            DOB: <?= htmlspecialchars($p['dob']) ?><br/>
            Gender: <?= htmlspecialchars($p['gender']) ?><br/>
            Phone: <?= htmlspecialchars($p['phone']) ?><br/>
            Email: <?= htmlspecialchars($p['email'] ?: 'Not provided') ?><br/>
            Emergency: <?= htmlspecialchars($p['emergency_contact'] ?: 'Not provided') ?>
        </div>
    <?php endforeach; ?>
</div>