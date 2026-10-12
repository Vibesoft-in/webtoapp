<div class="admin-orders-container">
    <div class="page-header">
        <h1>Customer Orders</h1>
    </div>

    <table class="table-standard">
        <thead>
            <tr>
                <th>Order #</th>
                <th>User ID</th>
                <th>Plan ID</th>
                <th>Total Amount</th>
                <th>Currency</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $o): ?>
                <tr>
                    <td><?= e($o['order_number']) ?></td>
                    <td>#<?= (int)$o['user_id'] ?></td>
                    <td><?= $o['plan_id'] ? '#' . (int)$o['plan_id'] : '-' ?></td>
                    <td>₹<?= number_format((float)$o['total_amount'], 2) ?></td>
                    <td><?= e($o['currency']) ?></td>
                    <td><span class="badge"><?= ucfirst(e($o['status'])) ?></span></td>
                    <td><?= e($o['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
