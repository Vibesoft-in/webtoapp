<div class="improvement-form-container">
    <div class="page-header">
        <h1>Submit Website Improvement Request</h1>
        <p>Your website requires technical adjustments before mobile app generation can be initialized.</p>
    </div>

    <div class="form-card">
        <form action="<?= url('/website/improvement-submit') ?>" method="POST" class="form-standard">
            <?= csrf_field() ?>
            <input type="hidden" name="website_id" value="<?= e($website['id'] ?? '') ?>">

            <div class="form-group">
                <label>Website URL</label>
                <input type="text" value="<?= e($website['url'] ?? '') ?>" disabled>
            </div>

            <div class="form-group">
                <label for="issue_type">Improvement Category</label>
                <select id="issue_type" name="issue_type" required>
                    <option value="ssl_certificate">SSL / HTTPS Configuration Issue</option>
                    <option value="api_endpoint">REST API Access & Authentication Setup</option>
                    <option value="mobile_responsive">Mobile Viewport & Responsive Design Fixes</option>
                    <option value="plugin_conflict">WordPress / WooCommerce Plugin Incompatibility</option>
                    <option value="shopify_storefront">Shopify Private App / Storefront Access</option>
                    <option value="custom_other">Custom Architecture Support</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Detailed Description of Request</label>
                <textarea id="description" name="description" rows="5" required placeholder="Describe any specific server setup or assistance needed to make your site compatible..."></textarea>
            </div>

            <div class="form-group">
                <label for="notes">Additional Notes / Contact Information</label>
                <textarea id="notes" name="notes" rows="3" placeholder="Provide any alternate contact email or instructions..."></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Submit Improvement Request</button>
                <a href="<?= url('/compatibility-result?id=' . ($website['id'] ?? '')) ?>" class="btn btn-secondary">Back to Audit</a>
            </div>
        </form>
    </div>
</div>
