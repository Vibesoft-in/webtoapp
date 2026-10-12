<div class="app-settings-container">
    <div class="page-header">
        <h1>App Configuration & Branding</h1>
        <p>Customize your application name, branding color scheme, and visual assets.</p>
    </div>

    <?php if ($app): ?>
        <form action="<?= url('/dashboard/app-settings') ?>" method="POST" class="form-standard">
            <?= csrf_field() ?>
            <input type="hidden" name="app_id" value="<?= e($app['id']) ?>">

            <div class="form-group">
                <label for="app_name">Mobile App Display Name</label>
                <input type="text" id="app_name" name="app_name" value="<?= e($app['app_name']) ?>" required>
            </div>

            <div class="form-group">
                <label for="primary_color">Primary Theme Color</label>
                <input type="color" id="primary_color" name="primary_color" value="<?= e($app['primary_color']) ?>">
            </div>

            <div class="form-group">
                <label for="secondary_color">Secondary Accent Color</label>
                <input type="color" id="secondary_color" name="secondary_color" value="<?= e($app['secondary_color']) ?>">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save Settings</button>
            </div>
        </form>
    <?php else: ?>
        <p>Please configure an app first.</p>
    <?php endif; ?>
</div>
