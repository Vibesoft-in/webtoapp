<div class="app-features-container">
    <div class="page-header">
        <h1>App Features & Add-ons</h1>
        <p>Enable or disable active add-on capabilities integrated into your mobile app.</p>
    </div>

    <?php if (!empty($features)): ?>
        <div class="features-list">
            <?php foreach ($features as $feature): ?>
                <div class="feature-item">
                    <div class="feature-info">
                        <h4>Feature: <?= ucfirst(str_replace('-', ' ', e($feature['feature_key']))) ?></h4>
                        <span>Status: <?= (int)$feature['is_enabled'] === 1 ? 'Enabled' : 'Disabled' ?></span>
                    </div>
                    <form action="<?= url('/dashboard/features/toggle') ?>" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="feature_id" value="<?= e($feature['id']) ?>">
                        <input type="hidden" name="is_enabled" value="<?= (int)$feature['is_enabled'] === 1 ? 0 : 1 ?>">
                        <button type="submit" class="btn btn-sm <?= (int)$feature['is_enabled'] === 1 ? 'btn-secondary' : 'btn-primary' ?>">
                            <?= (int)$feature['is_enabled'] === 1 ? 'Disable' : 'Enable' ?>
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No add-on features currently attached to this app.</p>
    <?php endif; ?>
</div>
