<div class="admin-section" style="max-width:800px;margin:0 auto;">
    <h2>Edit Platform: <?= e($platform['name']) ?></h2>
    <p style="color:var(--text-secondary);margin-bottom:1.5rem;">Update the public API requirements, description, and setup parameters for this integration.</p>

    <div class="form-card">
        <form action="<?= url('/admin/platforms/' . $platform['key'] . '/update') ?>" method="POST" class="form-standard">
            <?= csrf_field() ?>

            <div class="form-group">
                <label>Platform Name</label>
                <input type="text" name="name" value="<?= e($platform['name']) ?>" required>
            </div>

            <div class="form-group">
                <label>Subtitle / Authentication Method</label>
                <input type="text" name="subtitle" value="<?= e($platform['subtitle']) ?>" required>
            </div>

            <div class="form-group">
                <label>API Type</label>
                <input type="text" name="api_type" value="<?= e($platform['api_type']) ?>" required>
            </div>

            <div class="form-group">
                <label>Estimated Setup Time</label>
                <input type="text" name="setup_time" value="<?= e($platform['setup_time']) ?>" required>
            </div>

            <div class="form-group">
                <label>Description / Guidance</label>
                <textarea name="description" rows="3" required><?= e($platform['description']) ?></textarea>
            </div>

            <div class="form-actions" style="margin-top:1.5rem;display:flex;gap:1rem;">
                <button type="submit" class="btn btn-primary">Save Platform Changes</button>
                <a href="<?= url('/admin/platforms') ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
