<div class="billing-container">
    <div class="page-header">
        <h1>Billing & Invoices</h1>
        <p>Review completed orders, invoices, and transaction histories.</p>
    </div>

    <div class="orders-history">
        <?php if (!empty($orders)): ?>
            <table class="table-standard">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= e($order['order_number']) ?></td>
                            <td>₹<?= number_format((float)$order['total_amount'], 2) ?></td>
                            <td><span class="badge badge-success"><?= ucfirst(e($order['status'])) ?></span></td>
                            <td><?= e($order['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No billing transactions found.</p>
        <?php endif; ?>
    </div>
</div>
