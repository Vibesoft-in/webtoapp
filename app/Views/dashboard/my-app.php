<div class="my-app-container">
    <?php if ($app): ?>
        <div class="app-summary-card">
            <div class="app-header-info">
                <h2><?= e($app['app_name']) ?></h2>
                <span class="badge badge-primary"><?= ucfirst(e($app['status'])) ?></span>
            </div>

            <div class="app-details-grid">
                <div><strong>Package Name:</strong> <?= e($app['package_name']) ?></div>
                <div><strong>Version:</strong> <?= e($app['version']) ?></div>
                <div><strong>Primary Color:</strong> <span style="display:inline-block;width:16px;height:16px;background:<?= e($app['primary_color']) ?>;border-radius:4px;vertical-align:middle;"></span> <?= e($app['primary_color']) ?></div>
                <div><strong>Created On:</strong> <?= e($app['created_at']) ?></div>
            </div>

            <div class="app-quick-actions" style="margin-top:1.5rem;">
                <a href="<?= url('/dashboard/app-settings') ?>" class="btn btn-primary">Edit Settings & Colors</a>
                <a href="<?= url('/dashboard/features') ?>" class="btn btn-secondary">Manage Add-on Features</a>
                <a href="<?= url('/dashboard/builds') ?>" class="btn btn-secondary">Request App Build</a>
            </div>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <p>No active mobile app found.</p>
            <a href="<?= url('/convert') ?>" class="btn btn-primary">Convert Your First Website</a>
        </div>
    <?php endif; ?>
</div>
