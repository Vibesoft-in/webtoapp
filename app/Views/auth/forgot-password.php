<div class="auth-box">
    <h2>Reset Password</h2>
    <p class="auth-desc">Enter your account email to receive a password recovery link.</p>

    <form action="<?= url('/forgot-password') ?>" method="POST" class="form-standard">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required autocomplete="email">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Send Recovery Link</button>
            <a href="<?= url('/login') ?>" class="link-muted">Back to Sign In</a>
        </div>
    </form>
</div>
