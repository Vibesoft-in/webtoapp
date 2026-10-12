<div class="builds-container">
    <div class="page-header">
        <h1>Build History & Generation</h1>
        <p>Request automated APK / AAB (Android) and IPA (iOS) package compilations.</p>
    </div>

    <?php if ($app): ?>
        <div class="trigger-build-card">
            <h3>Request New Binary Compilation</h3>
            <form action="<?= url('/dashboard/builds/trigger') ?>" method="POST" class="form-standard">
                <?= csrf_field() ?>
                <input type="hidden" name="app_id" value="<?= e($app['id']) ?>">

                <div class="form-group">
                    <label for="platform">Target Platform</label>
                    <select id="platform" name="platform">
                        <option value="android">Android (APK & Google Play AAB)</option>
                        <option value="ios">iOS (Apple App Store IPA)</option>
                        <option value="both">Both Platforms (Android + iOS)</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Queue Mobile Build</button>
                </div>
            </form>
        </div>
    <?php endif; ?>

    <div class="build-history-section" style="margin-top:2rem;">
        <h3>Build Log History</h3>
        <?php if (!empty($builds)): ?>
            <table class="table-standard">
                <thead>
                    <tr>
                        <th>Build #</th>
                        <th>Platform</th>
                        <th>Version</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Downloads</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($builds as $build): ?>
                        <tr>
                            <td>#<?= (int)$build['build_number'] ?></td>
                            <td><?= strtoupper(e($build['platform'])) ?></td>
                            <td><?= e($build['version']) ?></td>
                            <td><span class="badge"><?= ucfirst(e($build['status'])) ?></span></td>
                            <td><?= e($build['created_at']) ?></td>
                            <td>
                                <?php if (!empty($build['apk_url'])): ?>
                                    <a href="<?= e($build['apk_url']) ?>" class="btn btn-sm">Download APK</a>
                                <?php else: ?>
                                    <span class="text-muted">Compiling...</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No builds generated yet. Trigger a compilation above.</p>
        <?php endif; ?>
    </div>
</div>
