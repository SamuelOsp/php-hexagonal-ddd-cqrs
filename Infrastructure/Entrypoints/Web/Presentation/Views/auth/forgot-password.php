<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="container">
    <div class="card">
        <div class="card-logo">U</div>
        <h1 class="card-title">Reset Password</h1>
        <p class="card-subtitle">Enter your email to receive reset instructions</p>

        <?php if (!empty($message)): ?>
            <div class="alert-error"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert-success"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <form method="POST" action="?route=auth.forgot.send">
            <div class="form-group">
                <input type="email" name="email" placeholder="Enter your email"
                       value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required autofocus>
            </div>
            <button type="submit" class="btn btn-primary">Send Reset Link</button>
        </form>

        <div class="card-footer">
            <a href="?route=auth.login">Back to Sign In</a>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
