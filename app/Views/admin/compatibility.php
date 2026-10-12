<div class="admin-compatibility-container">
    <div class="page-header">
        <h1>Compatibility Reports Log</h1>
    </div>

    <table class="table-standard">
        <thead>
            <tr>
                <th>Report #</th>
                <th>Website ID</th>
                <th>Score</th>
                <th>Platform</th>
                <th>SSL</th>
                <th>API Status</th>
                <th>Mobile Score</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reports as $r): ?>
                <tr>
                    <td>#<?= (int)$r['id'] ?></td>
                    <td>#<?= (int)$r['website_id'] ?></td>
                    <td><strong><?= (int)$r['overall_score'] ?>%</strong></td>
                    <td><?= ucfirst(e($r['platform_status'])) ?></td>
                    <td><?= ucfirst(e($r['ssl_status'])) ?></td>
                    <td><?= ucfirst(e($r['api_status'])) ?></td>
                    <td><?= (int)$r['mobile_score'] ?>%</td>
                    <td><?= e($r['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
