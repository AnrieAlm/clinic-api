<!-- add_patient.php -->
<form method="POST" action="save_patient.php">
    <div class="form-group">
        <label>First Name:</label>
        <input type="text" name="first_name" required />
    </div>
    <div class="form-group">
        <label>Last Name:</label>
        <input type="text" name="last_name" required />
    </div>
    <div class="form-group">
        <label>Date of Birth:</label>
        <input type="date" name="dob" required />
    </div>
    <div class="form-group">
        <label>Gender:</label>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
    </div>
    <div class="form-group">
        <label>Phone:</label>
        <input type="text" name="phone" required />
    </div>
    <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" />
    </div>
    <div class="form-group">
        <label>Address:</label>
        <textarea name="address"></textarea>
    </div>
    <div class="form-group">
        <label>Emergency Contact:</label>
        <input type="text" name="emergency_contact" />
    </div>
    <button class="btn" type="submit">Save Patient</button>
</form>