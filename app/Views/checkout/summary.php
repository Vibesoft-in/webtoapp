<div class="checkout-summary-container">
    <div class="page-header">
        <h1>Order Summary</h1>
        <p>Review your selected conversion configuration before proceeding to checkout.</p>
    </div>

    <div class="summary-grid">
        <div class="summary-details">
            <h3>Configuration Breakdown</h3>
            
            <div class="summary-line">
                <span>Selected Plan: <strong><?= e($plan['name']) ?></strong></span>
                <span>₹<?= number_format((float)$plan['price'], 2) ?></span>
            </div>

            <div class="summary-line">
                <span>Selected Theme: <strong><?= e($theme['name']) ?></strong></span>
                <span>₹<?= number_format((float)$theme['price'], 2) ?></span>
            </div>

            <?php if (!empty($addons)): ?>
                <h4>Selected Add-ons</h4>
                <?php foreach ($addons as $addon): ?>
                    <div class="summary-line line-sub">
                        <span>+ <?= e($addon['name']) ?></span>
                        <span>₹<?= number_format((float)$addon['price'], 2) ?></span>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <hr>

            <div class="summary-totals">
                <div class="summary-line">
                    <span>Subtotal</span>
                    <span>₹<?= number_format((float)$calculation['subtotal'], 2) ?></span>
                </div>
                <div class="summary-line">
                    <span>GST / Taxes (<?= (float)$calculation['tax_rate'] ?>%)</span>
                    <span>₹<?= number_format((float)$calculation['tax_amount'], 2) ?></span>
                </div>
                <div class="summary-line total-amount">
                    <strong>Total Payable</strong>
                    <strong>₹<?= number_format((float)$calculation['total_amount'], 2) ?></strong>
                </div>
            </div>
        </div>

        <div class="summary-action-card">
            <?php if (!empty($website)): ?>
                <div class="target-site-card">
                    <p>App Target Domain:</p>
                    <strong><?= e($website['domain']) ?></strong>
                </div>
            <?php endif; ?>

            <form action="<?= url('/checkout/pay') ?>" method="POST">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-primary btn-block">Proceed to Razorpay Payment</button>
            </form>
            <a href="<?= url('/addons') ?>" class="link-muted">Modify Add-on Selection</a>
        </div>
    </div>
</div>
