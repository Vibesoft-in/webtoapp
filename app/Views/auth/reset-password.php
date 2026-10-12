<div class="auth-box">
    <h2>Set New Password</h2>

    <form action="<?= url('/reset-password') ?>" method="POST" class="form-standard">
        <?= csrf_field() ?>
        <input type="hidden" name="token" value="<?= e($token ?? '') ?>">

        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" id="password" name="password" required autocomplete="new-password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Password</button>
        </div>
    </form>
</div>
