<div class="admin-customers-container">
    <div class="page-header">
        <h1>Customer Management</h1>
    </div>

    <table class="table-standard">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Joined</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $c): ?>
                <tr>
                    <td>#<?= (int)$c['id'] ?></td>
                    <td><?= e($c['name']) ?></td>
                    <td><?= e($c['email']) ?></td>
                    <td><?= e($c['phone'] ?? '-') ?></td>
                    <td><span class="badge"><?= ucfirst(e($c['status'])) ?></span></td>
                    <td><?= e($c['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
