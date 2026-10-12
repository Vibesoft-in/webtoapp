<div class="admin-improvement-requests-container">
    <div class="page-header">
        <h1>Website Improvement Requests</h1>
    </div>

    <table class="table-standard">
        <thead>
            <tr>
                <th>ID</th>
                <th>Website ID</th>
                <th>Issue Category</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requests as $req): ?>
                <tr>
                    <td>#<?= (int)$req['id'] ?></td>
                    <td>#<?= (int)$req['website_id'] ?></td>
                    <td><?= e($req['issue_type']) ?></td>
                    <td><?= e(substr($req['description'], 0, 80)) ?>...</td>
                    <td><span class="badge"><?= ucfirst(e($req['status'])) ?></span></td>
                    <td>
                        <form action="<?= url('/admin/improvement-requests/update') ?>" method="POST" style="display:inline-flex;gap:0.5rem;">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= e($req['id']) ?>">
                            <select name="status" class="form-control-sm">
                                <option value="pending" <?= $req['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="in_review" <?= $req['status'] === 'in_review' ? 'selected' : '' ?>>In Review</option>
                                <option value="resolved" <?= $req['status'] === 'resolved' ? 'selected' : '' ?>>Resolved</option>
                                <option value="rejected" <?= $req['status'] === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
