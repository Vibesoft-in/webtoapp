<div class="admin-apps-container">
    <div class="page-header">
        <h1>All Managed Mobile Apps</h1>
    </div>

    <table class="table-standard">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>App Name</th>
                <th>Package Name</th>
                <th>Status</th>
                <th>Version</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($apps as $app): ?>
                <tr>
                    <td>#<?= (int)$app['id'] ?></td>
                    <td>#<?= (int)$app['user_id'] ?></td>
                    <td><?= e($app['app_name']) ?></td>
                    <td><?= e($app['package_name']) ?></td>
                    <td><span class="badge"><?= ucfirst(e($app['status'])) ?></span></td>
                    <td><?= e($app['version']) ?></td>
                    <td><?= e($app['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
