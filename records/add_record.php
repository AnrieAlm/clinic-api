<?php
// Ensure this file is included from a valid context (e.g., dashboard.php)
if (!isset($patients)) {
    $patients = [];
}
?>

<!-- Add Medical Record Modal -->
<div id="recordModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="hideModal('recordModal')">&times;</span>
        <h3>Add Medical Record</h3>
        <form method="POST" action="save_record.php">
            <div class="form-group">
                <label>Patient:</label>
                <select name="patient_id" required>
                    <?php foreach ($patients as $p): ?>
                        <option value="<?= htmlspecialchars($p['id']) ?>">
                            <?= htmlspecialchars($p['first_name'] . ' ' . $p['last_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Diagnosis:</label>
                <textarea name="diagnosis" required></textarea>
            </div>
            <div class="form-group">
                <label>Treatment:</label>
                <textarea name="treatment" required></textarea>
            </div>
            <div class="form-group">
                <label>Notes:</label>
                <textarea name="notes"></textarea>
            </div>
            <div class="form-group">
                <label>Doctor:</label>
                <input type="text" name="doctor" required />
            </div>
            <button class="btn" type="submit">Save Record</button>
        </form>
    </div>
</div>