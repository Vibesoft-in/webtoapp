<div class="addons-container">
    <div class="page-header">
        <h1>Select Native Features & Add-ons</h1>
        <p>Boost your mobile app engagement with push notifications, WhatsApp chat, analytics, and more.</p>
    </div>

    <form action="<?= url('/addons/select') ?>" method="POST">
        <?= csrf_field() ?>

        <div class="addons-grid">
            <?php foreach ($addons as $addon): ?>
                <div class="addon-card">
                    <div class="addon-header">
                        <h3><?= e($addon['name']) ?></h3>
                        <span class="addon-price">+₹<?= number_format((float)$addon['price'], 2) ?></span>
                    </div>
                    <p><?= e($addon['description']) ?></p>
                    <div class="addon-toggle">
                        <label class="checkbox-label">
                            <input type="checkbox" name="addon_ids[]" value="<?= e($addon['id']) ?>" <?= in_array((int)$addon['id'], $selectedAddons ?? []) ? 'checked' : '' ?>>
                            Include in Mobile Build
                        </label>
                        <a href="<?= url('/addons/' . e($addon['slug'])) ?>" class="link-muted">Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="form-submit-bar" style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Proceed to Order Summary</button>
        </div>
    </form>
</div>
