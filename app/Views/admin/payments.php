<div class="admin-payments-container">
    <div class="page-header">
        <h1>Payment Transactions</h1>
    </div>

    <table class="table-standard">
        <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>
                <th>Gateway</th>
                <th>Gateway Order ID</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($payments as $p): ?>
                <tr>
                    <td>#<?= (int)$p['id'] ?></td>
                    <td>#<?= (int)$p['order_id'] ?></td>
                    <td><?= ucfirst(e($p['gateway'])) ?></td>
                    <td><?= e($p['gateway_order_id'] ?? '-') ?></td>
                    <td>₹<?= number_format((float)$p['amount'], 2) ?></td>
                    <td><span class="badge"><?= ucfirst(e($p['status'])) ?></span></td>
                    <td><?= e($p['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
