<div style="display:flex;justify-content:space-between;align-items:center;">
    <h2>Medical Records</h2>
    <button class="btn" onclick="showModal('recordModal')">➕ Add Record</button>
</div>
<input type="text" placeholder="Search records..." onkeyup="search(this.value, 'records')" />
<div id="recordsList" class="record-grid">
    <?php foreach ($medicalRecords as $r): ?>
        <div class="record-card">
            <strong class="name"><?= htmlspecialchars($r['first_name'] . ' ' . $r['last_name']) ?></strong><br/>
            Diagnosis: <?= htmlspecialchars($r['diagnosis']) ?><br/>
            Treatment: <?= htmlspecialchars($r['treatment']) ?><br/>
            Notes: <?= htmlspecialchars($r['notes']) ?><br/>
            Doctor: <span class="doctor"><?= htmlspecialchars($r['doctor']) ?></span><br/>
            Date: <span class="date"><?= htmlspecialchars(date('F j, Y', strtotime($r['date_recorded']))) ?></span>
        </div>
    <?php endforeach; ?>
</div>