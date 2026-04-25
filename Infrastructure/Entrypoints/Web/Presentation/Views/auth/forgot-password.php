<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-box">
    <div class="auth-logo">U</div>
    <h2>Reset Password</h2>
    <p class="subtitle">Enter your email to receive reset instructions</p>
    
    <?php if (!empty($message)): ?>
        <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    
    <form action="?route=auth.forgot.send" method="POST">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="Enter your email">
            <?php if (!empty($errors['email'])): ?><span class="field-error"><?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Send Instructions</button>
    </form>
    
    <div class="auth-footer">
        <a href="?route=auth.login">Back to Sign In</a>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>