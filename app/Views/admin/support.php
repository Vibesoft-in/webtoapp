<div class="admin-support-container">
    <div class="page-header">
        <h1>Support Desk Tickets</h1>
    </div>

    <table class="table-standard">
        <thead>
            <tr>
                <th>Ticket #</th>
                <th>User ID</th>
                <th>Subject</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tickets as $t): ?>
                <tr>
                    <td><?= e($t['ticket_number']) ?></td>
                    <td>#<?= (int)$t['user_id'] ?></td>
                    <td><?= e($t['subject']) ?></td>
                    <td><?= ucfirst(e($t['priority'])) ?></td>
                    <td><span class="badge"><?= ucfirst(e($t['status'])) ?></span></td>
                    <td><?= e($t['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
