<div class="dashboard-overview-container">
    <div class="dashboard-stats-grid">
        <div class="stat-card">
            <span class="stat-title">Active Apps</span>
            <span class="stat-value"><?= count($apps) ?></span>
        </div>
        <div class="stat-card">
            <span class="stat-title">Total Orders</span>
            <span class="stat-value"><?= count($orders) ?></span>
        </div>
        <div class="stat-card">
            <span class="stat-title">Notifications</span>
            <span class="stat-value"><?= count($notifications) ?></span>
        </div>
    </div>

    <div class="dashboard-section">
        <h3>My Mobile Applications</h3>
        <?php if (!empty($apps)): ?>
            <div class="apps-table-container">
                <table class="table-standard">
                    <thead>
                        <tr>
                            <th>App Name</th>
                            <th>Package ID</th>
                            <th>Status</th>
                            <th>Version</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($apps as $app): ?>
                            <tr>
                                <td><?= e($app['app_name']) ?></td>
                                <td><?= e($app['package_name']) ?></td>
                                <td><span class="badge"><?= ucfirst(e($app['status'])) ?></span></td>
                                <td><?= e($app['version']) ?></td>
                                <td>
                                    <a href="<?= url('/dashboard/my-app') ?>" class="btn btn-sm">Manage</a>
                                    <a href="<?= url('/dashboard/builds') ?>" class="btn btn-sm btn-secondary">Builds</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <p>You have not configured any mobile apps yet.</p>
                <a href="<?= url('/convert') ?>" class="btn btn-primary">Start Website Conversion</a>
            </div>
        <?php endif; ?>
    </div>
</div>
