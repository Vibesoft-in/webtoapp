<div class="admin-dashboard-container">
    <div class="admin-stats-grid">
        <div class="stat-card">
            <span class="stat-title">Customers</span>
            <span class="stat-value"><?= (int)$userCount ?></span>
        </div>
        <div class="stat-card">
            <span class="stat-title">Converted Apps</span>
            <span class="stat-value"><?= (int)$appCount ?></span>
        </div>
        <div class="stat-card">
            <span class="stat-title">Orders</span>
            <span class="stat-value"><?= (int)$orderCount ?></span>
        </div>
        <div class="stat-card">
            <span class="stat-title">Gross Revenue</span>
            <span class="stat-value">₹<?= number_format((float)$totalRevenue, 2) ?></span>
        </div>
        <div class="stat-card">
            <span class="stat-title">Pending Improvements</span>
            <span class="stat-value"><?= (int)$pendingImprovements ?></span>
        </div>
    </div>

    <div class="admin-section" style="margin-top:2rem;">
        <h3>Recent Orders</h3>
        <table class="table-standard">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>User ID</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentOrders as $o): ?>
                    <tr>
                        <td><?= e($o['order_number']) ?></td>
                        <td>#<?= (int)$o['user_id'] ?></td>
                        <td>₹<?= number_format((float)$o['total_amount'], 2) ?></td>
                        <td><span class="badge"><?= ucfirst(e($o['status'])) ?></span></td>
                        <td><?= e($o['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
