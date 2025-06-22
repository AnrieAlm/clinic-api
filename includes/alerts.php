<?php if (isset($_SESSION['success'])): ?>
<div class="alert success"><?= htmlspecialchars($_SESSION['success']) ?></div>
<?php unset($_SESSION['success']); ?>
<?php elseif (isset($_SESSION['error'])): ?>
<div class="alert error"><?= htmlspecialchars($_SESSION['error']) ?></div>
<?php unset($_SESSION['error']); ?>
<?php endif; ?>