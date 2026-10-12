<div class="admin-builds-container">
    <div class="page-header">
        <h1>Compilation Builds Queue</h1>
    </div>

    <table class="table-standard">
        <thead>
            <tr>
                <th>Build #</th>
                <th>App ID</th>
                <th>Platform</th>
                <th>Version</th>
                <th>Status</th>
                <th>Started At</th>
                <th>Artifacts</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($builds as $b): ?>
                <tr>
                    <td>#<?= (int)$b['build_number'] ?></td>
                    <td>#<?= (int)$b['app_id'] ?></td>
                    <td><?= strtoupper(e($b['platform'])) ?></td>
                    <td><?= e($b['version']) ?></td>
                    <td><span class="badge"><?= ucfirst(e($b['status'])) ?></span></td>
                    <td><?= e($b['started_at'] ?? '-') ?></td>
                    <td>
                        <?= !empty($b['apk_url']) ? '<a href="' . e($b['apk_url']) . '">APK</a> ' : '' ?>
                        <?= !empty($b['ipa_url']) ? '<a href="' . e($b['ipa_url']) . '">IPA</a>' : '' ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
