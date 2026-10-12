<div class="admin-section">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
        <h2>Supported Platforms &amp; API Configurations</h2>
    </div>

    <table class="table-standard">
        <thead>
            <tr>
                <th>Platform</th>
                <th>API Type</th>
                <th>Subtitle</th>
                <th>Setup Time</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($platforms as $p): ?>
                <tr>
                    <td><strong><?= e($p['name']) ?></strong> (<code><?= e($p['key']) ?></code>)</td>
                    <td><?= e($p['api_type']) ?></td>
                    <td><?= e($p['subtitle']) ?></td>
                    <td><?= e($p['setup_time']) ?></td>
                    <td><span class="badge badge-success">Active</span></td>
                    <td>
                        <a href="<?= url('/admin/platforms/' . $p['key'] . '/edit') ?>" class="btn btn-secondary" style="padding:0.35rem 0.75rem;font-size:0.8rem;">Edit Configuration</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
