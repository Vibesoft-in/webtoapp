<div class="checkout-success-container">
    <div class="success-card">
        <div class="success-icon">&#10004;</div>
        <h1>Payment Successful!</h1>
        <p>Thank you for your order. Your mobile app project has been created and initialized.</p>

        <?php if (!empty($order)): ?>
            <div class="order-details-box">
                <p>Order Reference: <strong><?= e($order['order_number']) ?></strong></p>
                <p>Total Paid: <strong>₹<?= number_format((float)$order['total_amount'], 2) ?></strong></p>
                <p>Status: <span class="badge badge-success"><?= ucfirst(e($order['status'])) ?></span></p>
            </div>
        <?php endif; ?>

        <div class="success-actions">
            <a href="<?= url('/dashboard/my-app') ?>" class="btn btn-primary">Configure Your Mobile App</a>
            <a href="<?= url('/dashboard') ?>" class="btn btn-secondary">Go to Customer Dashboard</a>
        </div>
    </div>
</div>
