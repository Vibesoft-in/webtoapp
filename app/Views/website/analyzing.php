<div class="analyzing-container">
    <div class="analyzing-card">
        <h2>Analyzing <?= e($website['domain'] ?? 'Website') ?></h2>
        <p class="status-message">Evaluating SSL security, platform endpoints, mobile viewport, and API responsiveness...</p>

        <div class="progress-bar-placeholder">
            <div class="spinner"></div>
        </div>

        <form id="checkForm" action="<?= url('/compatibility/check') ?>" method="POST" style="margin-top: 2rem;">
            <input type="hidden" name="website_id" value="<?= e($website['id']) ?>">
            <button type="submit" class="btn btn-secondary">Run Analysis Now</button>
        </form>
    </div>
</div>
