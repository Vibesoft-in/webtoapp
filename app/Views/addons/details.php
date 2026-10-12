<div class="addon-details-container">
    <div class="page-header">
        <h1><?= e($addon['name']) ?></h1>
        <p class="addon-category">Category: <?= ucfirst(e($addon['category'])) ?></p>
    </div>

    <div class="addon-info-card">
        <p class="description"><?= e($addon['description']) ?></p>
        <p class="price-tag">
            Price: ₹<?= number_format((float)$addon['price'], 2) ?> (<?= e($addon['billing_type']) ?>)
        </p>

        <div class="actions">
            <a href="<?= url('/addons') ?>" class="btn btn-secondary">Back to Add-ons</a>
        </div>
    </div>
</div>
