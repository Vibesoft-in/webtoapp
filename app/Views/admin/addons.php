<div class="admin-addons-container">
    <div class="page-header">
        <h1>Add-ons & Features</h1>
    </div>

    <table class="table-standard">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Category</th>
                <th>Price</th>
                <th>Billing</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($addons as $a): ?>
                <tr>
                    <td>#<?= (int)$a['id'] ?></td>
                    <td><?= e($a['name']) ?></td>
                    <td><?= e($a['slug']) ?></td>
                    <td><?= ucfirst(e($a['category'])) ?></td>
                    <td>₹<?= number_format((float)$a['price'], 2) ?></td>
                    <td><?= e($a['billing_type']) ?></td>
                    <td><span class="badge"><?= ucfirst(e($a['status'])) ?></span></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
