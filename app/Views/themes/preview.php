<div class="theme-preview-container">
    <div class="page-header">
        <h1>Preview: <?= e($theme['name']) ?></h1>
        <p>Interactive preview container for <?= e($theme['name']) ?> theme styling.</p>
    </div>

    <div class="device-viewport-frame">
        <div class="mock-device-screen">
            <div class="mock-app-bar">
                <span>App Preview</span>
            </div>
            <div class="mock-app-body">
                <p>Live Theme Simulation for <?= e($theme['slug']) ?></p>
            </div>
        </div>
    </div>

    <div class="preview-actions">
        <form action="<?= url('/themes/select') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="theme_id" value="<?= e($theme['id']) ?>">
            <button type="submit" class="btn btn-primary">Select & Continue</button>
            <a href="<?= url('/themes') ?>" class="btn btn-secondary">Close Preview</a>
        </form>
    </div>
</div>
