<div class="admin-pricing-container">
    <div class="page-header">
        <h1>Pricing Plans</h1>
    </div>

    <table class="table-standard">
        <thead>
            <tr>
                <th>ID</th>
                <th>Plan Name</th>
                <th>Slug</th>
                <th>Price</th>
                <th>Billing Cycle</th>
                <th>Max Apps</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($plans as $p): ?>
                <tr>
                    <td>#<?= (int)$p['id'] ?></td>
                    <td><?= e($p['name']) ?></td>
                    <td><?= e($p['slug']) ?></td>
                    <td>₹<?= number_format((float)$p['price'], 2) ?></td>
                    <td><?= e($p['billing_cycle']) ?></td>
                    <td><?= (int)$p['max_apps'] ?></td>
                    <td><span class="badge"><?= ucfirst(e($p['status'])) ?></span></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
