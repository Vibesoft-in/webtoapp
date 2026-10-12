<div class="admin-websites-container">
    <div class="page-header">
        <h1>Analyzed Websites</h1>
    </div>

    <table class="table-standard">
        <thead>
            <tr>
                <th>ID</th>
                <th>Domain</th>
                <th>Platform</th>
                <th>SSL</th>
                <th>Status</th>
                <th>Last Checked</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($websites as $w): ?>
                <tr>
                    <td>#<?= (int)$w['id'] ?></td>
                    <td><a href="<?= e($w['url']) ?>" target="_blank"><?= e($w['domain']) ?></a></td>
                    <td><?= ucfirst(e($w['platform'])) ?></td>
                    <td><?= (int)$w['ssl_enabled'] === 1 ? 'Yes' : 'No' ?></td>
                    <td><span class="badge"><?= ucfirst(e($w['status'])) ?></span></td>
                    <td><?= e($w['last_checked_at'] ?? '-') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
